<?php
// 包含 PDO 连接文件
require __DIR__ . '/../../config/pdo-content.php';

// 处理查询条件
$where = '';
$placeholders = [];
if (!empty($_GET['theme_name'])) {
  $where .= "theme_name LIKE ?";
  $placeholders[] = '%' . $_GET['theme_name'] . '%';
}

$sql = "SELECT * FROM `themes`";
if (!empty($where)) {
  $sql .= " WHERE " . $where;
}

// 准备并执行查询
$stmt = $pdo->prepare($sql);
$stmt->execute($placeholders);
$rows = $stmt->fetchAll();

// 返回查询结果
header('Content-Type: application/json');
echo json_encode($rows);

// 結束腳本
exit;

