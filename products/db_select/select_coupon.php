<?php
require __DIR__ . '/../config/PDO-config.php';  // 引入資料庫設定

$c_sql = "SELECT * FROM `coupon`";
$all_coupon_row = [];
$all_coupon_row = $pdo->query($c_sql)->fetchAll();
