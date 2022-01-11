<?php
require_once(ROOT_PATH .'Models/User.php');
if(!isset($_SESSION)){
    session_start(); 
  }
  $err = [];

if(empty($_POST['password'])) {
    $err['password'] = 'パスワードを記入してください。';
} elseif(!preg_match("/\A[a-z\d]{8,100}+\z/i", $_POST['password'])) {
    $err['password'] = 'パスワードは英数字８文字以上１００文字以下にしてください。';
}
//確認用パスワード(パスワードとあっているか)
if(empty($_POST['check'])) {
    $err['check'] = '確認用パスワードを記入してください。';
} elseif($_POST['password'] !== $_POST['check']) {
    $err['check'] = 'パスワードと異なっています。';
}

if(count($err) > 0) {
    //エラーがあった場合は戻す
    $_SESSION = $err;
    header('Location: pass_reset.php');
    return;
}
var_dump($_POST);
//$result = UserLogic::updatemypage();
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base16.css">
    <title>パスワードリセット完了</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <p>パスワードを更新しました</p>
    
     <div id="top">
       <a href="login.php">ログインページに戻る</a>
     </div>
 </body>
</html>