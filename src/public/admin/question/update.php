<?php
/**
 * GET  /admin/question/update.php?qId=1-20 問題更新フォームを表示
 * POST /admin/question/update.php?qId=1-20 問題更新処理(delete->inset)
 *
 */

require_once '../../../HtmlTemplateClass.php';
require_once '../../../QuestionModel.php';

//POSTのみ処理
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $id = $_POST['id'];
  $name = $_POST['name'];
  $sentence = $_POST['sentence'];
  $score = $_POST['score'];
  $flag = $_POST['flag'];
  
  $questionModel = new QuestionModel();

  //バリテーションチェック
  if($id === '' || $name === '' || $sentence === '' || $score === '' || $flag === '')
  {
    $errorMsg = '空白の項目があります。';
  }
  else if(!ctype_digit($id))
  {
    $errorMsg = 'idは1-20の数字にしてください。';
  }
  else if(!ctype_digit($score))
  {
    $errorMsg = '得点は数字にしてください。';
  }
  else if($questionModel->findId($id) !== NULL)
  {
    $errorMsg = '問題IDはすでに存在しています。';
  }
  else{
    $questionInfo =  array(
      'id' => $id,
      'name' => $name,
      'sentence' => $sentence,
      'score' => $score,
      'flag' => $flag,
    );
    //DBへ追加
    $questionModel->insert($questionInfo);
    header('Location: /admin/question');
    exit;
  }
}
//GET
else
{
  $id = $_GET['qId'];
  var_dump($id);
  $questionModel = new QuestionModel();
  $question = $questionModel->findId($id);
  if($question === NULL)
  {
    header('Location: /admin/question');
    exit;
  }
  var_dump($question);
  $id = $question['id'];
  $name = $question['name'];
  $sentence = $question['sentence'];
  $score = $question['score'];
  $flag = $question['flag'];
}

?>

<!DOCTYPE html>
<html>
  <?=HtmlTemplateClass::dumpHead(); ?>
  <body>
    <main class="wrapper">
      <?=HtmlTemplateClass::dumpNav(); ?>
        <section class="container">
          <h3 class="title">問題編集</h3>
          <form action="" method="post">
            <fieldset>
              <label for="id">id</label>
              <select name="id">
                <?php for($i=1; $i<=20; $i++) :?>
                  <?php if(isset($id) && $id == $i) :?>
                    <option selected value="<?=$i?>"><?=$i?></option>
                  <?php else : ?>
                    <option value="<?=$i?>"><?=$i?></option>
                  <?php endif; ?>
                <? endfor;?>
              </select>

              <label for="name">名前</label>
              <input type="text" name="name" value="<?php if(isset($name)) { echo $name; }?>">
              
              <label for="sentence">問題文(HTML)</label>
              <textarea name="sentence"><?php if(isset($sentence)) { echo $sentence; }?></textarea>
              
              <label for="score">得点</label>
              <input type="text" name="score" value="<?php if(isset($score)) { echo $score; }?>">

              <label for="flag">フラグ</label>
              <input type="text" name="flag" value="<?php if(isset($flag)) { echo $flag; }?>">
              <p style="color:red;">
                <?php if(isset($errorMsg)){ echo $errorMsg; } ?>
              </p>
              <input type="submit" value="作成" class="button-primary">
            </fieldset>
          </form>
        </section>
      <?=HtmlTemplateClass::dumpFooter(); ?>
    </main>
  </body>
</html>