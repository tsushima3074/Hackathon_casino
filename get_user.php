<?php

  require __DIR__ . "/db_connect_class_sample.php";

  // -------------------環境変数の取得-------------------
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  $user = $_ENV["USER"];
  $pw = $_ENV["PW"];
  $database = $_ENV["DATABASE"];
  $server = $_ENV["SERVER"];

  // --------------------------------------------------

  // インスタンスの生成
  $connect = new Connect($user, $pw, $database, $server);

  $pdo = $connect->get_select_user();
//      sql文の構築
  $sql = "SELECT * FROM users";

//      プリペアードステートメントを作成する
  $stm = $pdo->prepare($sql);

  //      sql文の実行
  $stm->execute();

  var_dump($stm->fetchALL(PDO::FETCH_ASSOC));
