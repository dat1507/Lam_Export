<?php
// File: config/database.php
class Database {
    private $host = "localhost";
    private $username = "root"; 
    private $password = "";     
    private $db_name = "lamexpor_nguyenlamdev";
    public $conn;

    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Kết nối Database thất bại: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
        return $this->conn;
    }
}
?>
