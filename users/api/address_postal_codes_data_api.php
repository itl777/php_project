<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$city_id = json_decode(file_get_contents("php://input"))->city_id;


$sql_district = "SELECT * FROM district WHERE city_id = $city_id";
$district_data = $pdo->query($sql_district)->fetchAll();

echo json_encode($district_data);
