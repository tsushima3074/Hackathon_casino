<?php 
  session_start();
  require_once 'function/point_function.php';
  require_once 'db/point_db.php';

  if(isset($_SESSION["user"], $_POST["best"], $_POST["id"])) {
    $point_db = new point_db();
    $point = $point->get_user_point($_SESSION["user"]["id"]);
    if($_POST["best"] < $point) {
      point_function($_SESSION["user"]["id"], $_POST["id"], 1, $_POST["bet"]);
      $user_point = $point_db->update_point($_SESSION["user"]["id"], $_POST["bet"]);
    }
  }


  // $data = [
  //   "bet" => $_POST["bet"]
  // ];

  // echo json_encode($data);

?>
