<?php


if (!isset($pageName))
  $pageName = ''; ?>




<style>
  .container .navbar-nav .nav-link.active {
    border-radius: 6px;
    background-color: #0d6efd;
    color: white;
    font-weight: 900;
  }

  .container .navbar-brand {
    background-color: black;
    color: white;
  }

  .container .navbar-brand:hover {
    color: gold;
  }
</style>
<div class="container">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand px-2" href="<?= BASE_URL ?>index_.php">資料表練習</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link px-2 <?= $pageName == 'orders' ? 'active' : '' ?>" href="<?= BASE_URL ?>orders/order-list.php">訂單列表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 <?= $pageName == 'users' ? 'active' : '' ?>" href="<?= BASE_URL ?>users/users.php">會員列表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 <?= $pageName == 'products' ? 'active' : '' ?>" href="<?= BASE_URL ?>products/index.php">商品列表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 <?= $pageName == 'orders' ? 'active' : '' ?>" href="<?= BASE_URL ?>themes/address_book/theme_list.php">行程列表</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 <?= $pageName == 'orders' ? 'active' : '' ?>" href="<?= BASE_URL ?>teams/teams.php">揪團列表</a>
          </li>
        </ul>

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if (isset($_SESSION['admin'])) : ?>
            <!--有登入才顯示的-->
            <li class="nav-item">
              <a class="nav-link px-2"><?= $_SESSION['admin']['nickname'] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2" href="<?= BASE_URL ?>parts/logout.php">登出</a>
            </li>
          <?php else : ?>
            <!--沒分是否登入的-->
            <li class="nav-item">
              <a class="nav-link px-2" data-bs-toggle="modal" data-bs-target="#loginModal">登入會員</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 <?= $pageName == 'register' ? 'active' : '' ?>" href="./register.php">註冊</a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
</div>