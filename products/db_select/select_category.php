<?php
require __DIR__ . '/../../config/pdo-connect.php';  // 引入資料庫設定 


// 分類查詢
$category_sql = "SELECT * FROM product_category";
$category_all_row = $pdo->query($category_sql)->fetchAll();




// 取得網址列GET
// 點選類別後，進入類別的SQL select
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// 確認類別是否為空或正確
if ($category_id !== null && is_numeric($category_id)) {
    // 查詢
    $join_sql = "SELECT *
            FROM product_management 
            LEFT JOIN product_category 
            ON product_management.category_id = product_category .category_id
            WHERE product_category .category_id = ?";
    $stmt = $pdo->prepare($join_sql);
    $stmt->execute([$category_id]);
    // 取得搜尋資料
    $category_row = $stmt->fetchAll();
}
