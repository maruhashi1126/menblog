<?php
if(!isset($_SESSION)) { 
   session_start(); 
}

if (empty($_SERVER["HTTP_REFERER"])) {
header('Location: post.php');
}


require_once(ROOT_PATH.'Controllers/BlogController.php');
  $complet = new BlogController();
  $params = $complet->complet();

  
  var_dump($_POST);
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>投稿完了</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <div class="text">
        <p>投稿ありがとう</p>
        <p>みんなの美味しい話を楽しもう</p>
     </div>
     <button type="submit"><a href="mypage.php">マイページに戻る</a></button>
 </body>
</html>