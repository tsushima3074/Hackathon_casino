<?php
  session_start();

  require_once 'db/user_db.php';
  require_once 'function/public_function.php';
  require_once 'function/user_function.php';

  $error_flag = array();

  // postデータの存在チェック
  if (isset($_POST["mail"], $_POST["name"], $_POST["pw"], $_POST["re_pw"])) {
    // 変数に代入
    $mail = $_POST["mail"];
    $name = $_POST["name"];
    $pw = $_POST["pw"];
    $re_pw = $_POST["re_pw"];
    // pwと確認用pwが一致しているか
    if ($pw !== $re_pw) {
      $error_flag[] = "pwが一致していません"; 
    }
    // メール形式で送られてきているか
    if (!mail_validation($mail)) {
      $error_flag[] = "メール形式が不正です";
    }
    // 名前のバリデーションチェック
    if (!name_validation($name)) {
      $error_flag[] = "名前が短い、もしくは長すぎます";
    }
    // pwのバリデーションチェック
    if (!pw_validation($pw)) {
      $error_flag[] = "大文字小文字数字を含め、８文字以上を使ってください";
    }

    // エラーを管理する配列が空なら、登録処理を実行
    if (empty($error_flag)) {
      // salt用のランダムな文字列の取得
      $salt = randomStr(16);

      // pwのhash化
      $hash_pw = hash256($pw, $salt);

      try {
        // user_dbクラスのインスタンス作成
        $user_db = new user_db();
        // 登録しようとしているメールが使われていないか確認
        if ($user_db->select_mail_user($mail)) {
          $error_flag[] = "既に使われているメールです";
        } else {
          $user = $user_db->create_account($name, $mail, $hash_pw, $salt);
          $_SESSION["user"] = $user;
        }
      } catch (Exception $e) {
        $error_flag[] = $e;
      }
    }

    if (empty($error_flag)) {
      header("Location:index.php");
      exit();
    }

    foreach($error_flag as $message) {
      echo "<script>alert('" . $message . "')</script>";
    }
    
  } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント登録</title>
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
    <img src="img/icon.png" alt="icon">
    <span class="title">じょびカジノ</span>
  </div>
  <div class="box align-center">
    <p class="subtitle">アカウント登録</p>
    <form action="./create_account.php" method="post" class="account-form">
      <div class="input-center"><p class="f-p">メールアドレス</p><span class="flex"><img src="src/img/mail.png" width="40"><input type="email" name="mail" id="" class="f-input" required></span></div><br>
      <div class="input-center"><p class="f-p">ユーザ名</p><span class="flex"><img src="src/img/user.png" width="40"><input type="text" name="name" id="" class="f-input" required></span></div><br>
      <div class="input-center"><p class="f-p">パスワード</p><span class="flex"><img src="src/img/pass.png" width="40"><input type="password" name="pw" id="" class="f-input" required></span></div><br>
      <div class="input-center"><p class="f-p">確認用パスワード</p><span class="flex"><img src="src/img/pass.png" width="40"><input type="password" name="re_pw" id="" class="f-input" required></span></div><br>
      <button type="submit" class="f-btn">アカウント作成</button>
    </form>
    <a href="login.php" class="move-login">ログイン画面へ</a>
  </div>
</body>
</html>
