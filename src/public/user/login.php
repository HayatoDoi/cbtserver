<?php
/**
 * GET  /user/login.php ログインフォームを表示
 * POST /user/login.php パスワードチャック→ログイン処理→リダイレクト
 *
 */
require_once '../../HtmlTemplateClass.php';
require_once '../../SessionClass.php';
require_once '../../UserModel.php';
SessionClass::unlogined();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  //バリテーションチェック
  if($username === '' || $password === '')
  {
    $formError = '空の項目が存在します';
  }
  else
  {
    try
    {
      //パスワードチャック
      $userModel = new UserModel();
      if(!$userModel->passwordCheck($username, $password))
      {
        $formError = 'パスワード又はユーザ名が違います';
      }
      else
      {
        //ログイン処理
        
        // 認証が成功
        // セッションIDの追跡を防ぐ
        session_regenerate_id(true);
        //ユーザ名をセット
        $_SESSION['username'] = $username;
        header('Location: /questions.php');
        exit;
      }
    }
    catch(Exception $e)
    {
      error_log($e->getMessage());
      $formError = 'データベースエラー';
    }
  }
}
?>

<?php if(isset($_SESSION['Name'])){ echo $_SESSION['Name']. '<br>'; } ?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">Login</h3>
          <form action="" method="post">
            <fieldset>
            <label for="username">ユーザ名</label>
            <input type="text" name="username" value="<?php if(isset($username)){ echo $username; } ?>">
            
            <label for="password">パスワード</label>
            <input type="password" name="password">

            <p style="color:red;">
              <?php if(isset($formError)){ echo $formError; } ?>
            </p>
            <input type="submit" value="Login" class="button-primary">
            <div class="float-right">
              <a href="/user/register.php">アカウントの作成</a>
            </div>
            </fieldset>
          </form>
        </section>
        <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>