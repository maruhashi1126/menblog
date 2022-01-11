<?php
require_once(ROOT_PATH .'Models/User.php');

if(!isset($_SESSION)){
  session_start(); 
}
$result = UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base4.css">
    <title>新規登録ページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
    <div id="touroku">
       <p>新規ユーザー登録画面にようこそ！！</p>
    </div>
    <form action="newuser_comp.php" method="POST" id='con' novalidate>
    <?php if (isset($login_err)):?>
            <p><?php echo $login_err ?></p>
            <?php endif; ?>
     <!--ユーザー名-->
    <div class="name">
     <label for="name">ユーザー名</label>
     <input id="name"type="name"name="name">
     </div>
      <!--誕生日-->
    <div class="birth">
     <label for="birth">誕生日</label>
     <input id="birth"type="birth"name="birth">
     </div>
     <!--メール-->
    <div class="email">
     <label for="email">メールアドレス</label>
     <input id="email"type="email"name="email">
    </div>
    <!--パスワード-->
    <div class="password">
     <label for="password">パスワード</label>
     <input id="password"type="password"name="password">
    </div>
    <!--パスワード確認-->
    <div class="check">
     <label for="check">パスワード確認</label>
     <input id="check"type="password"name="check">
    </div>
    <a href="top_page.php"><input id="back" type="button"name="back"value="戻る"></a>
    <button type="submit">登録します</button>
</div>
</form>
 </body>
</html>