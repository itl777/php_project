


// 發票類型選擇
function toggleInvoiceType () {
  const useMemberInvoiceRadio = document.getElementById('useMemberInvoice');
  const useMobileInvoiceRadio = document.getElementById('useMobileInvoice');
  const useTaxIdRadio = document.getElementById('useTaxId');
  if (useMemberInvoiceRadio.checked) {
    document.querySelector('.mobile-invoice-div').classList.add('d-none');
    document.querySelector('.tax-id-div').classList.add('d-none');
    document.getElementById('saveMobileInvoice').checked = false;
    document.getElementById('saveTaxId').checked = false;
  }
  if (useMobileInvoiceRadio.checked) {
    document.querySelector('.mobile-invoice-div').classList.remove('d-none');
    document.querySelector('.tax-id-div').classList.add('d-none');
    document.getElementById('saveTaxId').checked = false;
  }
  if (useTaxIdRadio.checked) {
    document.querySelector('.mobile-invoice-div').classList.add('d-none');
    document.querySelector('.tax-id-div').classList.remove('d-none');
    document.getElementById('saveMobileInvoice').checked = false;
  }
  saveInvoice ();
}

function saveInvoice () {
  const mobileInvoiceInput = document.getElementById('mobileInvoice');
  const saveMobileInvoiceCheckbox = document.getElementById('saveMobileInvoice');
  const taxIdInput = document.getElementById('taxId');
  const saveTaxIdCheckbox = document.getElementById('saveTaxId');

  if (mobileInvoiceInput.value === fetchMemberMobileInvoice && fetchMemberMobileInvoice !== null && fetchMemberMobileInvoice !== '') {
    saveMobileInvoiceCheckbox.parentElement.classList.add('d-none');
  } else {
    saveMobileInvoiceCheckbox.parentElement.classList.remove('d-none');
  }

  if (taxIdInput.value === fetchMemberTaxId && fetchMemberTaxId !== null && fetchMemberTaxId !== '') {
    saveTaxIdCheckbox.parentElement.classList.add('d-none');
  } else {
    saveTaxIdCheckbox.parentElement.classList.remove('d-none');
  }
}



document.addEventListener('DOMContentLoaded', function () {


  // 初始化發票類型
  toggleInvoiceType();

  // 在所有發票類型加上監聽器
  document.getElementById('useMemberInvoice').addEventListener('change', toggleInvoiceType);
  document.getElementById('useMobileInvoice').addEventListener('change', toggleInvoiceType);
  document.getElementById('useTaxId').addEventListener('change', toggleInvoiceType);

  document.getElementById('useMobileInvoice').addEventListener('click', saveInvoice);
  document.getElementById('useTaxId').addEventListener('click', saveInvoice);

  document.getElementById('mobileInvoice').addEventListener('change', saveInvoice);
  document.getElementById('taxId').addEventListener('change', saveInvoice);
});


// 發票送出驗證
function invoicePrepareToSubmit () {
  // const useMemberInvoice = document.getElementById('useMemberInvoice');
  // const useMobileInvoice = document.getElementById('useMobileInvoice');
  // const useTaxId = document.getElementById('useTaxId');

  const useMemberInvoice = document.getElementById('useMemberInvoice');
  const useMobileInvoice = document.getElementById('useMobileInvoice');
  const mobileInvoice = document.getElementById('mobileInvoice');
  const useTaxId = document.getElementById('useTaxId');
  const taxId = document.getElementById('taxId');
  
  if (useMemberInvoice.checked) {
    mobileInvoice.disabled = true;
    taxId.disabled = true;
  } else if (useMobileInvoice.checked) {
    taxId.disabled = true;
  } else if (useTaxId.checked) {
    mobileInvoice.disabled = true;
  }

  // if (useMemberInvoice.checked) {
  //   document.getElementById('mobileInvoice').disabled = true;
  //   document.getElementById('taxId').disabled = true;
  // } else if (useMobileInvoice.checked) {
  //   document.getElementById('taxId').disabled = true;
  // } else if(useTaxId.checked) {
  //   document.getElementById('mobileInvoice').disabled = true;
  // }
    


}