<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント登録</title>
  <style>
    .flex {
      display: flex;
    }
    .justify-center {
      justify-content: center;
    }
    .align-center {
      align-items: center;
    }
    .title {
      font-size: 40px;
      font-weight: 600;
    }
    .subtitle {
      font-size: 50px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
      margin-top: 20px;
    }
    .box {
      width: 40%;
      height: 750px;
      background-color: #E3E3E3;
      border-radius: 50px;
      border: 1px solid #000;
      margin: 0 auto;
      margin-top: 10px;
    }
    .account-form {
      margin: 0 auto;
    }
    .f-p {
      font-size: 30px;
      margin-bottom: 0;
      margin-top: 5px;
    }
    .form-div {
      display: flex;
    }
    .input-center {
      margin: 0 auto;
      margin-left: 135px;
    }
    .f-input {
      width: 70%;
      font-size: 35px;
    }
    .f-btn {
      width: 65%;
      height: 50px;
      font-size: 30px;
      margin: 20px 0px 20px 135px;
      color: #fff;
      border: none;
      background-color: #31C4FC;
      border-radius: 50px;
    }
    .f-btn:hover {
      cursor: pointer;
      background-color: #2EB7E2;
    }
    .move-login {
      font-size: 25px;
      margin-left: 130px;
    }
  </style>
</head>
<body>
  <div class="flex justify-center align-center">
    <img src="img/icon.png" alt="icon">
    <span class="title">じょびカジノ</span>
  </div>
  <div class="box align-center">
    <p class="subtitle">アカウント登録</p>
    <form action="./create_account.php" method="post" class="account-form">
      <div class="input-center"><p class="f-p">メールアドレス</p><span class="flex"><img src="img/mail.png" width="40"><input type="text" name="mail" id="" class="f-input"></span></div><br>
      <div class="input-center"><p class="f-p">ユーザ名</p><span class="flex"><img src="img/user.png" width="40"><input type="text" name="name" id="" class="f-input"></span></div><br>
      <div class="input-center"><p class="f-p">パスワード</p><span class="flex"><img src="img/pass.png" width="40"><input type="text" name="pw" id="" class="f-input"></span></div><br>
      <div class="input-center"><p class="f-p">確認用パスワード</p><span class="flex"><img src="img/pass.png" width="40"><input type="text" name="re_pw" id="" class="f-input"></span></div><br>
      <button type="submit" class="f-btn">アカウント作成</button>
    </form>
    <a href="login.php" class="move-login">ログイン画面へ</a>
  </div>
</body>
</html>
