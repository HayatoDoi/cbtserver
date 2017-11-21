<?php
/**
 * GET  /ranking.php ランキングテーブルの表示
 *
 */
require_once '../HtmlTemplateClass.php';
require_once '../UserModel.php';

$userModel = new UserModel();
$htmlTemplate = new HtmlTemplateClass();

$userRank = $userModel->ranking();

?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">Ranking</h3>
          <table>
            <thead>
              <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;?>
              <?php foreach($userRank as $row) : ?>
                <tr>
                  <td><?=$i++ ?></td>
                  <td><a href="/user.php?id=<?=htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></a></td>
                  <td><?=$row['score'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>