document.addEventListener('DOMContentLoaded', function () {
  //要素の表示、円周上に表示させる
  let num = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
  //HTMLに表示
  let roulette = document.getElementById('roulette');
  /*円形に並べる*/
  let item_length = num.length;
  //rouletteの半径を計算
  let r = roulette.clientWidth / 2;
  //360度÷配置要素数
  let deg = 360.0 / item_length;
  //さっきの角度をラジアンに変更
  let rad = (deg * Math.PI) / 180.0;

  //要素追加して表示させる
  for (var i = 0; i < num.length; i++) {
    //div要素の追加
    let div = document.createElement('div');
    div.className = 'cil';
    div.id = 'cil' + i;
    div.innerHTML = num[i];
    const x = Math.cos(rad * i) * r + r;
    const y = Math.sin(rad * i) * r + r;
    let circle = roulette.appendChild(div);
    circle.style.left = x + 'px';
    circle.style.top = y + 'px';
    // console.log(x);
  }
  //ルーレットする
  let interval; //インターバル
  let first = false; //フラグ
  let number = 1;
  let grid = 0;

  //start状態
  function start_set() {
    document.getElementById('start').disabled = true;
    document.getElementById('stop').disabled = false;
    document.getElementById('reset').disabled = false;
    if (first === false) {
      interval = setInterval(start_go, 100);
      first = true;
    }
  }

  //start押下
  function start_go() {
    set_point();
    for (var k = 0; k < item_length; k++) {
      let div_number = document.getElementById('cil' + [k]); //表示上のidの取得
      div_number.classList.remove('red'); //.redを消す
    }
    grid = Math.floor(Math.random() * num.length);
    number = num[grid]; //.redをつけるためのランダムな数字を選択
    div_number = document.getElementById('cil' + number);
    //console.log(div_number);
    div_number.classList.add('red');
  }

  //stop押下
  function stop_set() {
    document.getElementById('stop').disabled = true;
    document.getElementById('start').disabled = false;
    clearInterval(interval);
    first = false;
    let red_number = document.querySelector('.red'); //.redクラスのついているものを取得
    console.log(grid);
    num.splice(grid, 1); //配列からred_numberのところを1つ削除
    console.log(num);
    red_number.classList.remove('red');
    red_number.classList.add('pink');
    if (num.length === 0) {
      document.getElementById('start').disabled = true;
    }
  }

  //リセット押下
  function reset_set() {
    clearInterval(interval);
    first = false;
    document.getElementById('start').disabled = false;
    for (var j = 0; j < 10; j++) {
      let all = document.getElementById('cil' + j);
      all.classList.remove('pink');
      all.classList.remove('red');
    }
    num = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
  }

  const starter = document.getElementById('start');
  const stopper = document.getElementById('stop');
  const resetter = document.getElementById('reset');
  starter.addEventListener('click', start_set, false);
  stopper.addEventListener('click', stop_set, false);
  resetter.addEventListener('click', reset_set, false);
  document.getElementById('stop').disabled = true;
  document.getElementById('reset').disabled = true;
});

const set_point = async () => {
  const url = 'roulette_bet.php';
  let params = url.searchParams;
  const Bet = document.getElementById('Bet').value;
  var form = new FormData();
  form.append('bet', Bet);
  form.append('id', params.get('id'));
  const response = await fetch(url, {
    method: 'POST', // GET POST PUT DELETEなど
    body: form, // リクエスト本文にフォームデータを設定
  })
    .then((res) => {
      return res.json();
    })
    .then((json) => {
      console.log(json);
    });
};
