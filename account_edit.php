<?php
  session_start();

  require_once 'db/user_db.php';
  require_once 'function/user_function.php';
  require_once 'function/public_function.php';

  $error_flag = array();

  var_dump($_SESSION);

  if (!isset($_SESSION["user"]["id"])) {
    header("Location:./login.php");
  }

  if (isset($_POST["mail"], $_POST["name"])) {
    $user_id = $_SESSION["user"]["id"];
    $mail = $_POST["mail"];
    $name = $_POST["name"];

    // メール形式で送られてきているか
    if (!mail_validation($mail)) {
      $error_flag[] = "メール形式が不正です";
    }
    // 名前のバリデーションチェック
    if (!name_validation($name)) {
      $error_flag[] = "名前が短い、もしくは長すぎます";
    }

    // エラーを管理する配列が空なら、登録処理を実行
    if (empty($error_flag)) {
      try {
        // user_dbクラスのインスタンス作成
        $user_db = new user_db();
        $user = $user_db->select_mail_user2($mail, $user_id);
        if ($user) {
          $error_flag[] = "既に使われているメールです";
        } else {
          $user = $user_db->update_account($name, $mail, $user_id);
          $_SESSION["user"] = $user_db->select_mail_user($mail);
        }
      } catch (Exception $e) {
        $error_flag[] = $e;
      }
    } 
  } else {
    $error_flag = "ちゃんとデータをおくってください";
  }

  var_dump($error_flag);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント編集</title>
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
      margin-top: 20px;
    }
    .box {
      width: 40%;
      height: 750px;
      background-color: #E3E3E3;
      border-radius: 50px;
      border: 1px solid #000;
      margin: 0 auto;
      margin-top: 10px;
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
    }
    .f-input {
      width: 70%;
      font-size: 35px;
    }
    .f-btn {
      width: 65%;
      height: 50px;
      font-size: 30px;
      margin: 20px 0px 20px 135px;
      color: #fff;
      border: none;
      background-color: #31C4FC;
      border-radius: 50px;
    }
    .f-btn:hover {
      cursor: pointer;
    }
    .move-login {
      font-size: 25px;
      margin-left: 130px;
    }
  </style>
</head>
<body>
  <div>
    <form action="account_edit.php" method="post">
      <div class="input-center"><p class="f-p">メールアドレス</p><span class="flex"><img src="img/mail.png" width="40"><input type="text" name="mail" id="" class="f-input"></span></div>
      <div class="input-center"><p class="f-p">ユーザ名</p><span class="flex"><img src="img/user.png" width="40"><input type="text" name="name" id="" class="f-input"></span></div><br>
      <!-- メールアドレス: <input type="text" name="mail" id=""><br>
      ユーザ名: <input type="text" name="name" id=""><br> -->
      <button type="submit">送信</button>
    </form>
  </div>
</body>
</html>


