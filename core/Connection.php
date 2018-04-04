<?php
namespace Core;

use PDO;
use PDOException;

class Connection {
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8;collation=utf8_unicode_ci", "root", 'biscoito');
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
