<?php 
  session_start();
  require_once 'db/casino_db.php';

  if(isset($_SESSION["user"])) {
    try{
      $casino_db = new casino_db();
      $slot = $casino_db->select_slot_list();
      $roulette = $casino_db->select_roulette_list();
      // var_dump($roulette);
    } catch (Exception $e) {
      echo $e;
    }
  } else {
    header("Location:login.php");
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
      
    <!-- スライド -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php foreach($roulette as $r) : ?>
          <div class="swiper-slide">
            <p class="f-30 bold">最低Bet額 : <?php echo $r["min_bet"]; ?></p>
            <p class="f-30 bold">最高Bet額 : <?php echo $r["max_bet"]; ?></p>
            <img src="src/img/icon.png">
            <p class="f-30 bold">上限値 : <?php echo $r["upper_limit"]; ?></p>
            <p class="f-30 bold">下限値 : <?php echo $r["lower_limit"]; ?></p>
            <p class="f-30 bold">現在のPOINT : <?php echo $r["now_point"]; ?></p>
            <form action="roulette.php" method="get">
            <button class="play-btn" name="id" type="submit" value="<?php echo $r["id"]; ?>">ルーレットをプレイする</button>
          </form>
          </div>
          <?php endforeach ;?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>

      <!-- <p class="f-30 bold">上限値 : 99999</p>
      <p class="f-30 bold">上限まで残り : 99999</p>
      <a href="roulette.php" class="play-btn">ルーレットをプレイする</a> -->
    </div>

    <div class="slot ta-center">
      <!-- スライド -->
      <div class="swiper mySwiper1">
        <div class="swiper-wrapper">
          <?php foreach($slot as $s) : ?>
          <div class="swiper-slide">
            <p class="f-30 bold">Bet額 : <?php echo $s["min_bet"]; ?></p>
            <img src="src/img/slot.png">
            <p class="f-30 bold">上限値 : <?php echo $s["upper_limit"]; ?></p>
            <p class="f-30 bold">下限値 : <?php echo $s["lower_limit"]; ?></p>
            <p class="f-30 bold">現在のPOINT : <?php echo $s["now_point"]; ?></p>
            <form action="slot.php" method="get">
            <button class="play-btn" type="submit" name="id" value="<?php echo $s["id"]; ?>">スロットをプレイする</button>
          </form>
          </div>
          <?php endforeach ;?>
          <!-- <div class="swiper-slide"><img src="src/img/slot.png"></div>
          <div class="swiper-slide"><img src="src/img/slot.png"></div> -->
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>

    <div class="trade ta-center">
      <p class="f-30 bold">景品交換所</p>
      <a href="gift_trade.php" class="trade-btn">景品と交換する</a>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
    const swiper1 = new Swiper(".mySwiper1", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
    }) 
  </script>
</body>
</html>
