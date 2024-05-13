<?php
header('Content-Type: application/json');
$output = [
  'success' => false,
  'code' => 0,
];



// $sql = 
// INSERT INTO `address` (`option_id`, `option_name`, `option_value`, `autoload`)
// VALUES (NULL, 'admin_email', 'service1@achang.com.tw', 'no')
// ON DUPLICATE KEY UPDATE `option_name` = 'admin_email', `option_value`='service1@achang.com.tw', `autoload`='no';




















echo json_encode($output);