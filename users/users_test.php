<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/navbar.php' ?>

<div class="container">
  <button type="button" class="btn btn-warning" onclick="addModalShow()">新增</button>


  <form name="selectForm" id="selectForm">

    <div class="row">

      <input type="text" name="user_id" class="form-control" placeholder="會員編號">
      <input type="text" name="account" class="form-control" placeholder="帳號">
      <input type="text" name="name" class="form-control" placeholder="姓名">
      <input type="text" name="nick_name" class="form-control" placeholder="暱稱">
      <input type="text" name="mobile_phone" class="form-control" placeholder="電話號碼">



      <label class="input-group">
        <div class="input-group-text">
          <input class="form-check-input mt-0" name="gender" type="radio" value="0">
        </div>
        <span class="form-control">男</span>
      </label>
      <label class="input-group">
        <div class="input-group-text">
          <input class="form-check-input mt-0" name="gender" type="radio" value="1">
        </div>
        <span class="form-control">女</span>
      </label>



      <label class="input-group">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="checkbox" value="0">
        </div>
        <span class="form-control">停用會員</span>
      </label>
      <label class="input-group">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="checkbox" value="1">
        </div>
        <span class="form-control">黑名單</span>
      </label>


      <label class="input-group">
        <div class="input-group-text">
          <input class="form-check-input mt-0" name="DESC" type="checkbox" value="1">
        </div>
        <span class="form-control">降順</span>
      </label>


      <!-- //user_id 會員編號查詢
        //account 帳號查詢
        //name 姓名查詢
        //nick_name 暱稱查詢
        //gender 性別查詢
        //mobile_phone 電話號碼查詢
        //user_status 啟用狀態篩選
        //blacklist 黑名單篩選 -->
    </div>
  </form>

  <!-- table start -->
  <div class="row">
    <div class="col-12">

      <table class="table table-bordered table-hover" id="userList">
        <thead>
          <!-- column start -->
          <tr>
            <th></th>
            <th>會員編號</th>
            <th>姓名</th>
            <th>性別</th>
            <th>帳號</th>
            <th>帳號狀態</th>
            <!-- <th>編輯</th> -->
          </tr>
          <!-- column end -->
        </thead>
        <tbody>
          <!-- row start -->

          <!-- row end -->
        </tbody>
        <tfoot>

        </tfoot>
      </table>

    </div>
  </div>
  <!-- table end -->


</div>






<!-- edit_modal -->
<?php include __DIR__ . '/include/edit_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/address_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/successModal.php' ?>
<!-- scripts_map -->
<?php include __DIR__ . '/include/scripts_map.php' ?>

<script>
  let userListData;
  const fetchUserListData = function () {
    userListData = ''; //清空變數重新fetch

    let url = `api/user_list_data_api.php`;
    fetchJsonData(url)
      .then(data => {
        // userListData = data; 考量一下有沒有存資料到變數的必要
        userTable(data['user_data']);
        userTablePagination(data['page'], data['totalPages']);

      });
  };
  fetchUserListData();


  const userTable = function (data) {

    let userTable = '';

    data.forEach(item => {
      userTable += `<tr onclick="editModalShow(${item['user_id']})">`;

      userTable += `<td class="align-middle"><img src="images/${item['avatar']}" class="rounded-circle" style="width: 40px;height: 40px"></td>`;
      userTable += `<td class="align-middle">${item['user_id']}</td>`;
      userTable += `<td class="align-middle">${item['name']}</td>`;
      userTable += `<td class="align-middle">${item['gender'] === '0' ? '男' : '女'}`;
      userTable += `<td class="align-middle">${item['account']}</td>`;

      userTable +=
        `<td class="align-middle">
        <div class="btn-group" role="group">
        ${item['user_status'] === '0' ? '<i class="bi btn btn-warning bi-exclamation-triangle-fill"></i>' : ''}
        ${item['blacklist'] === '1' ? '<i class="bi btn btn-danger bi-exclamation-circle-fill"></i>' : ''}
        </div>
        </td>`;
      //原本的編輯按鈕，函式改加在整個tr上了
      // userTable += `<td class="align-middle"><button type="button" class="btn btn-warning" onclick="editModalShow(${item['user_id']})"><i class="bi bi-pencil-square"></i></button></td>`;
      userTable += `<tr>`;
    });

    $("#userList tbody").append(userTable);
  };

  const userTablePagination = function (page, totalPages) {
    console.log(page);
    console.log(totalPages);

    // 值=page 就加 active class
    // 值<0 就加 disabled class
    // 值>totalPages 就加 disabled class
    let userTablePagination = '';

    userTablePagination +=
      `<tr><td colspan=6>
      <nav>
      <ul class="pagination">
        <li class="page-item ${page <= 1 ? 'disabled' : ''}">
          <a class="page-link">上一頁</a>
        </li>`



    for (let i = page - 3; i <= totalPages; i++) {
      if (i < 1) continue;
      if (i > totalPages) con




      }
      < li class="page-item" > <a class="page-link" href="#">${page - 1}</a></ >
        <li class="page-item active" aria-current="page"><a class="page-link" href="#">${page}</a></li>
        <li class="page-item"><a class="page-link" href="#">${page + 1}</a></li>


    userTablePagination +=
      `<li class="page-item ${page >= totalPages ? 'disabled' : ''}">
          <a class="page-link" href="#">下一頁</a>
        </li>
      </ul>
    </nav>
    </td></tr>`;




    console.log(userTablePagination);
    $("#userList tfoot").append(userTablePagination);



  }





  //user_id 會員編號查詢
  //account 帳號查詢
  //name 姓名查詢
  //nick_name 暱稱查詢
  //gender 性別查詢
  //mobile_phone 電話號碼查詢
  //user_status 啟用狀態篩選
  //blacklist 黑名單篩選

  let select = {
    //這邊可以寫篩選需求
    page: 1, //當前頁 option給選?
    perPage: 20, //一頁幾筆，看要不要給改
  };
</script>








<?php include __DIR__ . '/../parts/html-foot.php' ?>