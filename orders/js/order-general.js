// 清空會員相關欄位
function clearMemberFields() {
  document.getElementById("memberId").value = "";
  document.getElementById("memberName").value = "";
  document.getElementById("recipientName").value = "";
  document.getElementById("recipientMobile").value = "";
  document.getElementById("city").value = "";
  document.getElementById("district").value = "";
  document.getElementById("address").value = "";
  document.getElementById("mobileInvoice").value = "";
}

// 清空收件人相關欄位
function clearRecipientFields() {
  document.getElementById("recipientName").value = "";
  document.getElementById("recipientMobile").value = "";
  document.getElementById("city").value = "";
  document.getElementById("district").value = "";
  document.getElementById("address").value = "";
}

// 清空發票相關欄位
function clearInvoiceFields() {
  document.getElementById("mobileInvoice").value = "";
  document.getElementById("taxId").value = "";
}



// disabled 收件人相關欄位
function disabledRecipientInput () {
  document.querySelectorAll('.new-address input').forEach(input => {
    input.disabled = true;
  });
  document.querySelectorAll('.new-address select').forEach(input => {
    input.disabled = true;
  });
}

// 取消 disabled 收件人相關欄位
function enabledRecipientInput () {
  document.querySelectorAll('.new-address input').forEach(input => {
    input.disabled = false;
  });
  document.querySelectorAll('.new-address select').forEach(input => {
    input.disabled = false;
  });
}

// 確認欄位是否有值
function emptyChecked (value) {
  if (value == null) return false;
  if (typeof value === 'string' && value.trim() === '') return false;
  if (Array.isArray(value) && value.length === 0) return false;
  if (typeof value === 'object' && value.constructor === Object && Object.keys(value).length === 0) return false;

  return true;
}


// 手機驗證欄位
function validatePhoneNumber(element) {
  const regex = /^[+-]?\d+$/;
  element.nextElementSibling.textContent = regex.test(element.value) ? '' : '請勿輸入特殊符號';
}

// 姓名欄位驗證
function validateName(element) {
  const regex = /^[a-zA-Z\u4e00-\u9fa5 ]*$/;
  element.nextElementSibling.textContent = regex.test(element.value) ? '' : '姓名只能包含中文、英文和空格';
}

// 地址欄位驗證
function validateAddress(element) {
  const regex = /^[a-zA-Z\u4e00-\u9fa5\d]*$/;
  element.nextElementSibling.textContent = regex.test(element.value) ? '' : '地址只能包含中文、英文和數字，不能有空格';
}

// 手機載具驗證
function validateMobileCarrier(element) {
  const regex = /^\/[0-9A-Z.-]{7}$/;
  element.nextElementSibling.textContent = regex.test(element.value) ? '' : '手機載具格式錯誤';
}

// 統一編號驗證
function validateTaxID(element) {
  const regex = /^\d{8}$/;
  element.nextElementSibling.textContent = regex.test(element.value) ? '' : '統一編號格式錯誤';
}

document.addEventListener('DOMContentLoaded', function () {
    const recipientNameInput = document.getElementById('recipientName');
    const recipientMobileInput = document.getElementById('recipientMobile');
    const addressInput = document.getElementById('address');
    const mobileInvoiceInput = document.getElementById('mobileInvoice');
    const taxIdInput = document.getElementById('taxId');

    recipientMobileInput.addEventListener('change', function () {
        validatePhoneNumber(this);
    });

    recipientName.addEventListener('change', function () {
      validateName(this);
  });


    addressInput.addEventListener('change', function () {
        validateAddress(this);
    });

    mobileInvoiceInput.addEventListener('change', function () {
        validateMobileCarrier(this);
    });

    taxIdInput.addEventListener('change', function () {
        validateTaxID(this);
    });




});

