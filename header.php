<style>
  .header {
    border-bottom: 2px solid #000;
    justify-content: space-around;
    background-color: #fff;
  }
  .flex {
    display: flex;
  }
  .align-center {
    align-items: center;
  }
  .h-title {
    font-weight: 600;
    font-size: 48px;
  }
  .h-username {
    margin-left: 300px;
  }
  .f-30 {
    font-size: 30px;
  }
  .non-a {
    text-decoration: none;
    color: #000;
    display: inline-block;
  }
  .non-a::after {
    position: relative;
    bottom: 1px; /*　線の位置を設定できる */
    content: ""; /* :hover::after呼び出す */
    display: block;
    width: 0;
    transition: width 0.3s;
    border-bottom: 3px solid #000;
    margin: 0 auto;
  }
  .non-a:hover::after {
    width: 100%;
  }
</style>
<body>
  <header class="flex header align-center">
    <div class="flex align-center">
      <img class="h-img" src="src/img/h-icon.png" />
      <div class="h-title">
        <span><a href="index.php" class="non-a">じょびカジノ</a></span>
      </div>
    </div>
    <div class="h-username f-30">
      <span>ユーザ名</span>
    </div>
    <div class="h-edit f-30">
      <span><a href="edit.php" class="non-a">編集</a></span>
    </div>
    <div class="h-logout f-30">
      <span><a href="logout.php" class="non-a">ログアウト</a></span>
    </div>
    <div class="h-point f-30">
      <span>所有ポイント : 9999999</span>
    </div>
  </header>
</body>
