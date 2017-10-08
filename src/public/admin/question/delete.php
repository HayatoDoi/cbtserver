<?php
/**
 * GET  /admin/question/delete.php?qId=1-20 問題の削除
 *
 */
require_once '../../../QuestionModel.php';
$questionModel = new QuestionModel();
$id = $_GET['qId'];
$questionModel->delete($id);
header('Location: /admin/question');
exit;