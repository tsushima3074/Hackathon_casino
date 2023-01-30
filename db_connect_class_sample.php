<?php

  require __DIR__ . '/vendor/autoload.php';

  class Connect {

    // ユーザの指定
    private $user;
    // pwの指定
    private $pw;

    // データベースの指定
    private $database;
    // サーバーの指定
    private $server;

    // コンストラクタの定義
    function __construct($user, $pw, $database, $server) {
      $this->user = $user;
      $this->pw = $pw;
      $this->database = $database;
      $this->server = $server;
    }

    // select_userのコネクションの取得
    // select_userのpdoを戻り値にする
    public function get_select_user() {
      // DSM文字列の生成
      $dsn = "mysql:host={$this->server};dbname={$this->database};charset=utf8";
      // mysqlへの接続
      try{
        // PDOのインスタンスを作成し、DBに接続する
        $pdo = new PDO($dsn, $this->user, $this->pw);
        // プリペアドステートメントのエミュレーションを無効か
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // 例外がスローされるように変更する
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // pdoインスタンスを戻り値に指定
        echo "接続成功";
        return $pdo;
      }catch(Exception $e){
        echo "接続エラー:";
        echo $e -> getMessage();
        exit();
      }
    }
  }

  // -------------------環境変数の取得-------------------
  // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  // $dotenv->load();
  // $user = $_ENV["USER"];
  // $pw = $_ENV["PW"];
  // $database = $_ENV["DATABASE"];
  // $server = $_ENV["SERVER"];

  // --------------------------------------------------

  // インスタンスの生成
  // $connect = new Connect($user, $pw, $database, $server);
  // コネクションの取得
  // $connect->get_select_user();

