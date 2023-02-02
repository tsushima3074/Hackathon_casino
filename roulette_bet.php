<?php
  session_start();
  require 'function/point_function.php';
  if(isset($_SESSION["user"], $_POST["bet"], $_POST["id"])) {
    point_function($_SESSION["user"]["id"], $_POST["id"], 1, $_POST["bet"]);

  }


// $data = [
//   "bet" => $_POST["bet"]
// ];

// echo json_encode($data);