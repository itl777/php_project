<?php
require __DIR__ . '/../../config/pdo-connect.php';

$query = $_GET['query'] ?? '';

$sql = "SELECT p.id,
  p.product_name,
  p.unit_price,
  p.product_status,
  COALESCE(wh.total_quantity, 0) AS warehousing_quantity,
  COALESCE(od.total_ordered, 0) AS ordered_quantity,
  (COALESCE(wh.total_quantity, 0) - COALESCE(od.total_ordered, 0)) AS stock_quantity
  FROM products p
  LEFT JOIN (
  SELECT product_id, SUM(quantity) AS total_quantity
  FROM product_warehousing
  GROUP BY product_id
  ) wh ON p.id = wh.product_id
  LEFT JOIN (
  SELECT product_id, SUM(quantity) AS total_ordered
  FROM order_details
  GROUP BY product_id
  ) od ON p.id = od.product_id
  WHERE p.id LIKE ? OR p.product_name LIKE ?
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

