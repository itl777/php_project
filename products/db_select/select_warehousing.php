<?php

$t_sql = "SELECT COUNT(1) FROM product_warehousing";

// 總筆數 rows
$totalRows = $pdo->query($t_sql)->fetch(pdo::FETCH_NUM)[0];

$allRows = [];

if ($totalRows) {

    # 總頁數
    // $totalPages = ceil($totalRows / $perPage);
    // if ($page > $totalPages) {
    //     header("Location: ?page={$totalPages}");
    //     exit; # 結束這支程式
    // }

    # 取得分頁資料
    $sql = "SELECT * FROM `product_warehousing`";
    // 取得全部資料
    $allRows = $pdo->query($sql)->fetchAll();
}