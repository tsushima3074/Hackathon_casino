<?php
    include dirname(__FILE__) . '\connect.php';
    include dirname(__FILE__) . "\get_db_data.php";

    class casino_db {

      public function select_game_list(){
      
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      $pdo = $connect->get_select_user();

      $sql = "SELECT * FROM stand_name as sn
                INNER JOIN stand as s ON sn.id = s.standname_id"; 

      $stm = $pdo->prepare($sql);

      
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_ASSOC);
  
      }

    }