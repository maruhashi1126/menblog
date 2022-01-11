<?php

require_once(ROOT_PATH.'Controllers/BlogController.php');
$post = new BlogController();
 $params = $post->index();

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>トップページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>

 <body>
     <div class="bg">
        <h2>☆☆Welcome 麺,s&nbsp;blog☆彡</h2>
        <h2>魅惑の麺料理の世界へようこそ！！</h2>
        <h2>みんなの美味しい話を楽しみましょう！！</h2>
     </div>
     <div id="toukou">
        <p>最新の麺料理情報！！</p>
     </div>
     <table class=db>

     <th class=a>店名</th>
    <th class=a>住所</th>
    <th class=a>料理の写真</th>

     <?php foreach($params['post'] as $colume):?>
     <tr class=dbr>
       <td class=a><?php echo htmlspecialchars( $colume['store'],ENT_QUOTES,"UTF-8" )?></td>
       <td class=b><?php echo htmlspecialchars($colume['address'],ENT_QUOTES ,"UTF-8") ?></td> 
       <td class=c><?php echo '<img src="/img/' . $colume['photo1'] .'" width="30%"">';  ?></td>
       <td><a href="published.php?id=<?=$colume['id'] ?>">詳細</a></td>
       <?php endforeach; ?>
     </tr>
     <div class='paging'>
    <?php
    for($i=0;$i<=$params['pages'];$i++) {
        if(isset($_GET['page']) && $_GET['page'] == $i) {
            echo $i+1;
        } else {
            echo "<a href='?page=".$i."'>".($i+1)."</a>";
        }
    }
    ?>
     </table>
 </body>
</html>