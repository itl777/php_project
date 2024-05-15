<?php
require __DIR__ . '/../config/pdo-connect.php';

header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有登入成功
  'bodyData' => $_POST,
  'code' => 0, # 除錯追踨用的
  'error' => '',

];


if (empty($_POST['account']) or empty($_POST['password'])) {
  $output['code'] = 400;
  echo json_encode($output);
  exit; # 結束 php 程式
}

# preg_match(): regexp 比對用 

# mb_strlen(): 算字串的長度

# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL): 檢查 email 格式


# 1. 判斷帳號是否正確
$sql = "SELECT * FROM b2b_user WHERE account=?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$_POST['account']]);
$row = $stmt->fetch();

if (empty($row)) {
  # 帳號是錯的
  $output['code'] = 420;
  $output['error'] = '帳號或密碼錯誤';
  echo json_encode($output);
  exit; # 結束 php 程式
}

if (password_verify($_POST['password'], $row['password'])) {
  $output['success'] = true;
  # 把登入完成的狀態記錄在 session
  $_SESSION['admin'] = [
    'id' => $row['b2b_id'],
    'account' => $row['account'],
    'nickname' => $row['b2b_name'],
  ];
} else {
  # 密碼是錯的
  $output['code'] = 440;
  $output['error'] = '密碼錯誤請重新輸入';
}


echo json_encode($output);
