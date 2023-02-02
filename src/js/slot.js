function TMamSlot() {
  'use strict';
  this.d = [0, 0, 0]; //0～999
  this.ds = [0, 0, 0]; //0:stop 1:start 2:stopping
  this.dv = [0, 0, 0];
  this.status = 0; //0 1
  this.BStop = [];
  this.BStart = null;
  this.can = null;
  this.ctx = null;
  this.result = null;
  this.size = 30;
  this.family =
    'BlinkMacSystemFont,"Helvetica Neue",Arial,"Hiragino Kaku Gothic ProN","Hiragino Sans",Meiryo,sans-serif,"Segoe UI"';

  this.init = function () {
    this.can = document.getElementById('slotcan');
    this.can.width = 300;
    this.can.height = 200;
    this.can.style.maxWidth = '600px';
    this.can.style.maxHeight = '600px';
    this.can.style.width = '100%';
    this.ctx = this.can.getContext('2d');
    this.ctx.font = this.size + 'px ' + this.family;
    this.ctx.textAlign = 'center';
    this.ctx.documenttextBaseline = 'middle';
    for (let i = 0; i < this.d.length; i++) {
      this.BStop[i] = document.querySelector('#stop' + (i + 1));
      this.BStop[i].addEventListener(
        'click',
        function () {
          let id = parseInt(event.target.id.substr(-1)) - 1;
          if (this.status == 1 && this.ds[id] == 1) {
            this.ds[id] = 2;
          }
        }.bind(this)
      );
    }
    this.BStart = document.querySelector('#start');
    this.BStart.addEventListener(
      'click',
      function () {
        if (this.status == 0) {
          this.start();
        }
      }.bind(this)
    );
    this.result = document.querySelector('#slotresult');
    this.draw();
  };
  this.draw = function () {
    let lg = this.ctx.createLinearGradient(0, 0, 0, this.can.height);

    lg.addColorStop(0.0, 'rgb(255,255,255)');
    lg.addColorStop(0.3, 'rgb(255,255,255)');
    lg.addColorStop(0.5, 'rgb(180,255,255)');
    lg.addColorStop(0.7, 'rgb(255,255,255)');
    lg.addColorStop(1.0, 'rgb(255,255,255)');

    this.ctx.fillStyle = lg;
    this.ctx.fillRect(0, 0, this.can.width, this.can.height, 1);

    for (let i = 0; i < this.d.length; i++) {
      for (let j = -4; j <= 4; j++) {
        let pos = this.d[i] % 100; //% 剰余
        let v = Math.floor(this.d[i] / 100) + j;
        v = (10 + v) % 10;
        let size = this.size * (1 - Math.abs(j - pos / 100) / 5);
        this.ctx.font = size + 'px ' + this.family;
        let col = Math.floor(Math.abs((256 / 16) * (j - pos / 100)));
        this.ctx.fillStyle = 'rgb(' + col + ',' + col + ',' + col + ')';
        //let y=(j-pos/100)*this.size;
        let y =
          (Math.sin((((j - pos / 100) / 4) * Math.PI) / 2) * this.can.height) /
          2;
        this.ctx.fillText(
          v,
          (this.can.width / 3) * i + this.can.width / 6,
          this.can.height / 2 + y
        );
      }
    }
    this.ctx.beginPath();
    this.ctx.strokeStyle = 'rgba(0,0,0,0.8)';
    this.ctx.lineWidth = 8;
    this.ctx.rect(0, 0, this.can.width, this.can.height);
    this.ctx.stroke();

    this.ctx.beginPath();
    this.ctx.strokeStyle = 'rgba(0,0,0,0.3)';
    this.ctx.lineWidth = 1;
    this.ctx.moveTo(
      this.can.width * 0.1,
      this.can.height / 2 - this.size * 0.66
    );
    this.ctx.lineTo(
      this.can.width * 0.9,
      this.can.height / 2 - this.size * 0.66
    );
    this.ctx.moveTo(
      this.can.width * 0.1,
      this.can.height / 2 + this.size * 0.5
    );
    this.ctx.lineTo(
      this.can.width * 0.9,
      this.can.height / 2 + this.size * 0.5
    );
    this.ctx.stroke();
  };
  this.start = function () {
    if (this.status == 1) {
      return;
    }
    this.status = 1;
    for (let i = 0; i < this.d.length; i++) {
      this.ds[i] = 1;
      this.dv[i] = 0;
    }
    console.log('set_point呼び出し');
    set_point();
    this.result.innerHTML = '　';
    this.starting();
  };
  this.starting = function () {
    for (let i = 0; i < this.d.length; i++) {
      if (this.ds[i] == 1) {
        this.dv[i] += Math.floor(1 + Math.random() * 3);
        if (this.dv[i] > 30) {
          this.dv[i] = 30;
        }
      } else if (this.ds[i] == 2) {
        if (this.dv[i] > 2) {
          this.dv[i] -= Math.floor((Math.random() * this.dv[i]) / 10) + 1;
          if (this.dv[i] < 2) {
            if (this.d[i] % 2 == 1) {
              this.d[i]++;
            }
            this.dv[i] = 2;
          }
        } else {
          if (this.d[i] % 2 == 1) {
            this.d[i]++;
          }
          this.dv[i] = 2;
        }
      }
      if (this.ds[i] != 0) {
        this.d[i] += this.dv[i];
        this.d[i] %= 1000;
        if (this.ds[i] == 2 && this.dv[i] == 2 && this.d[i] % 100 == 0) {
          this.ds[i] = 0;
          this.dv[i] = 0;
        }
      }
    }
    if (this.ds[0] == 0 && this.ds[1] == 0 && this.ds[2] == 0) {
      this.status = 0;
      if (this.d[0] == 700 && this.d[1] == 700 && this.d[2] == 700) {
      } else if (this.d[0] == this.d[1] && this.d[1] == this.d[2]) {
        console.log('add_point呼び出し');
        add_point();
        this.result.innerHTML = 'あたり';
      } else if (
        this.d[0] == this.d[1] ||
        this.d[1] == this.d[2] ||
        this.d[0] == this.d[2]
      ) {
        // this.result.innerHTML = 'おしい';
      } else {
        // this.result.innerHTML = 'はずれ';
      }
      this.draw();
    } else {
      this.draw();
      setTimeout(this.starting.bind(this), 20);
    }
  };
  this.init();
}
window.addEventListener('load', function () {
  MamSlot = new TMamSlot();
});

const set_point = async () => {
  const url = 'slot_bet.php';
  let param_url = new URL(window.location.href);
  let params = param_url.searchParams;
  const Bet = document.getElementById('Bet').value;
  var form = new FormData();
  form.append('bet', -Bet);
  form.append('id', params.get('id'));
  const response = await fetch(url, {
    method: 'POST', // GET POST PUT DELETEなど
    body: form, // リクエスト本文にフォームデータを設定
  });
};

const add_point = async () => {
  const url = 'slot_bet.php';
  let param_url = new URL(window.location.href);
  let params = param_url.searchParams;
  const Bet = document.getElementById('Bet').value;
  const addBet = Bet * 10;
  var form = new FormData();
  form.append('bet', addBet);
  form.append('id', params.get('id'));
  const response = await fetch(url, {
    method: 'POST', // GET POST PUT DELETEなど
    body: form, // リクエスト本文にフォームデータを設定
  });
};
