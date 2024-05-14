<?php
require __DIR__ . '/../../config/pdo-content.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id < 1) {
    header('Location: branch_list.php');
    exit;
}
$sql = "DELETE FROM `branches` WHERE `id`=$id";
$pdo->query($sql);

# $_SERVER['HTTP_REFERER']: 從哪個頁面連過來的
$comeFrom = 'branch_list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}
header("Location: $comeFrom");
