document.addEventListener('DOMContentLoaded', function () {
  const modalBody = document.querySelector('#addressModal .modal-body');

  // 點擊會員編號選項後載入會員地址
  document.querySelector('.member-id-dropdown').addEventListener('click', function () {
    loadAddress();
  });
  



  document.querySelector('#addressModal .btn-primary').addEventListener('click', function () {
    const selectedAddress = document.querySelector('input[name="groupAddress"]:checked');
    if (selectedAddress) {
      document.getElementById('recipientName').value = selectedAddress.dataset.recipientName;
      document.getElementById('recipientMobile').value = selectedAddress.dataset.recipientMobile;
      document.getElementById('city').value = selectedAddress.dataset.cityId;
      document.getElementById('district').value = selectedAddress.dataset.districtId;
      document.getElementById('address').value = selectedAddress.dataset.address;
  
      updateDistrictOptions(selectedAddress.dataset.cityId, selectedAddress.dataset.districtId);
      
      // bootstrap.Modal.getInstance(addressModal).hide();
      let modalElement = document.getElementById('addressModal');
      let modalInstance = bootstrap.Modal.getInstance(modalElement);
      modalInstance.hide();
    } else {
      alert('請選擇一個地址。');
    }
  });
});

  // 透過會員 id 查詢地址
  function loadAddress() {
    const memberId = document.getElementById('memberId').value;
    const modalBody = document.querySelector('#addressModal .modal-body');

    if (!memberId) {
      console.log('無會員編號');
      modalBody.innerHTML = '<p>請提供會員編號</p>';
      return;
    }

    fetch(`api/get-member-address-api.php?memberId=${encodeURIComponent(memberId)}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // 清空原本的內容
        modalBody.innerHTML = '';
        let defaultAddressTimeOut = false;

        if (data.success && data.addresses && data.addresses.length > 0) {
          data.addresses.forEach(address => {
            const radioHtml = `
              <div class="form-check position-relative mb-3 saved-address-row">
                <input class="form-check-input" type="radio" name="groupAddress" id="address${address.id}" data-city-id="${address.cityId}" data-district-id="${address.districtId}" data-address="${address.address}" data-recipient-name="${address.recipientName}" data-city-name="${address.cityName}" data-district-name="${address.districtName}" data-recipient-mobile="${address.recipientMobile}" value="">
                <label class="form-check-label" for="address${address.id}">【${address.recipientName}】${address.fullAddress} ${address.recipientMobile}</label>
              </div>
            `;
            modalBody.innerHTML += radioHtml;
            memberDefaultAddress = false;
            console.log(memberDefaultAddress);
            
            if (address.defaultAddress == 1 && document.getElementById('useSavedAddress').checked == true) {
              document.getElementById('recipientName').value = address.recipientName;
              document.getElementById('recipientMobile').value = address.recipientMobile;
              document.getElementById('city').value = address.cityId;
              document.getElementById('district').value = address.districtId;
              document.getElementById('address').value = address.address;
              document.querySelector('.address-helper-text').textContent = ''; //清空 helper text

              updateDistrictOptions(address.cityId, address.districtId);

              if (document.getElementById('recipientName').parentElement.querySelector('.helper-text').textContent !== '') {
                clearErrorFor(recipientName);
              }
              if (document.getElementById('recipientMobile').parentElement.querySelector('.helper-text').textContent !== '') {
                clearErrorFor(recipientMobile);
              }
              if (document.getElementById('city').parentElement.querySelector('.helper-text').textContent !== '') {
                clearErrorFor(city);
              }
              if (document.getElementById('district').parentElement.querySelector('.helper-text').textContent !== '') {
                clearErrorFor(district);
              }
              if (document.getElementById('address').parentElement.querySelector('.helper-text').textContent !== '') {
                document.getElementById('address').parentElement.querySelector('.helper-text').textContent = '';
                // clearErrorFor(address);
              }


              if (!defaultAddressTimeOut) {
                setTimeout(() => {
                  document.getElementById('address'+address.id).checked = true;
                  defaultAddressTimeOut = true;
                }, 0);
              }
            }

          });
        } else {
          modalBody.innerHTML = '查無地址';
        }
      })
      .catch(error => {
        console.error('Error loading addresses:', error);
        modalBody.innerHTML = '<p>載入地址失敗</p>';
      });
  }
