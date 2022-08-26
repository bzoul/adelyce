<?php

class Database 
{

    public static function getConnection() {
        $dbname   = 'adelyce';
        $username = 'postgres';
        $password = '01072018';
        $host = 'localhost';
        try {
            $pdo = new \PDO("pgsql:host=$host;dbname=$dbname", $username,  $password);
        } catch (Exception $e) {
            print $e->getMessage() . "\n";
        }
        return $pdo;
    }
}
?>