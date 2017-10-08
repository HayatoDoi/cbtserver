<?php
/**
 * GET  /questions.php 問題一覧を表示
 *
 */
require_once '../HtmlTemplateClass.php';
require_once '../QuestionModel.php';

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
              </tr>
            </thead>
            <tbody>
              <?php foreach($questions as $question) : ?>
                <tr>
                  <td><?=$question['id'] ?></td>
                  <td><a href="/question.php?qId=<?=$question['id'] ?>"><?=$question['name'] ?></a></td>
                  <td><?=$question['score'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>