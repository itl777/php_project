<?php
require __DIR__ . '/../config/pdo-connect.php';

header('Content-Type: application/json');

    // 抓行程(themes) = tour 資料
    // $sql1 = "SELECT * FROM teams_members
    // order by join_team_id";

    $sql1 = "SELECT join_team_id, COUNT(join_team_id) AS member_count
    FROM teams_members
    GROUP BY join_team_id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $members = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// 回傳 JSON 格式的資料
// echo json_encode($sql1);
    echo json_encode($members);

    // echo $members;

    // <?php
// 假設你已經建立了與資料庫的連接

// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $team_member_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($team_member_counts);
// ?>
