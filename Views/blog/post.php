<?php
if(!isset($_SESSION)){
    session_start(); 
}
require_once(ROOT_PATH.'Controllers/BlogController.php');
 $post = new BlogController();
 $params = $post->index();
 

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base8.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    <title>投稿ページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
 <form enctype="multipart/form-data" action="post_comp.php" method="POST"  novalidate>
     <input id="name_id"name="name_id" type="hidden">
 <dd>
        <label for="store"id="store"name="store">店舗名</label>
        <input id="store"name="store" type="text"placeholder="店舗名">
     </dd>
     <dd>
        <label for="address"id="address">住所&nbsp;&nbsp;&nbsp;</label>
        <input id="address"type="text"name="address"placeholder="住所">
     </dd>
     <dd>
        <input type="file" id="photo1" name="photo1" accept="image/jpeg, image/png">
     </dd>
     <dd>
        <h3>*得点は100点満点でお願いします</h3>
        <label for="eat"id="eat">味&nbsp;</label>
        <input id="eat"type="text"name="eat"placeholder="味">

        <label for="bea"id="bea">綺麗さ&nbsp;</label>
        <input id="bea"type="text"name="bea"placeholder="綺麗さ">
       
        <label for="customer"id="customer">接客&nbsp;</label>
        <input id="customer"name="customer"type="text"placeholder="接客">
       
        <label for="look"id="look">見た目&nbsp;</label>
        <input id="look"type="text"name="look"placeholder="見た目">
        
        <label for="money"id="money">金額&nbsp;</label>
        <input id="money"type="text"name="money"placeholder="金額">
     </dd>
     <dd>
       <label for="body"id="body">感想</label>
       <textarea name="body" id="body" cols="150" rows="20"></textarea>
     </dd>
     <dd>
     <button type="submit">投稿する</button>
     <a onclick="history.back(-1)">マイページに戻る</a>
     </dd>
    </form>
<!--    <script>
$(function(){
  var store =$("input#store").val();
  var address =$("input#address").val();
  var eat =$("input#eat").val();
  var bea =$("input#bea").val();
  var customer =$("input#customer").val();
  var look =$("input#look").val();
  var money =$("input#money").val();
  var body =$("input#body").val();
  
  $("button").on('click', function(){
  if ( $("input#store").val()== '') {
    alert('お店の名前を入力してください');
    return false;
  }
  });
 
  $("button").on('click', function(){
  if ($("input#address").val() == '') {
    alert('住所をを入力してください');
    return false;
  }
  });
  
  $("button").on('click', function(){
  if(!$("input#eat").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if(!$("input#eat").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if(!$("input#bea").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if(!$("input#customer").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if(!$("input#look").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if(!$("input#money").val().match(/^[0-9]*$/)){
    alert('得点は数字で入力してください');
    return false;
  } 
  });
  $("button").on('click', function(){
  if ($("textarea#body").val() == '') {
    alert('本文を入力してください');
    return false;
  } 
  });
});
</script> -->
 </body>
</html>