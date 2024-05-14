<?php
require __DIR__ . '/../config/pdo-connect.php';

// 設置回傳的 Content-Type 為 JSON
header('Content-Type: application/json');

    // 抓團隊狀態對照表
    $sql = "SELECT * FROM teams_status";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 回傳 JSON 格式的資料
    echo json_encode($users);