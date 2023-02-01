<?php 
  require_once 'db/casino_db.php';
  session_start();

  if(isset($_SESSION["user"])) {
    try{
      $casino_db = new casino_db();
      $slot = $casino_db->select_slot_list();
      $roulette = $casino_db->select_roulette_list();
    } catch (Exception $e) {
      echo $e;
    }
  }
?>  

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>じょびカジノ</title>
  <?php include('header.php') ?>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
  />
  <link rel="stylesheet" href="src/css/index.css">
  <link rel="stylesheet" href="src/css/slide.css">
</head>
<body>
  <div class="flex justify-around mt-20">
    <div class="roulette ta-center">
      <p class="f-30 bold">最低Bet額 : 100</p>
    <!-- スライド -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="src/img/icon.png"></div>
          <div class="swiper-slide"><img src="src/img/icon.png"></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      
      <p class="f-30 bold">上限値 : 99999</p>
      <p class="f-30 bold">上限まで残り : 99999</p>
      <a href="roulette.php" class="play-btn">ルーレットをプレイする</a>
    </div>

    <div class="slot ta-center">
      <p class="f-30 bold ta-center">最低Bet額 : 100</p>
      <!-- スライド -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="src/img/slot.png"></div>
          <div class="swiper-slide"><img src="src/img/slot.png"></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <p class="f-30 bold">上限値 : <?php ?></p>
      <p class="f-30 bold">上限まで残り : 99999</p>
      <a href="slot.php" class="play-btn">スロットをプレイする</a>
    </div>

    <div class="trade ta-center">
      <p class="f-30 bold">景品交換所</p>
      <a href="trade.php" class="trade-btn">景品と交換する</a>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
</body>
</html>