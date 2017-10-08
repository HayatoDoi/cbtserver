<?php
/**
 * GET  /index.php トップページ
 *
 */

require_once '../HtmlTemplateClass.php';
?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
      <section class="container">
        <h1 class="title">cbtserver</h1>
        <p class="description">Vulnerable CTF server
          <br>
          <i>
            <small>Currently v.β</small>
          </i>
        </p>
        <a class="button" href="https://github.com/HayatoDoi/cbtserver" title="Read source code">Read source code</a>

      </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>