<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


// 從POST請求中獲取JSON格式的原始數據並解析JSON數據
$user_id = json_decode(file_get_contents("php://input"))->user_id;
$tablename = 'users';


$sql_users = "SELECT * FROM $tablename WHERE user_id = $user_id";
$user_data = $pdo->query($sql_users)->fetch();


$sql_address = "SELECT 
address.id address_id,
district.postal_codes,
city_name,
district_name,
address,
type 
FROM address 
JOIN district ON address.district_id = district.id 
JOIN city ON district.city_id = city.id 
WHERE user_id = $user_id";


$address_data = $pdo->query($sql_address)->fetchAll();

$output = [
  'user_data' => $user_data,
  'address_data' => $address_data
];

$data = json_encode($output);
echo $data;
