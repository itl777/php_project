<?php

require __DIR__ . '/config.php';  // 同資料夾的config引入資料庫設定



$dir = __DIR__ . '/../imgs/'; # 存放檔案的資料夾
$exts = [   # 檔案類型的篩選
  'image/jpeg' => '.jpg',
  'image/png' =>  '.png',
  'image/webp' => '.webp',
];

$output = [
  'success' => false,
  'files' => [],
  'debug' => [],
  'newId' => ''
];    # 輸出的格式


// img存資料庫 SQL
$sql = "INSERT INTO `product_img`(`file_name`) VALUES (?)";
$stmt = $pdo->prepare($sql);





if (!empty($_FILES) and !empty($_FILES['photos'])) {

  if (is_array($_FILES['photos']['name'])) {    # 是不是陣列

    foreach ($_FILES['photos']['name'] as $i => $name) {
      if (!empty($exts[$_FILES['photos']['type'][$i]]) and $_FILES['photos']['error'][$i] == 0) {
        $ext = $exts[$_FILES['photos']['type'][$i]]; # 副檔名
        $f = sha1($name . uniqid() . rand()); # 隨機的主檔名
        if (move_uploaded_file($_FILES['photos']['tmp_name'][$i], $dir . $f . $ext)) {
          $output['files'][] = $f . $ext;  // array push

        }
      }
    }
    if (count($output['files'])) {
      $output['success'] = true;

      // 存入圖片資料庫
      foreach ($output['files'] as $i) {
        $output['debug'][] = $i;
        $stmt->execute([$i]);
      }
    }
  }
}

$output['newId'] = $pdo->lastInsertId(); # 取得最近的新增資料

header('Content-Type: application/json');
echo json_encode($output);
