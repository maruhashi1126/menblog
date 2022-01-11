<?php
require_once(ROOT_PATH .'Models/User.php');

class UserController {
    private $request; //リクエストパラメータ（GET、POST）
    private $UserLogic; //Userモデル
    
    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        //モデルオブジェクトの生成
        $this->UserLogic =new UserLogic();
    }
    public static function check($email, $birth) {
        $checkPass = $this->mypage->checkPass();
        $userCheck = $this->mypage->findByid($this->request['post']['id']);
        $params = [
            'userCheck' => $userCheck
        ];
        return $params;
    }
    public function Mypage() {
      
        $updateMypage= $this->UserLogic->updateMypage(); 
    }
    /**
     * ユーザー削除ページ
     */
    public function deleteUser(){
        if(empty($this->request["get"]["id"])){
            echo "指定のパラメータが不正です。このページを表示できません。";
            exit;
        }
        $deleteUser =$this->UserLogic->deleteUser($this->request['get']['id']);
        $params = [
            'deleteUser' => $deleteUser
        ];
        return $params;

	}
}
?>