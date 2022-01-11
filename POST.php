<?php
//丸　Db.phpとの接続
require_once(ROOT_PATH.'/Models/Db.php');

class Post extends Db {
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
//丸　postデータベースとの接続
public function findAll($page = 0):Array {
    $sql = 'SELECT * FROM post';
    $sql .= ' LIMIT 5 OFFSET '.(5 * $page);
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
   //丸　idごとにpost1の内容を表示
    public function findById($id = 0):Array {
        $sql ='SELECT * FROM post';
        $sql .= ' WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * postテーブルから全データを取得
     * 
     * @return Int $count 全件数
     */
    //丸　ページ取得
    public function countAll():Int {
        $sql = 'SELECT count(*) as count FROM post';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $post_count = $sth->fetchColumn();
        return $post_count;
    }

    /**
     * 
     * 投稿データを入れる
     * 
     */
    //丸　投稿内容を保存する。
    public function complet() { 
 $sql = "INSERT INTO post(name_id,store,address,photo1,eat,bea,customer,look,money,body) 
     VALUES(:name_id,:store,:address,:photo1,:eat,:bea,:customer,:look,:money,:body)";

  $files=$_FILES['photo1'];
  $filename=basename($files['name']);
  $tmp_path=$files['tmp_name'];
  $fileerr=$files['error'];
  $filesize=$files['size'];
  $pass="../public/img/";
  $type= mt_rand();
  $path = $filename;
  if(move_uploaded_file($tmp_path,$pass.$type.$path)) {
  }else{
  };
  $img=$type.$path;

        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':name_id',$_POST['name_id'], PDO::PARAM_INT); 
        $sth->bindValue(':store',$_POST['store'], PDO::PARAM_STR); 
        $sth->bindValue(':address',$_POST['address'], PDO::PARAM_STR); 
        $sth->bindValue(':photo1',$img, PDO::PARAM_STR); 
        $sth->bindValue(':eat',$_POST['eat'], PDO::PARAM_INT); 
        $sth->bindValue(':bea',$_POST['bea'], PDO::PARAM_INT); 
        $sth->bindValue(':customer',$_POST['customer'], PDO::PARAM_INT); 
        $sth->bindValue(':look',$_POST['look'], PDO::PARAM_INT); 
        $sth->bindValue(':money',$_POST['money'], PDO::PARAM_INT); 
        $sth->bindValue(':body',$_POST['body'], PDO::PARAM_STR);
        $sth= $sth ->execute();
    }  
    /**
     * 
     * editデータ更新
     */
    public function edit($id = 0):Array {
        $sql = 'SELECT * FROM post Where id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id',(int)$id,PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * update更新
     */
     public function update() {
        $id=$_POST['id'];
        $store=$_POST['store'];
        $address=$_POST['address'];
        $eat=$_POST['eat'];
        $bea=$_POST['bea'];
        $look=$_POST['look'];
        $customer=$_POST['customer'];
        $money=$_POST['money'];
        $body=$_POST['body'];

        $files=$_FILES['photo1'];
        $filename=basename($files['name']);
        $tmp_path=$files['tmp_name'];
        $fileerr=$files['error'];
        $filesize=$files['size'];
        $pass="../public/img/";
        $type= mt_rand();
        $path = $filename;
        if(move_uploaded_file($tmp_path,$pass.$type.$path)) {
         
        }else{
        };
        $img=$type.$path;
 
    $sql = "UPDATE post SET store= :store, address = :address, photo1 = :photo1, eat = :eat, bea = :bea, customer = :customer, look = :look, money = :money, body = :body WHERE id = :id";
        
               $sth = $this->dbh->prepare($sql);
               $this->dbh->beginTransaction();
               try {
                $sth->bindValue(':id',$id); 
               $sth->bindValue(':store',$store); 
               $sth->bindValue(':address',$address); 
               $sth->bindValue(':photo1',$img);  
               $sth->bindValue(':eat',$eat); 
               $sth->bindValue(':bea',$bea); 
               $sth->bindValue(':customer',$customer); 
               $sth->bindValue(':look',$look); 
               $sth->bindValue(':money',$money); 
               $sth->bindValue(':body',$body);
               $sth->execute();
               $this->dbh->commit();
             }catch(PDOException $e){
               $this->dbh->rollback();
               throw $e;
             } 
            }

    /**
     * delete削除
     */
    public function delete() {
        $sql = 'DELETE FROM post WHERE id=:id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id',$_GET["id"], PDO::PARAM_STR);
        $result = $sth -> execute();
    } 
     /**
     * sarch検索
     */
    public function search($store,$address) {
        $sql = "SELECT * FROM post WHERE store LIKE :store AND address LIKE :address "; //SQL文を実行して、結果を$stmtに代入する。
        $sth = $this->dbh->prepare($sql);
        $store = '%'.$store.'%';
        $address = '%'.$address.'%';
        $sth->bindValue(':store',$store, PDO::PARAM_STR);
        $sth->bindValue(':address',$address, PDO::PARAM_STR);
        $result = $sth -> execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
}

  public function post_set($id = 0):Array {
    $sql = 'SELECT post_com.com  FROM post_com
    JOIN post ON post.id = post_com.post_id ';
    $sql .= ' WHERE post.id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
   }

}
?>