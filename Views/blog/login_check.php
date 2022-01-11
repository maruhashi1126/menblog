<?php

require_once(ROOT_PATH .'Models/User.php');
if(!isset($_SESSION)){
    session_start(); 
  }
  $err = [];

  $token = filter_input(INPUT_POST, 'csrf_token');
  //トークンがない、もしくは一致しない場合、処理を中止
  if(!isset($_SESSION['csrf_token'])|| $token !==$_SESSION['csrf_token']){
      exit('不正なリクエスト');
  }

  unset($_SESSION['csrf_token']);

if(!$email = filter_input(INPUT_POST, 'email')){
    $err['email'] = 'メールアドレスを記入してください';
}
if(!$password = filter_input(INPUT_POST, 'password')){
    $err['password'] = 'パスワードを記入してください';
}else if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
    $err = 'パスワードは英数字8文字以上100文字以内で記入してください';
}
//ログインする処理
if(count($err) > 0) {
    //エラーがあった場合は戻す
    $_SESSION =  $err;
    header('Location: login.php');
    return;
}
//ログイン成功時
$result = UserLogic::login($email, $password);
//ログイン失敗
if(!$result){
    header('Location: login.php');
    return;
}
$login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base9.css">
    <title>マイページ</title>
</head>
<header>
    <?php 
    include('header.php');
    ?>
</header>
<body>
 <?php if(count($err) > 0): ?>
  <?php foreach($err as $err2): ?>
  <p><?php echo $err2 ?></p>
  <?php endforeach; ?>
  <?php else: ?>
 <h2>ログインしました。</h2>
 <?php endif; ?>
 <button type="submit" id=myb><a id="my" href="/blog/mypage.php?cid=<?= $login_user['id'] ?>">マイページへ</a></button>
</body>
</html>