<?php
// ajax_confirm_wholesale_request.php
// Admin action: confirm or reject a wholesale request
// IMPORTANT: no HTML output — JSON only
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
    exit;
}

header('Content-Type: application/json; charset=utf-8');
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$id     = isset($_POST['id'])     ? (int)$_POST['id']     : 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : '';

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid request ID.']);
    exit;
}

$allowed_statuses = ['Confirmed', 'Rejected'];
if (!in_array($action, $allowed_statuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    exit;
}

$safe_action = $conn->real_escape_string($action);
$sql = "UPDATE wholesale_requests SET request_status = '$safe_action', updated_at = NOW() WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'new_status' => $action, 'message' => "Wholesale request {$action} successfully."]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}
