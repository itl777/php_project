<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$sql_city = "SELECT * FROM city";
$city_data = $pdo->query($sql_city)->fetchAll();

$sql_postal_codes = "SELECT * FROM district";
$postal_codes_data = $pdo->query($sql_postal_codes)->fetchAll();


echo json_encode($city_data);
