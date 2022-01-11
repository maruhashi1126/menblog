<?php
$id = $_GET['id'];

if(empty($id)){
    exit('idが不正です');
}
require_once(ROOT_PATH.'Controllers/BlogController.php');
$post_edit = new BlogController();
$params = $post_edit->edit();
$id = $params['post']['id'];
$store = $params['post']['store'];
$address = $params['post']['address'];
$eat = $params['post']['eat'];
$bea = $params['post']['bea'];
$customer = $params['post']['customer'];
$look = $params['post']['look'];
$money = $params['post']['money'];
$body = $params['post']['body'];
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base14.css">
    <title>投稿内容編集画面</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>
 <body>
 <form enctype="multipart/form-data" action="post_edit_comp.php" method="POST"  novalidate>
 <input id="id"name="id" type="hidden"value="<?php echo htmlspecialchars($id, ENT_QUOTES) ?>">
    <p>投稿内容を変更しますか？</p> 
    
    <dd>
     <?php// if(isset($error['store']) && $error['store'] ==='blank'): ?>
        <label for="store"id="store"name="store">店舗名</label>
        <?php// endif; ?>
        <input id="store"name="store" type="text"placeholder="店舗名"value="<?php echo htmlspecialchars($store, ENT_QUOTES) ?>">
     </dd>
     <dd>
     <?php// if(isset($error['address']) && $error['address'] ==='blank'): ?>
        <label for="address"id="address">住所&nbsp;&nbsp;&nbsp;</label>
        <?php// endif; ?>
        <input id="address"type="text"name="address"placeholder="住所"value="<?php echo htmlspecialchars($address, ENT_QUOTES) ?>">
     </dd>
     <dd>
        <label for="photo1"id="photo1">写真&nbsp;&nbsp;&nbsp;</label>
        <input type="file" id="photo1" name="photo1" accept="image/jpeg, image/png">
     </dd>
     <dd>
        <h3>*得点は100点満点でお願いします</h3>
        <?php// if(isset($error['eat']) && $error['eat'] ==='blank'): ?>
        <label for="eat"id="eat">味&nbsp;</label>
        <?php// endif; ?>
        <input id="eat"type="text"name="eat"placeholder="味"value="<?php echo htmlspecialchars($eat, ENT_QUOTES) ?>">

        <?php// if(isset($error['bea']) && $error['bea'] ==='blank'): ?>
        <label for="bea"id="bea">綺麗さ&nbsp;</label>
        <?php// endif; ?>
        <input id="bea"type="text"name="bea"placeholder="綺麗さ"value="<?php echo htmlspecialchars($bea, ENT_QUOTES) ?>">
       
        <?php// if(isset($error['customer']) && $error['customer'] ==='blank'): ?>
        <label for="customer"id="customer">接客&nbsp;</label>
        <?php// endif; ?>
        <input id="customer"name="customer"type="text"placeholder="接客"value="<?php echo htmlspecialchars($customer, ENT_QUOTES) ?>">
       
        <?php// if(isset($error['look']) && $error['look'] ==='blank'): ?>
        <label for="look"id="look">見た目&nbsp;</label>
        <?php// endif; ?>
        <input id="look"type="text"name="look"placeholder="見た目"value="<?php echo htmlspecialchars($look, ENT_QUOTES) ?>">
        
        <?php// if(isset($error['money']) && $error['money'] ==='blank'): ?>
        <label for="money"id="money">金額&nbsp;</label>
        <?php// endif; ?>
        <input id="money"type="text"name="money"placeholder="金額"value="<?php echo htmlspecialchars($money, ENT_QUOTES) ?>">
     </dd>
     <dd>
     <?php// if(isset($error['body']) && $error['body'] ==='blank'): ?>
       <label for="body"id="body">感想</label>
       <?php// endif; ?>
       <textarea name="body" id="body" cols="100" rows="20"><?php echo htmlspecialchars($body, ENT_QUOTES) ?></textarea>
     </dd>
     <dd>
     <button type="submit">投稿する</button>
     <a onclick="history.back(-1)">投稿内容に戻る</a>
     </dd>
    </form>
 </body>
</html>