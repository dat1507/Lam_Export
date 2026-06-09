<?php
class CustomerModel {
    private $conn;
    private $table_name = "customers";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả khách hàng
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY customer_name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Tạo khách hàng mới
    public function create($name, $phone) {
        $query = "INSERT INTO " . $this->table_name . " (customer_name, telephone, points) VALUES (:name, :phone, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        
        if($stmt->execute()) {
            return $this->conn->lastInsertId(); // Trả về ID khách vừa tạo
        }
        return false;
    }
}