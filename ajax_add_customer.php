<?php
session_start(); 
ob_start();
header('Content-Type: application/json');

try {
    require_once 'logger.php';
    require_once 'connect.php'; 

    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? ''); 
    $type = trim($_POST['type'] ?? 'retail'); 

    $isValid = false;
    $errorMsg = '';

    if (!$name || !$phone) {
        $errorMsg = 'Vui lòng nhập đủ tên và số điện thoại!';
    } elseif ($type === 'wholesale' && empty($address)) {
        $errorMsg = 'Bắt buộc phải nhập Địa chỉ đối với Khách Sỉ/Đại lý!';
    } else {
        $isValid = true;
    }

    if ($isValid) {
        $name_safe = mysqli_real_escape_string($conn, $name);
        $phone_safe = mysqli_real_escape_string($conn, $phone);
        $address_safe = mysqli_real_escape_string($conn, $address); 
        $type_safe = mysqli_real_escape_string($conn, $type);

        $sql = "INSERT INTO customers (customer_name, telephone, address, customer_type) 
                VALUES ('$name_safe', '$phone_safe', '$address_safe', '$type_safe')";
        
        if (mysqli_query($conn, $sql)) {
            $new_id = mysqli_insert_id($conn);
            $response = [
                'status' => 'success',
                'id' => $new_id
            ]; 
                  $current_user = $_SESSION['admin_username'] ?? ($_SESSION['username'] ?? 'Admin');
            $action = 'Thêm khách hàng';
            
            if ($type === 'wholesale') {
                $details = "Thêm khách sỉ mới: $name (SĐT: $phone, Đ/c: $address)";
            } else {
                // Khách lẻ nếu có nhập địa chỉ thì ghi thêm vào log, không thì thôi
                $addr_text = !empty($address) ? ", Đ/c: $address" : "";
                $details = "Thêm khách lẻ mới: $name (SĐT: $phone$addr_text)";
            }
            
            logActivity($conn, $current_user, $action, $details);

        } else {
            if (mysqli_errno($conn) == 1062) {
                $response = ['error' => 'Lỗi: Số điện thoại này đã tồn tại trong hệ thống!'];
            } else {
                $response = ['error' => 'Lỗi lưu dữ liệu: ' . mysqli_error($conn)];
            }
        }
    } else {
        $response = ['error' => $errorMsg];
    }

} catch (Throwable $e) {
    $response = ['error' => 'Lỗi hệ thống: ' . $e->getMessage()];
}

ob_end_clean();
echo json_encode($response);
?>