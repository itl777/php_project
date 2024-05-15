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



