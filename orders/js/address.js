document.addEventListener('DOMContentLoaded', function () {
    const useSavedAddressRadio = document.getElementById('useSavedAddress');
    const useNewAddressRadio = document.getElementById('useNewAddress');
  

    // 顯示或隱藏新增收件人相關欄位
    function toggleUseMemberInfo () {
      if (useNewAddressRadio.checked) {
        document.querySelector('.use-member-info').classList.remove('d-none');
        document.querySelector('.saved-address-modal-btn').disabled = true;
        enabledRecipientInput(); // 取消 disabled 收件人相關欄位
        clearRecipientFields();
        document.getElementById("useMemberInfo").checked = false;
      } else {
        document.querySelector('.use-member-info').classList.add('d-none');
        document.querySelector('.saved-address-modal-btn').disabled = false;
        disabledRecipientInput(); // disabled 收件人相關欄位
        clearRecipientFields();
      }
    }

    // 初始化（隱藏收件人相關欄位）
    toggleUseMemberInfo();
    
    // 若「使用常用地址」或「新增受件地址」radio button 有改變，會觸發顯示或隱藏的 toggle
    useNewAddressRadio.addEventListener('change', toggleUseMemberInfo);
    useSavedAddressRadio.addEventListener('change', toggleUseMemberInfo);

    // 使用「帶入會員資料」
    document.getElementById("useMemberInfo").addEventListener("click", function () {
      if (this.checked) {
        document.getElementById("recipientName").value = fetchMemberName;
        document.getElementById("recipientMobile").value = fetchMemberPhone;
      } else {
        document.getElementById("recipientName").value = "";
        document.getElementById("recipientMobile").value = "";
      }
    });


    // 若會員有編輯過收件人、收件人手機，取消勾選「帶入會員資料」
    document.getElementById('recipientName').addEventListener('change', function () {
      if (document.getElementById("recipientName").value !== fetchMemberName || document.getElementById("recipientMobile").value !== fetchMemberPhone) {
        document.getElementById("useMemberInfo").checked = false;
      }
    });



});



