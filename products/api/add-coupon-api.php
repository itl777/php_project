<?php
require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定
header('Content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST,
    'newId' => 0,
];


// 新增
$sql = "INSERT INTO `coupon`(
    `coupon_name`,
    `discount`,
    -- `category_id`,
    `total_quantity`,
    `user_group`,
    `expiry_date`,
    `created_at`, 
    `last_modified_by`, 
    `last_modified_at`
    ) VALUES (
?,
?,
?,
?,
?,
NOW(),
?,
NOW()
)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['coupon_name'],
    $_POST['discount'],
    // $_POST['category_id'],
    $_POST['total_quantity'],
    $_POST['user_group'],
    $_POST['expiry_date'],
    "輸入人員",


]);

$output['success'] = !!$stmt->rowCount(); # 新增了幾筆
$output['newId'] = $pdo->lastInsertId(); # 取得最近的新增資料的primary key

echo json_encode($output);
