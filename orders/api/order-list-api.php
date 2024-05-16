<?php
require __DIR__ . '/../../config/pdo-connect.php';


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPages = 20; // 每頁顯示的數據量

$startDate = $_GET['startDate'] ?? '';
$endDate = $_GET['endDate'] ?? '';
$memberSearch = $_GET['memberSearch'] ?? '';
$productSearch = $_GET['productSearch'] ?? '';
$orderStatus = $_GET['orderStatus'] ?? '';

$query = "SELECT 
    o.id AS order_id,
    o.order_date,
    u.name AS member_name,
    o.payment_method,
    CONCAT(c.city_name, d.district_name, o.order_address) AS full_address,
    o.recipient_name,
    os.order_status_name
    FROM orders AS o
    LEFT JOIN users AS u ON u.user_id = o.member_id
    LEFT JOIN district AS d ON d.id = o.order_district_id
    LEFT JOIN city AS c ON c.id = d.city_id
    LEFT JOIN order_status AS os ON os.id = o.order_status_id
    WHERE 1=1";

$params = [];

if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND o.order_date BETWEEN :startDate AND :endDate";
    $params['startDate'] = $startDate;
    $params['endDate'] = $endDate;
}
if (!empty($memberSearch)) {
    $query .= " AND (u.name LIKE :memberSearch OR u.user_id LIKE :memberSearch)";
    $params['memberSearch'] = "%$memberSearch%";
}
if (!empty($productSearch)) {
    $query .= " AND EXISTS (SELECT 1 FROM order_details od JOIN product_management pm ON od.order_product_id = pm.product_id WHERE od.order_id = o.id AND (pm.product_name LIKE :productSearch OR pm.product_id LIKE :productSearch))";
    $params['productSearch'] = "%$productSearch%";
}

if (!empty($orderStatus)) {
    $query .= " AND os.id = :orderStatus"; // 假設訂單狀態是以 id 儲存
    $params['orderStatus'] = $orderStatus;
}


$totalQuery = "SELECT COUNT(*) FROM ($query) as subquery";
$totalStmt = $pdo->prepare($totalQuery);
$totalStmt->execute($params);
$totalRows = $totalStmt->fetchColumn(); // 獲取總行數

$totalPages = ceil($totalRows / $perPages);

$query .= " ORDER BY o.id DESC LIMIT :offset, :perPage";
$params['offset'] = ($page - 1) * $perPages;
$params['perPage'] = $perPages;

$stmt = $pdo->prepare($query);
foreach ($params as $key => $value) {
    if ($key == 'offset' || $key == 'perPage') {
        $stmt->bindValue($key, $value, PDO::PARAM_INT);
    } else {
        $stmt->bindValue($key, $value);
    }
}
$stmt->execute();
$orderRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paymentMethodMap = [
    null => '未填寫付款方式',
    'credit-card' => '線上刷卡',
    'line-pay' => 'LINE PAY',
];

$orderDetailsSql = "SELECT
    od.order_product_id,
    p.product_name,
    od.order_unit_price,
    od.order_quantity
    FROM order_details AS od
    LEFT JOIN product_management AS p ON p.product_id = od.order_product_id
    WHERE od.order_id = ?";

foreach ($orderRows as &$order) {
    // 轉換顯示的文字
    $order['payment_method'] = $paymentMethodMap[$order['payment_method']] ?? '未知付款方式';
    $orderDetailsStmt = $pdo->prepare($orderDetailsSql);
    $orderDetailsStmt->execute([$order['order_id']]);
    $orderDetails = $orderDetailsStmt->fetchAll(PDO::FETCH_ASSOC);

    $totalAmount = 0;
    foreach ($orderDetails as $detail) {
        $totalAmount += $detail['order_unit_price'] * $detail['order_quantity'];
    }
    $order['total_amount'] = $totalAmount;
    $order['details'] = $orderDetails;
}

echo json_encode([
    'data' => $orderRows,
    'totalPages' => ceil($totalRows / $perPages),
    'currentPage' => $page
]);
