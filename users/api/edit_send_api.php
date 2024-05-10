<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$output = [
  'success' => false, # 有沒有新增成功
  'postData' => $_POST,
  'error' => '資料沒有修改',
  'code' => 0, # 追踨程式執行的編號
];


$output['user_id'] = $_POST['user_id'];

#檢查收到收到的資料是否為空值
if (!empty($_POST) && !empty($_POST['user_id'])) {
  // TODO: 檢查各個欄位的資料, 有沒有符合規定

  $account = filter_var($_POST['account'], FILTER_VALIDATE_EMAIL);
  if ($account === false) {
    $output['error'] = '請填寫正確的 Email';
    $output['code'] = 101;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  if (strlen($_POST['name']) < 2) {
    $output['error'] = '請填寫正確的姓名';
    $output['code'] = 102;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  if (strlen($_POST['nick_name']) > 50) {
    $output['error'] = '暱稱請勿超過50個字';
    $output['code'] = 103;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  if ($_POST['gender'] != '0' && $_POST['gender'] != '1') {
    echo $_POST['gender'];
    $output['error'] = '請正確選擇性別';
    $output['code'] = 104;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  $birthday = null;
  if (!empty($_POST['birthday'])) {
    $birthday = strtotime($_POST['birthday']);
    if ($birthday === false) {
      # 不是合法的日期字串
      $birthday = null;
      $output['code'] = 105;
      $output['birthday'] = '生日修改失敗';
    } else {
      $birthday = date('Y-m-d', $birthday);
    }
  }

  $mobile_phone = $_POST['mobile_phone'];
  if (!preg_match("/09[0-9]{2}[0-9]{6}/", $mobile_phone) && strlen($_POST['mobile_phone']) != 10) {
    # 不是合法的電話字串
    $mobile_phone = null;
    $output['code'] = 106;
    $output['mobile_phone'] = '電話修改失敗';
  }

  if ($_POST['status'] != 0 && $_POST['status'] != 1) {
    $output['status'] = '請選擇帳號啟用狀態';
    $output['code'] = 107;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }






  $sql = "UPDATE `users` SET 
  `account`=?,
  `name`=?,
  `nick_name`=?,
  `gender`=?,
  `birthday`=?,
  `mobile_phone`=?,
  `invoice_carrier_id`=?,
  `tax_id`=?,
  `note`=?,
  `user_status`=?,
  `last_modified_by`=now()

  WHERE `user_id`=?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $account,
    $_POST['name'],
    $_POST['nick_name'],
    $_POST['gender'],
    $birthday,
    $mobile_phone,
    $_POST['mobile_barcode'],
    $_POST['gui_number'],
    $_POST['note'],
    $_POST['status'],


    $_POST['user_id']
  ]);
  $output['code'] = 200;
  $output['success'] = boolval($stmt->rowCount());
}




echo json_encode($output, JSON_UNESCAPED_UNICODE);
