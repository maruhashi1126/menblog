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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>完了画面</title>
</head>
<body>
<?php if(count($err) > 0): ?>
  <?php foreach($err as $err2): ?>
  <p><?php echo $err2 ?></p>
  <?php endforeach; ?>
  <?php else: ?>
<h2>ログインしました。</h2>
<?php endif; ?>
 <a href="/Players/mypage.php?cid=<?= $login_user['role'] ?>">マイページへ</a>
    <p>
   <a href="login.php">戻る</a>
    </p>
</form>
</body>
</html>