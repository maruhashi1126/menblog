<?php
$id = $_GET['id'];
if(empty($id)){
    exit('idが不正です');
}
var_dump($_GET);
require_once(ROOT_PATH .'Models/User.php');
require_once(ROOT_PATH .'/Models/Db.php');
//$deletemypage = UserLogic::deletemypage();

?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>マイページ削除</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
 <p>マイページ削除しました。</p> 
      <a href="top_page.php">トップページに戻る</a>
 </body>
</html>