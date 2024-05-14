<?php

require __DIR__ . '/connect-config.php';

$dsn = "mysql:host={$db_host};dbname={$db_name};port=3306;charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

if (!isset($_SESSION)) {
  session_start();
}
