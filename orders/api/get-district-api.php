<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$cityId = isset($_GET['cityId']) ? $_GET['cityId'] : 0;

$sql = "SELECT * FROM district WHERE city_id = ?";

$districts = [];

$stmt = $pdo->prepare($sql);
$stmt->execute([$cityId]);

$districts = $stmt->fetchAll();


echo json_encode($districts);
