<?php
require __DIR__ . '/../config/pdo-connect.php';  // 引入資料庫設定

// 確認warehousing_id有沒有值，如果有轉成數字
$warehousing_id = isset($_GET['warehousing_id']) ? intval($_GET['warehousing_id']) : 0;
if ($warehousing_id < 1) {
    // <1跳轉到列表
    header('Location: Warehousing.php');
    exit;
}

// 有值則繼續執行SQL刪除語法
$sql = "DELETE FROM product_warehousing WHERE warehousing_id=$warehousing_id";
$pdo->query($sql);

# $_SERVER['HTTP_REFERER']: 從哪個頁面連過來的
$comeFrom = 'index.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header("Location: $comeFrom");
