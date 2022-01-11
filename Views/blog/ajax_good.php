<?php
//データベースとの接続
require_once(ROOT_PATH .'/database.php');
require_once(ROOT_PATH.'/Models/Db.php');
//Postで定義した内容を表示
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

//いいね機能の実施を行う
function check_good($user_id,$post_id){
    $result = false;
    //　データベースに接続をする。
    $dbh = new PDO(
        'mysql:dbname='.DB_NAME.
        ';host='.DB_HOST, DB_USER, DB_PASSWD
    );
    $sql = " SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $like = $stmt->fetch();
    if(!empty($like)) {
        $result = true;
    }
    return $result;
}
if(isset($_POST)){

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    //登録しているかの確認
    if(check_good($user_id,$post_id)){
        $action = '解除';
        $sql = " DELETE FROM likes WHERE :user_id = :user_id AND :post_id = post_id ";
      }else{
        $action = '登録';
        $sql = " INSERT INTO likes (user_id, post_id ) VALUE (:user_id, :post_id) ";
      }
      try{
        $dbh = new PDO(
            'mysql:dbname='.DB_NAME.
            ';host='.DB_HOST, DB_USER, DB_PASSWD
        );
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
      } catch (\Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        echo ("error".$e);
      }
   }
    
?>