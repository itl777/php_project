<?php
require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定

header('Content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST,
    'debugstr' => ''
];



try {
    $sql = "UPDATE `product_management` SET 
    `product_name`=?,
    `price`=?,
    `summary`=?,
    -- 新增
    `product_img`=?,
    `category_id`=?,
    `components`=?,
    `players`=?,
    `duration`=?,
    `age`=?,
    `status`=?,
    `last_modified_by`=?,
    `last_modified_at`=NOW()
    
    WHERE product_id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['product_name'],
        $_POST['price'],
        $_POST['summary'],
        // 新增
        $_POST['product_img'],
        $_POST['category_id'],
        $_POST['components'],
        $_POST['players'],
        $_POST['duration'],
        $_POST['age'],
        $_POST['status'],
        $_POST['last_modified_by'],

        $_POST['product_id']
    ]);
} catch (Exception $e) {
    $output['debugstr'] = $e->getMessage();
}

$output['success'] = !!$stmt->rowCount(); # 編輯了幾筆
echo json_encode($output);
