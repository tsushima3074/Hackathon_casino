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
          最低Bet額 : 10<br>
          ナンバーを選択し、Bet額を入力することでBetすることが出来ます。<br>
          回すをクリックして選択したナンバーに止まると、<br>
          ポイントを獲得することができます。<br>
          右下にこの台での変動したポイントが表示されます。
        </p>
      </div>

      <div class="box">
        <form class="Bet flex">
          <p class="Bet-text">Betナンバー</p>
          <input type="text" name="Bet-number" id="" require>
          <p class="Bet-text">Bet額</p>
          <input type="text" name="Bet-point" id="" require>
        </form>
      </div>

      <div class="box">
        <p class="change-point-text">ポイントの変動 : +9999</p>
      </div>

    </div>
  </div>
  
  <script src="src/js/roulettte.js"></script>
</body>
</html>