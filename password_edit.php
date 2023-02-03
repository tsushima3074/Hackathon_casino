<?php  
  session_start();

  require_once 'db/user_db.php';
  require_once 'function/user_function.php';
  require_once 'function/public_function.php';

  $error_flag = array();

  // var_dump($_SESSION); 

  if (!isset($_SESSION["user"]["id"])) {
    header("Location:./login.php");
  }

  if (isset($_POST["pw"], $_POST["re_pw"])) {
    $user_id = $_SESSION["user"]["id"];
    $pw = $_POST["pw"];
    $re_pw = $_POST["re_pw"];
    // pwと確認用pwが一致しているか
    if ($pw !== $re_pw) {
      $error_flag[] = "pwが一致していません"; 
    }
    // pwのバリデーションチェック
    if (!pw_validation($pw)) {
      $error_flag[] = "大文字小文字数字を含め、８文字以上を使ってください";
    }

    // salt用のランダムな文字列の取得
    $salt = randomStr(16);

    // pwのhash化
    $hash_pw = hash256($pw, $salt);

    // エラーを管理する配列が空なら、登録処理を実行
    if (empty($error_flag)) {
      try {
        // user_dbクラスのインスタンス作成
        $user_db = new user_db();

        $user = $user_db->update_password($hash_pw, $user_id);
      } catch (Exception $e) {
        $error_flag[] = $e;
      }
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
  <title>パスワード編集</title>
  <style>
    .flex {
      display: flex;
    }
    .justify-center {
      justify-content: center;
    }
    .justify-around {
      justify-content: space-around;
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
      margin-top: 40px;
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
      font-size: 35px;
      margin-bottom: 0;
      margin-top: 5px;
    }
    .form-div {
      display: flex;
    }
    .input-center {
      margin: 0 auto;
      margin-top: 80px;
      margin-bottom: 30px;
      margin-left: 135px;
    }
    .f-input {
      width: 70%;
      font-size: 35px;
    }
    .f-btn {
      width: 65%;
      height: 60px;
      font-size: 30px;
      margin: 10px 0px 20px 135px;
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
    .f-a {
      font-size: 20px;
    }
  </style>
</head>
<body>
  <?php include "header.php"; ?> 
  <div class="box align-center">
    <p class="subtitle">パスワード編集</p>
    <form action="password_edit.php" method="post">
      <div class="input-center"><label for="pass"><p class="f-p">パスワード</p><span class="flex"><img src="src/img/pass.png" width="40"><input type="password" name="pw" id="" class="f-input" required></span></label></div>
      <div class="input-center"><label for="password"><p class="f-p">確認パスワード</p><span class="flex"><img src="src/img/pass.png" width="40"><input type="password" name="re_pw" id="" class="f-input" required></span></label></div><br>
      <button type="submit" class="f-btn">編集</button>
    </form>
    <div class="flex justify-around"><a href="account_edit.php" class="f-a">アカウント編集</a><a href="account_delete.php" class="f-a">アカウント削除</a></div>
  </div>
</body>
</html>


