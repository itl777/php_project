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
  <!-- JQuery -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- 套版的navbar要加的 -->
  <link href="../css/styles.css" rel="stylesheet" />
  <script>
    const loginData = function(e) {
      e.preventDefault();
      let sendData = new FormData(document.loginForm); // 沒有外觀的表單物件
      fetch(`http://localhost/iSpanProject/parts/login_api.php`, {
        method: 'POST',
        body: sendData,
      }).then(r => r.json()).then(data => {
        console.log(data);
        // if(data)
        window.location.reload();
      });
    }
  </script>
  <link rel="stylesheet" href="../css/order-list.css">
</head>

<body>





  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">登入</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form name="loginForm" id="loginForm" onsubmit="loginData(event)">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">帳號</label>
              <input type="text" class="form-control" name="account">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">密碼</label>
              <input type="password" class="form-control" name="password">
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            <button type="submit" class="btn btn-primary">登入</button>
          </form>

        </div>
      </div>
    </div>
  </div>