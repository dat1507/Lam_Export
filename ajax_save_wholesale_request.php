<?php
// ajax_save_wholesale_request.php
// Handles POST from the Wholesale Quote Request modal on detail.php
header('Content-Type: application/json; charset=utf-8');
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$product_id        = isset($_POST['product_id'])        ? trim($conn->real_escape_string($_POST['product_id']))    : '';
$product_name      = isset($_POST['product_name'])      ? trim($conn->real_escape_string($_POST['product_name']))   : '';
$customer_name     = isset($_POST['customer_name'])     ? trim($conn->real_escape_string($_POST['customer_name']))  : '';
$phone_number      = isset($_POST['phone_number'])      ? trim($conn->real_escape_string($_POST['phone_number']))   : '';
$requested_qty     = isset($_POST['requested_quantity']) ? (int)$_POST['requested_quantity']                         : 0;
$notes             = isset($_POST['notes'])             ? trim($conn->real_escape_string($_POST['notes']))           : '';

// Server-side validation
if (empty($customer_name)) {
    echo json_encode(['success' => false, 'message' => 'Customer name is required.']);
    exit;
}
if (empty($phone_number)) {
    echo json_encode(['success' => false, 'message' => 'Phone number is required.']);
    exit;
}
if ($requested_qty <= 0) {
    echo json_encode(['success' => false, 'message' => 'Requested quantity must be greater than 0.']);
    exit;
}
if (empty($product_id) || empty($product_name)) {
    echo json_encode(['success' => false, 'message' => 'Invalid product information.']);
    exit;
}


// Auto-create table if it doesn't exist
$create_table_sql = "
    CREATE TABLE IF NOT EXISTS wholesale_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id VARCHAR(11) NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        customer_name VARCHAR(150) NOT NULL,
        phone_number VARCHAR(50) NOT NULL,
        requested_quantity INT NOT NULL DEFAULT 1,
        notes TEXT,
        request_status ENUM('Pending','Confirmed','Rejected') NOT NULL DEFAULT 'Pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
$conn->query($create_table_sql);

// Migrate: ensure product_id is VARCHAR(11) in case it was created as INT previously
@$conn->query("ALTER TABLE wholesale_requests MODIFY COLUMN product_id VARCHAR(11) NOT NULL");

$sql = "INSERT INTO wholesale_requests
            (product_id, product_name, customer_name, phone_number, requested_quantity, notes, request_status)
        VALUES
            ('$product_id', '$product_name', '$customer_name', '$phone_number', '$requested_qty', '$notes', 'Pending')";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Wholesale request submitted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}
