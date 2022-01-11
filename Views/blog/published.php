<?php
 $id=$_GET['id'];
 require_once(ROOT_PATH. 'Controllers/BlogController.php');

 $post_set = new BlogController();
 $params = $post_set->post_set();
 $post = $params['post']; 
 $post_set=$params['post_set'];
 

var_dump($params);
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
  <?php echo $post['store']?>
</div>
<div class=address>
  <?php echo $post['address']?>
</div>
<session>
<div class=img>
  <?php echo '<img src="/img/' .  $post['photo1'] .'" width="75%"">';?>
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
                data: [<?php echo $post['eat'] ?>,
                <?php echo $post['bea'] ?>, 
                <?php echo $post['customer'] ?>,
                <?php echo $post['look'] ?>,
                <?php echo $post['money'] ?>],
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
  <?php echo nl2br($post['body'])?>
</div>
<p>コメントページ</p>
<div class=comment>
<?php foreach ($post_set as $com): ?>
  <p><?php echo nl2br($com['com']) ?></p>
  <?php endforeach; ?>
  </div>
 <a href="top_page.php">トップページに戻る</a>
 <a class=ah href="pub_com.php?id=<?php echo $post['id'] ?>">コメントしますか？</a>

 </body>
</html>
     

</body>
</html>