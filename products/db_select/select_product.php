<?php
require __DIR__ . '/../../config/pdo-connect.php';  // 引入資料庫設定


// 取得所有商品數量sql語法
$t_sql = "SELECT COUNT(1) FROM product_management";

// 總筆數 rows
$totalRows = $pdo->query($t_sql)->fetch(pdo::FETCH_NUM)[0];


$allRows = [];


if ($totalRows) {
    $sql = sprintf(
        "SELECT * FROM `product_management`"
    );
    // 取得全部資料
    $allRows = $pdo->query($sql)->fetchAll();
}


// TODO 
// 重複寫了...  
// 商品連結分類
// 連結表格拿到分類資料
// if(isset($_GET['category_id'])){
//     $join_sql = "SELECT *
//                 FROM product_management 
//                 LEFT JOIN product_category 
//                 ON product_management.category_id = product_category .category_id
//                 WHERE product_category .category_id = ?";
//     $stmt = $pdo->prepare($join_sql);
//     $stmt->execute([
//         $_GET['category_id']
//     ]);
//     // 取得搜尋資料
//     $category_row = $stmt->fetchAll();


// }
