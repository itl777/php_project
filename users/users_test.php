<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/navbar.php' ?>

<div class="container">
  <button type="button" class="btn btn-warning" onclick="addModalShow()">新增</button>

  <!-- table start -->
  <div class="row">
    <div class="col">
      <form name="form1" onsubmit="sendMultiDel(event)">
        <table class="table table-bordered table-striped">
          <thead>
            <!-- column start -->
            <tr>
              <th>會員編號</th>
              <th>姓名</th>
              <th>性別</th>
              <th>帳號</th>
              <th><i class="bi bi-pencil-square"></i></th>
            </tr>
            <!-- column end -->
          </thead>
          <tbody>
            <!-- row start -->
            <tr>





            </tr>
            <!-- row end -->
          </tbody>
        </table>
      </form>
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

  let userListData ;
  const fetchUserListData = function () {
    userListData = '';
    let url = `api/user_list_data_api.php`;
    fetchJsonData(url)
      .then(data => {
        userListData = data;
      });
  };
  fetchUserListData();

  let select = {
    //這邊可以寫篩選需求
    page : 1 ,//當前頁 option給選?
    perPage : 20 , //一頁幾筆，看要不要給改
  };


</script>








<?php include __DIR__ . '/../parts/html-foot.php' ?>