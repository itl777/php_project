<?php
require __DIR__ . '/../../config/pdo-connect.php';  // 引入資料庫設定

// 狀態查詢
$status_sql = "SELECT * FROM status";
$status = $pdo->query($status_sql)->fetchAll();
