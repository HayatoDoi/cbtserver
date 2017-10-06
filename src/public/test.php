<?php
require '../DataBaseConfigClass.php';

$dataBaseConfig = new DataBaseConfigClass();
echo $dataBaseConfig->HOST;
echo $dataBaseConfig->USER;
echo $dataBaseConfig->PASSWORD;
