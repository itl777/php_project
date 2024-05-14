<?php
require __DIR__ . '/../config/pdo-connect.php';
$title = '通訊錄列表';
$pageName = 'list';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

$perPage = 20; # 每頁有幾筆
# 算總筆數 $totalRows
$t_sql = "SELECT COUNT(1) FROM users";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數

$rows = []; # 預設值
# 如果有資料的話
if ($totalRows) {
  #如果指定頁數大於總頁數，限制跳轉頁數=總頁數
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }
  # 顯示第幾頁到第幾頁
  $sql = sprintf("SELECT user_id,name,account,gender FROM `users` ORDER BY user_id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll();
}
?>





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
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td><?= $r['user_id'] ?></td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['gender'] == 0 ? '男' : '女' ?></td>
                <td><?= $r['account'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" onclick="editModalShow(<?= $r['user_id'] ?>)"><i class="bi bi-pencil-square"></i></button>
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
<?php include __DIR__ . '/include/edit_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/address_modal.php' ?>
<!-- address_modal -->
<?php include __DIR__ . '/include/successModal.php' ?>
<!-- scripts_map -->
<?php include __DIR__ . '/include/scripts_map.php' ?>



<?php include __DIR__ . '/../parts/html-foot.php' ?>