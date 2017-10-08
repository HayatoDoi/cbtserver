<?php
/**
 * questionsテーブルに関するモデル
 */
require_once 'ModelBase.php';

class QuestionModel extends ModelBase
{
  protected $table = 'questions';
  
  public function findId($id)
  {
    $query = "SELECT * FROM questions WHERE id = $id;";
    $sth = $this->db->query($query);
    return $sth->fetchAll()[0];
  }

  public function flagCheck($qId, $flag)
  {

    $query = "SELECT * FROM questions WHERE id = $qId AND flag = '$flag';";
    $sth = $this->db->query($query);
    return ( $sth->rowCount() > 0);
  }

  public function insert($questionInfo)
  {
    $id = $questionInfo['id'];
    $name = $questionInfo['name'];
    $sentence = $questionInfo['sentence'];
    $flag = $questionInfo['flag'];
    $score = $questionInfo['score'];
    $query = "INSERT INTO questions (id, name, sentence, flag, score) VALUES($id, '$name', '$sentence', '$flag', $score);";
    $sth = $this->db->query($query);
  }

  public function delete($id)
  {
    $query = "DELETE FROM questions WHERE id = $id;";
    $sth = $this->db->query($query);
  }
}