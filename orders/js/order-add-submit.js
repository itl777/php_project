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

  // 帶入常用地址後清空 helper text
  document.querySelector('#addressModal .btn-primary').addEventListener ('click', function () {
    // clearErrorFor(recipientName);
    // clearErrorFor(recipientMobile);
    // clearErrorFor(city);
    // clearErrorFor(district);
    // clearErrorFor(address);
    document.querySelector('.address-helper-text').textContent = '';
  });

  // 選擇商品後清空 helper text
  document.querySelector('.product-id-dropdown').addEventListener ('click', function () {
    if (document.querySelector('.product-helper-text').textContent !== '') {
      document.querySelector('.product-helper-text').textContent = '';
    }
  });


  document.getElementById('useMemberInfo').addEventListener ('change', function() {
    const recipientNameValue = document.getElementById('recipientName').value;
    const recipientMobileValue = document.getElementById('recipientMobile').value;
    const cityValue = document.getElementById('city').value;
    const districtValue = document.getElementById('district').value;
    const addressValue = document.getElementById('address').value;

    if(emptyChecked(recipientNameValue) && emptyChecked(recipientMobileValue) && emptyChecked(cityValue) && emptyChecked(districtValue) && emptyChecked(addressValue)) {
      document.querySelector('.address-helper-text').textContent = '';
    }
  }) ;

  // document.getElementById('useMemberInfo').addEventListener ('change', function () {
  //   if (document.getElementById('memberId').value !== '') {
  //     clearErrorFor(recipientName);
  //     clearErrorFor(recipientMobile);
  //   }
  // });

  // document.querySelector('.member-id-dropdown').addEventListener ('click', function () {
  //   if (document.getElementById('useMemberInfo').checked) {
  //     clearErrorFor(recipientName);
  //     clearErrorFor(recipientMobile);
  //   }
  // });

});



