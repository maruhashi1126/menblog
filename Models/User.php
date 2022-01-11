<?php
require_once(ROOT_PATH .'/database.php');
require_once(ROOT_PATH .'/Models/Db.php');

class UserLogic extends Db {
    public function __construct($dbh = null) {
        parent::__construct($dbh);
    }
 /**
  * 
  * ユーザー登録
  * @param array $userDate
  * @return bool $result
  */
 public static function createUser($userDate){
    $result = false;

    $dbh = new PDO (
      'mysql:dbname='.DB_NAME.
      ';host='.DB_HOST, DB_USER, DB_PASSWD
    );
    $sql = 'INSERT INTO mypage (name, email, birth, password) VALUES (:name, :email, :birth, :password)';
    $sth = $dbh->prepare($sql);
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sth->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $sth->bindParam(':birth', $_POST['birth'], PDO::PARAM_INT);
    $sth->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $sth->bindParam(':password', $pass_hash, PDO::PARAM_STR);

    try{
      $result = $sth->execute();
      return $result;
  } catch (PDOException $e) {
      return $result;
  }
   }

 /**
  *  ログイン処理
  * @param string $email
  * @param string $password
  * @return bool $result
  */
  public static function login($email, $password){
    //結果
    $result = false;
    //ユーザーをメールアドレスから取得
    $user = self::getUserByEmail($email);

    if(!$email) {
        $_SESSION['msg'] = 'emailが一致しません。';
        return $result;
    }
    //パスワード照会
    if(password_verify($password,$user['password'])){
        //ログイン成功
        session_regenerate_id(true);
        $_SESSION['login_user'] = $user;
        $result = true;
        return $result;
    }

    $_SESSION['msg'] = 'passwordが一致しません。';
    return $result;

 }

 /**
  * 
  *  emailからユーザー名を取得
  * @param string $email
  * @return array|bool $user|false
  */
 public static function getUserByEmail($email){
    //sqlの準備
    //sqlの実行
    //sqlの結果を返す
    $dbh = new PDO(
        'mysql:dbname='.DB_NAME.
         ';host='.DB_HOST, DB_USER, DB_PASSWD
      );

      $sql = 'SELECT * FROM mypage WHERE email = :email';
      $sth = $dbh->prepare($sql);
      $sth->bindParam(':email', $email, PDO::PARAM_STR);

      try {
        $sth->execute();
        $user = $sth->fetch();
        return $user;
      } catch(\Exception $e) {
        return false;
      }
 }
 /**
  * 
  * ログインチェック
  * @param void
  * @return bool $result
  */
  public static function checkLogin(){

    $result = false;

    //セッションにログインユーザーが入っていなかったらfalse
    if(isset($_SESSION['login_user'])&& $_SESSION['login_user']['id'] >0 ){
      return $result = true;
    }

    return $result;

  }
  /**
   * ユーザー情報確認（誕生日）
   * 
   */
  public static function getUserBybirth($birth){
    //sqlの準備
    //sqlの実行
    //sqlの結果を返す
    $dbh = new PDO(
        'mysql:dbname='.DB_NAME.
         ';host='.DB_HOST, DB_USER, DB_PASSWD
      );

      $sql = 'SELECT * FROM mypage WHERE birth = :birth';
      $sth = $dbh->prepare($sql);
      $sth->bindParam(':birth', $birth, PDO::PARAM_INT);

      try {
        $sth->execute();
        $user = $sth->fetch();
        return $user;
      } catch(\Exception $e) {
        return false;
      }
 }
  /**
   * 
   * ログアウト処理
   */
  public static function logout(){
    $_SESSION = array();
    session_destroy();
  }
  /**
   * メールアドレスと誕生日でユーザー情報を確認
   * 
   */
  public static function checkPass($email, $birth) {
    //結果の取得
    $result = false;
    $user = self::getUserByEmail($email);
     /*
       丸 メールアドレスがあっていなければエラー文を表示する
        */
        if(!$user) {
          $_SESSION['msg'] = 'メールアドレスが一致しません。';
          return $result;
      }
      //誕生日の照会
      if($birth === $user['birth']) {
        //照会成功
        $_SESSION['user'] = $user;
        $result = true;
        return $result;
    }

    /*
    丸　birthがあっていなければエラー文表示
    */
    $_SESSION['msg'] = '誕生日が一致しません。';
    return $result;
}

/**
 * パスワードリセット
 * 
 */
public static function updatemypage(){
  $password = $_POST['password'];

  $sql = ' UPDATE mypage SET password = :password ';
  $sql = ' WHERE id = :id ';
  $sth = $this->dbh->prepare($sql);
  $pass_hash = password_hash($password, PASSWORD_DEFAULT);
  $sth->bindParam(':password', $pass_hash,PDO::PARAM_STR);

  $sth->execute();
}
}
?>