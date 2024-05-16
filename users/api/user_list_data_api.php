<?php
require __DIR__ . '/../../config/pdo-connect.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
//$data 包含篩選資料，等前端新增


//TODO 前端要給的資料
$perPage = 20; # 每頁有幾筆



//搜尋

$user_id = isset($data['user_id']) ? $data['user_id'] : '';
$account = isset($data['account']) ? $data['account'] : '';
$name = isset($data['name']) ? $data['name'] : '';
$nick_name = isset($data['nick_name']) ? $data['nick_name'] : '';
$mobile_phone = isset($data['mobile_phone']) ? $data['mobile_phone'] : '';
$user_status = isset($data['user_status']) ? $data['user_status'] : '';
$blacklist = isset($data['blacklist']) ? $data['blacklist'] : '';

$select_data = [
  "user_id" => $user_id,
  "account" => $account, //like
  "name" => $name, //like
  "nick_name" => $nick_name, //like
  "mobile_phone" => $mobile_phone,
  "user_status" => $user_status,
  "blacklist" => $blacklist
];

$select_sql = [];
foreach ($select_data as $key => $value) {
  if (!empty($value)) {
    // 檢查欄位是否需要模糊搜尋
    if (in_array($key, ['account', 'name', 'nick_name'])) {
      $select_sql[] = "$key LIKE '%$value%'";
    } else {
      // 其他欄位正常搜尋
      $select_sql[] = "$key = '$value'";
    }
  }
}

function select($select, $select_sql)
{
  if (!empty($select_sql)) {
    $select .= implode(" AND ", $select_sql);
  } else {
    // 若沒有任何條件，移除 WHERE 子句
    $select = rtrim($select, " WHERE ");
  }
  return $select;
}




// where column like '%$search_key%'"


# 算總筆數 $totalRows
$t_sql = "SELECT COUNT(1) FROM users WHERE ";
$t_sql = select($t_sql, $select_sql);

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數





if (isset($data['page'])) {
  $page = $data['page'];

  if ($page > $totalPages) {
    $page = $totalPages;
  } else if ($page < 1) {
    $page = 1;
  } else {
    $page = $data['page'];
  }
} else {
  $page = 1;
}




# 如果有資料的話
if ($totalRows) {
  # 顯示第幾頁到第幾頁
  $sql = "SELECT 
    user_id,
    name,
    account,
    gender,
    user_status,
    blacklist,
    avatar
    FROM `users` WHERE ";
  $sql = select($sql, $select_sql);
  $sql = $sql . " ORDER BY user_id  DESC ";
  if (!empty($data['desc'])) {
    $sql = rtrim($sql, " DESC ");
  }

  $sql = $sql . sprintf(" LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

  // echo $sql;
  // exit;

  $user_data = $pdo->query($sql)->fetchAll();
}



$output = [
  'page' => $page, //現在是第幾頁
  'perPage' => $perPage, //一頁有幾筆
  'totalRows' => $totalRows, //總筆數
  'totalPages' => $totalPages, //總頁數


  // 'user_data' => $user_data //回傳的user資料
];

if (!empty($user_data)) {
  $output['user_data'] = $user_data;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
