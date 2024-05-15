const quickAdd = function (pageNow) {
  let url = `../database/fake-data/fake-data-users.php`;
  fetchJsonData(url)
    .then((data) => {
      let failureInfo = document.querySelector("#successModal .alert");
      console.log(data);
      if (data.success) {
        failureInfo.classList.remove("alert-danger");
        failureInfo.classList.add("alert-success");
        failureInfo.innerHTML = "快速新增成功";
      } else {
        failureInfo.classList.remove("alert-success");
        failureInfo.classList.add("alert-danger");
        failureInfo.innerHTML = data.error;
      }
      successModal.show();
      setTimeout(function () {
        successModal.hide();
        pageChange(pageNow);
      }, 1000);
    })
    .catch((error) => console.error("Error:", error));
};



const quickAddAddress = function () {
  let user_id = editForm.elements.user_id.value;
  let url = "../database/fake-data/fake-data-address-button.php";
  fetchJsonData(url, { user_id: user_id }).then((data) => {


    addressModalData(data['user_id']);
    // let failureInfo = document.querySelector("#successModal .alert");
    // console.log(data);
    // if (data.success) {
    //   failureInfo.classList.remove("alert-danger");
    //   failureInfo.classList.add("alert-success");
    //   failureInfo.innerHTML = "快速新增成功";
    // } else {
    //   failureInfo.classList.remove("alert-success");
    //   failureInfo.classList.add("alert-danger");
    //   failureInfo.innerHTML = data.error;
    // }
    // successModal.show();
    // setTimeout(function () {
    //   successModal.hide();
    //   addressModalData(data['user_id']);
    // }, 1000);
  })
    .catch((error) => console.error("Error:", error));


}