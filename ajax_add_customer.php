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
        $errorMsg = 'Please enter both name and phone number!';
    } elseif ($type === 'wholesale' && empty($address)) {
        $errorMsg = 'Address is required for Wholesale/Agency customer!';
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
            $action = 'Add Customer';
            
            if ($type === 'wholesale') {
                $details = "Add new wholesale customer: $name (Phone: $phone, Addr: $address)";
            } else {
                // Khách lẻ nếu có nhập địa chỉ thì ghi thêm vào log, không thì thôi
                $addr_text = !empty($address) ? ", Addr: $address" : "";
                $details = "Add new retail customer: $name (Phone: $phone$addr_text)";
            }
            
            logActivity($conn, $current_user, $action, $details);

        } else {
            if (mysqli_errno($conn) == 1062) {
                $response = ['error' => 'Error: This phone number already exists in the system!'];
            } else {
                $response = ['error' => 'Error saving data: ' . mysqli_error($conn)];
            }
        }
    } else {
        $response = ['error' => $errorMsg];
    }

} catch (Throwable $e) {
    $response = ['error' => 'System error: ' . $e->getMessage()];
}

ob_end_clean();
echo json_encode($response);
?>