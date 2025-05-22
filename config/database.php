<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'aurora';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception("Connectie mislukt: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $this->conn;
    }
}
