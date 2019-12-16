<?php

namespace HO;

use PDO;

class Database 
{ 
    private $database;
 
    public function __construct() 
    {
        try 
        {
            $this->database = new PDO(
                MYSQL_DSN, 
                MYSQL_USER, 
                MYSQL_PASSWORD, 
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES 'utf8'",
                    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get()
    {
        return $this->database;
    }
}