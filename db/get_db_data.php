<?php
  require __DIR__ . '/vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  function get_select_user_data() {
    $data = [
      "user" => $_ENV["USER"],
      "pw" => $_ENV["PW"],
      "database" => $_ENV["DATABASE"],
      "server" => $_ENV["SERVER"]
    ];
    return $data;
  }
