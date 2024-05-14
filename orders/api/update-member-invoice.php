<?php
require __DIR__ . '/../../config/pdo-connect.php';
header('Content-Type: application/json');

// 獲取 JSON 格式
$inputData = json_decode(file_get_contents("php://input"), true);

$response = [
  'success' => false,
  'newId' => 0,
  'message' => '',
];

try {
  $pdo->beginTransaction();

  if (isset($inputData['memberId'])) {
    if (isset($inputData['mobileInvoice'])) {
      $updateMemberMobileCarrierSql = "UPDATE `users` SET 
          invoice_carrier_id = ?,
          last_modified_at = now()
          WHERE user_id = ?";
      $updateMemberMobileCarrierStmt = $pdo->prepare($updateMemberMobileCarrierSql);
      if (!$updateMemberMobileCarrierStmt->execute([$inputData['mobileInvoice'], $inputData['memberId']])) {
        throw new Exception("Failed to update mobile invoice: " . implode(", ", $updateMemberMobileCarrierStmt->errorInfo()));
      }
    }

    if (isset($inputData['taxId'])) {
      $updateMemberTaxIdSql = "UPDATE `users` SET 
          tax_id = ?,
          last_modified_at = now()
          WHERE user_id = ?";
      $updateMemberTaxIdStmt = $pdo->prepare($updateMemberTaxIdSql);
      if (!$updateMemberTaxIdStmt->execute([$inputData['taxId'], $inputData['memberId']])) {
        throw new Exception("Failed to update tax ID: " . implode(", ", $updateMemberTaxIdStmt->errorInfo()));
      }
    }

    $response['success'] = true;
    $response['message'] = 'Member mobile invoice or tax id has been successfully updated';
    $pdo->commit();
  } else {
    throw new Exception("Member ID not provided");
  }

} catch (Exception $e) {
  $pdo->rollback();
  $response['message'] = 'Error updating member data: ' . $e->getMessage();
  error_log("Error updating member data: " . $e->getMessage());
  error_log("Input data: " . print_r($inputData, true));
}

echo json_encode($response);
