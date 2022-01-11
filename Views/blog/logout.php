<?php
 if(!isset($_SESSION)){
    session_start(); 
  }
  require_once(ROOT_PATH .'Models/User.php');

  if (!$logout = filter_input(INPUT_POST, 'logout')){
      exit('不正なリクエストです！');
  }
  //ログインしているかの判定し、セッションが切れていたら、ログインしてくださいとメッセージを出す
  $result = UserLogic::checkLogin();
  if (!$result) {
      exit('セッションが切れましたので、ログインしなおしてください。');
  }
  //ログアウト
  UserLogic::logout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base3.css">
    <title>ログアウトページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>
    <title>ログアウト</title>
</head>
<body>
    <h2>ログアウト</h2>
    <p>ログアウトしました！！</p>
    <button type="submit"><a id="out" href="login.php">ログイン画面へ</a></button>
</body>
</html>