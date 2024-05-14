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
user_id,
u.name,
d.id AS order_district_id,
c.id AS order_city_id,
order_date,
payment_method,
delivery_method,
order_address,
recipient_name,
recipient_mobile,
recipient_invoice_carrier,
recipient_tax_id,
member_carrier,
order_status_id
FROM orders AS o
LEFT JOIN users AS u
ON u.user_id = o.member_id
LEFT JOIN district AS d
ON d.id = o.order_district_id
LEFT JOIN city AS c
ON c.id = d.city_id
WHERE o.id = $id";

$orderRow = $pdo->query($orderSql)->fetch();


if ($orderRow) {
  echo json_encode($orderRow);
} else {
  echo json_encode(['error' => 'No order found']);
  header('Location: order-list.php');
  exit;
}
