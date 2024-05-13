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

  <!-- pagination start -->
  <div class="row">
    <div class="col">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <!-- 第一頁 -->
          <li class="page-item">
            <a class="page-link" href="?page=1">
              <i class="bi bi-caret-left-square"></i>
            </a>
          </li>
          <!-- 上一頁 -->
          <li class="page-item">
            <a class="page-link" href="?page=<?= $page - 1 ?>">
              <i class="bi bi-caret-left"></i>
            </a>
          </li>
          <!-- 分頁 -->

          <li class="page-item <?= $page == $i ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>

          <!-- 下一頁 -->
          <li class="page-item">
            <a class="page-link" href="?page=<?= $page + 1 ?>">
              <i class="bi bi-caret-right"></i>
            </a>
          </li>
          <!-- 最後一頁 -->
          <li class="page-item">
            <a class="page-link" href="?page=<?= $totalPages ?>">
              <i class="bi bi-caret-right-square"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- pagination end -->

</div>

<script>

  const fetchUserListData = function () {
    let url = `api/user_list_data_api.php`;
    let select = [
      //這邊可以寫篩選需求
    ];
    fetchJsonData(url, select)
      .then(r => r.json()).then(data => {
        console.log(data);






      })
  }

</script>




<!-- edit_modal -->
<?php include __DIR__ . '/include/edit_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/address_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/successModal.php' ?>
<!-- scripts_map -->
<?php include __DIR__ . '/include/scripts_map.php' ?>



<?php include __DIR__ . '/../parts/html-foot.php' ?>