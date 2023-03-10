<?php  
  require_once dirname(__FILE__) . '/connect.php';
  require_once dirname(__FILE__) . "/get_db_data.php";

  class gift_db {

    public function select_gift() {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM gift_name";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);

//      sql文の実行
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_gift_point($gift_id) {
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      //      select_userのコネクションを取得
      $pdo = $connect->get_select_user();
//      sql文の構築
      $sql = "SELECT * FROM gift_name WHERE id = :id";

//      プリペアードステートメントを作成する
      $stm = $pdo->prepare($sql);
      $stm->bindValue(":id", $gift_id, PDO::PARAM_INT);

//      sql文の実行
      $stm->execute();

      return $stm->fetch(PDO::FETCH_ASSOC)["exchange_point"];
    }
  }
