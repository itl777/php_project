<?php

$title = '分店總覽';
$pageName = 'branch_list';
?>
<?php

require __DIR__ . '/../../config/pdo-connect.php';

$perPage = 20; # 每一頁最多有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header("Location:?page=1");
  exit;
}

$t_sql = "SELECT COUNT(id) FROM `branches`";

# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = '';
$rows = [];
if ($totalRows) {
  # 總頁數
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header("Location:?page={$totalPages}");
    exit; // 結束這支程式
  }
  # 取得分頁資料
  $sql = sprintf(
    "SELECT * FROM `branches` ORDER BY id  LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}
?>

<?php include __DIR__ . '/../../parts/html-head.php' ?>
<?php include __DIR__ . '/../../parts/navbar.php' ?>

<div class="container-fluid pt-5">

  <div class="container">
    <div class="row">
      <div class="accordion accordion-flush col-2" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              行程管理
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body d-flex ">
              <div class="d-flex flex-column bd-highlight mb-3">
                <div class="p-2 bd-highlight "><a class="link-secondary" href="branch_list.php" style="text-decoration: none;">分店管理</a></div>
                <div class="p-2 bd-highlight"><a class="link-secondary" href="theme_list.php" style="text-decoration: none;">主題管理</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-10">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">分店名</th>
              <th scope="col">地址</th>
              <th scope="col">電話</th>
              <th scope="col">營業時間</th>
              <th scope="col">結束時間</th>
              <th scope="col">分店狀態</th>
              <th scope="col"><i class="fa-solid fa-file-lines"></i>
              <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
              <th scope="col"><i class="fa-solid fa-trash"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td><?= $r['id'] ?></td>
                <td><?= $r['branch_name'] ?></td>
                <td><?= htmlentities($r['branch_address']) ?></td>
                <td><?= $r['branch_phone'] ?></td>
                <td><?= $r['open_time'] ?></td>
                <td><?= $r['close_time'] ?></td>
                <td><?= $r['branch_status'] ?></td>
                <td>
                  <a href="branch_content.php?id=<?= $r['id'] ?>">
                    <i class="fa-solid fa-file-lines text-secondary"></i>
                  </a>
                </td>
                <td>
                  <a href="branch_edit.php?id=<?= $r['id'] ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
                <td><a href="branch_delete.php?id=<?= $r['id'] ?>" onclick="return confirm('是否要刪除編號為<?= $r['id'] ?>的資料')">
                    <i class="fa-solid fa-trash text-danger"></i>
                  </a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../../parts/scripts.php' ?>
<?php include __DIR__ . '/../..//parts/html-foot.php' ?>