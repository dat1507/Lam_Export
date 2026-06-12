<?php
$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname  = "lamexpor_nguyenlamdev"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

if (!function_exists('quantity_check')) {
    function quantity_check($qty) {
        if ($qty === 'Liên hệ' || (is_numeric($qty) && $qty <= 0)) {
            return 'Contact';
        }
        return $qty;
    }
}
?>