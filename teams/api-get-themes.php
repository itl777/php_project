<?php
require __DIR__ . '/../config/pdo-connect.php';

// 設置回傳的 Content-Type 為 JSON
header('Content-Type: application/json');

    // 抓行程(themes) = tour 資料
    $sql1 = "SELECT * FROM themes";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $tours = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// 回傳 JSON 格式的資料
    echo json_encode($tours);