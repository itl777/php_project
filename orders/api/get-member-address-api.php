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
  c.id AS city_id,
  c.city_name,
  d.id AS district_id,
  d.district_name,
  a.address,
  a.recipient_name,
  a.recipient_mobile,
  a.default_address
  FROM `address` AS a
  JOIN districts d
  ON a.district_id = d.id
  JOIN cities c
  ON d.city_id = c.id
  WHERE a.member_id = ?";
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
        'recipientMobile' => $address['recipient_mobile'],
        'defaultAddress' => $address['default_address'],
      ];
      array_push($response['addresses'], $formattedAddress);
    }
  }
}

echo json_encode($response);