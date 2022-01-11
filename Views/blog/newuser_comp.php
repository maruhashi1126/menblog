<?php
if(!isset($_SESSION)){
   session_start(); 
 }
 require_once(ROOT_PATH .'Models/User.php');
 //エラーメッセージ
$err = [];
if(!$name = filter_input(INPUT_POST, 'name')){
   $err[] = 'ユーザー名を記入してください';
}
if(!$email = filter_input(INPUT_POST, 'email')){
   $err[] = 'メールアドレスを記入してください';
}else if ( !preg_match("/\A[a-z\d]{8,100}+\z/i", $_POST['password']) ) {
   $error['password'] = 'password';
}
//正規表現
if(!$password = filter_input(INPUT_POST, 'password')){
   $err[] = 'パスワードを記入してください';
}else if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
   $err = 'パスワードは英数字8文字以上100文字以内で記入してください';
}
//登録する処理
if(count($err) === 0) {
$hasCreated = UserLogic::createUser($_POST);

if(!$hasCreated) {
   $err[] = '登録できませんでした。';
 }
}
var_dump($_POST);
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base6.css">
    <title>新規登録完了</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <div class="bg">
     </div>
     <?php if(count($err) > 0): ?>
  <?php foreach($err as $err2): ?>
  <p><?php echo $err2 ?></p>
  <?php endforeach; ?>
  <?php else: ?>
   <div class="comp">
        <p>ようこそ！！</p>
        <p>登録かんりょうしました！！</p>
        <p>美味しい話をしましょう！</p>
     </div>
  <?php endif; ?>
     <div class="toppage">
     <a href="top_page.php"><input id="toppage" type="button"name="toppage"value="トップページ"></a>
     </div>
 </body>
</html>