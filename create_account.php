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

    // salt用のランダムな文字列の取得
    $salt = randomStr(16);

    // pwのhash化
    $hash_pw = hash256($pw, $salt);

    try {
      $user_db = new user_db();
      $user_db->create_account($name, $mail, $hash_pw, $salt);
    } catch (Exception $e) {
      $error_flag[] = $e;
    }

    var_dump($error_flag);
    
  } else {
    $error_flag[] = "ちゃんとデータ送ってください";
  }

?>

<form action="./create_account.php" method="post">
  mail: <input type="text" name="mail" id=""><br>
  name: <input type="text" name="name" id=""><br>
  pw: <input type="text" name="pw" id=""><br>
  repw: <input type="text" name="re_pw" id=""><br>
  <button type="submit">送信</button>
</form>
