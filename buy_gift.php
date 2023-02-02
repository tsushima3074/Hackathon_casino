<?php
  session_start();

  require_once 'db/gift_db.php';
  require_once 'db/user_db.php';
  require_once 'function/point_function.php';

  $response = [];

  $response["message"] = "ギフトコードが入ります";

  if (isset($_SESSION["user"], $_POST["id"])) {
    try {
      $user_db = new user_db();
      $gift_db = new gift_db();
      $gift_point = $gift_db->get_gift_point($_POST["id"]);
      // 最新のuserテーブルのpointが購入ポイントより高いか
      if ($user_db->get_user_point($_SESSION["user"]["id"]) >= $gift_point) {
        point_function($_SESSION["user"]["id"], $_POST["id"], 2, 0);
        // TODO accountテーブルのpointを減算する関数を呼ぶこと
        $_SESSION["user"] = $user_db->select_mail_user($_SESSION["user"]["mail"]);
      } else {
        $response["message"] = "ポイントが足りません";
      }
    } catch (Exception $e) {
      $response["message"] = "ポイントの更新に失敗しました";
    }
  }

  echo json_encode($response);

