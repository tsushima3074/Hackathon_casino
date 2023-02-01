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
  <div class="flex justify-around">
    <!-- ルーレット部分 -->


    <div>
      <div class="box">
        <h2 class="rule">ルール</h2>
        <p class="rule-text">
          Bet可能額 : 10 ~ 500<br>
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
          <p class="Bet-text text2">Bet額 : </p>
          <input type="number" min="10" max="500" require>
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