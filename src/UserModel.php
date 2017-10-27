<?php
/**
 * usersテーブルに関するモデル
 */
require_once 'ModelBase.php';

class UserModel extends ModelBase
{
  protected $table = 'users';

  public function findName($username)
  {
    $query = "SELECT * FROM users WHERE name = '$username';";
    $sth = $this->db->query($query);
    return $sth->fetchAll()[0];
  }

  public function delete($username)
  {
    $query = "DELETE FROM users WHERE name = '$username';";
    $sth = $this->db->query($query);
  }

  public function register($user, $password)
  {
    $query = "INSERT INTO users(name, password) VALUES('$user', '$password');";
    $sth = $this->db->query($query);
  }

  public function passwordCheck($user, $password)
  {

    $query = "SELECT * FROM users WHERE name = '$user' AND password = '$password';";
    $sth = $this->db->query($query);
    return ( $sth->rowCount() > 0);
  }

  public function ranking()
  {
    // $query = "SELECT * FROM users;";
    $query = "SELECT * FROM users order by score desc,score_update_time asc;";
    $sth = $this->db->query($query);
    return $sth->fetchAll();
  }
  
  public function isCorrect($username, $qId)
  {
    $qId = sprintf('%02d', $qId);
    $query = "SELECT * FROM users WHERE name = '$username' AND question$qId = true;";
    $sth = $this->db->query($query);
    return ( $sth->rowCount() > 0);
  }

  public function updateScore($username, $qId)
  {
    //得点の取り出し。
    $query = "SELECT * FROM questions WHERE id = $qId";
    $sth = $this->db->query($query);
    $score = $sth->fetchAll()[0]['score'];
    var_dump($score);
    //得点,回答済みフラグの更新
    $qId = sprintf('%02d', $qId);
    $query = "UPDATE users SET question$qId = true, score = score + $score, update_time = NOW() WHERE name = '$username';";
    var_dump($query);
    $sth = $this->db->query($query);
  }

  public function updateSelfIntroduction($username, $self_introduction)
  {
    $query = "UPDATE users SET self_introduction = '$self_introduction' WHERE name = '$username';";
    $sth = $this->db->query($query);
  }
}