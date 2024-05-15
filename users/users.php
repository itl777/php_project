<?php
$title = '會員中心';
?>


<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>
<link rel="stylesheet" href="../css/styles.css">

<div class="container">
  <h1 class="my-5">會員中心</h1>
  <form name="selectForm" id="selectForm" onsubmit="selectFormData(event)" class="g-5">

    <div class="container-fluid">
      <div class="row g-3 border bg-light pb-3 mb-3 form-control">

        <div class="col-12 d-flex">
          <input type="text" name="account" class="form-control mx-3" placeholder="帳號">
          <input type="text" name="name" class="form-control mx-3" placeholder="姓名">
          <input type="text" name="nick_name" class="form-control mx-3" placeholder="暱稱">
          <input type="text" name="user_id" class="form-control mx-3" placeholder="會員編號">
          <input type="text" name="mobile_phone" class="form-control mx-3" placeholder="電話號碼">
        </div>
        <div class="col-12 d-flex gap-4">
          <label class="input-group form-control">
            <div class="form-check form-switch">
              <input class="form-check-input" name="user_status" value="1" type="checkbox" role="switch">
              隱藏停用會員
            </div>
          </label>

          <label class="input-group form-control">
            <div class="form-check form-switch">
              <input class="form-check-input" name="blacklist" value="1" type="checkbox" role="switch">
              黑名單
            </div>
          </label>

          <label class="input-group form-control">
            <div class="form-check form-switch">
              <input class="form-check-input" name="desc" value="1" type="checkbox" role="switch">
              更改排序
            </div>
          </label>

        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="form-control">
        <button type="button" class="btn btn-warning" onclick="addModalShow()">新增</button>
        <button type="button" class="btn btn-primary" onclick="quickAdd(pageNow)">快速新增</button>
      </div>
    </div>

    <!-- table start -->
    <div class="container-fluid">
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
                <th>黑名單</th>
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
    </div>

    <!-- table end -->



  </form>


</div>





<!-- modal -->
<?php include __DIR__ . '/include/edit_modal.php' ?>
<?php include __DIR__ . '/include/address_modal.php' ?>
<?php include __DIR__ . '/include/success_modal.php' ?>


<!-- scripts_map -->
<?php include __DIR__ . '/../parts/scripts.php' ?>
<?php include __DIR__ . '/include/scripts_map.php' ?>


<?php include __DIR__ . '/../parts/html-foot.php' ?>