<?php
require __DIR__ . '/../../config/pdo-connect.php';

$query = $_GET['query'] ?? '';

$sql = "SELECT * FROM users WHERE user_id LIKE ? OR `name` LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%{$query}%", "%{$query}%"]);

$response = $stmt->fetchAll();
echo json_encode($response);