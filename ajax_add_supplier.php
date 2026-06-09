<?php
session_start();
require_once 'connect.php';
require_once 'logger.php';

if (!isset($_SESSION['admin_username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Bạn chưa đăng nhập hoặc không có quyền!']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['name']) && trim($data['name']) !== '') {
    
    $name = mysqli_real_escape_string($conn, trim($data['name']));
    $phone = isset($data['phone']) ? mysqli_real_escape_string($conn, trim($data['phone'])) : '';
    $address = isset($data['address']) ? mysqli_real_escape_string($conn, trim($data['address'])) : '';

    // 4. Lưu vào Database
    $sql = "INSERT INTO suppliers (name, phone, address) VALUES ('$name', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        $new_id = mysqli_insert_id($conn);

        if (function_exists('logActivity')) {
            logActivity($conn, $_SESSION['admin_username'], "Thêm Nhà cung cấp", "Thêm nhanh NCC: $name (ID: $new_id)");
        }

        echo json_encode([
            'status' => 'success',
            'id' => $new_id,
            'message' => 'Đã thêm nhà cung cấp thành công!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Lỗi khi lưu vào Database: ' . mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Tên nhà cung cấp không được để trống!'
    ]);
}
?>