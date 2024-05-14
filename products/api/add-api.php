<?php
require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定
header('Content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST,
    'newId' => 0,
];





// 新增
$sql = "INSERT INTO `product_management`(
    `product_name`, `price`, `category_id`, `summary`, `created_at`,`components`,`players`,`duration`,`age`,`status`,`last_modified_by`,`last_modified_at`,
    `product_img`
    ) VALUES (
      ?,
      ?,
      ?,
      ?, 
      NOW(),
      ?,
      ?,
      ?,
      ?, 
      ?,
      ?, 
      NOW(),
      ?
       )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['product_name'],
    $_POST['price'],
    $_POST['category_id'],
    $_POST['summary'],

    $_POST['components'],
    $_POST['players'],
    $_POST['duration'],
    $_POST['age'],
    $_POST['status'],
    '輸入人員',
    $_POST['product_img']
]);

$output['success'] = !!$stmt->rowCount(); # 新增了幾筆
$output['newId'] = $pdo->lastInsertId(); # 取得最近的新增資料的primary key

echo json_encode($output);
