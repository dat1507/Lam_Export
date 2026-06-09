<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu mã hóa đơn']);
    exit;
}

$order_id = mysqli_real_escape_string($conn, $_GET['id']);


$sql = "SELECT product_name, quantity, price, subtotal 
        FROM order_details 
        WHERE order_id = '$order_id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $details = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $details[] = $row;
    }
    
    if (count($details) > 0) {
        echo json_encode(['status' => 'success', 'details' => $details]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Hóa đơn này không có sản phẩm nào.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi truy vấn Database: ' . mysqli_error($conn)]);
}
?>