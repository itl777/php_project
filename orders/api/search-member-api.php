<?php
require __DIR__ . '/../../config/pdo-connect.php';

$query = $_GET['query'] ?? '';

$sql = "SELECT * FROM members WHERE id LIKE ? OR member_name LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%{$query}%", "%{$query}%"]);

$response = $stmt->fetchAll();
echo json_encode($response);