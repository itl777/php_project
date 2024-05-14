let originalProductsCount = 0;
let originalProductIdsArray = [];
const orderId = getOrderIdFromURL();
loadOrders(orderId);
loadOrderDetails(orderId);

// 從 url 取得訂單編號
function getOrderIdFromURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('id');
}

// 取得訂單編號的資料
function loadOrders(orderId) {
  fetch(`api/get-order-api.php?id=${orderId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.error) {
          console.error(data.error);
          alert(data.error);
        } else {
          displayOrders(data);
          loadAddress();
        }
      })
      .catch(error => {
          console.error('Error:', error);
      });
}



function displayOrders(data) {
  document.getElementById('orderId').value = data.order_id;
  document.getElementById('orderDate').value = data.order_date;
  document.getElementById('orderDate').disabled = true;
  document.getElementById('memberId').value = data.member_id;
  document.getElementById('memberId').disabled = true;
  document.getElementById('memberName').value = data.member_name;
  document.getElementById('memberName').disabled = true;
  document.querySelectorAll('[name="paymentMethod"]').forEach(radio=> {
    radio.disabled = true;
    radio.value === data.payment_method ? radio.checked = true : radio.checked = false;
  });
  document.getElementById('recipientName').value = data.recipient_name;
  document.getElementById('recipientMobile').value = data.order_mobile_phone;
  
  document.getElementById('city').value = data.order_city_id;
  document.getElementById('district').value = data.order_district_id;
  updateCitySelect(data.order_city_id, data.order_district_id);
  document.getElementById('address').value = data.address;

  if (data.member_carrier) {
    document.getElementById('useMemberInvoice').checked = true;
    document.querySelector('.mobile-invoice-div').classList.add('d-none');
    document.querySelector('.tax-id-div').classList.add('d-none');
  }

  if (data.order_invoice_carrier) {
    document.getElementById('useMobileInvoice').checked = true;
    document.getElementById('mobileInvoice').value = data.order_invoice_carrier;
    document.querySelector('.tax-id-div').classList.add('d-none');
  }

  if (data.order_tax_id) {
    document.getElementById('useTaxId').checked = true;
    document.getElementById('taxId').value = data.order_tax_id;
    document.querySelector('.mobile-invoice-div').classList.add('d-none');
  }
  
}

function updateCitySelect(cityIdToSelect, districtIdToSelect) {
  const citySelect = document.getElementById("city");

  fetch("api/get-city-api.php")
    .then((response) => response.json())
    .then((data) => {
      citySelect.innerHTML = ""; // 清空既有選項
      data.forEach((city) => {
        let option = new Option(city.city_name, city.id);
        citySelect.add(option);
      });
      citySelect.value = cityIdToSelect; // 設定當前城市
      updateDistrictOptions(cityIdToSelect, districtIdToSelect); // 更新區域選項
    });
}




function loadOrderDetails(orderId) {
  const orderItemContainer = document.querySelector('.order-item-container');  // 商品清單 container

  fetch(`api/get-order-detail-api.php?id=${orderId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((data) => {
      if (data.error) {
        console.error(data.error);
        return;
      }
      if (data.length > 0) {
        originalProductsCount = data.length;
        originalProductIdsArray = data.map(item => item.product_id);
        console.log('originalProductsCount'+originalProductsCount);
        console.log('originalProductIdsArray'+originalProductIdsArray);

        data.forEach((item, index) => {
          const productCardHtml = `
            <div class="col-12 position-relative order-item mb-4">
              <h6 class="mb-3">(${item.product_id}) ${item.product_name} ${index + 1}</h6>
              <button type="button" class="delete-item delete-product"><i class="fa-solid fa-xmark"></i></button>
              <div class="col-4 mb-3">
                <input type="number" class="form-control" id="productQuantity${index + 1}" name="productQuantities[]" value="${item.ordered_quantity}" placeholder="商品數量">
              </div>
              <span>剩餘庫存：${item.stock_quantity-item.ordered_quantity}</span>
              <p class="mb-0">商品單價：${item.order_unit_price}</p>
              <p class="mb-0">商品總金額：<span class="product-total-price">${item.ordered_quantity * item.order_unit_price}</span></p>
              <input type="text" class="d-none" id="productId${index + 1}" name="productIds[]" value="${item.product_id}">
              <input type="number" class="d-none" id="productUnitPrice${index + 1}" name="productUnitPrices[]" value="${item.order_unit_price}">
            </div>`;
          orderItemContainer.insertAdjacentHTML('beforeend', productCardHtml);
          updateOrderTotal();
          addedProductIds.add(item.product_id);
          orderItemNum = originalProductsCount + 1;
        });
      } else {
        orderItemContainer.innerHTML = '<p>No products found.</p>';
      }
    })
    .catch((error) => {
      console.error('Error loading order details:', error);
      orderItemContainer.innerHTML = '<p>Error loading order details.</p>';
    });
}
