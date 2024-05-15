<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST,
  'newId' => 0,
];

//TODO: 欄位資料檢查
if (!isset($_POST['branch_name'])) {
  echo json_encode($output);
  exit; # 結束 php 程式
}

// 準備 SQL 查詢，使用 JOIN 操作獲取分店所屬的主題名稱
$sql = "SELECT branches.branch_name, themes.theme_name
        FROM branches
        INNER JOIN themes ON branches.theme_id = themes.theme_id";


$themeId = intval($_POST['theme_id']);

$sql = "INSERT INTO `branches`(`branch_name`, `theme_id`, `branch_phone`, `open_time`, `close_time`, `branch_status`, `branch_address`, `created_at`) VALUES (
  ?,
  ?,
  ?,
  ?,
  ?,
  ?,
  ?,
  NOW())";

// 執行數據庫
$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['branch_name'],
  $themeId,
  $_POST['branch_phone'],
  $_POST['open_time'],
  $_POST['close_time'],
  $_POST['branch_status'],
  $_POST['branch_address'],
]);



$output['success'] = !!$stmt->rowCount(); # 新增了幾筆
$output['newId'] = $pdo->lastInsertId(); # 取得最近新增數據的主键


echo json_encode($output);
