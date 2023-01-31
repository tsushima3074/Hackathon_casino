<?php
    session_start();
    require __DIR__ . "\db\user_db.php";

    if(isset($_SESSION["id"])) {
      $id = $_SESSION["user"]["id"];

      try {
        $user = new user_db();
        $data = $user->delete_name_user($id);
        var_dump($data);  
        } catch (Exception $e) {
        echo $e;
        }

    }
    
