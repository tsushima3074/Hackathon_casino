<?php
  session_start();

  require_once 'db/casino_db.php';

  if(isset($_SESSION["user"])) {
    if(isset($_GET["id"])){
      try{
        $id = $_GET["id"];
        $casino_db = new casino_db();
        $slot = $casino_db->select_roulette_bet($id);
        // var_dump($slot);
      } catch (Exception $e) {
        echo $e;
      }
    }

  }else {
    header("Location:login.php");
  }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>スロット</title>
  <link rel="stylesheet" href="src/css/slot.css">
  <?php include "header.php" ?>
</head>
<body>
  <div class="flex">
    <!-- スロット部分 -->
    <div class="slot">
      <canvas id="slotcan" class="slot-canvas"></canvas>
      <div class="slot-div">
        <div class="reel"><a class="slotButton" id="stop1">Stop</a></div>
        <div class="reel"><a class="slotButton" id="stop2">Stop</a></div>
        <div class="reel"><a class="slotButton" id="stop3">Stop</a></div>
      </div>
      <div>
        <div class="Start-btn"><a class="slotButton slotStart" id="start">Start</a></div>
        <div id="slotresult" class="result">　</div>
      </div>
    </div>

    <div class="margin">
      <div class="box">
        <h2 class="rule">ルール</h2>
        <p class="rule-text">
          Bet額 : <?php echo $slot["min_bet"];?><br>
          Bet額を入力することでBetすることが出来ます。<br>
          StartをクリックしてStopボタンを押すことで止まります。<br>
          列がそろうとポイントを獲得することができます。<br>
          右下にこの台での変動したポイントが表示されます。          
        </p>
      </div>
      <div class="box Bet-box">
        <form class="Bet-form flex align-center">
          <p class="Bet-text text2">Bet額 : </p>
          <input type="number" 
            min="<?php echo $slot['max_bet']; ?>"
            max="<?php echo $_SESSION['user']['point'] > $slot['max_bet'] ? $slot['max_bet']  : 0 ?>"
            value="<?php echo $_SESSION['user']['point'] > $slot['max_bet'] ? $slot['max_bet']  : 0 ?>"id="Bet" require readonly="readonly">
        </form>
      </div>
      <div class="box">
        <p class="change-point-text">ポイントの変動 : <span id="change_point">+9999</span></p>
      </div>
    </div>
  </div>
  
  <script src="src/js/slot.js"></script>
</body>
</html>