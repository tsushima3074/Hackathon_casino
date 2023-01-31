<?php
    session_start();
    require "db/user_db.php";
    require "function/user_function.php";

  $error_flag = array();
    

    if(isset($_POST['mail'])) {
        $mail = $_POST['mail'];
        if(!mail_validation($mail)){
          $error_flag[] = "メールの形式が間違っています";
          var_dump($error_flag);
        } else {
          try {
              $user = new user_db();
              $salt=$user->getsalt($mail);
              if($salt){
                echo $salt["salt"];
                $pw = $_POST['pw'];
                if(!pw_validation($pw)){
                  $error_flag[] = "パスワードの形式が間違っています";
                  var_dump($error_flag);
                } else {
                  $hashed_pw = hash256($pw,$salt["salt"]);
                    $user_data=$user->login($mail,$hashed_pw);
                    if ($user_data) {
                      $_SESSION["user"] = $user_data;
                    } else {
                      echo "pwがまちがえています";
                    }
                    var_dump($_SESSION);
                  }
                } else {
                  echo "メールがありません";
                }
         
              } catch (Exception $e) {
                  echo $e;
              }
          }
        } 
 ?>
 
 <form action="login.php" method="post">
    メール：<input type="text" name="mail" id=""><br>
    パスワード：<input type="text" name="pw" id=""><br>
    <input type="submit">
 </form>