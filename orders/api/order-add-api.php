<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');


$response = [
  'success' => false,
  'newId' => 0,
  'message' => '',
];

try {
  $pdo->beginTransaction();

  // inset into orders table
  $insetOrderSql = "INSERT INTO `orders`(
  `order_date`,
  `member_id`, 
  `payment_method`, 
  `recipient_name`, 
  `recipient_mobile`, 
  `order_district_id`, 
  `order_address`,
  `recipient_invoice_carrier`,
  `recipient_tax_id`,
  `member_carrier`,
  `order_status_id`,
  `created_at`,
  `last_modified_at`) VALUES
  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())";


  $insetOrderStmt = $pdo -> prepare($insetOrderSql);

  $insetOrderStmt->execute([
    $_POST['orderDate'],
    $_POST['memberId'], 
    $_POST['paymentMethod'],
    $_POST['recipientName'],
    $_POST['recipientMobile'],
    $_POST['district'], 
    $_POST['address'], 
    $_POST['mobileInvoice'] ?? null, 
    $_POST['taxId'] ?? null, 
    $_POST['memberInvoice'] ?? 0, 
    $_POST['orderStatus'] ?? 1,
  ]);


  $orderId = $pdo->lastInsertId();
  $response['newId'] = $orderId;

  // insert into oder_details
  $orderDetailsSql = "INSERT INTO `order_details`(`order_id`, `order_product_id`, `order_quantity`, `order_unit_price`, `created_at`, `last_modified_at`) VALUES (?, ?, ?, ?, now(), now())";

  $orderDetailsStmt = $pdo->prepare($orderDetailsSql);

  $productCount = count($_POST['productIds']);

  for ($i = 0; $i < $productCount; $i++) {
    $orderDetailsStmt->execute([
        $orderId,
        $_POST['productIds'][$i],
        $_POST['productQuantities'][$i],
        $_POST['productUnitPrices'][$i],
    ]);
  }


  $response['success'] = true;
  $response['message'] = 'Orders has been successfully added';
  $pdo->commit();

} catch (Exception $e) {
  $pdo->rollback();
  $response['message'] = 'Error adding order: ' . $e->getMessage();;
}

error_log(print_r($_POST, true));
echo json_encode($response);