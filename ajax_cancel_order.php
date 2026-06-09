<?php
session_start(); 

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    // Bắt đầu Transaction
    $conn->begin_transaction();

    try {
        $stmt_check = $conn->prepare("SELECT customer_id, debt_amount, status FROM orders WHERE order_id = ?");
        $stmt_check->bind_param("i", $order_id);
        $stmt_check->execute();
        $order = $stmt_check->get_result()->fetch_assoc();

        if (!$order) {
            throw new Exception("Không tìm thấy đơn hàng!");
        }
        if ($order['status'] === 'Đã hủy') {
            throw new Exception("Đơn hàng này đã được hủy từ trước.");
        }

        $customer_id = $order['customer_id'];
        $debt_amount = floatval($order['debt_amount']);

        $stmt_items = $conn->prepare("SELECT product_id, quantity FROM order_details WHERE order_id = ?");
        $stmt_items->bind_param("i", $order_id);
        $stmt_items->execute();
        $items = $stmt_items->get_result();

        $stmt_update_stock = $conn->prepare("UPDATE products SET quantity = CAST(quantity AS UNSIGNED) + ? WHERE id = ? AND quantity != 'Liên hệ' AND quantity REGEXP '^[0-9]+$'");
        
        while ($item = $items->fetch_assoc()) {
            $qty_to_return = intval($item['quantity']);
            $product_id = $item['product_id']; 
            
            $stmt_update_stock->bind_param("is", $qty_to_return, $product_id);
            $stmt_update_stock->execute();
        }

        if (!empty($customer_id) && $debt_amount > 0) {
            $stmt_update_debt = $conn->prepare("UPDATE customers SET total_debt = total_debt - ? WHERE customer_id = ?");
            $stmt_update_debt->bind_param("di", $debt_amount, $customer_id);
            $stmt_update_debt->execute();
        }

        $stmt_cancel = $conn->prepare("UPDATE orders SET status = 'Đã hủy', debt_amount = 0 WHERE order_id = ?");
        $stmt_cancel->bind_param("i", $order_id);
        $stmt_cancel->execute();

       
        $nhan_vien = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; 
        $hanh_dong = "Hủy đơn hàng";
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $fmt_debt = number_format($debt_amount, 0, ',', '.');
        
        $chi_tiet_log = "Hủy hóa đơn #$order_id. Hệ thống đã tự động hoàn kho và trừ nợ ($fmt_debt đ).";
        
        $stmt_log = $conn->prepare("INSERT INTO activity_logs (username, action, details, ip_address) VALUES (?, ?, ?, ?)");
        $stmt_log->bind_param("ssss", $nhan_vien, $hanh_dong, $chi_tiet_log, $ip_address);
        
        if (!$stmt_log->execute()) {
            throw new Exception("Lỗi khi ghi lịch sử hoạt động!");
        }

        // Lưu toàn bộ thay đổi
        $conn->commit();
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        // Có lỗi thì quay lui lại từ đầu
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
}
?>