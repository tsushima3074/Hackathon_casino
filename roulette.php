<?php
  session_start();
  require_once 'db/casino_db.php';
  include "header.php"
  /* 
  ・セッションの確認
  ・getで台のidを受け取る
  ・台のbet額を表示

  ・使ったポイントの登録
  ・勝ったときのみポイント加算
  */


  if(isset($_SESSION["users"])) {
    if(isset($_GET["id"])){
      try{
        $id = $_GET["id"];
        $casino_db = new casino_db();
        $roulette = $casino_db->select_roulette_bet($id);
      } catch (Exception $e) {
        echo $e
      }
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ルーレット</title>
  <style>
    /* ルーレット部分 */
    .display{
      margin-top: 100px;
      margin-left:100px;
      width: 400px;
    }
    .roulette{
      display: block;
      width: 300px;
      height: 300px;
      margin: auto;
      position: relative;
    }
    .cil{
      width: 80px;
      height: 80px; 
      background-color: rgb(250, 255, 180);
      border-radius: 50%;/* 円*/
      line-height: 80px;
      text-align: center;
      display: block;
      position: absolute;
    }
    .c_button{
      width: 600px;
      top: 100px;
      margin: auto;
      position: relative;
    }
    button {
      width: 150px;
      height: 50px;
      margin: 20px;
      border: 2px solid #000;
      border-radius: 0;
      background: #fff;
      text-align: center;
    }
    button:hover {
      color: #fff;
      background: #000;
    }
    .red {
      background-color:#ff0062;
      width: 80px;
      height: 80px; 
      border-radius: 50%;/* 円*/
      line-height: 80px;
      text-align: center;
      display: block;
      position: absolute;
    }
    .pink{
      background-color:#ff73dc;
      width: 80px;
      height: 80px; 
      border-radius: 50%;/* 円*/
      line-height: 80px;
      text-align: center;
      display: block;
      position: absolute;
    }

    /* ルール部分 */
    .rule-box {
      border: solid 1px #000;
      padding: 0px 20px;
    }
    .rule {
      font-size: 35px;
      margin-top: 10px;
      margin-bottom: 0px;
    }
    .rule-text {
      font-size: 25px;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  
  <div class="flex">
    <div>
      <div class="display">
        <div id = "roulette" class="roulette"></div>
        <div class="c_button">
          <button id ="start">スタート</button>
          <button id ="stop">ストップ</button>
          <button id ="reset">リセット</button>
        </div>
      </div>
    </div>

    <div>
      <div class="rule-box">
        <h2 class="rule">ルール</h2>
       
        <p class="rule-text">
          最低Bet額 : <?php $roulette["min_bet"]; ?><!-- データベースから --><br>
          ナンバーを選択し、Bet額を入力することでBetすることが出来ます。<br>
          回すをクリックして選択したナンバーに止まると、<br>
          ポイントを獲得することができます。<br>
          右下にこの台での変動したポイントが表示されます。
        </p>
      </div>

      <div></div>

      <div></div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function(){
      //要素の表示、円周上に表示させる
      let num = [0,1,2,3,4,5,6,7,8,9];
      //HTMLに表示
      let roulette = document.getElementById("roulette");
      /*円形に並べる*/
      let item_length = num.length;
      //rouletteの半径を計算
      let r = roulette.clientWidth/2;
      //360度÷配置要素数
      let deg = 360.0/item_length;
      //さっきの角度をラジアンに変更
      let rad = (deg*Math.PI/180.0);
      
      //要素追加して表示させる
      for(var i = 0; i < num.length; i++ ){
          //div要素の追加
          let div = document.createElement('div');
          div.className = "cil";
          div.id = "cil"+ i;
          div.innerHTML= num[i] ;
          const x = Math.cos(rad * i) * r + r;
          const y = Math.sin(rad * i) * r + r;
          let circle = roulette.appendChild(div);
          circle.style.left = x + "px";
          circle.style.top = y + "px";
        // console.log(x);
      }    
      //ルーレットする
      let interval;//インターバル
      let first = false;//フラグ
      let number = 1;
      let grid =0; 
      function start_set(){//start状態
        document.getElementById("start").disabled = true;
        document.getElementById("stop").disabled = false;
        document.getElementById("reset").disabled = false;
        if(first === false){
          interval = setInterval(start_go,100);
          first = true;
        }         
      }
      function start_go(){//start押下
        for(var k = 0; k < item_length; k++){
          let div_number = document.getElementById('cil'+[k]);//表示上のidの取得
          div_number.classList.remove('red');//.redを消す
        }
        grid = Math.floor(Math.random()*num.length);
        number = num[grid];//.redをつけるためのランダムな数字を選択
        div_number = document.getElementById('cil'+ number);
        //console.log(div_number);
        div_number.classList.add('red');
      }
      function stop_set(){//stop押下
        document.getElementById("stop").disabled = true;
        document.getElementById("start").disabled = false;
        clearInterval(interval);
        first = false;
        let red_number = document.querySelector('.red');//.redクラスのついているものを取得
        //console.log(grid);  
        num.splice(grid,1);//配列からred_numberのところを1つ削除     
        //console.log(num);    
        red_number.classList.remove('red');
        red_number.classList.add("pink");
        if(num.length === 0){
          document.getElementById("start").disabled = true;
        }
      }
      function reset_set(){//リセット押下
        clearInterval(interval);
        first = false;
        document.getElementById("start").disabled = false;
        for(var j = 0; j < 10 ; j++){
          let all = document.getElementById("cil" + j);
          all.classList.remove('pink');
          all.classList.remove('red');
        }
        num = [0,1,2,3,4,5,6,7,8,9];
      }
      const starter = document.getElementById("start");
      const stopper = document.getElementById("stop");
      const resetter = document.getElementById("reset");
      starter.addEventListener("click",start_set,false);
      stopper.addEventListener("click",stop_set,false);
      resetter.addEventListener("click",reset_set,false);
      document.getElementById("stop").disabled = true;
      document.getElementById("reset").disabled = true;
    })

  </script>
  
</body>
</html>