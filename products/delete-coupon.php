<?php
require __DIR__ . '/../config/pdo-connect.php';  // 引入資料庫設定

// 確認sid有沒有值，如果有轉成數字
$coupon_id = isset($_GET['coupon_id']) ? intval($_GET['coupon_id']) : 0;
if ($coupon_id < 1) {
    // <1跳轉到列表
    header('Location: coupon.php');
    exit;
}

// 有值則繼續執行SQL刪除語法
$sql = "DELETE FROM coupon WHERE coupon_id=$coupon_id";
$pdo->query($sql);

# $_SERVER['HTTP_REFERER']: 從哪個頁面連過來的
$comeFrom = 'coupon.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header("Location: $comeFrom");
