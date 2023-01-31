<?php
    require __DIR__ . "\db\user_db.php";

    $id = $_SESSION["id"];

    $user = new user_db();

    $data = $user->delete_name_user($id);
    var_dump($data);