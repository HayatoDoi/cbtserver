<?php
/**
 * GET  /profile/edit.php ユーザープロフィール編集フォームの表示
 * POST  /profile/edit.php ユーザープロフィールを編集後 /user?id=?? にリダイレクト
 *
 */

require_once '../../HtmlTemplateClass.php';
require_once '../../SessionClass.php';
require_once '../../UserModel.php';

$userModel = new UserModel();
SessionClass::logined();
$username = $_SESSION['username'];

$user = $userModel->findName($username);
if($user['self_introduction'] != NULL)
{
  $self_introduction = $user['self_introduction'];
}

//POSTのみ処理
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $self_introduction = $_POST['self_introduction'];
  //バリテーションチェック
  if($self_introduction === NULL || $self_introduction === '')
  {
    $errorMsg = '自己紹介文(HTML)が空白です。';
  }
  else
  {
    $userModel->updateSelfIntroduction($username, $self_introduction);
    //リダイレクト
    header("Location: /user.php?id=$username");
    exit();
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
          <h3 class="title">プロフィールの編集</h3>
          <form action="" method="post">
            <fieldset>
              <label for="self_introduction">自己紹介文(HTML)</label>
              <textarea name="self_introduction"><?php if(isset($self_introduction)) { echo $self_introduction; }?></textarea>
              <p style="color:red;">
                <?php if(isset($errorMsg)){ echo $errorMsg; } ?>
              </p>
              <input type="submit" value="submit" class="button-primary">
            </fieldset>
          </form>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>