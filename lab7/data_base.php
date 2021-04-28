<?php
require_once('env.php');
function db()
{
    $db_driver = $_ENV["db_driver"];
    $host = $_ENV["host"];
    $database = $_ENV["database"];
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = $_ENV["username"];
    $password = $_ENV["password"];
    try {
        return new PDO ($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}