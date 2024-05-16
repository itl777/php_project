//讀取 addressModalData / 新增addAddressLine / 新增資訊addressLineData / 城市選項cityOptions / 鄉鎮市區選項postalCodesOptions 

// 兩層選單監聽cityChanged

const addressRow = $("#addressForm>.row");

const addressModalData = function () {
  addressRow.empty();
  let user_id = editForm.elements.user_id.value;
  addressForm.elements.user_id.value = user_id;
  let url = "api/address_modal_address_api.php";

  editModal.hide();
  addressModal.show();
  fetchJsonData(url, { user_id: user_id }).then((data) => {
    data.forEach((item) => {
      addAddressLine(item);
    });
  });
};

const addressLineData = async (addressData = {}) => {
  let cityOptionsHtml = await cityOptions(addressData.city_id);
  let postalCodesOptionsHtml = await postalCodesOptions(
    addressData.city_id,
    addressData.district_id
  );

  let addressLineData = '';
  addressLineData += `<div class="col-12 px-3">`;

  addressLineData +=
    `<input name="address_id" type="hidden" value="${addressData.address_id || ""}" data-tag="${addressData.address_id ? 'update' : 'insert'}">`;

  addressLineData += `<div class="d-flex">`;

  addressLineData +=
    `<select name="city" class="form-select d-inline-block w-25 me-2" onChange="cityChanged(event)">${cityOptionsHtml}</select>`;

  addressLineData +=
    `<select name="district_id" class="form-select d-inline-block w-25 me-2">${postalCodesOptionsHtml}</select>`;

  addressLineData +=
    `<input type="text" name="addressLine" class="form-control d-inline-block me-2" value="${addressData.address || ""}">`;

  addressLineData +=
    `<input type="text" name="recipient_name" class="form-control d-inline-block w-25 me-2" value="${addressData.recipient_name || ""}">`

  addressLineData +=
    `<input type="text" name="mobile_phone" class="form-control d-inline-block w-50 me-2" value="${addressData.mobile_phone || ""}">`

  addressLineData +=
    `<button type="button" class="btn btn-danger" onclick="removeAddressLine(event)"><i class="bi bi-trash"></i></button>`;

  addressLineData +=
    `</div>`;


  addressLineData +=
    `<div class="form-text"></div>`;

  addressLineData +=
    `</div>`;

  return addressLineData;
};

const addAddressLine = async (addressData) => {
  addressRow.append(await addressLineData(addressData));
};

function removeAddressLine(event) {
  const $el = $(event.target);
  $el.closest('.col-12').hide();
  $el.closest('.col-12').find('[name="address_id"]').attr('data-tag', 'delete');
};



let cachedCityData = null;

const cityOptions = async (city_id) => {
  let url = "api/address_city_data_api.php";
  let options = "";
  const cities = cachedCityData || (await fetchJsonData(url));
  if (!city_id) { options += `<option value="">請選擇</option>`; };
  cities.forEach((item) => {
    let selected = item.id === city_id ? "selected" : "";
    options += `<option value="${item.id}" ${selected}>${item.city_name}</option>`;
  });
  return options;
};

const postalCodesOptions = async (city_id, district_id = {}) => {
  let options = "";
  if (!city_id) {
    return `<option value="">請選擇</option>`;
  } else {
    let url = "api/address_postal_codes_data_api.php";
    const postal_codes = cachedCityData || (await fetchJsonData(url, { city_id: city_id }));
    postal_codes.forEach((item) => {
      let selected = item.id === district_id ? "selected" : "";
      options += `<option value="${item.id}" ${selected}>${item.district_name}</option>`;
    });
    return options;
  }
};

const cityChanged = async (event) => {
  const cityId = event.target.value;
  const postalCodesSelect = event.target.parentElement.querySelector('[name="district_id"]');
  const postalCodesOptionsHtml = await postalCodesOptions(cityId);
  postalCodesSelect.innerHTML = postalCodesOptionsHtml;
};

