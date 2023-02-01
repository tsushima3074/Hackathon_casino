<?php
    session_start();
    $_SESSION["user"] = 1;
    require_once 'db/casino_db.php';

    if(isset($_SESSION["user"])) {
      try{
        $casino_db = new casino_db();
        $casino = $casino_db->select_game_list();
        var_dump($casino);
      } catch (Exception $e) {
        echo $e;
      }
    }



   