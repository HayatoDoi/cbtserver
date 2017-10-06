<?php
/**
 * MySQLの設定呼び出しClass
 */
class DataBaseConfigClass
{
    public $HOST = null;
    public $USER = null;
    public $PASSWORD = null;
    
    function DataBaseConfigClass()
    {
        $this->HOST = $_ENV["DATABASE_HOST"];
        $this->USER = $_ENV["MYSQL_USER"];
        $this->PASSWORD = $_ENV["MYSQL_PASSWORD"];
    }
}
