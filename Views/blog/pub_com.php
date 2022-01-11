<?php
$id = $_GET['id'];
var_dump($_GET);
if(empty($id)){
   exit('idが不正です');
}
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base7.css">
    <title>コメントページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
    <form action="pub_comp.php"method="POST" id='con' novalidate>
    <input id="id"name="id" type="hidden"value="<?php echo htmlspecialchars($id, ENT_QUOTES) ?>">
    <div id="comm">コメントはこちらに！！！！</div>
    <textarea id="com"name="com"></textarea>
    <div class="comp">
    <button type="submit">コメントする</button>
    </div>
    <div class="top">
    <a href="top_page.php"><input type="button"id="top"name="button"value="トップページに戻る"></a>
    </div>
    </form>
 </body>
</html>