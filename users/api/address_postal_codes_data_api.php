<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$city_id = json_decode(file_get_contents("php://input"))->city_id;


$sql_postal_codes = "SELECT * FROM district WHERE city_id = $city_id";
$postal_codes_data = $pdo->query($sql_postal_codes)->fetchAll();

echo json_encode($postal_codes_data);
