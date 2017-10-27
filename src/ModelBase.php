<?php
/**
 * モデルの基底クラス
 */
require_once 'DataBaseConfigClass.php';

class ModelBase
{
  protected $db;
  protected $table;

  public function __construct()
  {
    $this->initDb();
  }
  public function __destruct()
  {
    $this->closeDb();
  }

  public function initDb()
  {
    $dataBaseConfig = new DataBaseConfigClass();
    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;charset=utf8mb4',
      $dataBaseConfig->HOST,
      $dataBaseConfig->DB
    );
    $this->db = new PDO($dsn, $dataBaseConfig->USER, $dataBaseConfig->PASSWORD);
  }

  public function closeDb()
  {
    $this->db = null;
  }

  public function all()
  {
    $query = "SELECT * FROM $this->table;";
    $sth = $this->db->query($query);
    return $sth->fetchAll();
  }

  public function truncate()
  {
    $query = "TRUNCATE TABLE $this->table;";
    $sth = $this->db->query($query);
  }
}
