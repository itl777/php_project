const addressSendData = function (e) {
  e.preventDefault();
  // let isPass = true; // 整個表單有沒有通過檢查

  let $addressForm = $("#addressForm");
  let $row = $addressForm.find(".col-12");
  let $errorText = $addressForm.find(".form-text");
  let $address_id = $addressForm.find('[name="address_id"]');
  let $city = $addressForm.find('[name="city"]');
  let $postal_codes = $addressForm.find('[name="postal_codes"]');
  let $addressLine = $addressForm.find('[name="addressLine"]');
  let $recipient_name = $addressForm.find('[name="recipient_name"]');
  let $mobile_phone = $addressForm.find('[name="mobile_phone"]');

  let formData = {
    user_id: addressForm.user_id.value,
  };

  let formDataIsPass = true;
  let updateOrInsert = [];
  let DELETE = [];

  for (let i = 0; i < $row.length; i++) {
    $address_id.eq(i).removeData("tag");
    let $dataTag = $address_id.eq(i).data("tag");

    $errorText[i].innerHTML = "";
    //驗證是否為空值
    let isPass = true;
    let validateField = function (field, index) {
      let isEmpty = field.value.length === 0 && $dataTag !== "delete";
      let borderColor = isEmpty ? "red" : "#CCC";
      field.style.border = `1px solid ${borderColor}`;
      if (isEmpty) {
        formDataIsPass = false;
        isPass = false;
      }
    };
    let fields = [
      $city[i],
      $postal_codes[i],
      $addressLine[i],
      $recipient_name[i],
      $mobile_phone[i],
    ];

    let data = {};
    if ($dataTag === "insert" || $dataTag === "update") {
      data = {
        address_id: $address_id[i].value,
        city: $city[i].value,
        postal_codes: $postal_codes[i].value,
        addressLine: $addressLine[i].value,
        recipient_name: $recipient_name[i].value,
        mobile_phone: $mobile_phone[i].value,
      };
      fields.forEach((field) => validateField(field, i));
    } else if ($dataTag === "delete") {
      data = {
        address_id: $address_id[i].value,
      };
    } else {
      return alert(`發生預期外的錯誤，請重新檢查程式碼`);
    }

    //驗證成功的話分別包裝陣列
    if (isPass) {
      if ($dataTag === "update" || $dataTag === "insert")
        updateOrInsert.push(data);
      if ($dataTag === "delete") DELETE.push(data);
    } else {
      console.log(`isPass no ${$address_id.eq(i).data("tag")} ${i}`);
      $errorText[i].innerHTML = "請填寫完整地址";
    }
  }

  formData.delete = DELETE;
  formData.updateOrInsert = updateOrInsert;

  // console.log(formDataIsPass);
  let failureInfo = document.querySelector("#addressForm .alert");

  if (formDataIsPass) {
    console.log(formData);

    let url = `api/address_send_data_api.php`;
    fetchJsonData(url, formData)
      .then((data) => {
        console.log(data);

        failureInfo.classList.replace("opacity-0", "opacity-100");
        setTimeout(function () {
          failureInfo.classList.replace("opacity-100", "opacity-0");
          addressModal.hide();
          editModal.show();
        }, 2000);
      })
      .catch((error) => console.error("Error:", error));
  } else {
    return;
  }
};
