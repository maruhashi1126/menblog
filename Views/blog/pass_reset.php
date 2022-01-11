<?php
require_once(ROOT_PATH. 'Controllers/function.php');
var_dump($_POST);
if(!isset($_SESSION)){
  session_start(); 
}
require_once(ROOT_PATH .'Models/User.php');

if(!isset($_SESSION['password']) && !isset($_SESSION['password_conf'])) {
$err = [];
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = 'メールアドレスを記入してください。';
}
if(!$birth = filter_input(INPUT_POST, 'birth')) {
  $err['birth'] = '誕生日を記入してください。';
}

if(count($err) > 0) {
  $_SESSION = $err;
  header('Location: pass_check.php');
  return;
}
 
  $result = UserLogic::checkPass($email, $birth);
  //丸　照会が失敗した場合、pass_reset.phpに戻る
  if(!$result){
  header('Location: pass_check.php');
  return;
}
}
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base16.css">
    <title>パスワードリセット</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <p>新しいパスワードを記載してください！</p>
     <?php if(isset($err['msg'])) : ?>
      <p class="err"><?php echo $err['msg']; ?></p>
     <?php endif; ?>

     <form action="pass_comp.php" method="POST" id='con' novalidate>
    <!--パスワード-->
    <div class="password">
     <label for="password">新しいパスワード</label>
     <?php if(isset($err['password'])) : ?>
       <p class="err"><?php echo $err['password']; ?></p>
     <?php endif; ?>
     <input id="password"type="password"name="password">
    </div>
    <!--パスワードの確認-->
    <div class="check">
     <label for="check">新しいパスワード確認</label>
     <?php if(isset($err['check'])) : ?>
      <p class="err"><?php echo $err['check']; ?></p>
     <?php endif; ?>
     <input id="check"type="password"name="check">
    </div>
     <div id="login">
     <input type="hidden" name="csrf_token"value="<?php echo h(setToken());?>">
       <button type="submit">更新する</button>
     </div>
 </body>
</html>