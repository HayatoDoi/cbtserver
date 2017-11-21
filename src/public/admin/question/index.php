<?php
/**
 * GET  /admin/question 問題一覧を表示
 *
 */

require_once '../../../HtmlTemplateClass.php';
require_once '../../../QuestionModel.php';

$questionModel = new QuestionModel();

$questions = $questionModel->all();
?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">Questions</h3>
          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Score</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($questions as $question) : ?>
                <tr>
                  <td><?=$question['id'] ?></td>
                  <td><?=$question['name'] ?></td>
                  <td><?=$question['score'] ?></td>
                  <td width="200">
                    <a class="button button-update" href="/admin/question/update.php?qId=<?=$question['id'] ?>">更新</a>
                    <a class="button button-delete" href="/admin/question/delete.php?qId=<?=$question['id'] ?>">削除</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <a class="button button-plus-wide" href="/admin/question/new.php"><h3>+</h3></a>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>