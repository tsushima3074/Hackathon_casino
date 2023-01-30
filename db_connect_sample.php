<?php

require __DIR__ . '/vendor/autoload.php';


// select_userのコネクションの取得
// select_userのpdoを戻り値にする
function get_root_user() {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  // データベースの指定
  $database = $_ENV["DATABASE"];
  // サーバーの指定
  $server = $_ENV["SERVER"];
  // ユーザの指定
  $user = $_ENV["USER"];
  // pwの指定
  $pw = $_ENV["PW"];
  // DSM文字列の生成
  $dsn = "mysql:host={$server};dbname={$database};charset=utf8";
  // mysqlへの接続
  try{
    // PDOのインスタンスを作成し、DBに接続する
    $pdo = new PDO($dsn, $user, $pw);
    // プリペアドステートメントのエミュレーションを無効か
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 例外がスローされるように変更する
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // pdoインスタンスを戻り値に指定
    // return $pdo;
    echo "接続成功";
  }catch(Exception $e){
    echo "接続エラー:";
    echo $e -> getMessage();
  }
}

get_root_user();


