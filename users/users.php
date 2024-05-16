<?php
$title = '會員中心';


header("Access-Control-Allow-Origin: *");
?>



<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>
<link rel="stylesheet" href="../css/styles.css">

<div class="container">
  <h1 class="my-5">會員中心</h1>

  <div class="container-fluid">
    <form name="selectForm" id="selectForm" onsubmit="selectFormData(event)" class="g-5">
      <div class="row g-3 border bg-light pb-3 px-3 mb-3 rounded-3">

        <div class="col-12 d-flex">

          <div class="input-group">


            <input type="text" name="account" class="form-control mx-1" placeholder="帳號">
            <input type="text" name="name" class="form-control mx-1" placeholder="姓名">
            <input type="text" name="nick_name" class="form-control mx-1" placeholder="暱稱">
            <input type="text" name="user_id" class="form-control mx-1" placeholder="會員編號">
            <input type="text" name="mobile_phone" class="form-control mx-1" placeholder="電話號碼">
            <button class="btn btn-outline-dark" type="button"><i class="bi bi-search"></i></button>
          </div>
        </div>

        <div class="col-12 d-flex justify-content-between">


          <div class="col-4 g-3 d-flex gap-3 ms-1">
            <button type="button" class="btn btn-warning" onclick="addModalShow()">新增</button>
            <button type="button" class="btn btn-dark" onclick="quickAdd(pageNow)">快速新增</button>
          </div>


          <div class="col-4 g-3 bg-white py-2 px-4 border border-1 rounded-3 d-flex gap-3 me-1">
            <label class="">
              <div class="form-check form-switch">
                <input class="form-check-input" name="user_status" value="1" type="checkbox" role="switch">
                隱藏停用會員
              </div>
            </label>
            <label class="">
              <div class="form-check form-switch">
                <input class="form-check-input" name="blacklist" value="1" type="checkbox" role="switch">
                黑名單
              </div>
            </label>

            <label class="">
              <div class="form-check form-switch">
                <input class="form-check-input" name="desc" value="1" type="checkbox" role="switch">
                更改排序
              </div>
            </label>
          </div>

        </div>
      </div>
    </form>
  </div>



  <!-- table start -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <table class="table table-bordered table-hover" id="userList">
          <thead>
            <!-- column start -->
            <tr class="table-dark border-0">
              <th class="text-center border-0" style="border-radius: 0.5rem 0 0 0;"><i class="bi bi-image"></i></th>
              <th class="text-center">會員編號</th>
              <th class="text-center">姓名</th>
              <th class="text-center">性別</th>
              <th class="ps-3">帳號</th>
              <th class="text-center" style="border-radius: 0 0.5rem 0 0;">黑名單</th>
            </tr>
            <!-- column end -->
          </thead>
          <tbody>
            <!-- row start -->

            <!-- row end -->
          </tbody>
          <tfoot class="table-dark">

          </tfoot>
        </table>

      </div>
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