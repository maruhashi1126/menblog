<?php

if(!isset($_SESSION)){
   session_start(); 
 }
 require_once(ROOT_PATH .'Models/User.php');
 $result = UserLogic::checkLogin();
 if($result) {
   if($_SESSION['login_user']['role'] != 0) {
     if(empty($_SERVER['HTTP_REFERER'])) {
       header('Location: err.php');
     }
   }
 } else {
   $_SESSION['login_err'] = 'ユーザ登録してログインしてください。';
   header('Location: newuser.php');
   return;
 }
 
 require_once(ROOT_PATH. 'Controllers/BlogController.php');
 $post_set = new BlogController();
 $params = $post_set->post_set();
 $post_set=$params['post_set'];
 $post=$params['post_set'];
 $id=$_GET['id'];
 
 $login_user = $_SESSION['login_user'];
 //var_dump($params);
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/base13.css">
    <title>投稿ページ</title>
 </head>
   <header>
    <?php 
    include('header.php');
    ?>
    </header>
    
 <body>
 
  <div class=store>
  <?php echo $params['post']['store']?>
 </div>
<div class=address>
  <?php echo $params['post']['address']?>
</div>
<session>
<div class=img>
  <?php echo '<img src="/img/' .  $params['post']['photo1'] .'" width="75%"">';?>
</div>
<div class=glaf>
<canvas id="myChart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script>
var ctx = document.getElementById("myChart");
var myRadarChart = new Chart(ctx, {
        type: 'radar', 
        data: { 
            labels: ["味", "見た目", "接客", "外見", "金額"],
            datasets: [{
                label: '総合点数',
                data: [<?php echo $params['post']['eat'] ?>,
                <?php echo $params['post']['bea'] ?>, 
                <?php echo $params['post']['customer'] ?>,
                <?php echo $params['post']['look'] ?>,
                <?php echo $params['post']['money'] ?>],
                backgroundColor: 'RGBA(255,255,255, 0.5)',
                borderColor: 'RGBA(255,255,255, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'RGB(0,0,0)'
            }]
        },
        options: {
            title: {
                display: true,
                text: '料理評価'
            },
            scale:{
                ticks:{
                    suggestedMin: 0,
                    suggestedMax: 100,
                    stepSize: 10,
                    callback: function(value, index, values){
                        return  value +  '点'
                    }
                }
            }
        }
    });
</script>
</div>
  </session>
<div class=body>
  <?php echo nl2br($params['post']['body'])?>
</div>
<p>コメントページ</p>
<div class=comment>
<?php foreach ($post_set as $com): ?>
  <p><?php echo nl2br($com['com']) ?></p>
  <?php endforeach; ?>
  </div>
<a href="mypage.php">マイページに戻る</a>
<a class=ah href="post_edit.php?id=<?php echo $params['post']['id'] ?>">内容を編集しますか？</a>
<a class=ahb href="post_delete.php?id=<?php echo $params['post']['id'] ?>"onclick="return confirm('削除しますか')">内容を削除しますか？</a>
 </body>
</html>