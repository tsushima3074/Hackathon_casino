<?php
  require __DIR__ . "\db\user_db.php";

  $name = $_POST["name"];

  $user = new user_db();

  $data = $user->select_name_user($name);
  var_dump($data);
  
