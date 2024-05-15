<?php
require __DIR__ . '/../../config/pdo-connect.php';

$query = $_GET['query'] ?? '';

$sql = "SELECT
  p.product_id,
  p.product_name,
  p.price,
  p.status AS product_status,
  COALESCE(wh.total_quantity, 0) AS warehousing_quantity,
  COALESCE(od.total_ordered, 0) AS ordered_quantity,
  (COALESCE(wh.total_quantity, 0) - COALESCE(od.total_ordered, 0)) AS stock_quantity
  FROM product_management AS p
  LEFT JOIN (
  SELECT product_id, SUM(quantity) AS total_quantity
  FROM product_warehousing
  GROUP BY product_id
  ) wh ON p.product_id = wh.product_id
  LEFT JOIN (
  SELECT order_product_id, SUM(order_quantity) AS total_ordered
  FROM order_details
  INNER JOIN orders ON orders.id = order_details.order_id
  INNER JOIN order_status ON order_status.id = orders.order_status_id
  WHERE order_status.out_of_warehouse = 1
  GROUP BY order_product_id
  ) od ON p.product_id = od.order_product_id
  WHERE p.product_id LIKE ? OR p.product_name LIKE ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute(["%{$query}%", "%{$query}%"]);

$products = $stmt->fetchAll();

echo json_encode($products);


// require __DIR__ . '/../config/pdo-connect.php';

// $query = $_GET['query'] ?? '';

// $sql = "SELECT * FROM products WHERE id LIKE ? OR product_name LIKE ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(["%{$query}%", "%{$query}%"]);

// $response = $stmt->fetchAll();
// echo json_encode($response);

