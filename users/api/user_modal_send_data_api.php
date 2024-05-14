<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$output = [
  'success' => false, # 有沒有新增成功
  'postData' => $_POST,
  'error' => '資料沒有修改',
  'code' => 0, # 追踨程式執行的編號
  'user_id' => $_POST['user_id']
];


function validateAccount($account)
{
  $re = '/^(([^<>()\[\]\\.,;:\s@\']+(\.[^<>()\[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
  return preg_match($re, $account);
}

#檢查收到收到的資料是否為空值
if (!empty($_POST)) {
  // TODO: 檢查各個欄位的資料, 有沒有符合規定

  $account = $_POST['account'];
  if (validateAccount($_POST['account']) === 0 && validateAccount($_POST['account']) === false) {
    $output['error'] = '請填寫正確的 Email';
    $output['code'] = 101;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  $password = null;
  if (strlen($_POST['password']) < 8) {
    $output['error'] = '請填寫正確的密碼';
    $output['code'] = 102;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  } else {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  }

  if (strlen($_POST['name']) < 2) {
    $output['error'] = '請填寫正確的姓名';
    $output['code'] = 103;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  }

  $nick_name = null;
  if (strlen($_POST['nick_name']) > 50) {
    $output['error'] = '暱稱請勿超過50個字';
    $output['code'] = 104;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
  } else if (empty($_POST['nick_name'])) {
    $nick_name = $_POST['name'];
  } else {
    $nick_name = $_POST['nick_name'];
  }

  $gender = null;
  if (isset($_POST['gender'])) {
    if ($_POST['gender'] != '0' && $_POST['gender'] != '1') {
      $output['error'] = '請正確選擇性別';
      $output['code'] = 105;
      echo json_encode($output, JSON_UNESCAPED_UNICODE);
      exit;
    } else {
      $gender = $_POST['gender'];
    }
  }

  $birthday = null;
  if (!empty($_POST['birthday'])) {
    $birthday = strtotime($_POST['birthday']);
    if ($birthday === false) {
      # 不是合法的日期字串
      $birthday = null;
      $output['code'] = 106;
      $output['birthday'] = '生日修改失敗';
    } else {
      $birthday = date('Y-m-d', $birthday);
    }
  }

  $mobile_phone = $_POST['mobile_phone'];
  if (!preg_match("/09[0-9]{2}[0-9]{6}/", $mobile_phone) && strlen($_POST['mobile_phone']) != 10) {
    # 不是合法的電話字串
    $mobile_phone = null;
    $output['code'] = 107;
    $output['mobile_phone'] = '電話修改失敗';
  }

  $user_status = null;
  if (isset($_POST['user_status'])) {
    if ($_POST['user_status'] != 0 && $_POST['user_status'] != 1) {
      $user_status = '0';
    } else {
      $user_status = $_POST['user_status'];
    }
  }

  $blacklist = null;
  if (isset($_POST['blacklist'])) {
    if ($_POST['blacklist'] != 0 && $_POST['blacklist'] != 1) {
      $blacklist = '0';
    } else {
      $blacklist = $_POST['blacklist'];
    }
  }


  $avatar = $_POST['avatar'];
  if (empty($_POST['avatar'])) {
    $avatar = 'default.gif';
  }




  // 新增
  if (empty($_POST['user_id'])) {
    $sql = "INSERT INTO `users`(
  `account`,
  `password`,
  `name`,
  `nick_name`,
  `gender`,
  `birthday`,
  `mobile_phone`,
  `invoice_carrier_id`,
  `tax_id`,
  `avatar`,
  `note`,
  `user_status`,
  `blacklist`,
  `created_at`,
  `last_modified_at`
  ) VALUES (
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
    '1',
    '0',
    now(),
    now()
    )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $account,
      $password,
      $_POST['name'],
      $nick_name,
      $gender,
      $birthday,
      $mobile_phone,
      $_POST['invoice_carrier_id'],
      $_POST['tax_id'],
      $avatar,
      $_POST['note'],
    ]);
  }



  // 修改
  else {
    $sql = "UPDATE `users` SET 
  `account`=?,
  `password`=?,
  `name`=?,
  `nick_name`=?,
  `gender`=?,
  `birthday`=?,
  `mobile_phone`=?,
  `invoice_carrier_id`=?,
  `tax_id`=?,
  `avatar`=?,
  `note`=?,
  `user_status`=?,
  `blacklist`=?,
  `last_modified_at`= NOW()
  WHERE `user_id`= ?";

    $data = [
      $account,
      $password,
      $_POST['name'],
      $nick_name,
      $gender,
      $birthday,
      $mobile_phone,
      $_POST['invoice_carrier_id'],
      $_POST['tax_id'],
      $avatar,
      $_POST['note'],
      $user_status,
      $blacklist,
      $_POST['user_id']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);


    if (!empty($_POST['address'])) {
      $address = $_POST['address'];
      $user_id = $_POST['user_id'];
      $sql = "UPDATE `address` SET `type`= '0' WHERE `user_id`= $user_id";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      $sql = "UPDATE `address` SET `type`= '1' WHERE `id`= $address";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
    };
  };



  $output['code'] = 200;
  $output['success'] = boolval($stmt->rowCount());
};
echo json_encode($output, JSON_UNESCAPED_UNICODE);
