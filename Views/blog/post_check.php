<?php
if(!isset($_SESSION)) { 
       session_start(); 
   }
/*
 if (!isset($_SESSION['form'])){
     header('Location: post.php');
     exit();
   }else{
  $_POST =$_SESSION['form'];
   }
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      header('Location: post_comp.php');
      exit();
   }
   if (empty($_SERVER["HTTP_REFERER"])) {

    header('Location: post.php');
  }*/

  /*if(isset($_FILES['photo1'])){

 }*/

 $files=$_FILES['photo1'];
 $filename=basename($files['name']);
 $tmp_path=$files['tmp_name'];
 $fileerr=$files['error'];
 $filesize=$files['size'];
 $pass="../public/img/";

 $path = $filename;

$filename= mt_rand();
if(move_uploaded_file($tmp_path,$pass.$filename.$path)) {
   echo "ok";
}else{
   echo "ng";
};
var_dump($filename.$path);
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <title>投稿確認</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
  <form action="post_comp.php" method="POST" novalidate> 
     <div class="text">
        <p>こちらの内容を登録しますか？</p>
     </div>
     <label for="store">店名</label> 
     </dt>
     <dd class=b>
     <?php echo @htmlspecialchars($_POST['store'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dl> 
      <dt class=a>
        <label for="address">住所</label>
     </dt>
     <dd class=b>
     <?php echo @htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
</dl>
     <dl>
      <dt class=a>
        <label for="eat">味の点数</label>
     </dt>
     <dd class=b><?php echo @htmlspecialchars($_POST['eat'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dl>
      <dt class=a>
        <label for="bea">綺麗さ</label>
     </dt>
     <dd class=b><?php echo @htmlspecialchars($_POST['bea'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dl>
      <dt class=a>
        <label for="customer">接客</label>
     </dt>
     <dd class=b><?php echo @htmlspecialchars($_POST['customer'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dl>
      <dt class=a>
        <label for="look">見た目</label>
     </dt>
     <dd class=b><?php echo @htmlspecialchars($_POST['look'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dl>
      <dt class=a>
        <label for="money">金額</label>
     </dt>
     <dd class=b><?php echo @htmlspecialchars($_POST['money'], ENT_QUOTES, 'UTF-8'); ?>
     </dd>
     </dl>
     <dt class=a>
        <label for="body">感想</label>
     </dt>
     <dd class=c>
     <?php echo nl2br(@htmlspecialchars($_POST['body'])) ;?>
     </dd>
     <button type="submit">投稿する！！</a></button>
     <a href="javascript:history.back();">投稿ページに戻る</a>
</form>
 </body>
</html>