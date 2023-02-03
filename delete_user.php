<?php
  session_start();
  require __DIR__ . "/db/user_db.php";

  if(isset($_SESSION["id"])) {
    $id = $_SESSION["user"]["id"];

    try {
      $user = new user_db();
      $user->delete_name_user($id);  
      } catch (Exception $e) {
      echo $e;
      }

  }
    
