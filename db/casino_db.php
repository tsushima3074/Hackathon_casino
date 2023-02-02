<?php
    include dirname(__FILE__) . '\connect.php';
    include dirname(__FILE__) . "\get_db_data.php";

    class casino_db {

      public function select_roulette_list(){
      
      $db_data = get_select_user_data();
      $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
      $pdo = $connect->get_select_user();

      $sql = "SELECT s.id as id, upper_limit, lower_limit, max_bet, min_bet, now_point, name FROM stand as s
              INNER JOIN  stand_name as sn ON sn.id = s.standname_id
              WHERE standname_id IN(SELECT id FROM stand_name WHERE name LIKE '%ルーレット%')";

      $stm = $pdo->prepare($sql);

      
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_ASSOC);
  
      }

      public function select_slot_list(){
      
        $db_data = get_select_user_data();
        $connect = new Connect($db_data["user"], $db_data["pw"], $db_data["database"], $db_data["server"]);
        $pdo = $connect->get_select_user();
  
        $sql = "SELECT s.id as id, upper_limit, lower_limit, max_bet, min_bet, now_point, name FROM stand as s
                INNER JOIN stand_name as sn ON sn.id = s.standname_id
                WHERE standname_id IN(SELECT id FROM stand_name WHERE name LIKE '%スロット%')";
  
        $stm = $pdo->prepare($sql);
  
        
        $stm->execute();
  
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    
        }
    }