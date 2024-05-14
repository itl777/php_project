<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$user_id = json_decode(file_get_contents("php://input"))->user_id;


$sql_address = "SELECT 
user_id AS user_id,
address.id AS address_id,
city_id AS city_id,
district.id AS district_id,
address,
recipient_name,
mobile_phone,
type 

FROM address 

JOIN district 
ON address.district_id = district.id 

WHERE user_id = $user_id";



$address_data = $pdo->query($sql_address)->fetchAll();


echo json_encode($address_data);
