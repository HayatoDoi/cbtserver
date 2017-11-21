<?php
/**
 * GET  /admin/user/profile.php ユーザーのプロフィール表示
 *
 */
require_once '../../../HtmlTemplateClass.php';
require_once '../../../UserModel.php';

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
             <h2 class="title"><?=$user['name']?></h2>
             <p>Score : <b><?=$user['score']?></b></p>
            <p><?=$user['self_introduction']?></p>
            <a class="button button-delete-wide" href="/admin/user/delete.php?name=<?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>">Delete</a>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>
