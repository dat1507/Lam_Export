<?php
session_start();
require_once 'config/database.php';

// Thiết lập header trả về JSON
header('Content-Type: application/json');

// Đọc dữ liệu JSON gửi lên từ JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Không nhận được dữ liệu hợp lệ.']);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$customer_id = isset($data['customer_id']) ? intval($data['customer_id']) : 0;
$paid_amount = isset($data['paid_amount']) ? floatval($data['paid_amount']) : 0;
$discount_amount = isset($data['discount_amount']) ? floatval($data['discount_amount']) : 0;
$note = isset($data['note']) ? $db->real_escape_string($data['note']) : '';
$items = isset($data['items']) ? $data['items'] : [];

if ($customer_id === 0 || empty($items)) {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không đầy đủ.']);
    exit;
}

$db->begin_transaction();

try {
    // 1. Lấy tên khách hàng để đưa vào bảng orders
    $customer_name = "Khách sỉ";
    $sql_cus = "SELECT customer_name FROM customers WHERE customer_id = $customer_id";
    $res_cus = $db->query($sql_cus);
    if ($res_cus && $row = $res_cus->fetch_assoc()) {
        $customer_name = $db->real_escape_string($row['customer_name']);
    }

    // 2. Tính toán tiền nong
    $total_goods = 0;
    foreach ($items as $item) {
        $total_goods += (floatval($item['price']) * intval($item['qty']));
    }
    
    // Tiền cuối cùng (đã trừ chiết khấu)
    $final_amount = $total_goods - $discount_amount;
    if ($final_amount < 0) $final_amount = 0;
    
    // Nợ
    $debt_amount = $final_amount - $paid_amount;
    if ($debt_amount < 0) $debt_amount = 0;

    // Xét trạng thái đơn hàng
    $status = ($debt_amount > 0) ? 'Còn nợ' : 'Đã thanh toán';

    // 3. Thêm vào bảng orders
    $sale_type = 'wholesale';
    $sql_order = "INSERT INTO orders (customer_id, customer_name, total_amount, discount_amount, status, sale_type, paid_amount, debt_amount) 
                  VALUES ($customer_id, '$customer_name', $final_amount, $discount_amount, '$status', '$sale_type', $paid_amount, $debt_amount)";
    
    if (!$db->query($sql_order)) {
        throw new Exception("Lỗi khi tạo đơn hàng: " . $db->error);
    }
    
    $order_id = $db->insert_id; // Lấy ID của đơn hàng vừa tạo

    // 4. Thêm vào bảng order_details
    $sold_items_log = [];

    foreach ($items as $item) {
        $product_id = $db->real_escape_string($item['id']);
        $product_name = $db->real_escape_string($item['name']); 
        $qty = intval($item['qty']);
        $price = intval($item['price']); 
        $subtotal = $qty * $price; 

        $sql_check_stock = "SELECT quantity FROM products WHERE id = '$product_id'";
        $res_stock = $db->query($sql_check_stock);
        if ($res_stock && $row_stock = $res_stock->fetch_assoc()) {
            $current_stock = intval($row_stock['quantity']);
            
            if ($qty > $current_stock) {
                throw new Exception("Sản phẩm '$product_name' không đủ hàng! (Kho chỉ còn: $current_stock, Khách đặt: $qty)");
            }
        } else {
             throw new Exception("Lỗi: Không tìm thấy sản phẩm '$product_name' trong kho dữ liệu!");
        }

        $sold_items_log[] = $product_name . " (SL: " . $qty . ")";

        $sql_detail = "INSERT INTO order_details (order_id, product_id, product_name, quantity, price, subtotal) 
                       VALUES ($order_id, '$product_id', '$product_name', $qty, $price, $subtotal)";
        
        if (!$db->query($sql_detail)) {
            throw new Exception("Lỗi khi lưu chi tiết đơn: " . $db->error);
        }
        
        // Trừ tồn kho trong bảng products
        $sql_update_stock = "UPDATE products SET quantity = CAST(quantity AS SIGNED) - $qty WHERE id = '$product_id'";
        $db->query($sql_update_stock); 
    }

    // 5. Cộng công nợ cho khách hàng (nếu nợ)
    if ($debt_amount > 0) {
        $sql_update_debt = "UPDATE customers SET total_debt = total_debt + $debt_amount WHERE customer_id = $customer_id";
        if (!$db->query($sql_update_debt)) {
            throw new Exception("Lỗi khi cập nhật công nợ: " . $db->error);
        }
    }

   
    $nhan_vien = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; 
    $hanh_dong = "Tạo đơn sỉ";
    
    // 2. Lấy IP của máy đang thao tác
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // 3. Lấy ghi chú (nếu có)
    $note_text = !empty($data['note']) ? $db->real_escape_string(trim($data['note'])) : "Không có";

    // 4. Format lại tiền và danh sách hàng hóa
    $fmt_total = number_format($final_amount, 0, ',', '.');
    $fmt_paid  = number_format($paid_amount, 0, ',', '.');
    $fmt_debt  = number_format($debt_amount, 0, ',', '.');
    $list_products = implode(', ', $sold_items_log); // Nối các món hàng lại
    
    // 5. Lắp ráp nội dung log siêu chi tiết
    $chi_tiet_log = "Bán sỉ (Đơn #$order_id) | Đại lý: $customer_name | Gồm: $list_products | Tổng: {$fmt_total}đ | Đã thu: {$fmt_paid}đ | Còn nợ: {$fmt_debt}đ | Ghi chú: $note_text";
    
    // 6. Insert đúng vào bảng activity_logs
    $sql_log = "INSERT INTO activity_logs (username, action, details, ip_address) 
                VALUES ('$nhan_vien', '$hanh_dong', '$chi_tiet_log', '$ip_address')";
                
    if (!$db->query($sql_log)) {
        throw new Exception("Lỗi khi ghi lịch sử hoạt động: " . $db->error);
    }

    // 6. Chốt hạ lưu vào Database
    $db->commit();
    
    echo json_encode(['status' => 'success', 'order_id' => $order_id]);

} catch (Exception $e) {
    $db->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>