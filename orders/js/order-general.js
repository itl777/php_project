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

function clearRecipientFields() {
  document.getElementById("recipientName").value = "";
  document.getElementById("recipientMobile").value = "";
  document.getElementById("city").value = "";
  document.getElementById("district").value = "";
  document.getElementById("address").value = "";
}

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

