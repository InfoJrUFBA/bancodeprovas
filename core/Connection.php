<?php
namespace Core;

use PDO;
use PDOException;

class Connection {
    public static function connect() {

        $conf = include __DIR__ . "/../app/config.php";
        $host = $conf['database']['mysql']['host'];
        $database = $conf['database']['mysql']['database'];
        $username = $conf['database']['mysql']['username'];
        $password = $conf['database']['mysql']['password'];
        $charset = $conf['database']['mysql']['charset'];
        $collation = $conf['database']['mysql']['collation'];

        try {
            $pdo = new PDO("mysql:host={$host};dbname={$database};charset={$charset};collation={$collation}", "{$username}", "{$password}");
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES {$charset} COLLATE {$collation}");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error: " . $conf;
        }
    }

}
