<?php

  session_start();

  require_once 'db/gift_db.php';

  if (isset($_SESSION["user"])) {
    $gift_db = new gift_db();
    try {
      $gifts = $gift_db->select_gift();
      // var_dump($gifts);
    } catch (Exception $e) {
      echo $e;
    }
  } else {
    header("Location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>景品交換所</title>
  <link rel="stylesheet" href="src/css/gift_trade.css">
  <?php include "header.php" ?>
</head>
<body>
  <p class="subtitle">景品交換所</p>
  <div class="column column03">
    <ul>
      <?php foreach($gifts as $gift): ?>
        <li><img src="src/img/ダウンロード.jfif" /><p><?php echo $gift["gift"]; ?></p><span>交換ポイント : <?php echo $gift["exchange_point"] ?></span><button class="trade-btn" disabled>交換する</button></li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
