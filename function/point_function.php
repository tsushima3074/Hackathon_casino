<?php

  require_once dirname(__DIR__). "\db\point_db.php";
  
  // pointをDBに登録する関数
  function point_function($user_id, $id, $type, $point) {
    // pointを管理するクラスのインスタンスを作成
    $point_db = new point_db();
    // typeが1ならカジノを遊戯したと判定
    if ($type === 1) {
      $point_db->casino_point($user_id, $id, $point);
    } else {
      $point_db->gift_point($user_id, $id);
    }
  }


  // 実行テスト
    // casinoのテスト
  //  point_function(2, 1, 1, 100);
  // point_function(7, 1, 1, -100);

  // giftのテスト
  // point_function(7, 7, 2, 0);
