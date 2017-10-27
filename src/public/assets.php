<?php
/**
 * GET  /assets.php?file=???? 静的ファイルの出力
 *
 */

$mimeList = array('assets/css'=>'text/css', 'assets/js'=>'text/javascript', 'assets/font'=>'font/woff2');
$filename = 'assets/' . $_GET['file'];

//ファイルがなかったら。
if(!file_exists($filename))
{
  http_response_code(404);
  exit();
}

// ファイルの中身を出力
header('Content-Type: ' . $mimeList[pathinfo($filename)['dirname']]);
echo file_get_contents($filename);