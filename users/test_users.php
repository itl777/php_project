<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/navbar.php' ?>

<div class="container">

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
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td><?= $r['user_id'] ?></td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['gender'] == 0 ? '男' : '女' ?></td>
                <td><?= $r['account'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" onclick="editModalData(<?= $r['user_id'] ?>)"><i class="bi bi-pencil-square"></i></button>
                </td>
              </tr>
            <?php endforeach ?>
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
          <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
            <?php if ($i >= 1 and $i <= $totalPages) : ?>
              <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endif ?>
          <?php endfor ?>
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


<!-- edit_modal -->
<?php include __DIR__ . '/parts/edit_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/parts/address_modal.php' ?>
<!-- scripts_map -->
<?php include __DIR__ . '/parts/scripts_map.php' ?>





<?php include __DIR__ . '/../parts/html-foot.php' ?>