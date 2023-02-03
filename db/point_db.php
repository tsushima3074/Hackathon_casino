<?php  
  require_once dirname(__FILE__) . '/connect.php';
  require_once dirname(__FILE__) . "/get_db_data.php";

  class point_db {

    public function casino_point($user_id, $stand_id, $point) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "INSERT INTO casino VALUES(NULL, :point, :stand_id, :user_id)";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);

//      プレースホルダに値をバインドする
      $stm->bindValue(":point", $point, PDO::PARAM_INT);
      $stm->bindValue(":stand_id", $stand_id, PDO::PARAM_INT);
      $stm->bindValue(":user_id", $user_id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();

    }

    public function gift_point($user_id, $gift_id) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "INSERT INTO gift VALUES(NULL, :gift_id, :user_id, (SELECT exchange_point FROM gift_name WHERE id = :id), 0)";

      //      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
//      プリペアードステートメントを作成する
      $stm->bindValue(":gift_id", $gift_id, PDO::PARAM_INT);
      $stm->bindValue(":user_id", $user_id, PDO::PARAM_INT);
      $stm->bindValue(":id", $gift_id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();

    }

    //ポイントの変更を行う
    public function update_point($user_id, $point) {
      $db_data = get_select_user_data();
      
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      
      $pdo = $connect->get_select_user();

      $sql = "UPDATE account set point = point + :used_point WHERE id = :id";

      $stm = $pdo->prepare($sql);

      $stm->bindValue(":id", $user_id, PDO::PARAM_INT);
      $stm->bindValue(":used_point", $point ?? 0, PDO::PARAM_INT);

      $stm->execute();
    }

    public function get_user_point($user_id) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);

  //      insert_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT point FROM account WHERE id = :id";
//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
//      プレースホルダに値をバインドする
      $stm->bindValue(":id", $user_id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC)["point"];
    }
    
  }
