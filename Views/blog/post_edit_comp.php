<?php
require_once(ROOT_PATH.'Controllers/BlogController.php');
$update = new BlogController();
$params = $update->update();

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>投稿編集完了</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
 <div>
  <p>更新完了しました。</p>
        <a href="mypage.php">マイページへ戻る</a>
</div>
 </body>
</html>