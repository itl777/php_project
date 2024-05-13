<?php
require __DIR__ . '/../../config/pdo-connect.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
//$data 包含篩選資料，等前端新增



$sql_users = "SELECT 
user_id,
name,
account,
gender,
user_status,
blacklist,
avatar
FROM users";

$user_data = $pdo->query($sql_users)->fetchAll();


$data = json_encode($user_data);
echo $data;
