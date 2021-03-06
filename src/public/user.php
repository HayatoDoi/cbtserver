<?php
/**
 * GET  /user.php ユーザーのプロフィール表示
 *
 */
require_once '../HtmlTemplateClass.php';
require_once '../UserModel.php';

$userModel = new UserModel();
$htmlTemplate = new HtmlTemplateClass();

$username = $_GET['id'];
$user = $userModel->findName($username);

?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <!-- /user.php?id=xxxx と /admin/user/profile.php?id=xxxxxxxxのテンプレート -->
      <!-- TODO : 管理者ページにこのテンプレートを使ったユーザ管理ページを作る -->
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title"><?=$user['name']?></h3>
          <p><?=$user['self_introduction']?></p>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>
