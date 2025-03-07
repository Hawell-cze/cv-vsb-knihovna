<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {

        $config = require("config.php");
        // $host = "localhost";
        // $dbname = "autobazar";
        // $username = "root";
        // $userpass = "";

        try {
            $this->pdo = new PDO("mysql:host=" . $config["host"] . ";dbname=" . $config["dbname"] . ";charset=utf8", $config["username"], $config["userpass"]);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit("Chyba připojení k databázi: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {

        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
