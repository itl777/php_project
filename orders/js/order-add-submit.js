document.orderAddForm.addEventListener('submit', function (e) {
  e.preventDefault();

  if (validateForm()) {
    toggleFormElements(true); 
    invoicePrepareToSubmit();
    submitForm();
    if (saveToMembersOrNot()){
      memberInvoiceSubmit();
    } 
  }
});


document.addEventListener('DOMContentLoaded', function () {

  document.querySelector('#addressModal .btn-primary').addEventListener ('click', function () {
    clearErrorFor(recipientName);
    clearErrorFor(recipientMobile);
    clearErrorFor(city);
    clearErrorFor(district);
    clearErrorFor(address);
  });


  document.querySelector('.product-id-dropdown').addEventListener ('click', function () {
    if (document.querySelector('.product-helper-text').textContent !== '') {
      document.querySelector('.product-helper-text').textContent = '';
    }
  });

  document.getElementById('useMemberInfo').addEventListener ('change', function () {
    if (document.getElementById('memberId').value !== '') {
      clearErrorFor(recipientName);
      clearErrorFor(recipientMobile);
    }
  });

  document.querySelector('.member-id-dropdown').addEventListener ('click', function () {
    if (document.getElementById('useMemberInfo').checked) {
      clearErrorFor(recipientName);
      clearErrorFor(recipientMobile);
    }
  });

});


function toggleFormElements(disable = true) {
  // 如果使用常用地址欄位會 disabled，因此要把它取消
  setDisabled(['recipientName', 'recipientMobile', 'district', 'address'], false)
  // 只需要拋 district_id，因此 disabled city_id
  setDisabled(['city'], disable);

  // 隱藏所有 radio, select group name（不需拋到資料庫）
  document.querySelectorAll('[name^="group"]').forEach(input => {
    input.removeAttribute('name');
  });

  // 補回去 useMemberInvoice 選項（用來傳遞 0 or 1）
  const useMemberInvoice = document.getElementById('useMemberInvoice');
  useMemberInvoice.setAttribute('name', 'memberInvoice');
  useMemberInvoice.checked ? useMemberInvoice.value = 1 : useMemberInvoice.value = 0;

  // invoiceOptions();
}

function restoreFormState() {
  toggleFormElements(false);
}

// 快速設定 input disabled 函式
function setDisabled(ids, disabledStatus) {
  ids.forEach(id => {
    const element = document.getElementById(id);
    if (element) {
      element.disabled = disabledStatus;
    }
  });
}

// 設定錯誤訊息
function setErrorFor(inputElement, message) {
  // 取 input 父層向下的 span helper-text
  const helperText = inputElement.parentElement.querySelector('.helper-text');
  helperText.textContent = message;

  // 如有有輸入，則隱藏內容
  inputElement.addEventListener('input', function() {
    if (this.value.trim() !== '') {
      helperText.textContent = ''
    } else {
      helperText.textContent = message;
    }
  });
}

// 清空錯誤訊息
function clearErrorFor(inputElement) {
  const helperText = inputElement.parentElement.querySelector('.helper-text');
  helperText.textContent = '';
  // helperText.style.visibility = 'hidden';
}

// 錯誤驗證
function validateForm() {
  let isValid = true;
  const fieldsToCheck = [
    { id: 'orderDate', message: '請選擇訂單日期' },
    { id: 'memberId', message: '請輸入會員' },
    { id: 'recipientName', message: '請輸入收件人姓名' },
    { id: 'recipientMobile', message: '請輸入收件人手機' },
    { id: 'city', message: '請選擇縣市' },
    { id: 'district', message: '請選擇鄉鎮市區' },
    { id: 'address', message: '請輸入地址' },
  ];

  fieldsToCheck.forEach(field => {
    const inputElement = document.getElementById(field.id);
    if (inputElement.value.trim() === '' || inputElement.value === '請選擇') {
      setErrorFor(inputElement, field.message);
      isValid = false;
    } else {
      clearErrorFor(inputElement);
    }
  });

  // 手機載具與統一編號
  const mobileInvoiceInput = document.getElementById('mobileInvoice');
  const taxIdInput = document.getElementById('taxId');

  if (document.getElementById('useMobileInvoice').checked && mobileInvoiceInput.value.trim() === '') {
    setErrorFor(mobileInvoiceInput, '請輸入手機載具');
    isValid = false;
  }

  if (document.getElementById('useTaxId').checked && taxIdInput.value.trim() === '') {
    setErrorFor(taxIdInput, '請輸入統一編號');
    isValid = false;
  }

  // 商品驗證
  if (document.querySelectorAll('.order-item').length < 1) {
    document.querySelector('.product-helper-text').textContent = '請選擇至少一個商品';
    isValid = false;
  }

  return isValid;
}



function submitForm() {
  const fd = new FormData(document.orderAddForm);
  fetch('api/order-add-api.php', {
    method: 'POST',
    body: fd,
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('新增成功');
      location.href = 'order-list.php';
    } else {
      alert('新增失敗，請檢查資料是否正確。');
      console.log(data);
      // 新增失敗後，原本為了提交表單而變更的欄位狀態、value 都改回成原本的
      restoreFormState();
      toggleFormElements(false); 
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('發生錯誤，請稍後再試');
    restoreFormState();
    toggleFormElements(false); 
  });
}

function saveToMembersOrNot () {
  const useMobileInvoice = document.getElementById('useMobileInvoice').checked;
  const saveMobileInvoice = document.getElementById('saveMobileInvoice').checked;
  const mobileInvoice = document.getElementById('mobileInvoice').value;
  const useTaxId = document.getElementById('useTaxId').checked;
  const saveTaxId = document.getElementById('saveTaxId').checked;
  const taxId = document.getElementById('taxId').value;

  if (useMobileInvoice && saveMobileInvoice && emptyChecked(mobileInvoice)) {
    return true;
  } else if (useTaxId && saveTaxId && emptyChecked(taxId)) {
    return true;
  } else {
    return false;
  }
}

function memberInvoiceSubmit() {
  const memberId = document.getElementById('memberId').value;
  const useMobileInvoice = document.getElementById('useMobileInvoice').checked;
  const saveMobileInvoice = document.getElementById('saveMobileInvoice').checked;
  const mobileInvoice = document.getElementById('mobileInvoice').value;
  const useTaxId = document.getElementById('useTaxId').checked;
  const saveTaxId = document.getElementById('saveTaxId').checked;
  const taxId = document.getElementById('taxId').value;
  

  if (useMobileInvoice && saveMobileInvoice  && emptyChecked(mobileInvoice)) {
    const data = {
      memberId: memberId,
      mobileInvoice: mobileInvoice,
    };

    fetch('api/update-member-invoice.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    }).then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error('Error:', error));
  }

  if (useTaxId && saveTaxId && emptyChecked(taxId)) {
    const data = {
      memberId: memberId,
      taxId: taxId,
    };

    fetch('api/update-member-invoice.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    }).then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error('Error:', error));
  }

  return true;
}

