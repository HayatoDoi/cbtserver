<?php
/**
 * GET  /admin/user ユーザ一覧を表示
 *
 */

require_once '../../../HtmlTemplateClass.php';
require_once '../../../UserModel.php';

$userModel = new UserModel();

$users = $userModel->all();
?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">Users</h3>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Profile</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($users as $user) : ?>
                <tr>
                  <td><?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></td>
                  <td width="200">
                    <a class="button button-update" href="/admin/user/profile.php?id=<?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>">Open</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>