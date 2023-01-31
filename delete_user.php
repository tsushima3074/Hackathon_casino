<?php
  include "header.php";

  session_start();
  require __DIR__ . "\db\user_db.php";

  if(isset($_SESSION["id"])) {
    $id = $_SESSION["user"]["id"];

    try {
      $user = new user_db();
      $user->delete_name_user($id);  
    } catch (Exception $e) {
      echo $e;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント削除</title>
  <style>
    .flex {
      display: flex;
    }
    .justify-center {
      justify-content: center;
    }
    .align-center {
      align-items: center;
    }
    .title {
      font-size: 40px;
      font-weight: 600;
    }
    .subtitle {
      font-size: 50px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
      margin-top: 50px;
    }
    .box {
      width: 40%;
      height: 700px;
      background-color: #E3E3E3;
      border-radius: 50px;
      border: 1px solid #000;
      margin: 0 auto;
      margin-top: 30px;
    }
    .account-form {
      margin: 0 auto;
    }
    .f-p {
      font-size: 30px;
      margin-bottom: 0;
      margin-top: 5px;
    }
    .form-div {
      display: flex;
    }
    .input-center {
      margin: 0 auto;
      margin-top: 80px;
      margin-left: 135px;
    }
    .f-input {
      width: 70%;
      font-size: 40px;
    }
    .f-btn {
      width: 65%;
      height: 50px;
      font-size: 30px;
      margin: 60px 0px 50px 135px;
      color: #fff;
      border: none;
      background-color: #31C4FC;
      border-radius: 50px;
    }
    .f-btn:hover {
      cursor: pointer;
      background-color: #2EB7E2;
    }
    .move-login {
      font-size: 25px;
      margin-left: 130px;
    }
    .input-center {
      margin: 0 auto;
      margin-left: 135px;
      margin-top: 80px;
      margin-bottom: 50px;
    }
  </style>
</head>
<body>
  <div class="box align-center">
    <p class="subtitle">アカウント削除</p>
    <div class="input-center"><p class="f-p">ユーザ名 : name</p></div>
    <div class="input-center"><p class="f-p">所有ポイント : 999999</p></div>
    <button type="submit" class="f-btn">削除</button>
    <a href="login.php" class="move-login">アカウント編集</a>
  </div>
</body>
</html>

