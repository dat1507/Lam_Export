<?php
session_start();
require_once 'connect.php';
require_once 'logger.php';
$data = json_decode(file_get_contents('php://input'), true);

$customer_id = $data['customer_id'];
$cart = $data['cart'];
$total_amount = $data['total_amount'];

if (!empty($cart)) {
    $sql_order = "INSERT INTO orders (customer_id, total_amount, order_date) VALUES ('$customer_id', '$total_amount', NOW())";
    
    if (mysqli_query($conn, $sql_order)) {
        $order_id = mysqli_insert_id($conn);

        foreach ($cart as $item) {
            $p_id = $item['id'];
            $p_name = $item['name']; // Lấy tên sản phẩm
            $qty = $item['qty'];
            $price = $item['price'];
            $subtotal = $qty * $price; // Tính thành tiền cho từng món

            $sql_detail = "INSERT INTO order_details (order_id, product_id, product_name, quantity, price, subtotal) 
                           VALUES ('$order_id', '$p_id', '$p_name', '$qty', '$price', '$subtotal')";
            
            mysqli_query($conn, $sql_detail);

            $sql_update_stock = "UPDATE products SET quantity = quantity - $qty WHERE id = '$p_id'";
            mysqli_query($conn, $sql_update_stock);
        }

        if (isset($_SESSION['admin_username'])) {
            $action = "Thanh toán hóa đơn";
            $formatted_total = number_format($total_amount, 0, ',', '.');
            $details = "Đã thanh toán đơn hàng #" . $order_id . " - Tổng tiền: " . $formatted_total . "đ";
            
            logActivity($conn, $_SESSION['admin_username'], $action, $details);
        }

        echo json_encode(['status' => 'success', 'order_id' => $order_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}
?>