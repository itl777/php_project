<?php
require __DIR__ . '/../../config/pdo-connect.php';

// 關閉自動提交
$pdo->beginTransaction();




header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$output = [
  'success_delete' => false, # 有沒有新增成功
  'success_update' => false, # 有沒有新增成功
  'postData' => $data,
  'error' => '地址修改失敗，請填寫正確的地址',
  'code' => 0, # 追踨程式執行的編號
];


//判別有沒有輸入資料
if (empty($data)) {
  $output['code'] = 301;
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}


$delete = $data['delete'];
$update = $data['updateOrInsert'];
$user_id = $data['user_id'];



try {
  if (!empty($delete)) {
    foreach ($delete as $item) {
      $delete_id = $item['address_id'];
      $sql = "DELETE FROM `address` WHERE id = $delete_id;";
      // DELETE FROM products WHERE id IN (1, 4)
      $stmt1 = $pdo->prepare($sql);
      $stmt1->execute();
    };
    $output['code'] = 201;
    $output['success_delete'] = boolval($stmt1->rowCount());
  };





  if (!empty($update)) {
    $sql1 =
      "INSERT INTO `address` (
      `id`,
      `user_id`, 
      `district_id`, 
      `address`, 
      `recipient_name`, 
      `mobile_phone`
      ) VALUES ";

    $sql2 = [];

    $isFirst = true;
    foreach ($update as $item) {
      $insert_row = [];
      $address_id = intval($item['address_id']);
      if (strlen($address_id) <= 0) {
        $output['code'] = 101;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
      }
      $district_id = $item['district_id'];
      if (strlen($district_id) <= 0) {
        $output['code'] = 105;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
      }
      $addressLine = "'" . $item['addressLine'] . "'";
      if (strlen($addressLine) <= 0) {
        $output['code'] = 103;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
      }
      $recipient_name = "'" . $item['recipient_name'] . "'";
      if (strlen($recipient_name) < 2) {
        $output['code'] = 106;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
      }
      $mobile_phone = "'" . $item['mobile_phone'] . "'";
      if (!preg_match("/09[0-9]{2}[0-9]{6}/", $mobile_phone) && strlen($data['mobile_phone']) != 10) {
        $output['code'] = 104;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
      }


      $insert_row = '(' . implode(',', [$address_id, $user_id, $district_id, $addressLine, $recipient_name, $mobile_phone]) . ')';

      $sql2[] = $insert_row;
    };


    $sql3 =
      "ON DUPLICATE KEY UPDATE 
      `user_id` = VALUES(user_id),
      `district_id` = VALUES(district_id), 
      `address` = VALUES(address), 
      `recipient_name` = VALUES(recipient_name), 
      `mobile_phone` = VALUES(mobile_phone);";



    $sql = $sql1 . implode(',', $sql2) . $sql3;

    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute();

    $output['success_update'] = boolval($stmt2->rowCount());
  };



  $pdo->commit();

  $output['code'] = 200;

  echo json_encode($output, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
  // 如果有任何一步出現問題，則執行回滾
  $pdo->rollBack();
  echo json_encode([
    "success" => false,
    "error" => $e->getMessage()
  ]);
}
