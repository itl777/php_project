<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM city";

$cities = [];
$cities = $pdo->query($sql)->fetchAll();

echo json_encode($cities);

