<?php
if(!isset($_SESSION)){
   session_start(); 
 }
 $err = $_SESSION;

 require_once(ROOT_PATH. 'Controllers/function.php');
 require_once(ROOT_PATH .'Models/User.php');

 $result = UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}
 $_SESSION = array();
 session_destroy();
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base11.css">
    <title>ログインページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <div class=bg>
     </div>
     <div id=text>
     <form action="login_check.php" method="POST" id='con' novalidate>
     <h2>自分の投稿ページに入ります。</h2>
     <h2>マイページに入って好きな麺類について書き込もう！！</h2>
     </div>
     <?php if (isset($err['msg'])):?>
            <p><?php echo $err['msg'] ?></p>
            <?php endif; ?>
     <!--ユーザー名-->
     <div class=email>
     <label for="email">メールアドレス</label>
     <input id="email" type="email"name="email">
     <?php if (isset($err['email'])):?>
            <p><?php echo $err['email'] ?></p>
            <?php endif; ?>
     </div>
      <!--パスワード-->
      <div class=password>
      <label for="password">パスワード</label>
     <input id="password" type="password"name="password">
     <?php if (isset($err['password'])):?>
            <?php endif; ?>
     </div>
     <div id="login">
     <input type="hidden" name="csrf_token"value="<?php echo h(setToken());?>">
       <button type="submit">ログイン</button>
     </div>
     <div id=reset>
       <a href="pass_check.php">パスワードを忘れた方はこちら</a>
     </div>
  </form>
 </body>
</html>