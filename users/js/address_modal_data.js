const addressRow = $("#addressForm>.row");

const addressModalData = function () {
  addressRow.empty();
  let user_id = editForm.elements.user_id.value;
  addressForm.elements.user_id.value = user_id;
  let url = "./api/address_modal_address_api.php";

  fetchData(url, { user_id: user_id }).then((data) => {
    data.forEach((item) => {
      addAddressLine(item);
    });
  });
};

const addressLineData = async (addressData = {}) => {
  let cityOptionsHtml = await cityOptions(addressData.city_id);
  let postalCodesOptionsHtml = await postalCodesOptions(
    addressData.city_id,
    addressData.postal_codes_id
  );

  let addressLineData = '';
  addressLineData += `<div class="col-12 d-flex">`;

  addressLineData += `<input name="address_id" type="hidden" value="${addressData.address_id || ""}">`;

  addressLineData += `<select name="city" class="form-select d-inline-block" onChange="cityChanged(event)">${cityOptionsHtml}</select>`;

  addressLineData += `<select name="postal_codes" class="form-select d-inline-block">${postalCodesOptionsHtml}</select>`;

  addressLineData += `<input type="text" name="addressLine" class="form-control d-inline-block" value="${addressData.address || ""}">`;

  addressLineData += `<input type="text" name="addressLine" class="form-control d-inline-block" value="${addressData.recipient_name || ""}">`

  addressLineData += `<input type="text" name="addressLine" class="form-control d-inline-block" value="${addressData.mobile_phone || ""}">`

  addressLineData += `<button type="button" class="btn btn-danger" onclick="removeAddressLine(event)"><i class="bi bi-trash"></i></button></div>`;

  return addressLineData;
};

const addAddressLine = async (addressData) => {
  addressRow.append(await addressLineData(addressData));
};

function removeAddressLine(event) {
  const $el = $(event.target);
  $el.closest(".col-12").remove();
};



let cachedCityData = null;

const cityOptions = async (city_id = {}) => {
  let url = "./api/address_city_data_api.php";
  let options = "";
  const cities = cachedCityData || (await fetchData(url));
  cities.forEach((item) => {
    let selected = item.id === city_id ? "selected" : "";
    options += `<option value="${item.id}" ${selected}>${item.city_name}</option>`;
  });
  return options;
};

const postalCodesOptions = async (city_id, postal_codes_id = {}) => {
  let options = "";
  if(!city_id) {
    return `<option value="">請選擇</option>`;
  }else{
  let url = "./api/address_postal_codes_data_api.php";
  const postal_codes = cachedCityData || (await fetchData(url, { city_id: city_id }));
  postal_codes.forEach((item) => {
    let selected = item.id === postal_codes_id ? "selected" : "";
    options += `<option value="${item.id}" ${selected}>${item.district_name}</option>`;
  });
  return options;
}
};

const cityChanged = async (event) => {
  const cityId = event.target.value;
  const postalCodesSelect = event.target.parentElement.querySelector('[name="postal_codes"]');
  const postalCodesOptionsHtml = await postalCodesOptions(cityId);
  postalCodesSelect.innerHTML = postalCodesOptionsHtml;
};

