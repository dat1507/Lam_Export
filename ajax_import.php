<?php
session_start();
require_once 'connect.php';
require_once 'logger.php';

if (!isset($_SESSION['admin_username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Bạn chưa đăng nhập hoặc không có quyền!']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['cart'])) {
    $supplier_id = (int)$data['supplier_id']; 
    $note = mysqli_real_escape_string($conn, $data['note']);
    $total_amount = (float)$data['total_amount'];
    
    $discount_amount = isset($data['discount_amount']) ? (float)$data['discount_amount'] : 0;
    $tax_amount = isset($data['tax_amount']) ? (float)$data['tax_amount'] : 0;
    
    $cart = $data['cart'];

    mysqli_begin_transaction($conn);

    try {
        $sql_import = "INSERT INTO imports (supplier_id, total_amount, discount_amount, tax_amount, import_date, note) 
                       VALUES ($supplier_id, $total_amount, $discount_amount, $tax_amount, NOW(), '$note')";
        
        if (!mysqli_query($conn, $sql_import)) {
            throw new Exception("Lỗi tạo phiếu nhập: " . mysqli_error($conn));
        }
        
        $import_id = mysqli_insert_id($conn);

        $imported_items_log = [];

        foreach ($cart as $item) {
            $p_id = mysqli_real_escape_string($conn, $item['id']);
            $qty = (int)$item['qty'];
            $import_price = (float)$item['import_price'];
            $subtotal = $qty * $import_price;

            $sql_detail = "INSERT INTO import_details (import_id, product_id, quantity, import_price, subtotal) 
                           VALUES ($import_id, '$p_id', $qty, $import_price, $subtotal)";
            
            if (!mysqli_query($conn, $sql_detail)) {
                throw new Exception("Lỗi lưu chi tiết sản phẩm: " . mysqli_error($conn));
            }

            $sql_update_stock = "UPDATE products SET quantity = quantity + $qty WHERE id = '$p_id'";
            if (!mysqli_query($conn, $sql_update_stock)) {
                throw new Exception("Lỗi cập nhật tồn kho: " . mysqli_error($conn));
            }

            $imported_items_log[] = "SP: $p_id (SL: $qty)";
        }

        $supplier_name = "Không xác định"; 

        if (!empty($data['supplier_id']) && $data['supplier_id'] > 0) {
            $sup_id = mysqli_real_escape_string($conn, $data['supplier_id']);
            $sql_get_sup = "SELECT name FROM suppliers WHERE id = '$sup_id'";
            $res_sup = mysqli_query($conn, $sql_get_sup);
            
            if ($res_sup && mysqli_num_rows($res_sup) > 0) {
                $row_sup = mysqli_fetch_assoc($res_sup);
                $supplier_name = $row_sup['name'];
            }
        }

        // Lấy ghi chú
        $note_text = !empty($data['note']) ? trim($data['note']) : "Không có";

        if (function_exists('logActivity')) {
            $formatted_total = number_format($total_amount, 0, ',', '.');
            $formatted_tax = number_format($tax_amount, 0, ',', '.');
            $formatted_discount = number_format($discount_amount, 0, ',', '.');
            
            $list_products = implode(', ', $imported_items_log);
            
            $chi_tiet_log = "Nhập kho (Phiếu #$import_id) | NCC: $supplier_name | Gồm: $list_products | Tổng: {$formatted_total}đ (Thuế: {$formatted_tax}đ, CK: {$formatted_discount}đ) | Ghi chú: $note_text";
            
            logActivity($conn, $_SESSION['admin_username'], "Nhập hàng", $chi_tiet_log);
        }

        mysqli_commit($conn);
        
        echo json_encode(['status' => 'success', 'import_id' => $import_id]);

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng trống!']);
}
?>