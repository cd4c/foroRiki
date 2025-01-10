<?php
// config/database.php
class Database {
    public static function connect() {
        $host = 'mysql-db';
        $dbname = 'foroplatos';
        $username = 'admin';
        $password = 'admin';

        $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        return $connection;
    }
}
?>