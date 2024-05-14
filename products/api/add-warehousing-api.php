<?php
require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定
header('Content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST,
    'newId' => 0
   
];


foreach ($_POST['product_id'] as $key => $product_id) {


    $sql = "INSERT INTO `product_warehousing`(
            `product_id`, `quantity`, `warehousing_person`,`last_modified_by`,`warehousing_date`, `created_at`,`last_modified_at`) VALUES (
              ?,
              ?,
              ?,
              ?,
              ?,
              NOW(),
              NOW() )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([

        $product_id,
        $_POST['quantity'][$key],
        $_POST['warehousing_person'],
        $_POST['warehousing_person'],
        $_POST['warehousing_date']
    ]);
};


// $output['success'] = true;

$output['success'] = !!$stmt->rowCount(); # 新增了幾筆
$output['newId'] = $pdo->lastInsertId(); # 取得最近的新增資料的primary key


echo json_encode($output);
