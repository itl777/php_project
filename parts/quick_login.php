<?php

session_start();

$_SESSION['admin'] = [
    'id' => 7,
    'account' => 'admin',
    'nickname' => '管理員',
  ];

  header('Location: ../index/index_.php');