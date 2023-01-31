<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>じょびカジノ</title>
  <style>
    .justify-around {
      justify-content: space-around;
    }
    .justify-center {
      justify-content: center;
    }
    .ta-center {
      text-align: center;
    }
    .r-triangle{
      width: 0;
      height: 0;
      border-left: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    }
    .l-triangle{
      width: 0;
      height: 0;
      border-right: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    }
    .mt-20 {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="flex justify-around mt-20">
    <div class="roulette">
      <!-- 数字部分database -->
      <p class="f-30 ta-center">最低Bet額：100</p>
      <div class="flex justify-center align-center">
        <span class="l-triangle" onclick=""></span>
        <img src="img/icon.png" width="300">
        <!-- <ul class="">
          <li><img src="img/icon.png" width="300"></li>
          <li><img src="img/icon.png" width="300"></li>
          <li><img src="img/icon.png" width="300"></li>
        </ul> -->
        <span class="r-triangle"></span>
      </div>
      <p class="f-30 ta-center">かけ上限額：99999</p>
      <p class="f-30 ta-center">残りかけポイント：99999</p>
      <a href="">ルーレットをプレイする</a>
    </div>
    <div>
    </div>
    <div class="slot">
      <p class="f-30 ta-center">最低Bet額：100</p>
      <div class="flex justify-center align-center">
        <span class="l-triangle"></span>
        <img src="img/slot.png" width="300">
        <span class="r-triangle"></span>
      </div>
      <p class="f-30 ta-center">かけ上限額：99999</p>
      <p class="f-30 ta-center">残りかけポイント：99999</p>
      <a href="">スロットをプレイする</a>
    </div>
  </div>
  <script>

  </script>
</body>
</html>