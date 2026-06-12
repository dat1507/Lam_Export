<?php

require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $database = new Database();
    $db = $database->getConnection();

    $promo_name = isset($_POST['promo_name']) ? trim($_POST['promo_name']) : '';
    $promo_code = isset($_POST['promo_code']) ? strtoupper(trim($_POST['promo_code'])) : '';
    $promo_type = isset($_POST['promo_type']) ? $_POST['promo_type'] : '';
    
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $start_date = !empty($_POST['start_date']) ? date('Y-m-d H:i:s', strtotime($_POST['start_date'])) : null;
    $end_date = !empty($_POST['end_date']) ? date('Y-m-d H:i:s', strtotime($_POST['end_date'])) : null;
    $discount_val = 0;
    $buy_qty = 0;
    $get_qty = 0;

    if ($promo_type === 'discount_amount' || $promo_type === 'discount_percent') {
        $discount_val = isset($_POST['discount_val']) ? (float)$_POST['discount_val'] : 0;
    } else if ($promo_type === 'buy_x_get_y') {
        $buy_qty = isset($_POST['buy_qty']) ? (int)$_POST['buy_qty'] : 0;
        $get_qty = isset($_POST['get_qty']) ? (int)$_POST['get_qty'] : 0;
    }

    // 3. Kiểm tra rỗng (Validate)
    if (empty($promo_name) || empty($promo_code) || empty($promo_type)) {
        echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ Tên, Mã code và Chọn loại khuyến mãi!"]);
        exit();
    }

    // 4. Lưu vào Database (Dùng Prepared Statement chống hack)
    $query = "INSERT INTO promotions 
              (promo_name, promo_code, promo_type, buy_qty, get_qty, discount_val, start_date, end_date, is_active) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param("sssiidssi", 
            $promo_name, 
            $promo_code, 
            $promo_type, 
            $buy_qty, 
            $get_qty, 
            $discount_val, 
            $start_date, 
            $end_date, 
            $is_active
        );

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Thêm chương trình khuyến mãi thành công!"]);
        } else {
            // Có thể lỗi do trùng lặp Mã Code (Unique)
            $errorMsg = "Không thể lưu dữ liệu.";
            if ($db->errno == 1062) { // 1062 là mã lỗi MySQL khi bị trùng key (Duplicate entry)
                $errorMsg = "Mã Voucher này đã tồn tại, vui lòng chọn mã khác!";
            } else {
                $errorMsg .= " Chi tiết: " . $stmt->error;
            }
            echo json_encode(["status" => "error", "message" => $errorMsg]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi hệ thống: " . $db->error]);
    }
    
    $db->close();
} else {
    // Truy cập trái phép không qua method POST
    echo json_encode(["status" => "error", "message" => "Yêu cầu không hợp lệ!"]);
}
?>