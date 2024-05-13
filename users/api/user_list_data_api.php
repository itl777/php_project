<?php
require __DIR__ . '/../../config/pdo-connect.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
//$data 包含篩選資料，等前端新增


//TODO 前端要給的資料
$page = 1;
$perPage = 20; # 每頁有幾筆
// $user_id = 1; //會員編號查詢
// $account = ''; //帳號查詢
// $name = ''; //姓名查詢
// $nick_name = ''; //暱稱查詢
// $gender = '0'; //性別查詢
// $mobile_phone = ''; //電話號碼查詢
// $user_status = '0';  //啟用狀態篩選
// $blacklist = '0'; //黑名單篩選





# 算總筆數 $totalRows
$t_sql = "SELECT COUNT(1) FROM users";
//TODO 這邊要下篩選語句
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數







# 如果有資料的話
if ($totalRows) {
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }
  # 顯示第幾頁到第幾頁
  $sql1 = "SELECT 
    user_id,
    name,
    account,
    gender,
    user_status,
    blacklist,
    avatar
    FROM `users` 
    ORDER BY user_id";
  if (isset($DESC)) $sql1 . "DESC";

  $sql2 = '';







  $sql3 = sprintf(" LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  //TODO 這邊要下篩選語句

  $sql = $sql1 . $sql2 . $sql3;
  $user_data = $pdo->query($sql)->fetchAll();
}

$output = [
  'page' => $page, //現在是第幾頁
  'perPage' => $perPage, //一頁有幾筆
  'totalRows' => $totalRows, //總筆數
  'totalPages' => $totalPages, //總頁數


  'user_data' => $user_data //回傳的user資料
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);
