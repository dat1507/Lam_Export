<?php
/**
 * ajax_update_promotion.php
 * Backend handler for Edit Promotion form submission.
 */

require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$id         = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$promo_name = isset($_POST['promo_name']) ? trim($_POST['promo_name']) : '';
$promo_code = isset($_POST['promo_code']) ? strtoupper(trim($_POST['promo_code'])) : '';
$promo_type = isset($_POST['promo_type']) ? $_POST['promo_type'] : '';
$is_active  = isset($_POST['is_active']) ? 1 : 0;
$start_date = !empty($_POST['start_date']) ? date('Y-m-d H:i:s', strtotime($_POST['start_date'])) : null;
$end_date   = !empty($_POST['end_date'])   ? date('Y-m-d H:i:s', strtotime($_POST['end_date']))   : null;

$discount_val = 0;
$buy_qty      = 0;
$get_qty      = 0;

if ($promo_type === 'discount_amount' || $promo_type === 'discount_percent') {
    $discount_val = isset($_POST['discount_val']) ? (float)$_POST['discount_val'] : 0;
} elseif ($promo_type === 'buy_x_get_y') {
    $buy_qty = isset($_POST['buy_qty']) ? (int)$_POST['buy_qty'] : 0;
    $get_qty = isset($_POST['get_qty']) ? (int)$_POST['get_qty'] : 0;
}

if (!$id || empty($promo_name) || empty($promo_code) || empty($promo_type)) {
    echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập đầy đủ thông tin!']);
    exit;
}

$query = "UPDATE promotions SET
            promo_name   = ?,
            promo_code   = ?,
            promo_type   = ?,
            buy_qty      = ?,
            get_qty      = ?,
            discount_val = ?,
            start_date   = ?,
            end_date     = ?,
            is_active    = ?
          WHERE id = ?";

$stmt = $db->prepare($query);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống: ' . $db->error]);
    exit;
}

// Type string: s(promo_name) s(promo_code) s(promo_type) i(buy_qty) i(get_qty)
//              d(discount_val) s(start_date) s(end_date) i(is_active) i(id)
$stmt->bind_param("sssiidssii",
    $promo_name,
    $promo_code,
    $promo_type,
    $buy_qty,
    $get_qty,
    $discount_val,
    $start_date,
    $end_date,
    $is_active,
    $id
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Cập nhật khuyến mãi thành công!']);
} else {
    $errorMsg = 'Không thể cập nhật.';
    if ($db->errno == 1062) {
        $errorMsg = 'Mã Voucher này đã tồn tại, vui lòng chọn mã khác!';
    } else {
        $errorMsg .= ' Chi tiết: ' . $stmt->error;
    }
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
}

$stmt->close();
$db->close();
?>
