<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id < 1) {
  header('Location: order-list.php');
  echo json_encode(['error' => 'Invalid ID']);
  exit;
}

// get orders details data
$orderDetailsSql = "SELECT
  od.product_id,
  p.product_name,
  od.order_unit_price,
  od.quantity AS ordered_quantity,
  (COALESCE(ws.total_quantity, 0) - COALESCE(other_orders.total_ordered, 0)) AS stock_quantity
  FROM order_details AS od
  LEFT JOIN products AS p ON p.id = od.product_id
  LEFT JOIN (
      SELECT product_id, SUM(quantity) AS total_quantity
      FROM product_warehousing
      GROUP BY product_id
  ) ws ON ws.product_id = od.product_id
  LEFT JOIN (
      SELECT product_id, SUM(quantity) AS total_ordered
      FROM order_details
      WHERE order_id <> ?
      GROUP BY product_id
  ) other_orders ON other_orders.product_id = od.product_id
  WHERE od.order_id = ?";

$orderDetailsSqlStmt = $pdo->prepare($orderDetailsSql);
$orderDetailsSqlStmt->execute([$id, $id]);
$orderProducts = $orderDetailsSqlStmt->fetchAll();


if ($orderProducts) {
  echo json_encode($orderProducts);
} else {
  echo json_encode(['error' => 'No products found']);
}


// $orderDetailsSql = "SELECT
//   od.product_id,
//   p.product_name,
//   order_unit_price,
//   od.quantity
//   FROM order_details AS od
//   LEFT JOIN products AS p ON p.id = od.product_id
//   WHERE od.order_id = ?";

// $orderDetailsSqlStmt = $pdo->prepare($orderDetailsSql);
// $orderDetailsSqlStmt->execute([$id]);
// $orderProducts = $orderDetailsSqlStmt->fetchAll();

// if ($orderProducts) {
//   echo json_encode($orderProducts);
// } else {
//   echo json_encode(['error' => 'No products found']);
// }

