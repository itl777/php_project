<?php
require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定

header('Content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST,
    'debugstr'=>''
];



try {
    $sql = "UPDATE `product_warehousing` SET 
    `quantity`=?,
    `last_modified_by`=?,
    `last_modified_at`=NOW()

    WHERE warehousing_id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['quantity'],
        $_POST['last_modified_by'],
        $_POST['warehousing_id']
    ]);
} catch (Exception $e) {
    $output['debugstr'] = $e->getMessage();
}

$output['success'] = !!$stmt->rowCount(); # 編輯了幾筆
echo json_encode($output);
