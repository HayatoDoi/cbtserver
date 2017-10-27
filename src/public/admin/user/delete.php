<?php
/**
 * GET  /admin/user/delete.php?name=??? ユーザの削除
 *
 */
require_once '../../../UserModel.php';
$userModel = new UserModel();
$name = $_GET['name'];

$userModel->delete($name);
// header('Location: /admin/user');
// exit;