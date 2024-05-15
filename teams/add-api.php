<?php
require __DIR__ . '/../config/pdo-connect.php';

header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'postData' => $_POST,
  'error' => '',
  'code' => 0, # 追踨程式執行的編號
];

// TODO: 欄位資料檢查
if (!isset($_POST['team_title'])) {
  echo json_encode($output);
  exit; # 結束 php 程式
}

$sql = "INSERT INTO teams(
  `team_title`, `leader_id`, `team_limit`, `tour`, `create_at`,`last_modified_at`)
  VALUES
  (?, ?, ?, ?, NOW(), NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['team_title'],
  $_POST['leader_id'],
  $_POST['team_limit'],
  $_POST['tour']
]);


$output['success'] = !!$stmt->rowCount(); # 新增了幾筆
$output['tour_id'] = $pdo->lastInsertId(); # 取得最近的新增資料的primary key

// echo json_encode($output);

echo json_encode($output);
