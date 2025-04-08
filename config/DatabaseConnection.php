<?php
// config/DatabaseConnection.php
class DatabaseConnection {
    private $conn;

    // Modified constructor to accept connection parameters
    public function __construct($host, $user, $password, $database) {
        $this->conn = new mysqli($host, $user, $password, $database);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}