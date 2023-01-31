<?php
  session_start();

  require_once 'db/user_db.php';
  require_once 'function/public_function.php';
  require_once 'function/user_function.php';

  $error_flag = ();

  // postデータの存在チェック
  if (isset($_POST["mail"], $_POST["name"], $_POST["pw"], $_POST["re_pw"])) {
    // 変数に代入
    $mail = $_POST["mail"];
    $name = $_POST["name"];
    if ($_POST["pw"] !== $_POST["re_pw"]) {
      $error_flag[] = "pwが一致していません"; 
    }
    if (mail_validation())
  } else {
    $error_flag[] = "ちゃんとデータ送ってください";
  }
