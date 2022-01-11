<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Post_Com extends Db {
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function findAll():Array {
        $sql = 'SELECT * FROM post_com ';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * 
     * 投稿データを入れる
     * 
     */
    public function post_complet() {
        $sql = "INSERT INTO post_com (com,post_id) 
        VALUES(:com,:post_id)";
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':com',$_POST['com'], PDO::PARAM_STR); 
        $sth->bindValue(':post_id',$_POST['id'], PDO::PARAM_STR); 
        $sth= $sth ->execute();
    }  
    
    
}
?>