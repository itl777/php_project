const editFormRow = $("#editForm");

const editModalShow = function (user_id) {
  editModal.show();
  fetchEditModalData(user_id);
};

const addModalShow = function () {
  editModal.show();
  addModalData();
};

const fetchEditModalData = function (user_id) {
  fetch("api/edit_modal_data_api.php", {
    method: "POST",
    body: JSON.stringify({
      user_id: user_id,
    }),
  })
    .then((r) => r.json())
    .then((data) => {
      let user_data = data["user_data"];
      let address_data = data["address_data"];
      addModalData(user_data, address_data);
      // console.log(address_data);
    });
};

const ModalData = function (user_data, address_data) {
  let isSet = Object.keys(user_data).length;
  let ModalData = "";

  ModalData += `<input type="hidden" name="user_id" value="${user_data.user_id || ""
    }">`;

  ModalData += `<div class="row align-items-center">
        <div class="col-12 d-flex flex-column align-items-center">
          <input type="hidden" name="avatar" id="avatar" value="${user_data.avatar || ""
    }">
            <img src="images/${user_data.avatar || "default.gif"
    }" id="avatar_img" alt="頭像" class="rounded-circle opacity-100" style="width: 200px;height: 200px;transition: all 500ms ease-out;object-fit: cover;">  
          <button type="button" class="btn btn-primary my-3" onclick="avatar_upload.click()">上傳頭像</button>
        </div>
      </div>`;

  ModalData += `<div class="row align-items-center">
      <div class="col-6">
        <div class="row">
          <div class="col-4">
            <label for="account" class="col-form-label">帳號 <span class="badge bg-danger">必填</span></label>
          </div>
          <div class="col-8"> 
            <input type="text" name="account" class="form-control" 
            value="${user_data.account || ""}">
            <div class="form-text"></div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row">
          <div class="col-4">
            <label for="password" class="col-form-label">密碼 <span class="badge bg-danger">必填</span></label>
          </div>
          <div class="col-8"> 
            <input type="password" name="password" class="form-control" 
            value="${user_data.password || ""}">
            <div class="form-text"></div>
          </div>
        </div>
      </div>
    </div>`;

  ModalData += `<div class="row align-items-center">
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="name" class="col-form-label">姓名 <span class="badge bg-danger">必填</span></label>
      </div>
      <div class="col-8">
        <input type="text" name="name" class="form-control" 
        value="${user_data.name || ""}">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="nick_name" class="col-form-label">暱稱</label>
      </div>
      <div class="col-8">
        <input type="text" name="nick_name" class="form-control" value="${user_data.nick_name || ""
    }">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
</div>`;

  ModalData += `<div class="row align-items-center">
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <span class="col-form-label">性別</span>
      </div>
      <div class="col-8">
        <div class="form-control">
        <label class="form-check-label me-3">
          <input class="form-check-input" type="radio" name="gender" value="0" ${user_data.gender == 0 ? "checked" : ""
    }>
            男
          </label>
        <label class="form-check-label me-3">
          <input class="form-check-input" type="radio" name="gender" value="1" ${user_data.gender == 1 ? "checked" : ""
    }>
            女
          </label>
        </div>
        <div class="form-text"></div>
      </div>
    </div>
  </div>
</div>`;

  ModalData += `<div class="row align-items-center">
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="birthday" class="col-form-label">生日</label>
      </div>
      <div class="col-8">
        <input type="date" name="birthday" class="form-control" value="${user_data.birthday || ""
    }">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="mobile_phone" class="col-form-label">手機號碼</label>
      </div>
      <div class="col-8">
        <input type="text" name="mobile_phone" class="form-control" value="${user_data.mobile_phone || ""
    }">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
</div>`;

  ModalData += `<div class="row align-items-center">
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="invoice_carrier_id" class="col-form-label">常用載具</label>
      </div>
      <div class="col-8">
        <input type="text" name="invoice_carrier_id" class="form-control" 
        value="${user_data.invoice_carrier_id || ""}">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row">
      <div class="col-4">
        <label for="tax_id" class="col-form-label">常用統編</label>
      </div>
      <div class="col-8">
        <input type="text" name="tax_id" class="form-control" 
        value="${user_data.tax_id || ""}">
        <div class="form-text"></div>
      </div>
    </div>
  </div>
</div>`;

  if (isSet !== 0) {
    ModalData += `<div class="row align-items-center">
        <div class="col-12">
          <div class="row">
            <div class="col-2">
              <label for="address" class="col-form-label">常用地址</label>
            </div>
            <div class="col-10">
              <div class="input-group">
                <select class="form-select" name="address">
                  ${addressOptions(address_data) || ""}
                </select>
                <button type="button" class="btn btn-warning" onclick="addressModalData()" id="openAddressModal">編輯地址</button>
              </div>
            </div>
            <div class="form-text"></div>
          </div>
        </div>
      </div>`;
  }

  ModalData += `<div class="row align-items-center">
    <div class="col-12">
      <div class="row">
        <div class="col-2">
          <label for="note" class="form-label">備註</label>
        </div>
        <div class="col-10">
          <textarea class="form-control" name="note" rows="3">${user_data.note || ""
    }</textarea>
          <div class="form-text"></div>
        </div>
      </div>
    </div>
  </div>`;

  if (isSet !== 0) {
    ModalData += `<div class="row align-items-center" >
      <div class="col-6">
        <div class="row">
          <div class="col-4">
            <span class="col-form-label">帳號狀態</span>
          </div>
          <div class="col-8">
          <div class="form-control">
          <label class="form-check-label me-3">
              <input class="form-check-input" type="radio" name="user_status" value="1" ${user_data.user_status == 1 ? "checked" : ""
      }>
                啟用
              </label>
              <label class="form-check-label me-3">
              <input class="form-check-input" type="radio" name="user_status" value="0" ${user_data.user_status == 0 ? "checked" : ""
      }>
                停用
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
      <div class="row">
        <div class="col-4">
          <span class="col-form-label">黑名單</span>
        </div>
        <div class="col-8">
          <div class="form-control">
            <label class="form-check-label me-3">
                <input class="form-check-input" type="radio" name="blacklist" value="1" ${user_data.blacklist == 1 ? "checked" : ""
      }>
                  是
            </label>
            <label class="form-check-label me-3">
            <input class="form-check-input" type="radio" name="blacklist" value="0" ${user_data.blacklist == 0 ? "checked" : ""
      }>
              否
            </label>
          </div>
        </div>
      </div>
    </div >


    <div class="row align-items-center my-2">
      <div class="col-6">
        <div class="row">
          <div class="col-4">
            <span class="col-form-label">建立時間</span>
          </div>
          <div class="col-8">
            <span class="col-form-label">${user_data.created_at || ""}</span>
          </div>
        </div>
      </div>
      <div class="col-6">
      <div class="row">
        <div class="col-4">
          <span class="col-form-label">修改時間</span>
        </div>
        <div class="col-8">
          <span class="col-form-label">${user_data.last_modified_at || ""
      }</span>
        </div>
      </div>
    </div>
    </div>`;
  }

  ModalData += `<div class="row align-items-center">
      <div class="col-12 d-flex justify-content-end">
        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">關閉</button>
        <button type="submit" class="btn btn-primary">送出</button>
      </div>
    </div>`;

  return ModalData;
};

const addressOptions = (addressData = []) => {
  // console.log(addressData);
  if (!Array.isArray(addressData)) {
    return `<option value="">請選擇</option>`;
  } else {
    let options = "";
    addressData.forEach((item) => {
      let selected = item.type === "1" ? "selected" : "";
      options += `<option value="${item.address_id}" ${selected}>
    ${item.postal_codes}${item.city_name}${item.district_name}${item.address}
    </option>`;
    });
    return options;
  }
};

const addModalData = (user_data = {}, address_data = {}) => {
  editFormRow.empty();
  editFormRow.append(ModalData(user_data, address_data));

  let modalTitle = document.getElementById("editModalLabel");
  let text = "";
  if (typeof user_data.user_id !== "undefined") {
    text = `編輯客戶 No.${user_data.user_id}`;
  } else {
    text = "新增客戶";
  }
  modalTitle.innerText = text;
};
