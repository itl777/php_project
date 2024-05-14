<?php
require __DIR__ . '/../config/pdo-connect.php';
$title = "團隊列表";
$pageName = 'list';

$perPage = 10; # 每一頁最多有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit; # 結束這支程式
}

$t_sql = "SELECT COUNT(team_id) FROM teams";

# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

# 預設值
$totalPages = 0;
$rows = [];

if ($totalRows) {
    # 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: ?page={$totalPages}");
        exit; # 結束這支程式
    }

    # 取得分頁資料
    $sql = sprintf(
        "SELECT team_id, team_title, leader_id, nick_name, tour, theme_name, team_limit, status_text, count(join_user_id) as member_n
        FROM `teams` 
        join `users` on leader_id = users.user_id
        join `themes` on tour = themes.theme_id
        join `teams_status` on team_status = teams_status.status_id
        left join `teams_members` on team_id = join_team_id
        GROUP BY team_id
        ORDER BY team_id ASC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/navbar.php' ?>

<div class="container">
    <!-- 分頁選擇欄 -->
    <div class="row">
        <div class="col-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item ">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    <li class="page-item ">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item ">
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
        <div class="col-6">
            <ul class="nav nav-pills justify-content-end">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./teams/team_add.php">新增團隊</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- 分頁選擇欄 end -->

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-trash"></i></th>
                        <th scope="col">#</th>
                        <th scope="col">團隊名稱</th>
                        <th scope="col">開團者</th>
                        <th scope="col">行程名</th>
                        <th scope="col">目前人數</th>
                        <th scope="col">團隊狀態</th>
                        <th scope="col">修改資料</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><a href="javascript: deleteOne(<?= $r['team_id'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </a></td>
                            <td><?= $r['team_id'] ?></td>
                            <td>
                            <a href="./team_view.php?team_id=<?= $r['team_id'] ?>">
                                <?= $r['team_title'] ?></a></td>
                            <td><?= $r['nick_name'] ?></td>
                            <td><?= $r['theme_name'] ?></td>
                            <td><?= $r['member_n'] ?> / <?= $r['team_limit'] ?></td>
                            <td><?= $r['status_text'] ?></td>
                            <td>
                                <a href="./team_edit.php?team_id=<?= $r['team_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../parts/scripts.php' ?>
<script>
    const deleteOne = (team_id) => {
    if (confirm(`是否要刪除編號為 ${team_id} 的資料?`)) {
      location.href = `/teams/team_delete.php?team_id=${team_id}`;
    }
  }
</script>


    <?php include __DIR__ . '/../parts/html-foot.php' ?>