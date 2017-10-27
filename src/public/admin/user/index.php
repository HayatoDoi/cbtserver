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
                  <td><?=$user['name'] ?></td>
                  <td><?=$user['self_introduction'] ?></td>
                  <td width="200">
                    <a class="button button-delete" href="/admin/user/delete.php?name=<?=$user['name'] ?>">削除</a>
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