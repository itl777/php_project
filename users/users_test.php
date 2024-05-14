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

      <label class="input-group form-control">
      <div class="form-check form-switch">
        <input class="form-check-input" name="user_status" value="0" type="checkbox" role="switch">
        停用會員
      </div>
      </label>


      <label class="input-group form-control">
      <div class="form-check form-switch">
        <input class="form-check-input" name="blacklist" value="0" type="checkbox" role="switch">
        黑名單
      </div>
      </label>


      <label class="input-group form-control">
      <div class="form-check form-switch">
        <input class="form-check-input" name="desc" value="0" type="checkbox" role="switch">
        降順
      </div>
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





<!-- modal -->
<?php include __DIR__ . '/include/edit_modal.php' ?>
<?php include __DIR__ . '/include/address_modal.php' ?>
<?php include __DIR__ . '/include/success_modal.php' ?>

<!-- scripts_map -->
<?php include __DIR__ . '/include/scripts_map.php' ?>



<?php include __DIR__ . '/../parts/html-foot.php' ?>