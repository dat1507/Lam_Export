<?php
session_start();
require_once 'connect.php';
require_once 'logger.php';

if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['id'])) {
    // Ép an toàn chuỗi
    $product_id = mysqli_real_escape_string($conn, $_POST['id']); 

    $query_get = "SELECT product_name FROM products WHERE id = '$product_id'";
    $result_get = mysqli_query($conn, $query_get);
    
    if ($result_get && mysqli_num_rows($result_get) > 0) {
        $product = mysqli_fetch_assoc($result_get);
        $product_name = $product['product_name']; 

        // Xóa sản phẩm khỏi Database
        $query_delete = "DELETE FROM products WHERE id = '$product_id'"; 
        
        if (mysqli_query($conn, $query_delete)) {
            if (function_exists('logActivity')) {
                logActivity($conn, $_SESSION['admin_username'], "Delete product", "Deleted product: $product_name (ID: $product_id)");
            }
            
            $_SESSION['success_message'] = "Product deleted successfully!";
        } else {
            $_SESSION['error_message'] = "Error deleting from Database: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error_message'] = "Product not found in the system!";
    }
} else {
    $_SESSION['error_message'] = "Product ID is missing!";
}

// Chuyển hướng về lại trang Quản lý sản phẩm
header("Location: admin_products.php");
exit;
?>