<?php
session_start();
require_once 'connect.php';
require_once 'logger.php';

if (!isset($_SESSION['admin_username'])) {
    echo json_encode(['status' => 'error', 'message' => 'You are not logged in or do not have permission!']);
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
            throw new Exception("Error creating import slip: " . mysqli_error($conn));
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
                throw new Exception("Error saving product details: " . mysqli_error($conn));
            }

            $sql_update_stock = "UPDATE products SET quantity = quantity + $qty WHERE id = '$p_id'";
            if (!mysqli_query($conn, $sql_update_stock)) {
                throw new Exception("Error updating stock: " . mysqli_error($conn));
            }

            $imported_items_log[] = "Product: $p_id (Qty: $qty)";
        }

        $supplier_name = "Unknown"; 

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
        $note_text = !empty($data['note']) ? trim($data['note']) : "None";

        if (function_exists('logActivity')) {
            $formatted_total = number_format($total_amount, 0, ',', '.');
            $formatted_tax = number_format($tax_amount, 0, ',', '.');
            $formatted_discount = number_format($discount_amount, 0, ',', '.');
            
            $list_products = implode(', ', $imported_items_log);
            
            $chi_tiet_log = "Import stock (Receipt #$import_id) | Supplier: $supplier_name | Items: $list_products | Total: {$formatted_total}đ (Tax: {$formatted_tax}đ, Discount: {$formatted_discount}đ) | Note: $note_text";
            
            logActivity($conn, $_SESSION['admin_username'], "Import goods", $chi_tiet_log);
        }

        mysqli_commit($conn);
        
        echo json_encode(['status' => 'success', 'import_id' => $import_id]);

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Cart is empty!']);
}
?>