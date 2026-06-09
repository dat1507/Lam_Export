<?php
// File: models/Product.php

class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }
    
   
    public function getCategories() {
        $query = "SELECT id, category_name FROM categories ORDER BY category_name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // MySQLi phải dùng get_result() để trả về dữ liệu
        return $stmt->get_result();
    }

  
    public function getTrendingProducts($limit) {
        // Ép kiểu INT cho an toàn
        $limit = (int)$limit;
        
        $query = "SELECT p.*, c.category_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.status = 'available' AND p.is_trending = 1 
                  ORDER BY p.updated_at DESC 
                  LIMIT " . $limit; 
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    
    public function searchProducts($search, $type) {
        $query = "SELECT p.*, c.category_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.status = 'available'"; 
        
        $params = [];
        $types = "";

        // Thêm điều kiện tìm kiếm bằng chữ (string)
        if (!empty($search)) {
            $query .= " AND p.product_name LIKE ?"; // MySQLi dùng dấu ?
            $types .= "s"; // 's' là string
            $params[] = "%{$search}%";
        }
        
        // Thêm điều kiện tìm kiếm bằng ID danh mục (integer)
        if (!empty($type)) {
            $query .= " AND p.category_id = ?";
            $types .= "i"; // 'i' là integer
            $params[] = (int)$type;
        }
        
        $query .= " ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($query);

        // Nếu có điều kiện tìm kiếm thì gán biến động (bind_param)
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params); 
        }

        $stmt->execute();
        
        return $stmt->get_result();
    }


    public function getAllProducts() {
        $query = "SELECT p.*, c.category_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.id DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->get_result();
    }
}
?>