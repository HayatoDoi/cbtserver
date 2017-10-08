<?php
/**
 * GET  /question.php?qId=0-20 問題を表示
 * POST /question.php?qId=0-20 正解判定
 *
 */
require_once '../HtmlTemplateClass.php';
require_once '../SessionClass.php';
require_once '../QuestionModel.php';
require_once '../UserModel.php';

$questionModel = new QuestionModel();
$userModel = new UserModel();
SessionClass::logined();

//GET,POST共通処理
$qId = $_GET['qId'];
//バリテーションチェック
if($qId === NULL || $qId === '' || !ctype_digit($qId))
{
  header('Location: /questions.php');
  exit();
}
else
{
  $username = $_SESSION['username'];
  $question = $questionModel->findId($qId);
  $isCorrect = $userModel->isCorrect($username, $qId);
}

//POSTのみ処理
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  //正解済みならバイバイ
  if($isCorrect)
  {
    header('Location: /question.php?qId='.$qId);
    exit();
  }
  $flag = $_POST['flag'];
  //正解
  if($questionModel->flagCheck($qId, $flag))
  {
    $isCorrect = true;
    //データベースに登録
    $userModel->updateScore($username, $qId);
  }
  //不正解
  else
  {
    $errorMsg = '不正解です!!!!';
  }
}

?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title"><?=$question['name'] ?></h3>
          <dev><?=$question['sentence'] ?></dev>
          </br></br>
          <form action="" method="post">
            <fieldset>
              <label for="flag">フラグ</label>
              <input type="text" name="flag">
              <p style="color:red;">
                <?php if(isset($errorMsg)){ echo $errorMsg; } ?>
              </p>
              <p style="color:green;">
                <?php if($isCorrect){ echo '正解しました。'; } ?>
              </p>
              <input type="submit" value="submit" class="button-primary">
            </fieldset>
          </form>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>