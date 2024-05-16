let originalProductsCount = 0;
let originalProductIdsArray = [];
const orderId = getOrderIdFromURL();
document.addEventListener('DOMContentLoaded', function() {
  loadOrders(orderId);
  loadOrderDetails(orderId);}
);

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
  document.getElementById('memberId').value = data.user_id;
  document.getElementById('memberId').disabled = true;
  document.getElementById('memberName').value = data.name;
  document.getElementById('memberName').disabled = true;
  document.querySelectorAll('[name="paymentMethod"]').forEach(radio=> {
    radio.disabled = true;
    radio.value === data.payment_method ? radio.checked = true : radio.checked = false;
  });


  document.getElementById('orderStatus').value = data.order_id;

  document.getElementById('orderStatus').value = data.order_status_id;
  
  document.getElementById('recipientName').value = data.recipient_name;
  document.getElementById('recipientMobile').value = data.recipient_mobile;
  
  document.getElementById('city').value = data.order_city_id;
  document.getElementById('district').value = data.order_district_id;
  updateCitySelect(data.order_city_id, data.order_district_id);
  document.getElementById('address').value = data.order_address;

  if (data.member_carrier == 1) {
    document.getElementById('useMemberInvoice').checked = true;
    document.querySelector('.mobile-invoice-div').classList.add('d-none');
    document.querySelector('.tax-id-div').classList.add('d-none');
  }

  if (data.recipient_invoice_carrier !== null) {
    document.getElementById('useMobileInvoice').checked = true;
    document.getElementById('mobileInvoice').value = data.recipient_invoice_carrier;
    document.querySelector('.tax-id-div').classList.add('d-none');
  }

  if (data.recipient_tax_id !== null) {
    document.getElementById('useTaxId').checked = true;
    document.getElementById('taxId').value = data.recipient_tax_id;
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
        originalProductIdsArray = data.map(item => item.order_product_id);
        console.log('originalProductsCount'+originalProductsCount);
        console.log('originalProductIdsArray'+originalProductIdsArray);

        data.forEach((item, index) => {
          const productCardHtml = `
            <div class="col-12 position-relative order-item mb-4">
              <h6 class="mb-3">(${item.order_product_id}) ${item.product_name}</h6>
              <button type="button" class="delete-item delete-product"><i class="fa-solid fa-xmark"></i></button>
              <div class="col-4 mb-3">
                <input type="number" class="form-control" id="productQuantity${index + 1}" name="productQuantities[]" value="${item.order_quantity}" placeholder="商品數量">
                <span class="helper-text"></span>
              </div>
              <span class="stock-quantity">剩餘庫存：${item.stock_quantity}</span>
              <p class="mb-0">商品單價：${item.order_unit_price}</p>
              <p class="mb-0">商品總金額：<span class="product-total-price">${item.order_quantity * item.order_unit_price}</span></p>
              <input type="text" class="d-none" id="productId${index + 1}" name="productIds[]" value="${item.order_product_id}">
              <input type="number" class="d-none" id="productUnitPrice${index + 1}" name="productUnitPrices[]" value="${item.order_unit_price}">
            </div>`;
          orderItemContainer.insertAdjacentHTML('beforeend', productCardHtml);
          updateOrderTotal();
          addedProductIds.add(item.order_product_id);
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


    // orderItemContainer.addEventListener("input", function (event) {
    //   // 檢查是否是商品數量的輸入框引發了事件
    //   if (event.target.name === "productQuantities[]") {
    //     const quantityInput = event.target;
    //     // 將輸入的數字轉成整數
    //     let quantityValue = parseInt(quantityInput.value, 10);
    //     const orderItem = quantityInput.closest(".order-item"); // 取得商品卡片
    //     const stockSpan = orderItem.querySelector(".stock-quantity").textContent; // 取得庫存 span
    //     const stockQuantity = parseInt(stockSpan.split("：")[1]); // 將庫存 span 的字串以：分開，取 index[1]
    //     const helperText = orderItem.querySelector(".helper-text"); // 獲取對應的 helper text
  
    //     // 設置最小值和最大值(庫存量)
    //     quantityInput.min = 1;
    //     quantityInput.max = stockQuantity;
  
    //     if (quantityValue > stockQuantity) {
    //       quantityInput.value = stockQuantity; // 如果輸入的值大於庫存，自動修正為庫存的最大值
    //       helperText.textContent = "訂購商品數量不足";
    //     } else if (quantityValue < 1) {
    //       quantityInput.value = 1; // 如果輸入的值小於1，自動修正為1
    //       helperText.textContent = "最低訂購數量1";
    //     } else {
    //       quantityInput.value = quantityValue; // 轉為整數
    //       helperText.textContent = ""; // 清除任何錯誤消息
    //     }
        
    //   }
    // });

}



