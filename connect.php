<?php
$servername = "localhost";
$username = "lamexpor_taoquayqn123"; 
$password = "Snowgogogofx6!!@";    
$dbname  = "lamexpor_nguyenlamdev"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối Database thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>