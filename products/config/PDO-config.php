<?php

// 連接資料庫
require __DIR__ . '/connect-config.php';

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];



$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
//  Creates a PDO instance representing a connection to a database
// 建立一個表示與資料庫的連線的 PDO 實例
$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

// if (!isset($_SESSION)) {
//     session_start();
// }


// 創建資料庫連接 mysqli方式
// $conn = new mysqli($db_host, $db_user, $db_pass,$db_name);

// // 檢查連接
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
