const selectForm = document.querySelector('#selectForm');
selectForm.addEventListener('keydown', function (event) {
  if (event.key === 'Enter') {
    selectData();
  }
});

selectForm.addEventListener('change', function (event) {
  selectData();
});


const selectData = function () {

  event.preventDefault();
  let formData = {}
  Array.from(selectForm.elements).forEach(item => {
    formData[item.name] = item.value;
  });
  if (!selectForm.elements.user_status.checked) {
    delete formData.user_status;
  };
  if (!selectForm.elements.blacklist.checked) {
    delete formData.blacklist;
  };
  if (!selectForm.elements.desc.checked) {
    delete formData.desc;
  };

  let url = `api/user_list_data_api.php`;

  fetchJsonData(url, formData)
    .then(data => {
      console.log(data);
      userTable(data['user_data']);
      userTablePagination(data['page'], data['totalPages']);

    })

};