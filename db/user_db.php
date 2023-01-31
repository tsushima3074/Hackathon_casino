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


    public function delete_name_user($id) {
          
          $db_data = get_select_user_data();
          $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
          //      select_userのコネクションを取得
          $pdo = $connect->get_select_user();
  
          
          $sql = "DELETE * FROM account WHERE id = :id";
  
          $stm = $pdo->prepare($sql);
  
          $stm->bindValue(":id", $id, PDO::PARAM_STR);
  
          $stm->execute();
    }

    
  }

