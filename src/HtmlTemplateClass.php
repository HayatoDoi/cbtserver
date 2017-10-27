<?php
class HtmlTemplateClass
{
  public static function dumpNav()
  {
    @session_start();
    //ログイン済みの場合
    if(isset($_SESSION['username']))
    {
      $username = $_SESSION['username'];
      $nav = <<<EOT
      <nav class="navigation">
      <section class="container">
        <ul class="navigation-list float-left">
          <li class="navigation-item">
            <a href="/questions.php" class="navigation-link">Questions</a>
          </li>
          <li class="navigation-item">
            <a href="/ranking.php" class="navigation-link">Ranking</a>
          </li>
        </ul>

        <ul class="navigation-list float-right">
          <li class="navigation-item">
            <div class="dropdown">
              <a class="navigation-link">$username</a>
              <div class="dropdown-content">
                <a href="/user/logout.php">logout</a>
                <a href="/user.php?id=$username">Your profile</a>
                <a href="/profile/edit.php">Edit profile</a>
              </div>
            </div>
          </li>
        </ul>
      </section>
      </nav>
EOT;
    }
    else
    {
      $nav = <<<EOT
      <nav class="navigation">
      <section class="container">
        <ul class="navigation-list float-left">
          <li class="navigation-item">
            <a href="/questions.php" class="navigation-link">Questions</a>
          </li>
          <li class="navigation-item">
            <a href="/ranking.php" class="navigation-link">Ranking</a>
          </li>
        </ul>

        <ul class="navigation-list float-right">
          <li class="navigation-item">
            <a href="/user/login.php" class="navigation-link">Login</a>
          </li>
        </ul>
      </section>
      </nav>
EOT;
    }

    return $nav;
  }

  public static function dumpHead()
  {
    require_once 'AssetClass.php';
    $assetsPath  = '';
    $assetsPath .= AssetClass::path('css', 'font.css');
    $assetsPath .= AssetClass::path('css', 'normalize.css');
    $assetsPath .= AssetClass::path('css', 'milligram.min.css');
    $assetsPath .= AssetClass::path('css', 'main.css');
    $assetsPath .= AssetClass::path('css', 'original.css');
    $assetsPath .= AssetClass::path('js', 'hoge.js');

    $head = <<<EOT
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="HayatoDoi">

      <title>cbtserver</title>
      <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
      $assetsPath
    </head>
EOT;
    return $head;
  }

  public static function dumpFooter()
  {
    $footer = <<<EOT
    <footer class="footer">
      <section class="container">
        <p>&copy; 2015-2017 Hayato Doi</p>
      </section>
    </footer>
EOT;
    return $footer;
  }
}