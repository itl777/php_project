<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id < 1) {
  header('Location: order-list.php');
  echo json_encode(['error' => 'Invalid ID']);
  exit;
}

// get orders data
$orderSql = "SELECT
o.id AS order_id,
m.id AS member_id,
member_name,
d.id AS order_district_id,
c.id AS order_city_id,
order_date,
payment_method,
delivery_method,
address,
recipient_name,
o.mobile_phone AS order_mobile_phone,
o.invoice_carrier AS order_invoice_carrier,
o.tax_id AS order_tax_id,
member_carrier,
order_status
FROM orders AS o
LEFT JOIN members AS m
ON m.id = o.member_id
LEFT JOIN districts AS d
ON d.id = o.district_id
LEFT JOIN cities AS c
ON c.id = d.city_id
WHERE o.id = $id";

$orderRow = $pdo->query($orderSql)->fetch();

// $orderDetailsSql = "SELECT
// p.product_name,
// p.unit_price,
// od.product_id,
// od.quantity
// FROM order_details AS od
// LEFT JOIN products AS p ON p.id = od.product_id
// WHERE od.order_id = ?";

// $orderDetailsSqlStmt = $pdo->prepare($orderDetailsSql);
// $orderDetailsSqlStmt->execute([$id]);
// $products = $stmt->fetchAll();

if ($orderRow) {
  echo json_encode($orderRow);
} else {
  echo json_encode(['error' => 'No order found']);
  header('Location: order-list.php');
  exit;
}
