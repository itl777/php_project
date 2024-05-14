<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$sql_city = "SELECT * FROM city";
$city_data = $pdo->query($sql_city)->fetchAll();

$sql_district = "SELECT * FROM district";
$district_data = $pdo->query($sql_district)->fetchAll();


echo json_encode($city_data);
