<?php
namespace Core;

use PDO;
use PDOException;

class Connection {
    private $sgdb = "mysql:host=localhost;dbname=mydb";
    private $user = "root";
    private $pass = "";

    protected static function connect() {
        try {
            $pdo = new PDO($sgdb, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}