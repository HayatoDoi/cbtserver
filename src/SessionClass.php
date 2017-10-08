<?php
class SessionClass
{
  public static function unlogined()
  {
    // セッション開始
    @session_start();
    // ログインしていれば
    if (isset($_SESSION["username"]))
    {
      header('Location: /');
      exit;
    }
  }

  public static function logined()
  {
    // セッション開始
    @session_start();
    // ログインしていなければlogin.phpに遷移
    if (!isset($_SESSION["username"]))
    {
      header('Location: /login.php');
      exit;
    }
  }

  public static function logout()
  {
    // セッション開始
    @session_start();
    //すべてのセッションを削除
    $_SESSION = array();
    //クッキーを削除
    if(isset($_COOKIE["PHPSESSID"]))
    {
      setcookie("PHPSESSID", '', time() - 1800, '/');
    }
    //セッションに登録されたデータを全て破棄
    session_destroy();
    header('Location: /');
    exit;
  }

  // CSRFトークンの生成
  public static function generateToken()
  {
    // セッションIDからハッシュを生成
    return hash ( 'sha256', session_id() );
  }

  // CSRFトークンチェック
  public static function validateToken($token)
  {
    return $token === generate_token();
  }
}