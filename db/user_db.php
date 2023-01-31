<?php  
  include dirname(__FILE__) . '\connect.php';
  include dirname(__FILE__) . "\get_db_data.php";

  class user_db {

    public function select_name_user($name) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM users WHERE name = :name";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);

//      プレースホルダに値をバインドする
      $stm->bindValue(":name", $name, PDO::PARAM_STR);

//      sql文の実行
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_account($name, $mail, $pw, $salt) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);

  //      insert_userのコネクションを取得
      $pdo = $connect->get_select_user();
  //    sql文の構築
      $sql = "INSERT INTO account(name, mail, password, salt, point) VALUES (:name, :mail, :pw, :salt, 500)";
  //      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
  //      プレースホルダに値をバインドする
      $stm->bindValue(":name", $name, PDO::PARAM_STR);
       $stm->bindValue(":mail", $mail, PDO::PARAM_STR);
       $stm->bindValue(":pw", $pw, PDO::PARAM_STR);
       $stm->bindValue(":salt", $salt, PDO::PARAM_STR);

       $stm->execute();

      // return $this->login($mail, $pw);
    }
  }



