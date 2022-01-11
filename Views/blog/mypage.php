<?php
if(!isset($_SESSION)){
  session_start(); 
}
require_once(ROOT_PATH .'Models/User.php');
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH.'Controllers/BlogController.php');
require_once(ROOT_PATH. 'Controllers/function.php');

$post = new BlogController();
 $params = $post->index();


 //ログインしているか判定し、していなかったらログイン画面に戻る
 $result = UserLogic::checkLogin();
 if($result) {
  if($_SESSION['login_user']['role'] == 0) {
      $user_role = '一般ユーザー';
  }else if($_SESSION['login_user']['role'] == 1){
      $user_role = '管理ユーザ';
      if(empty($_SERVER['HTTP_REFERER'])){
          header('Location: err.php');
      }
  }
}else {
  $_SESSION['login_err'] = 'ユーザーを登録してログインしてください。';
  header('Location: newuser.php');
  return;
}
$login_user = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base10.css">
    <title>マイページ</title>
</head>
<header>
    <?php 
    include('header.php');
    ?>
    </header>
<body>
<div class="user">
 <h2>投稿マイページへようこそ！！</h2>
 <div id="user">
 <p>★ユーザー名★<?php echo h($login_user['name']) ?></p>
 <p>★メールアドレス★<?php echo h($login_user['email']) ?></p>
 <a href="post.php"><button type="submit"id="post">食べに行ったお店を語ろう</button></a>
 </div>
 <div class="good">
   <button type="submit"id="good">行きたいお店</button>
   <button type="submit"id="go">行ったことのあるお店</button>
    </div>
    <form action="logout.php" method="post">
   <div class="log">
   <input type="submit" name="logout" value="ログアウト">
   </div>
   <div class="mydelete">
  <a href="mypage_delete.php?id=<?=$login_user['id'] ?>"onclick="return confirm('マイページを削除しますか')">マイページ削除</a>
   </div>
   <session>
     <h3>～～投稿したお店～～</h3>
     <table class=db>

     <th class=a>店名</th>
    <th class=a>住所</th>
    <th class=a>登録写真</th>

    <?php if($_SESSION['login_user']['role'] == 1): ?>
     <?php foreach($params['post'] as $colume):?>
     <tr class=dbr>
       <td class=a><?php echo htmlspecialchars( $colume['store'],ENT_QUOTES,"UTF-8" )?></td>
       <td class=b><?php echo htmlspecialchars($colume['address'],ENT_QUOTES ,"UTF-8") ?></td> 
       <td><?php echo '<img src="/img/' . $colume['photo1'] .'" width="20%" ">';  ?></td>
       <td><a href="mypost.php?id=<?=$colume['id'] ?>">詳細</a></td>
       <td><a href="post_delete.php?id=<?=$colume['id'] ?>"onclick="return confirm('削除しますか')">削除</a></td>
       <?php endforeach; ?>
   <?php endif; ?>
   <div class='paging'>
    <?php if($_SESSION['login_user']['role'] == 1): ?>
    <?php
    for($i=0;$i<=$params['pages'];$i++) {
        if(isset($_GET['page']) && $_GET['page'] == $i) {
            echo $i+1;
        } else {
            echo "<a href='?page=".$i."'>".($i+1)."</a>";
        }
    }
    ?>
     <?php endif; ?>
     </tr>
     
     <?php if($_SESSION['login_user']['role'] == 0): ?>
     <?php foreach($params['post'] as $colume):?>
     <tr class=dbr>
       <td class=a><?php echo htmlspecialchars( $colume['store'],ENT_QUOTES,"UTF-8" )?></td>
       <td class=b><?php echo htmlspecialchars($colume['address'],ENT_QUOTES ,"UTF-8") ?></td> 
       <td><?php echo '<img src="/img/' . $colume['photo1'] .'" width="20%" ">';  ?></td>
       <td><a href="mypost.php?id=<?=$colume['id'] ?>">詳細</a></td>
       <?php endforeach; ?>
     </tr>
     <?php endif;?>
    <div class='paging'>
    <?php if($_SESSION['login_user']['role'] == 0): ?>
    <?php
    for($i=0;$i<=$params['pages'];$i++) {
        if(isset($_GET['page']) && $_GET['page'] == $i) {
            echo $i+1;
        } else {
            echo "<a href='?page=".$i."'>".($i+1)."</a>";
        }
    }
    ?>
     <?php endif; ?>
     </table>
   </session>
</body>
</html>