<?php
$id = $_GET['id'];
if(empty($id)){
    exit('idが不正です');
}
require_once(ROOT_PATH.'Controllers/BlogController.php');
$deleteCom = new BlogController();
$result = $deleteCom->deleteCom();
//var_dump($_GET);
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>コメント削除</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
 <p>削除しました。</p> 
      <a class="back" type="button" onclick="history.back(-1)">投稿に戻る</a>
 </body>
</html>