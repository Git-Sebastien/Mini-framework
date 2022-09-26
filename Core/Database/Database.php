<?php

namespace Core\Database;

use PDO;

class Database{
private static $settings = [];
    
    protected static $db_connection;
    public static $table;
    public static $sql;
    protected $id;
    
    public function db_connect() : PDO
    {
        self::$settings = require ROOT.'/app/config/database_config.php';
        if(self::$db_connection == null){
            self::$db_connection = new PDO('mysql:host='.self::$settings["db_host"].';dbname='.self::$settings["db_name"].';',self::$settings["db_username"],self::$settings["db_password"],[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }
        return self::$db_connection;
    }

    public function select($column = ['*'])
    {
        self::$sql = "SELECT $column FROM " .self::$table;
        return $this;
    }
    public  function table($table)
    {
        self::$table = $table;
        return $this;
    }

    public function where($value,$operators,string $compare)
    {
        self::$sql .= ' WHERE '.$value.''.$operators.'"'.$compare.'"';  
        return $this;   
    }

    public function limit(int $limit)
    {
        self::$sql .= ' LIMIT '.$limit;
        return $this;
    }

    public function get()
    {
        return self::$db_connection->query(self::$sql)->fetchAll();
    }
}