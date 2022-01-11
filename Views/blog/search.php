<?php
if (!empty($_POST)){
    $store=$_POST['store'];
    $address=$_POST['address'];
require_once(ROOT_PATH.'Controllers/BlogController.php');
$search = new BlogController();
$params = $search->search($store,$address);

}

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base15.css">
    <title>検索ページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>
 <body>
 <form action="search.php" method="post">
     <div class=search>
            店名:<input type="text" name="store"><br>
            住所:<input type="text" name="address"><br>
            <button type="submit">検索</button>
      </div>
        </form>
        <?php if(isset($params)): ?>
        <table>
            <tr><th>店の名前</th><th>住所</th></tr>
            <!-- ここでPHPのforeachを使って結果をループさせる -->
            <?php foreach ($params['search'] as $row): ?>
                <tr><td><?php echo htmlspecialchars( $row['store'],ENT_QUOTES,"UTF-8" )?></td>
                <td><?php echo htmlspecialchars( $row['address'],ENT_QUOTES,"UTF-8" )?></td>
                <td><a href="published.php?id=<?=$row['id'] ?>">詳細</a></td></tr>
            <?php endforeach; ?>
        </table>
        <?php endif ?>
 </body>
</html>