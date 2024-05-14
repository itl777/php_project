<?php
include __DIR__ . '/../basic-url.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['admin'])) {
  header('Location:' .BASE_URL. 'index_.php');
  exit;
}

?>