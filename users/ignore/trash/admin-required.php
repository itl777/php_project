<?php
// include __DIR__ . '/../basic-url.php';

if (!isset($_SESSION)) {
  session_start();
}

if ($_SERVER['REQUEST_URI'] !== '/iSpanProject/index_.php'){
if (!isset($_SESSION['admin'])) {
  header('Location: http://localhost/iSpanProject/index_.php');
  exit;
};
};

?>