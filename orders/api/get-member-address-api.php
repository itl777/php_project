<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

$memberId = $_GET['memberId'] ?? '';

$response = [
  'success' => false,
  'addresses' => []
];


if ($memberId) {
  $sql = "SELECT
  a.id,
  a.user_id,
  c.id AS city_id,
  c.city_name,
  d.id AS district_id,
  d.district_name,
  a.address,
  a.recipient_name,
  a.mobile_phone,
  a.type
  FROM `address` AS a
  JOIN district AS d
  ON a.district_id = d.id
  JOIN city AS c
  ON d.city_id = c.id 
  WHERE a.user_id =  ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$memberId]);
  $addresses = $stmt->fetchAll();


  if ($addresses) {
    $response['success'] = true;
    foreach ($addresses as $address) {
      $formattedAddress = [
        'id' => $address['id'],
        'fullAddress' => $address['city_name'] . $address['district_name'] . $address['address'],
        'cityId' => $address['city_id'],
        'districtId' => $address['district_id'],
        'address' => $address['address'],
        'recipientName' => $address['recipient_name'],
        'recipientMobile' => $address['mobile_phone'],
        'defaultAddress' => $address['type'],
      ];
      array_push($response['addresses'], $formattedAddress);
    }
  }
}

echo json_encode($response);