<?php
require __DIR__ . '/../config/pdo-connect.php';
header('Content-Type: application/json');

$output = [
  'success' => false,
  'bodyData' => $_POST,
  'newId' => 0,
];

// 欄位資料檢查
if (empty($_POST['branch_name']) || empty($_POST['theme_id']) || empty($_POST['branch_phone']) || empty($_POST['open_time']) || empty($_POST['close_time']) || empty($_POST['branch_status']) || empty($_POST['branch_address'])) {
  $output['error'] = '缺少必要欄位';
  echo json_encode($output);
  exit;
}

// 準備 SQL 查詢
$sql = "INSERT INTO `branches` (`branch_name`, `branch_address`, `branch_phone`, `open_time`, `close_time`, `branch_status`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    $_POST['branch_name'],
    $_POST['branch_address'],
    $_POST['branch_phone'],
    $_POST['open_time'],
    $_POST['close_time'],
    $_POST['branch_status']
  ]);

  $branchId = $pdo->lastInsertId();

  // 將分店與主題的關聯插入 branch_themes 表
  foreach ($_POST['theme_id'] as $themeId) {
    $sql = "INSERT INTO `branch_themes` (`branch_id`, `theme_id`) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$branchId, $themeId]);
  }

  $output['success'] = true;
  $output['newId'] = $branchId;
} catch (PDOException $e) {
  $output['error'] = $e->getMessage();
}

echo json_encode($output);
