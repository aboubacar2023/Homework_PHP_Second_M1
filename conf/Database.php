<?php
class Database
{
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $db = "tp_php_second";
    private $user = "root";
    private $pass = "";
    private function __construct()
    {
        $this->conn = new
            PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->conn;
    }
}