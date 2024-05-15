<?php
$title = '會員管理系統';
?>


<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>
<link rel="stylesheet" href="../css/styles.css">

<div class="container">



  <form name="selectForm" id="selectForm" onsubmit="selectFormData(event)">


    <div class="col-12 d-flex">

      <input type="text" name="account" class="form-control" placeholder="帳號">
      <input type="text" name="name" class="form-control" placeholder="姓名">
      <input type="text" name="nick_name" class="form-control" placeholder="暱稱">


    </div>




    <div class="col-12 d-flex">

      <input type="text" name="user_id" class="form-control" placeholder="會員編號">
      <input type="text" name="mobile_phone" class="form-control" placeholder="電話號碼">

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
      <div class="form-control">
        <button type="button" class="btn btn-warning" onclick="addModalShow()">新增</button>
        <button type="button" class="btn btn-primary" onclick="quickAdd(pageNow)">快速新增</button>
      </div>



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





<!-- modal -->
<?php include __DIR__ . '/include/edit_modal.php' ?>
<?php include __DIR__ . '/include/address_modal.php' ?>
<?php include __DIR__ . '/include/success_modal.php' ?>


<!-- scripts_map -->
<?php include __DIR__ . '/../parts/scripts.php' ?>
<?php include __DIR__ . '/include/scripts_map.php' ?>


<?php include __DIR__ . '/../parts/html-foot.php' ?>