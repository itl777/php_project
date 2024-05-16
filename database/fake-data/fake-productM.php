<?php
exit;
// 商品列表的假資料

require __DIR__ . '/../../config/pdo-connect.php';  // 引入資料庫設定

$ProductN = ["幸運之城", "冒險之路", "奇幻大冒險", "迷宮探險", "太空探險家", "魔法學院", "海盜寶藏", "古代遺跡", "城市建設者", "未來世界", "動物樂園", "時空穿越", "神秘島嶼", "歷史探索", "科學實驗室"];

$lasts = ["何", "傅", "劉", "吳", "呂", "周", "唐", "孫", "宋", "張", "彭", "徐", "於", "曹", "曾", "朱", "李", "林", "梁", "楊", "沈", "王", "程", "羅", "胡", "董", "蕭", "袁", "許", "謝", "趙", "郭", "鄧", "鄭", "陳", "韓", "馬", "馮", "高", "黃"];

$firsts = ["冠廷", "冠宇", "宗翰", "家豪", "彥廷", "承翰", "柏翰", "宇軒", "家瑋", "冠霖", "雅婷", "雅筑", "怡君", "佳穎", "怡萱", "宜庭", "郁婷", "怡婷", "詩涵", "鈺婷"];

$areas = ["玩家輪流擲骰子，根據點數移動角色，達成任務目標獲勝", "參與者透過選擇角色和行動卡進行勝利條件的競爭", "遊戲開始時，每個玩家根據角色特性獲得初始資源", "玩家通過收集資源、建造建築和交易獲得勝利點數", "遊戲目標是在指定時間內收集最多的地產和資源", "玩家利用房卡和土地卡擴建城市，競爭城市建設和人口發展", "玩家透過投擲機會卡和命運卡，影響遊戲進程和其他玩家", "參與者採取行動，使用技能卡和道具卡應對遊戲中的挑戰"];

$compArr = ["木製遊戲棋盤", "骰子", "遊戲卡片", "遊戲指示物", "計分板", "代幣/籌碼", "遊戲金幣", "家庭/建築物模型", "角色卡", "技能卡", "道具卡", "事件卡", "特殊效果牌", "任務牌", "賭注/押注籌碼", "時間輪/回合計數器", "遊戲地圖", "地形板塊", "建築物標記物", "特殊規則手冊"];

$players = ["2", "5-10", "10", "10-15"];

$GameDur = [15, 30, 60, 120];

$Age = ["3-5歲", "6-8歲", "9-12歲", "13-17歲", "18歲以上"];

$statusArr = [1, 2];

$sql = "INSERT INTO `product_management`(
     `product_name`,
      `category_id`, 
      `price`,  
      `summary`, 
      `components`, 
      `players`, 
      `duration`, 
      `age`, 
      `status`, 
      `created_at`, 
      `last_modified_by`, 
      `product_img`,
      `last_modified_at`) VALUES (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        NOW()
    )";

$stmt = $pdo->prepare($sql);

for ($i = 0; $i < 15; $i++) {


    shuffle($ProductN);
    $product_name = $ProductN[0];
    $category_id =  rand(1, 7);
    $price = rand(100, 2000);
    shuffle($areas);
    $summary = $areas[0];
    shuffle($compArr);
    $components = $compArr[0];

    shuffle($players);
    $Player = $players[0];

    shuffle($GameDur);
    $duration = $GameDur[0];

    shuffle($Age);
    $age = $Age[0];

    shuffle($statusArr);
    $status = $statusArr[0];

    $t = rand(strtotime('2000-01-01'), strtotime('2023-01-01'));
    $created_at =  date('Y-m-d', $t);
    shuffle($lasts);
    shuffle($firsts);
    $last_modified_by = $lasts[1] . $firsts[1];

    $img =  rand(1, 15);


    $stmt->execute([
        $product_name,
        $category_id,
        $price,
        $summary,
        $components,
        $Player,
        $duration,
        $age,
        $status,
        $created_at,
        $last_modified_by,
        $img
    ]);
}

echo json_encode([
    $stmt->rowCount(), // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);


/*
https://www.ntdtv.com/b5/2017/05/14/a1324156.html


let d = `01李 02王 03張 04劉 05陳 06楊 07趙 08黃 09周 10吳
11徐 12孫 13胡 14朱 15高 16林 17何 18郭 19馬 20羅
21梁 22宋 23鄭 24謝 25韓 26唐 27馮 28於 29董 30蕭
31程 32曹 33袁 34鄧 35許 36傅 37沈 38曾 39彭 40呂`.split('').sort().slice(119);
JSON.stringify(d);

// ---------------------
https://freshman.tw/namerank

let ar = [];
$('table').eq(0).find('tr>td:nth-of-type(2)').each(function(i, el){
    ar.push(el.innerText);
});
$('table').eq(1).find('tr>td:nth-of-type(2)').each(function(i, el){
    ar.push(el.innerText);
});
JSON.stringify(ar);

// -------------------
https://www.president.gov.tw/Page/106
let ar = [];
$('.btn.btn-default.alluser').each(function(i, el){
    ar.push(el.innerText);
});
JSON.stringify(ar);

*/