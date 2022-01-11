<?php
require_once(ROOT_PATH .'/Models/POST.php');
require_once(ROOT_PATH .'/Models/POST_COM.php');
class BlogController {
    private $request; //リクエストパラメータ（GET、POST）
    private $Post; //Postモデル
    private $Post_Com; //Post_Comモデル
    
    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        //モデルオブジェクトの生成
        $this->post =new post();
        $dbh = $this->post->get_db_handler();
        $this->post_com =new post_com($dbh);
      
    }

    public function index() {
        $page = 0;
        if(isset($this->request['get']['page'])) {
            $page = $this->request['get']['page'];
        }
        $pid = 0;
        if(isset($this->request['get']['cid'])) {
          $pid = $this->request['get']['cid'];
        }
        $post = $this->post->findAll($page);
        $post_count = $this->post->countAll();
        $params = [
            'post' => $post,
            'pages' => $post_count / 5,
        ];
        return $params;
    }

    public function view() {
        if(empty($this->request['get']['id'])) {
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit;
        }

        $post = $this->post->findById($this->request['get']['id']);
        $params = [
            'post' => $post
        ];
        return $params;
    }
 /**
  * 投稿ページ
  */
    public function complet() {
        $complet =$this->post->complet();
    }
/**
 * 
 * 更新ページ
 */
    public function edit() {
        if(empty($this->request["get"]["id"])){
            echo "指定のパラメータが不正です。このページを表示できません。";
            exit;
        }
        $post =$this->post->edit($this->request['get']['id']);
        $params = [
            'post' => $post
        ];
        return $params;
    }
    /**
     * アップデート
     */
    public function update() {
        $post =$this->post->update();
    }
   
    /**
     * 削除ページ
     */
    public function delete() {
        if(empty($this->request["get"]["id"])){
            echo "指定のパラメータが不正です。このページを表示できません。";
            exit;
        }
        $delete =$this->post->delete($this->request['get']['id']);
        $params = [
            'delete' => $delete
        ];
        return $params;
    }
   public function search($store,$address) {
   $search =$this->post->search($store,$address);
        $params = [
            'search' => $search
        ];
        return $params;
    }
    public function com_view() {
        if(empty($this->request['get']['id'])) {
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit;
        }

        $post_com = $this->post_com->findById($this->request['get']['id']);
        $params = [
            'post_com' => $post_com
        ];
        return $params;
    }
    /**
     * 
     * コメントページ
     */
    public function post_complet() {
        $post_complet =$this->post_com->post_complet($this->request['post']);
        $params = [
            'post_complet' => $post_complet
        ];
        return $params;
    }
    /**
     * 
     * コメントページ
     */
    public function post_set() {
        if(empty($this->request['get']['id'])) {
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit;
        }
        $post = $this->post->findById($this->request['get']['id']);
    $post_set = $this->post->post_set($this->request['get']['id']);
        $params = [
            'post' => $post,
            'post_set' => $post_set
        ];
        return $params;
    }
    
}
?>