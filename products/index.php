<?php
require __DIR__ . '/config/PDO-config.php';  // 引入資料庫設定

// 取得所有商品
include 'db_select/select_product.php';
// 取得分類
include 'db_select/select_category.php';



// -----頁面切換
// 用戶可決定看第幾頁，在網址+ ?page=10 true轉成整數 :false給1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    // 判斷page<1跳轉到第一頁
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM product_management";

// 總筆數 rows
$totalRows = $pdo->query($t_sql)->fetch(pdo::FETCH_NUM)[0];

$totalPages = 0;
$allRows = [];
// ----- 

if ($totalRows) {

    # 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: ?page={$totalPages}");
        exit; # 結束這支程式
    }

    # 取得分頁資料
    $sql = sprintf(
        "SELECT * FROM `product_management` ORDER BY sid DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    // 取得全部資料
    $allRows = $pdo->query($sql)->fetchAll();
}
// -----頁面切換

?>
<!-- TODO 正在改資料庫名稱 -->


<?php include 'components/head.php' ?>
<?php include 'components/navbar.php' ?>

<!-- 主內容 -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12 mt-4 mb-3">
            <h2>商品管理</h2>
        </div>
        <!-- 產品分類 -->
        <div class="col-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">所有商品</a>
                </li>

                <?php foreach ($category_all_row as $r) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="?category_id=<?= $r['category_id'] ?>"><?= $r['category_name'] ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>


        <div class="col-10">

            <!-- 搜尋列+新增商品+新增庫存 -->
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid d-flex justify-content-between">
                    <!-- 還沒做 -->
                    <form onsubmit="selectData()" class="d-flex" name="searchForm">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="mySearch">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <div>
                        <a class="btn btn-primary" href="add.php">
                            <i class="bi bi-person-fill-add"></i>
                            新增商品
                        </a>
                        <!--  新增庫存 -->
                        <a class="btn btn-primary" href="add-Warehousing.php">
                            <i class="bi bi-bag-plus-fill"></i>
                            新增庫存
                        </a>
                    </div>
                </div>
            </nav>
            <!-- 搜尋列結束 -->

            <!-- 頁面切換開始 -->

            <div class="container">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <!-- 雙箭頭 回到第一頁 -->
                        <li class="page-item ">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>

                        <!-- --單鍵頭 10頁 -->
                        <li class="page-item ">
                            <?php  ?>
                            <a class="page-link" href="?page=
                <?php
                // if ($page > 10) {
                //     $page - 10;
                // } else {
                //     $page = 1;
                // };
                ?>
                    ">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>

                        </li>
                        <!-- --所有頁碼-- -->
                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) : ?>
                                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <!-- ----+10頁----- -->

                        <li class="page-item ">
                            <a class="page-link" href="#">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>

                        <!-- 雙箭頭 到最後一頁 -->
                        <li class="page-item ">
                            <a class="page-link" href="?page=<?= $totalRows ?>">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

            <!-- 頁面切換結束 -->

            <!-- 表單開始 -->
            <table id="ProductTable" class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">商品編號</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">商品單價</th>
                        <th scope="col">庫存</th>
                        <th scope="col">編輯&刪除</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- TODO 拆分到獨立檔案 -->
                    <?php
                    if (isset($category_id)) :
                        // 有選類別
                        foreach ($category_row as $r) : ?>
                            <tr>
                                <td><?= $r['product_id'] ?></td>
                                <!-- 做字元跳脫避免JS注入 -->
                                <td><?= htmlentities($r['product_name']) ?></td>
                                <td><?= $r['price'] ?></td>
                                <td>111</td>

                                <!-- 按鈕 -->
                                <td>
                                    <a class="btn btn-warning" href="edit.php?product_id=<?= $r['product_id'] ?>">
                                        <i class="bi bi-pen-fill"></i>編輯
                                    </a>
                                    <a class="btn btn-danger" href="javascript: deleteOne(<?= $r['product_id'] ?>)">
                                        <i class="bi bi-trash-fill"></i>刪除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <!-- 沒有選類別 -->
                        <?php foreach ($allRows as $r) : ?>
                            <tr>
                                <td><?= $r['product_id'] ?></td>
                                <!-- 做字元跳脫避免JS注入 -->
                                <td><?= htmlentities($r['product_name']) ?></td>
                                <td><?= $r['price'] ?></td>
                                <td>111</td>

                                <!-- 按鈕 -->
                                <td>
                                    <a class="btn btn-warning" href="edit.php?product_id=<?= $r['product_id'] ?>">
                                        <i class="bi bi-pen-fill"></i>編輯
                                    </a>
                                    <a class="btn btn-danger" href="javascript: deleteOne(<?= $r['product_id'] ?>)">
                                        <i class="bi bi-trash-fill"></i>刪除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
            <!-- 表單結束 -->

        </div>








    </div>
</div>

<?php include 'components/script.php' ?>

<script>
    const deleteOne = (product_id) => {
        if (confirm(`是否要刪除編號為 ${product_id} 的資料?`)) {
            location.href = `delete.php?product_id=${product_id}`;
        }
    }
</script>

<?php include 'components/foot.php' ?>