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

<form action="./create_account.php" method="post">
  mail: <input type="text" name="mail" id=""><br>
  name: <input type="text" name="name" id=""><br>
  pw: <input type="text" name="pw" id=""><br>
  repw: <input type="text" name="re_pw" id=""><br>
  <button type="submit">送信</button>
</form>
