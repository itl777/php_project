<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
];

// 檢查是否傳入分店 ID
if (!isset($_POST['id'])) {
    $output['error'] = '缺少分店 ID';
    echo json_encode($output);
    exit;
}

// 檢查其他必要欄位是否存在並包含有效值
if (
    !isset($_POST['branch_name']) ||
    !isset($_POST['branch_address']) ||
    !isset($_POST['branch_phone']) ||
    !isset($_POST['open_time']) ||
    !isset($_POST['close_time']) ||
    !isset($_POST['branch_status'])
) {
    $output['error'] = '請提供所有必要的分店信息';
    echo json_encode($output);
    exit;
}

// 準備更新資料的 SQL 查詢語句
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
$stmt->execute([
    $_POST['branch_name'],
    $_POST['branch_address'],
    $_POST['branch_phone'],
    $_POST['open_time'],
    $_POST['close_time'],
    $_POST['branch_status'],
    $_POST['id']
]);

$output['success'] = !!$stmt->rowCount(); // 更新了幾筆數據

if ($output['success']) {
    // 获取最新的数据
    $id = $_POST['id'];
    $sql = "SELECT * FROM `branches` WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $output['row'] = $stmt->fetch();
}


echo json_encode($output);
