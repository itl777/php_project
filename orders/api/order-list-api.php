<?php
require __DIR__ . '/../../config/pdo-connect.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPages = 20; // 每頁顯示的數據數量

// 總筆數
$totalRows = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
// 計算總頁數
$totalPages = ceil($totalRows / $perPages);



// select 每頁的資料
$offset = ($page - 1) * $perPages;

$perPageData = sprintf("SELECT 
    o.id AS order_id,
    d.id AS district_id,
    c.id AS city_id,
    o.*, u.*, d.*, c.*
    FROM orders AS o
    LEFT JOIN users AS u ON u.user_id = o.member_id
    LEFT JOIN district AS d ON d.id = o.order_district_id
    LEFT JOIN city AS c ON c.id = d.city_id
    ORDER BY o.id DESC LIMIT %s, %s",
    $offset, $perPages
);

$orderStatusMap = [
    null => '',
    'unpaid' => '待付款',
    'paid' => '已付款',
    'expired' => '已逾期',
    'canceled' => '已取消',
    'tallying' => '理貨中',
    'shipping' => '已出貨',
    'arrived' => '已配送',
    'completed' => '已完成',
];

$deliveryMethodMap = [
    null => '',
    'home' => '宅配',
    '7-11' => '7-11超商取貨',
];

$paymentMethodMap = [
    null => '',
    'credit-card' => '線上刷卡',
    'line-pay' => 'LINE PAY',
];

$orderRows = $pdo->query($perPageData)->fetchAll();

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
    $order['order_status'] = $orderStatusMap[$order['order_status']] ?? $order['order_status'];
    $order['delivery_method'] = $deliveryMethodMap[$order['delivery_method']] ?? $order['delivery_method'];
    $order['payment_method'] = $paymentMethodMap[$order['payment_method']] ?? $order['payment_method'];
    // 取得訂單商品明細
    $orderDetailsStmt = $pdo->prepare($orderDetailsSql);
    $orderDetailsStmt -> execute([$order['order_id']]);
    $orderDetails = $orderDetailsStmt->fetchAll();
    // 初始化訂單金額
    $totalAmount = 0;
    // 取的訂單下所有的商品總金額
    foreach ($orderDetails as $detail) {
        $totalAmount += $detail['order_unit_price'] * $detail['order_quantity'];
    }
    // 將總金額放到回傳裡
    $order['total_amount'] = $totalAmount;
}

unset($order);




// 將資料和分頁信息一起發送
echo json_encode([
    'data' => $orderRows,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
