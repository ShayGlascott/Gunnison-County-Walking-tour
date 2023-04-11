<?php

class Database {
    private $host = 'mysql';
    private $db_name = 'database';
    private $username = 'user';
    private $password = 'password';
    private $conn;

    public function connect() {
        $this->conn = null;
        
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
            $this->conn = new PDO("mysql:host={$host};dbname={$db_name};charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
      
        return $this->conn;
    }

    public function query($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

?>