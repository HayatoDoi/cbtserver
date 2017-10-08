<?php
/**
 * MySQLの設定呼び出しClass
 */
class DataBaseConfigClass
{
    public $HOST = null;
    public $DB = null;
    public $USER = null;
    public $PASSWORD = null;
    
    function DataBaseConfigClass()
    {
        $this->HOST = $_ENV["DATABASE_HOST"];
        $this->DB = $_ENV["MYSQL_DATABASE"];
        $this->USER = $_ENV["MYSQL_USER"];
        $this->PASSWORD = $_ENV["MYSQL_PASSWORD"];
    }
}
