<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


// 從POST請求中獲取JSON格式的原始數據並解析JSON數據
$user_id = json_decode(file_get_contents("php://input"))->user_id;


$sql_users = "SELECT 
user_id,
name,
account,
gender 
FROM users";

$user_data = $pdo->query($sql_users)->fetchAll();


$data = json_encode($user_data);
echo $data;
