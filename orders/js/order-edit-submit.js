document.forms['orderEditForm'].addEventListener('submit', function (e) {
  e.preventDefault();
  invoiceOptions ();
  disabledInput ();
  submitForm();
});



// 判斷發票要送出的欄位
function invoiceOptions () {
  // 使用會員載具，清空預設帶入的會員載具、統一編號
  if (document.getElementById('useMemberInvoice').checked) {
    document.getElementById('useMemberInvoice').setAttribute('name', 'memberInvoice');
    document.getElementById('useMemberInvoice').value = 1;
    document.getElementById('taxId').disabled = true;
    document.getElementById('mobileInvoice').disabled = true;
  }

  // 使用手機載具，清空統一編號
  if (document.getElementById('useMobileInvoice').checked) {
    document.getElementById('taxId').disabled = true;
    document.getElementById('useMemberInvoice').disabled = true;
  }

  // 使用統一編號，清空手機載具
  if (document.getElementById('useTaxId').checked) {
    document.getElementById('mobileInvoice').disabled = true;
    document.getElementById('useMemberInvoice').disabled = true;
  }
}


function disabledInput () {
  document.getElementById('city').disabled = true;
  document.getElementById('useMobileInvoice').disabled = true;
  document.getElementById('useTaxId').disabled = true;
}



function submitForm() {
  const originalProductIdsValue = originalProductIdsArray.join(',');
  document.getElementById('originalProductIds').value = originalProductIdsValue;

  const fd = new FormData(document.orderEditForm);

  console.log(fd);
  fetch('api/order-edit-api.php', {
    method: 'POST',
    body: fd,
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('編輯成功');
      location.href = 'order-list.php';
    } else {
      alert('編輯失敗，請檢查資料是否正確。');
      console.log(data);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('發生錯誤，請稍後再試');
  });
}


