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

<form action="account_edit.php" method="post">
  name: <input type="text" name="name" id=""><br>
  mail: <input type="text" name="mail" id=""><br>
  <button type="submit">送信</button>
</form>
