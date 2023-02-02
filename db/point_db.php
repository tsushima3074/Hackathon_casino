<?php  
  include dirname(__FILE__) . '\connect.php';
  include dirname(__FILE__) . "\get_db_data.php";

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

      return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function gift_point($user_id, $gift_id, $number) {
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
  }
