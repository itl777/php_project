<?php
include __DIR__ . '/../basic-url.php';
if (!isset($_SESSION)) {
  session_start();
}
if ($_SERVER['REQUEST_URI'] !== '/iSpanProject/index_.php') {
  if (!isset($_SESSION['admin'])) {
    header('Location: http://localhost/iSpanProject/index_.php');
    exit;
  }
}

?>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($title) ? "$title | 密室逃脫" : '塊陶啊' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script>
    const loginData = function (e) {
      e.preventDefault();
      let sendData = new FormData(document.loginForm); // 沒有外觀的表單物件
      fetch(`http://localhost/iSpanProject/parts/login_api.php`, {
        method: 'POST',
        body: sendData,
      }).then(r => r.json()).then(data => {
        // console.log(data);
        window.location.reload();
      });
    }
  </script>
</head>

<body>
  <?php include __DIR__ . '/login_modal.php' ?>