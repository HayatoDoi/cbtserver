<?php
/**
 * GET  /admin 管理者コンソール
 *
 */
require_once '../../HtmlTemplateClass.php';
?>
<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">管理者コンソール</h3>
          <table>
            <thead>
              <tr>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>問題管理</td>
                  <td><a class="button button-update" href="/admin/question/">OPEN</a></td>
                </tr>
                <td>ユーザー管理</td>
                  <td><a class="button button-update" href="/admin/user/">OPEN</a></td>
                </tr>
            </tbody>
          </table>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>