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
              <option value="8">8</option>
              <option value="9">9</option>
            </select>
          </div>
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