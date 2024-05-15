<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$sql = "SELECT * FROM order_status";

$orderStatus = [];
$orderStatus = $pdo->query($sql)->fetchAll();

echo json_encode($orderStatus);

