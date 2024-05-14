<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json'); 

// 獲取 orderId，並確保它是有效的正整數。
$orderId = isset($_GET['orderId']) ? intval($_GET['orderId']) : 0;

$response =[
  'success' => false,
  'message' => '',
];


if ($orderId < 1) {
  header('Location: order-list.php');
  echo json_encode([
    'success' => false,
    'message' => '刪除失敗：order_id不存在'
  ]);
  exit;
}



try {
  // 需同時刪除 orders 和 order_details 表中的資料（兩個都要全部完成才可以執行。）
  $pdo->beginTransaction();

  // 刪除 order_details 表中所有 order_id 符合的記錄
  $orderDetailsSql = 'DELETE FROM order_details WHERE order_id = ?';
  $orderDetailsStmt = $pdo->prepare($orderDetailsSql);
  $orderDetailsStmt->execute([$orderId]);

  // 刪除 orders 表中的記錄
  $ordersSql = 'DELETE FROM orders WHERE id = ?';
  $ordersStmt = $pdo->prepare($ordersSql);
  $ordersStmt->execute([$orderId]);

  // 提交事務
  $pdo->commit();
  echo json_encode([
      'success' => true,
      'message' => '已成功刪除'
  ]);

} catch (Exception $e) {
  $pdo->rollBack();
  echo json_encode([
      'success' => false,
      'message' => '刪除失敗: ' . $e->getMessage()
  ]);
  error_log('刪除失敗：' . $e->getMessage());
  exit;
}
