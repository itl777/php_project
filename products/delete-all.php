<?php
require __DIR__ . '/../config/pdo-connect.php';  // 引入資料庫設定

$output = [
    'success' => false, # 有沒有新增成功
    'debugstr' => [],
    'bug' => ''
];



$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['delArr']) && is_array($data['delArr'])) {

    $delArr = $data['delArr'];
    $output['debugstr'] = $data['delArr'];


    $delArr = array_map('intval', $delArr);

    $placeholders = rtrim(str_repeat('?,', count($delArr)), ',');
    $sql = "DELETE FROM product_management WHERE product_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($delArr);
    $output['success'] = true;
}
$output['bug'] = 'end delete';
echo json_encode($output);
