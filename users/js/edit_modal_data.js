const editModalData = function (user_id) {
  let failureInfo = document.querySelector('#failureInfo');
  failureInfo.innerHTML = '';
  failureInfo.classList.add('d-none');
  document.editForm.elements.address.innerHTML = '';


  fetch('api/edit_modal_data_api.php', {
    method: 'POST',
    body: JSON.stringify({
      user_id: user_id
    })
  }).then(r => r.json()).then(data => {
    let user_data = data['user_data'];
    let address_data = data['address_data'];
    editFormFillOut(user_data, address_data);
    // console.log(address_data);
  });

  let editModal = new bootstrap.Modal(document.getElementById('editModal'));
  editModal.show();
  let modalTitle = document.getElementById('editModalLabel');
  modalTitle.innerText = `編輯客戶 No.${user_id}`;
}




const editFormFillOut = function (user_data, address_data) {
  editForm.elements.user_id.value = user_data.user_id;
  editForm.elements.account.value = user_data.account;
  editForm.elements.password.value = user_data.password;
  editForm.elements.name.value = user_data.name;
  editForm.elements.nick_name.value = user_data.nick_name;
  editForm.elements.gender.value = user_data.gender;
  editForm.elements.birthday.value = user_data.birthday;
  editForm.elements.mobile_phone.value = user_data.mobile_phone;
  editForm.elements.mobile_barcode.value = user_data.invoice_carrier_id;
  editForm.elements.gui_number.value = user_data.tax_id;
  editForm.elements.note.value = user_data.note;
  editForm.elements.status.value = user_data.user_status;
  editAvatar.src = `../imgs/${user_data.avatar}`;
  editCreateTime.innerText = user_data.created_at;
  editUpdateTime.innerText = user_data.last_modified_by;
  editFKUpdateId.innerText = user_data.last_modified_at;

  address_data.forEach(item => {
    let option = document.createElement('option');
    option.value = item.address_id;
    option.innerText = `${item.postal_codes}${item.city_name}${item.district_name}${item.address}`;
    if (item.type === '1') {
      option.selected = true;
    };
    editForm.elements.address.appendChild(option);
  });
};