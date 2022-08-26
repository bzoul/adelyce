<?php

class Database 
{
    private $dbname   = 'adelyce';
    private $username = 'postgres';
    private $password = '01072018';


    public static function getConnection() {
        try {
            $pdo = new \PDO("pgsql:host=localhost;dbname=adelyce", 'postgres',  '01072018');
        } catch (Exception $e) {
            print $e->getMessage() . "\n";
        }
        return $pdo;
    }
}
?>