<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id < 1) {
  header('Location: order-list.php');
  echo json_encode(['error' => 'Invalid ID']);
  exit;
}

$orderDetailsSql = "SELECT
  od.order_product_id,
  p.product_name,
  od.order_unit_price,
  od.order_quantity AS order_quantity,
  COALESCE(ws.total_quantity, 0) AS warehousing_quantity,
  COALESCE(filtered_orders.total_out_of_warehouse_quantity, 0) AS out_of_warehousing_quantity,
  (COALESCE(ws.total_quantity, 0) - COALESCE(filtered_orders.total_out_of_warehouse_quantity, 0)) AS stock_quantity
  FROM order_details AS od
  LEFT JOIN product_management AS p ON p.product_id = od.order_product_id
  LEFT JOIN (
    SELECT product_id, SUM(quantity) AS total_quantity
    FROM product_warehousing
    GROUP BY product_id
  ) ws ON ws.product_id = od.order_product_id
  LEFT JOIN (
    SELECT od.order_product_id, SUM(od.order_quantity) AS total_out_of_warehouse_quantity
    FROM order_details AS od
    INNER JOIN orders AS o ON o.id = od.order_id
    INNER JOIN order_status AS os ON os.id = o.order_status_id
    WHERE os.out_of_warehouse = 1
    GROUP BY od.order_product_id
  ) filtered_orders ON filtered_orders.order_product_id = od.order_product_id
  WHERE od.order_id = ?";


$orderDetailsSqlStmt = $pdo->prepare($orderDetailsSql);
$orderDetailsSqlStmt->execute([$id]);
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

