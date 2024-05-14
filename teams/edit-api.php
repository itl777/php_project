<?php
require __DIR__ . '/../config/pdo-connect.php';

header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST,
];

// TODO: 欄位資料檢查
if (!isset($_POST['team_id'])) {
  echo json_encode($output);
  exit; # 結束 php 程式
}

$sql = "UPDATE `teams` SET 
    `team_title`=?,
    `team_limit`=?,
    `tour`=?,
    `team_status`=?,
    `last_modified_at` = NOW()
WHERE team_id=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['team_title'],
  $_POST['team_limit'],
  $_POST['tour'],
  $_POST['team_status'],
  $_POST['team_id'],
  
]);

$output['success'] = !!$stmt->rowCount(); # 修改了幾筆


echo json_encode($output);

