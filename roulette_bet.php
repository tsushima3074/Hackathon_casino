<?php
  session_start();
  require 'function/point_function.php';
  require 'db/point_db.php';
  if(isset($_SESSION["user"], $_POST["bet"], $_POST["id"])) {
    point_function($_SESSION["user"]["id"], $_POST["id"], 1, $_POST["bet"]);
    //$point_db = new point_db();
    // $user_point = $point_db->update_point($_SESSION["user"]["id"], $_POST["bet"]);
  }


// $data = [
//   "bet" => $_POST["bet"]
// ];

// echo json_encode($data);