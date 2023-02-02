<?php 
    session_start();
    require_once 'function/point_function.php';
    require_once 'db/point_db.php';
    if(isset($_SESSION["user"], $_POST["bet"], $_POST["id"])) {
        $point_db = new point_db();
        point_function($_SESSION["user"]["id"], $_POST["id"], 1, $_POST["bet"]);
        $point = $point_db->get_user_point($_SESSION["user"]["id"]);
        $user_point = $point_db->update_point($_SESSION["user"]["id"], $_POST["bet"]);
    }