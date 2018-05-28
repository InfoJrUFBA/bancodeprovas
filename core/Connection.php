<?php
namespace Core;

use PDO;
use PDOException;

class Connection {
    public static function connect() {

        $conf = include __DIR__ . "/../app/database.php";
        $host = $conf['mysql']['host'];
        $database = $conf['mysql']['database'];
        $username = $conf['mysql']['username'];
        $password = $conf['mysql']['password'];
        $charset = $conf['mysql']['charset'];
        $collation = $conf['mysql']['collation'];
        try {
            $pdo = new PDO("mysql:host={$host};dbname={$database};charset={$charset};collation={$collation}", "{$username}", "{$password}");
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES {$charset} COLLATE {$collation}");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error: " . $conf;
            //var_dump($conf);
        }

        /*Conexao antiga; Comentário por @kylb*/
        /*try {
            $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8;collation=utf8_unicode_ci", "root", 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }*/
    }

}
