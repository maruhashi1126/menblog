<?php
if(!isset($_SESSION)){
  session_start(); 
}
require_once(ROOT_PATH .'Models/User.php');
 
 $result = UserLogic::checkLogin();
  if ($result) {
  header('Location: login.php');
  return;
  }
$_SESSION = [];
session_destroy();

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>ログインエラー</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
 <p>ログインし直してください。</p>
  <a href="login.php">ログイン画面へ戻る</a>
 </body>
</html>