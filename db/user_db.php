<?php  
  include dirname(__FILE__) . '\connect.php';
  include dirname(__FILE__) . "\get_db_data.php";

  class user_db {

    public function select_mail_user($mail) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM account WHERE mail = :mail";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);

//      プレースホルダに値をバインドする
      $stm->bindValue(":mail", $mail, PDO::PARAM_STR);

//      sql文の実行
      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function select_mail_user2($mail, $id) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM account WHERE mail = :mail AND id <> :id";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);

//      プレースホルダに値をバインドする
      $stm->bindValue(":mail", $mail, PDO::PARAM_STR);
      $stm->bindValue(":id", $id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC);
    }



    public function delete_name_user($id) {
      
          $db_data = get_select_user_data();
          $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
          //      select_userのコネクションを取得
          $pdo = $connect->get_select_user();
  
          
          $sql = "DELETE  FROM account WHERE id = :id";
  
          $stm = $pdo->prepare($sql);
  
          $stm->bindValue(":id", $id, PDO::PARAM_INT);
  
          $stm->execute();
          
    }

  


    // アカウント作成関数
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

      return $this->login($mail, $pw);
    }

    public function login($mail, $pw) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);

  //      insert_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM account WHERE mail = :mail AND password = :pw";
//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
//      プレースホルダに値をバインドする
      $stm->bindValue(":mail", $mail, PDO::PARAM_STR);
      $stm->bindValue(":pw", $pw, PDO::PARAM_STR);

//      sql文の実行
      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    //ソルトを取ってくる
    public function getsalt($mail){
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);

      $pdo = $connect->get_select_user();

      $sql = "SELECT salt FROM account WHERE mail = :mail";

      $stm = $pdo->prepare($sql);

      $stm->bindValue(":mail", $mail, PDO::PARAM_STR);

      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC);

    }

 
    public function update_account($name, $mail, $user_id) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);

  //      insert_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "UPDATE account SET name = :name, mail = :mail WHERE id = :id";
//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
//      プレースホルダに値をバインドする
      $stm->bindValue(":mail", $mail, PDO::PARAM_STR);
      $stm->bindValue(":name", $name, PDO::PARAM_STR);
      $stm->bindValue(":id", $user_id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();
    }

  }
  

