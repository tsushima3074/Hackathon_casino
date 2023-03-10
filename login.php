<?php

  session_start();
  require "db/user_db.php";
  require "function/user_function.php";

  $error_flag = array();
  

  if(isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    if(!mail_validation($mail)){
      $alert = "<script type='text/javascript'>alert('メールの形式が間違っています');</script>";
      echo $alert;
    } else {
      try {
        $user = new user_db();
        $salt=$user->getsalt($mail);
        if($salt){
          $pw = $_POST['pw'];
          if(!pw_validation($pw)){
            $alert = "<script type='text/javascript'>alert('パスワードの形式が間違っています');</script>";
            echo $alert;
          } else {
            $hashed_pw = hash256($pw,$salt["salt"]);
              $user_data=$user->login($mail,$hashed_pw);
              if ($user_data) {
                $_SESSION["user"] = $user_data;
              } else {
                $alert = "<script type='text/javascript'>alert('pwがまちがえています');</script>";
                echo $alert;
              }
              // var_dump($_SESSION);
              header("Location:index.php");
            }
        } else {
          $alert = "<script type='text/javascript'>alert('メールがありません');</script>";
          echo $alert;
        }
      } catch (Exception $e) {
        echo $e;
      }
    }
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
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
      margin-bottom: 50px;
      margin-top: 50px;
    }
    .box {
      width: 40%;
      height: 700px;
      background-color: #E3E3E3;
      border-radius: 50px;
      border: 1px solid #000;
      margin: 0 auto;
      margin-top: 50px;
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
      margin-left: 135px;
      margin-top: 50px;
    }
    .f-input {
      width: 70%;
      font-size: 35px;
    }
    .f-btn {
      width: 65%;
      height: 50px;
      font-size: 30px;
      margin: 50px 0px 30px 135px;
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
  </style>
</head>
<body>
  <div class="flex justify-center align-center">
    <img src="src/img/icon.png" alt="icon">
    <span class="title">じょびカジノ</span>
  </div>
  <div class="box align-center">
    <p class="subtitle">ログイン</p>
    <form action="login.php" method="post" class="account-form">
      <div class="input-center"><label for="mail"><p class="f-p">メールアドレス</p><span class="flex"><img src="src/img/mail.png" width="40"><input type="email" required name="mail" id="mail" class="f-input"></span></label></div><br>
      <div class="input-center"><label for="pass"><p class="f-p">パスワード</p><span class="flex"><img src="src/img/pass.png" width="40"><input type="password" required name="pw" id="pass" class="f-input"></span></label></div><br>
      <button type="submit" class="f-btn">ログイン</button>
    </form>
    <a href="create_account.php" class="move-login">アカウント登録</a>
  </div>
</body>
</html>
