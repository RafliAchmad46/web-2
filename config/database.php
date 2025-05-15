<?php
define('BASE_URL', 'http://localhost/aplikasi_koperasi/db_koperasi_pdo_crud');

class Database {
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $db_name = "db_koperasi1";
    private $username = "root";
    private $password = "";

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>