<?php
class Connection {
    private static $pdo;

    private final function __construct(){

    }

    public static function getConnection($dbconfig){
        if(!isset(self::$pdo)){
            $pdo = new PDO(
                $dbconfig['connection'] . ';dbname=' . $dbconfig['dbname'],
                $dbconfig['usr'],
                $dbconfig['pwd'],
                $dbconfig['options']
            );

            self::$pdo = $pdo;
        }
        return self::$pdo;
    }
}