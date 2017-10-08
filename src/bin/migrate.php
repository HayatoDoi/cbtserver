#!/usr/bin/env php
<?php
require_once 'DataBaseConfigClass.php';

function dumpHelp()
{
  $msg = <<<EOT
Usage: migrate.php [options]

[options]
  migrate  テーブルを作ります。
  reset    データをすべて削除します。
  delete   データベースを削除します。

EOT;
  echo $msg;
}
function createTable()
{
  $query_CREATE_users = "
  CREATE TABLE users (
    name varchar(40) NOT NULL PRIMARY KEY,
    password varchar(40) NOT NULL,
    score int(11) NOT NULL DEFAULT '0',
    update_time datetime NOT NULL DEFAULT NOW(),
    question01 boolean NOT NULL DEFAULT false,
    question02 boolean NOT NULL DEFAULT false,
    question03 boolean NOT NULL DEFAULT false,
    question04 boolean NOT NULL DEFAULT false,
    question05 boolean NOT NULL DEFAULT false,
    question06 boolean NOT NULL DEFAULT false,
    question07 boolean NOT NULL DEFAULT false,
    question08 boolean NOT NULL DEFAULT false,
    question09 boolean NOT NULL DEFAULT false,
    question10 boolean NOT NULL DEFAULT false,
    question11 boolean NOT NULL DEFAULT false,
    question12 boolean NOT NULL DEFAULT false,
    question13 boolean NOT NULL DEFAULT false,
    question14 boolean NOT NULL DEFAULT false,
    question15 boolean NOT NULL DEFAULT false,
    question16 boolean NOT NULL DEFAULT false,
    question17 boolean NOT NULL DEFAULT false,
    question18 boolean NOT NULL DEFAULT false,
    question19 boolean NOT NULL DEFAULT false,
    question20 boolean NOT NULL DEFAULT false
  ) DEFAULT CHARSET=utf8;";
  $query_CREATE_questions = "
  CREATE TABLE questions (
    id int(11) AUTO_INCREMENT PRIMARY KEY,
    name varchar(40) DEFAULT '',
    sentence text,
    flag varchar(40) DEFAULT '',
    score int(11) DEFAULT '0'
  ) DEFAULT CHARSET=utf8;";

  $dataBaseConfig = new DataBaseConfigClass();
  $mysqli = new mysqli( $dataBaseConfig->HOST, $dataBaseConfig->USER, $dataBaseConfig->PASSWORD, $dataBaseConfig->DB);
  if( $mysqli->connect_errno ) {
    throw new Exception('データベースに接続時出来なかった。');
  }
  $mysqli->set_charset('utf8');
  if( $mysqli->query($query_CREATE_users) )
  {
    throw new Exception('クエリエラー:query_CREATE_users');
  }
  if( $mysqli->query($query_CREATE_questions) )
  {
    throw new Exception('クエリエラー:query_CREATE_questions');
  }
  $mysqli->close();
}
function truncateTable()
{
  $query_TRUNCATE_users = "TRUNCATE TABLE users;";
  $query_TRUNCATE_questions = "TRUNCATE TABLE questions;";

  $dataBaseConfig = new DataBaseConfigClass();
  $mysqli = new mysqli( $dataBaseConfig->HOST, $dataBaseConfig->USER, $dataBaseConfig->PASSWORD, $dataBaseConfig->DB);
  if( $mysqli->connect_errno ) {
    throw new Exception('データベースに接続時出来なかった。');
  }
  $mysqli->set_charset('utf8');
  if( $mysqli->query($query_TRUNCATE_users) )
  {
    throw new Exception('クエリエラー:query_TRUNCATE_users');
  }
  if( $mysqli->query($query_TRUNCATE_questions) )
  {
    throw new Exception('クエリエラー:query_TRUNCATE_questions');
  }
  $mysqli->close();
}

// __main__
if(count($argv) !== 2)
{
  dumpHelp();
  exit(1);
}

if($argv[1] === 'migrate')
{
  try
  {
    createTable();
  }
  catch(Exception $e)
  {
    fputs(STDERR, $e->getMessage().PHP_EOL);
    exit(1);
  }
  echo 'migrate done'.PHP_EOL;
}
else if($argv[1] === 'reset')
{
  try
  {
    truncateTable();
  }
  catch(Exception $e)
  {
    fputs(STDERR, $e->getMessage().PHP_EOL);
    exit(1);
  }
  echo 'reset done'.PHP_EOL;
}
else if($argv[1] === 'delete')
{
  echo 'delete';
}
else
{
  dumpHelp();
  exit(1);
}