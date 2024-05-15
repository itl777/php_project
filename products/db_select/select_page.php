<?php

// -----頁面切換

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM product_management";


$perPage = 10;
$totalPages = 0;
$all_page = [];
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
        "SELECT * FROM `product_management` ORDER BY product_id DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    // 取得全部資料
    $all_page = $pdo->query($sql)->fetchAll();
}
// -----頁面切換