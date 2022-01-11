<?php
require_once(ROOT_PATH. 'Controllers/function.php');

if(!isset($_SESSION)){
  session_start(); 
  
}
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base17.css">
    <title>パスワードリセット</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <p>誕生日とメールアドレスを記載し、パスワードを設定します！</p>

     <?php if(isset($err['msg'])) : ?>
        <p class="errmessege"><?php echo $err['msg']; ?></p>
     <?php endif; ?>

     <form action="pass_reset.php" method="POST" id='con' novalidate>
     <!--誕生日登録-->
     <div class="birth">
     <label for="birth">誕生日</label>
     <?php if(isset($err['birth'])) : ?>
      <p class="errmessege"><?php echo $err['birth']; ?></p>
     <?php endif; ?>
     <input id="birth"type="birth"name="birth">
     </div>
     <!--メールアドレスを記載-->
     <div class="email">
     <label for="email">メールアドレス</label>
     <?php if(isset($err['email'])) : ?>
        <p class="errmessege"><?php echo $err['email']; ?></p>
     <?php endif; ?>
     <input id="email" type="email"name="email">
     </div>
     <!--ログインボタン-->
     <div id="login">
     <input type="hidden" name="csrf_token"value="<?php echo h(setToken());?>">
       <button type="submit">パスワード更新ページへ</button>
     </div>
 </body>
</html>