<?php
require __DIR__ . '/../config/pdo-connect.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
];

if (!isset($_POST['id'])) {
    $output['error'] = '缺少分店 ID';
    echo json_encode($output);
    exit;
}

// 更新操作的 SQL 查詢
$sql = "UPDATE `branches` SET
        `branch_name` = ?,
        `branch_address` = ?,
        `branch_phone` = ?,
        `open_time` = ?,
        `close_time` = ?,
        `branch_status` = ?
        WHERE `id` = ?";

$stmt = $pdo->prepare($sql);

// 執行更新操作
$result = $stmt->execute([
    $_POST['branch_name'],
    $_POST['branch_address'],
    $_POST['branch_phone'],
    $_POST['open_time'],
    $_POST['close_time'],
    $_POST['branch_status'],
    $_POST['id']
]);

if ($result) {
    $output['success'] = true;
} else {
    $output['error'] = '更新失敗';
}

echo json_encode($output);
