<?php
/**
 * GET  /user/register.php ユーザ登録フォームを表示
 * POST /user/register.php　ユーザ登録処理→ログイン処理→リダイレクト
 *
 */
require_once '../HtmlTemplateClass.php';
require_once '../SessionClass.php';
require_once '../UserModel.php';
SessionClass::unlogined();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_confirmation = $_POST['password-confirmation'];

  //バリテーションチェック
  if($username === '' || $password === '' || $password_confirmation === '')
  {
    $formError = '空の項目が存在します';
  }
  else if($password !== $password_confirmation)
  {
    $formError = 'パスワードが一致しません。';
  }
  else
  {
    try
    {
      //ユーザ登録処理
      $userModel = new UserModel();
      $userModel->register($username, $password);
      //ログイン処理
      session_regenerate_id(true);
      $_SESSION['username'] = $username;
      //リダイレクト
      header('Location: /questions.php');
      exit();
    }
    catch(Exception $e)
    {
      error_log($e->getMessage());
      $formError = 'データベースエラー';
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">Register</h3>
          <form action="" method="post">
            <fieldset>
            <label for="username">ユーザ名</label>
            <input type="text" name="username" value="<?php if(isset($username)){ echo $username; } ?>">
            
            <label for="password">パスワード</label>
            <input type="password" name="password">

            <label for="password-confirmation">パスワード(確認)</label>
            <input type="password" name="password-confirmation">

            <p style="color:red;">
              <?php if(isset($formError)){ echo $formError; } ?>
            </p>
            <input type="submit" value="Login" class="button-primary">
            </fieldset>
          </form>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>