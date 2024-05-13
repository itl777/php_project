<?php
require __DIR__ . '/../../config/pdo-connect.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
//$data 包含篩選資料，等前端新增


//TODO 前端要給的資料
$page = 1;
$perPage = 20; # 每頁有幾筆




# 算總筆數 $totalRows
$t_sql = "SELECT COUNT(1) FROM users";
//TODO 這邊要下篩選語句
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數



$sql = "SELECT 
user_id,
name,
account,
gender,
user_status,
blacklist,
avatar
FROM users";



$rows = []; # 預設值
# 如果有資料的話
if ($totalRows) {
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }
  # 顯示第幾頁到第幾頁
  $sql = sprintf("SELECT 
    user_id,
    name,
    account,
    gender,
    user_status,
    blacklist,
    avatar
    FROM `users` 
    ORDER BY user_id DESC 

    LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    //TODO 這邊要下篩選語句
  $user_data = $pdo->query($sql)->fetchAll();
}



echo json_encode($user_data, JSON_UNESCAPED_UNICODE);
