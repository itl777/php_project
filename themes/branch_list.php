<?php

$title = '分店總覽';
$pageName = 'branch_list';
?>
<?php

require __DIR__ . '/../config/pdo-connect.php';

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
    "SELECT * FROM `branches` ORDER BY id LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}
?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>


<div class="container-fluid p-5">
  <div class="container-fluid ">
    <div class="row">
      <!-- 右邊表格 -->
      <div class="col-12">
        <!-- 分頁膠囊 -->
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
          <li class="nav-item me-3" role="presentation">
            <button class="nav-link active rounded-pill fw-bold" id="pills-home-tab" data-bs-toggle="pill"
              data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
              aria-selected="true">分店列表</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill fw-bold" id="pills-profile-tab" data-bs-toggle="pill"
              data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
              aria-selected="false">新增分店</button>
          </li>
          <li class="ms-auto">

            <!-- 查詢 -->
            <div class="container ms-5">
              <form id="searchForm" class="mb-3">
                <div class="row">
                  <div class="col-8">
                    <input type="text" class="form-control" placeholder="输入分店名稱" name="branch_name">
                  </div>
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        </ul>

        <!-- 清單 -->
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <!-- 表單 -->
            <table id="branchListTable" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">分店名</th>
                  <th scope="col">地址</th>
                  <th scope="col">電話</th>
                  <th scope="col">營業時間</th>
                  <th scope="col">結束時間</th>
                  <th scope="col">分店狀態</th>
                  <th scope="col"><i class="fa-solid fa-user-check"> 預約</i></th>
                  <th scope="col"><i class="fa-solid fa-file-lines"></i>
                  <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                  <th scope="col"><i class="fa-solid fa-trash"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $r): ?>
                  <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['branch_name'] ?></td>
                    <td><?= htmlentities($r['branch_address']) ?></td>
                    <td><?= $r['branch_phone'] ?></td>
                    <td><?= $r['open_time'] ?></td>
                    <td><?= $r['close_time'] ?></td>
                    <td><?= $r['branch_status'] ?></td>
                    <td>
                      <a href="reservation_list.php?id=<?= $r['id'] ?>">
                        <i class="fa-solid fa-user-check"> 預約</i></i>
                      </a>
                    </td>
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
                    <td><a href="branch_delete.php?id=<?= $r['id'] ?>"
                        onclick="return confirm('是否要刪除編號為<?= $r['id'] ?>的資料')">
                        <i class="fa-solid fa-trash text-danger"></i>
                      </a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- 分頁按鈕 -->
            <div class="col-12 d-flex justify-content-end mt-5">
              <nav aria-label="Page navigation example m-auto">
                <ul class="pagination">
                  <li class="page-item ">
                    <a class="page-link" href="#">
                      <i class="fa-solid fa-angles-left"></i>
                    </a>
                  </li>
                  <li class="page-item ">
                    <a class="page-link" href="#">
                      <i class="fa-solid fa-angle-left"></i>
                    </a>
                  </li>
                  <?php for ($i = $page - 5; $i <= $page + 5; $i++):
                    if ($i >= 1 and $i <= $totalPages): ?>
                      <li class="page-item <?= $page == $i ? 'active' : '' ?> ">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                      </li>
                    <?php endif;
                  endfor ?>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li class="page-item ">
                    <a class="page-link" href="#">
                      <i class="fa-solid fa-angles-right"></i>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <!-- 新增主題 -->
          <div class="tab-pane fade mb-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php include __DIR__ . '/branch_add.php' ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include __DIR__ . '/../parts/scripts.php' ?>

<script>
  document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault(); // 阻止表单提交

    var formData = new FormData(this);
    var queryString = new URLSearchParams(formData).toString(); // 将表单数据转换为 URL 查询字符串

    fetch('branch_list_search.php?' + queryString) // 将查询字符串附加到 URL 中
      .then(response => response.json())
      .then(data => {
        var tableBody = document.createElement('tbody');
        data.forEach(branch => {
          var row = document.createElement('tr');
          row.innerHTML = `
          <td>${branch.id}</td>
          <td>${branch.branch_name}</td>
          <td>${branch.branch_address}</td>
          <td>${branch.branch_phone}</td>
          <td>${branch.open_time}</td>
          <td>${branch.close_time}</td>
          <td>${branch.branch_status}</td>
          <td><a href="branch_content.php?id=${branch.id}"><i class="fa-solid fa-file-lines text-secondary"></i></a></td>
          <td><a href="branch_edit.php?id=${branch.id}"><i class="fa-solid fa-pen-to-square"></i></a></td>
          <td><a href="branch_delete.php?id=${branch.id}" onclick="return confirm('是否要刪除編號為${branch.id}的資料')"><i class="fa-solid fa-trash text-danger"></i></a></td>
        `;
          tableBody.appendChild(row);
        });
        // 更新表格内容
        var branchListTable = document.getElementById('branchListTable');
        branchListTable.innerHTML = '';
        branchListTable.appendChild(tableBody);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });

</script>

<?php include __DIR__ . '/../parts/html-foot.php' ?>