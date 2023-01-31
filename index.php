<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>じょびカジノ</title>
  <!-- slickのcssを読み込むCDN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
  <!-- slick.jsとjquery.jsを読み込むCDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
    /* .l-triangle{
      width: 0;
      height: 0;
      border-right: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    }
    .r-triangle{
      width: 0;
      height: 0;
      border-left: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    } */
    .roulette > p , .slot > p {
      margin-top: 20px;
    }
    .mt-20 {
      margin-top: 20px;
    }
    .bold {
      font-weight: 600;
      color: #333;
    }
    .li-none {
      list-style: none;
    }
    .play-btn, .trade-btn {
      display: inline-block;
      text-align: center;
      padding: 20px 60px;
      text-decoration: none;
      background-color: #999;
      color: #fff;
      margin-top: 30px;
      font-size: 25px;
      font-weight: 600;
      border-radius: 40px;
    }
    .play-btn:hover {
      background: #777;
    }
    .trade-btn {
      background-color: #40bb62;
    }
    .trade-btn:hover {
      background-color: #3bab5a;
    }

    /* スライド関係 */
    .slide-image {
      width:100%;
    }
    .slide-items {
      display: block;
      list-style-type: none;
      margin-block-start: 0;
      margin-block-end: 0;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      padding-inline-start: 0;
      margin: 0;
      padding: 0;
    }
    .slide-items > li {
      margin: 0;
      padding:0;
    }
    .slide-grp {
      position: relative;
      top: 0px;
      left: 40px;
      max-width: 300px;
      height: 300px;
      z-index:1;
    }
    .next-arrow {
      position: absolute;
      top: 90px;
      left: 320px;
      width: 0;
      height: 0;
      border-left: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    }
    .prev-arrow {
      position: absolute;
      top: 90px;
      right: 320px;
      width: 0;
      height: 0;
      border-right: 30px solid black;
      border-top: 30px solid transparent;
      border-bottom: 30px solid transparent;
    }
  </style>
</head>
<body>
  <div class="flex justify-around mt-20">

    <div class="roulette ta-center">
      <p class="f-30 bold">最低Bet額 : 100</p>
      <!-- 実際のスライドショー -->
      <div class="slide-grp">
        <ul class="slide-items">
          <li><img class="slide-image" src="img/icon.png" alt="roulette1"></li>
          <li><img class="slide-image" src="img/icon.png" alt="roulette2"></li>
        </ul>
      </div>
      <p class="f-30 bold">上限値 : 99999</p>
      <p class="f-30 bold">上限まで残り : 99999</p>
      <a href="roulette.php" class="play-btn">ルーレットをプレイする</a>
    </div>

    <div class="slot ta-center">
      <p class="f-30 bold ta-center">最低Bet額 : 100</p>
      <!-- 実際のスライドショー -->
      <div class="slide-grp">
        <ul class="slide-items">
          <li><img class="slide-image" src="img/slot.png" alt="slot1"></li>
          <li><img class="slide-image" src="img/slot.png" alt="slot2"></li>
        </ul>
      </div>
      <p class="f-30 bold">上限値 : 99999</p>
      <p class="f-30 bold">上限まで残り : 99999</p>
      <a href="slot.php" class="play-btn">スロットをプレイする</a>
    </div>

  </div>
  <div class="trade ta-center">
    <!-- <p class="f-30 bold subtitle">景品交換所</p> -->
    <a href="trade.php" class="trade-btn">景品と交換する</a>
  </div>
  <script>
    // slickの設定
    $('.slide-items').slick({
      fade: false,
      speed: 1000,           // 画像切り替えにかかる時間（ミリ秒）
      arrows: true,         // 矢印表示・非表示
      slidesToShow: 1,       // スライド表示数
      slidesToScroll: 1,     // スライドする数
      infinite: true,      // 無限リピート オン・オフ
      pauseOnHover: true,     //マウスホバーで一時停止
      adaptiveHeight: true,
      prevArrow: '<span src="画像のパス" class="prev-arrow"></span>',
      nextArrow: '<span src="画像のパス" class="next-arrow"></span>',
    });
  </script>
  
</body>
</html>