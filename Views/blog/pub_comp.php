<?php
if(!isset($_SESSION)) { 
   session_start(); 
}
if (empty($_SERVER["HTTP_REFERER"])) {
   header('Location: pub_com.php');
   }

require_once(ROOT_PATH.'Controllers/BlogController.php');
  $post_complet = new BlogController();
  $params = $post_complet->post_complet();
  
var_dump($_POST);

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base12.css">
    <title>コメント投稿完了</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
    <div class="bg">
    </div>
     <p>コメント投稿しました！！</p>
     <p>THANK&nbsp;&nbsp;YOU</p>
     <button type="submit"><a href="top_page.php">トップページに戻る</a></button>
 </body>
</html>