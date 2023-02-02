<?php
  session_start();

  require_once 'db/casino_db.php';
  /* 
  ・セッションの確認
  ・getで台のidを受け取る
  ・台のbet額を表示

  ・使ったポイントの登録
  ・勝ったときのみポイント加算
  */


  if(isset($_SESSION["user"])) {
    if(isset($_GET["id"])){
      try{
        $id = $_GET["id"];
        $casino_db = new casino_db();
        $roulette = $casino_db->select_roulette_bet($id);
        // var_dump($roulette);
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
  <title>ルーレット</title>
  <link rel="stylesheet" href="src/css/roulette.css">
  <?php include "header.php" ?>
</head>
<body>
  <div class="flex justify-around">
    <!-- ルーレット部分 -->
    <div class="display">
      <div id="roulette" class="roulette"></div>
      <div class="c_button">
        <button id ="start">スタート</button>
        <button id ="stop">ストップ</button>
        <button id ="reset">リセット</button>
      </div>
    </div>
    <div>
      <div class="box">
        <h2 class="rule">ルール</h2>
        <p class="rule-text">
          Bet可能額 : <?php echo $roulette["min_bet"]; ?> ~ <?php echo $roulette["max_bet"]; ?><br>
          ナンバーを選択し、Bet額を入力することでBetすることが出来ます。<br>
          回すをクリックして選択したナンバーに止まると、<br>
          ポイントを獲得することができます。<br>
          右下にこの台での変動したポイントが表示されます。<br>
          一度止まった数字には止まらない設定です。<br>
          リセットを押せば止まった数字の履歴が消えます。
        </p>
      </div>

      <div class="box Bet-box">
        <form class="Bet-form flex align-center">
          <p class="Bet-text text1">Betナンバー : </p>
          <div class="select-div">
            <select class="Bet-select">
              <option value="0" selected>0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="2">8</option>
              <option value="2">9</option>

            </select>
          </div>
          <p class="Bet-text text2">Bet額 : </p>
          <input type="number" min="<?php echo $roulette["min_bet"]; ?>" max="<?php echo $roulette["max_bet"]; ?>" value="<?php $roulette['min_bet']; ?>" id="Bet" require>
        </form>
      </div>

      <div class="box">
        <p class="change-point-text">ポイントの変動 : +99999</p>
      </div>
    </div>
  </div>
  <script src="src/js/roulettte.js"></script>
</body>
</html>
  
</body>
</html>