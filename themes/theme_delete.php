<?php
require __DIR__ . '/../config/pdo-connect.php';
$id = isset($_GET['theme_id']) ? intval($_GET['theme_id']) : 0;
if ($id < 1) {
    header('Location: theme_list.php');
    exit;
}
$sql = "DELETE FROM `themes` WHERE `theme_id`=$id";
$pdo->query($sql);

# $_SERVER['HTTP_REFERER']: 從哪個頁面連過來的
$comeFrom = 'theme_list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}
header("Location: $comeFrom");
