<?php
/**
 * ajax_upload_image.php
 * API endpoint for TinyMCE image upload plugin.
 * Called by the editor when user inserts/pastes/drops an image into the description.
 */

session_start();

// Security: Only authenticated admins can upload
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => ['message' => 'Unauthorized', 'code' => 403]]);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => ['message' => 'Method not allowed', 'code' => 405]]);
    exit;
}

// Allowed MIME types
$allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

// Max size: 5MB
$max_size = 5 * 1024 * 1024;

$upload_dir = 'uploads/products/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if (!isset($_FILES['file'])) {
    http_response_code(400);
    echo json_encode(['error' => ['message' => 'No file received', 'code' => 400]]);
    exit;
}

$file = $_FILES['file'];

// Check for upload errors
if ($file['error'] !== UPLOAD_ERR_OK) {
    $upload_errors = [
        UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload limit.',
        UPLOAD_ERR_FORM_SIZE  => 'File exceeds form upload limit.',
        UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'File upload stopped by extension.',
    ];
    $msg = $upload_errors[$file['error']] ?? 'Unknown upload error.';
    http_response_code(500);
    echo json_encode(['error' => ['message' => $msg, 'code' => $file['error']]]);
    exit;
}

// Validate MIME type using finfo (more reliable than $_FILES['type'])
$finfo = new finfo(FILEINFO_MIME_TYPE);
$detected_type = $finfo->file($file['tmp_name']);

if (!in_array($detected_type, $allowed_types)) {
    http_response_code(400);
    echo json_encode(['error' => ['message' => 'File type not allowed. Allowed: JPG, PNG, GIF, WEBP', 'code' => 400]]);
    exit;
}

// Validate file size
if ($file['size'] > $max_size) {
    http_response_code(400);
    echo json_encode(['error' => ['message' => 'File too large. Maximum size is 5MB.', 'code' => 400]]);
    exit;
}

// Generate a safe, unique filename
$extension_map = [
    'image/jpeg' => 'jpg',
    'image/jpg'  => 'jpg',
    'image/png'  => 'png',
    'image/gif'  => 'gif',
    'image/webp' => 'webp',
];
$ext = $extension_map[$detected_type];
$new_filename = 'desc_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
$target_path = $upload_dir . $new_filename;

// Move uploaded file to destination
if (!move_uploaded_file($file['tmp_name'], $target_path)) {
    http_response_code(500);
    echo json_encode(['error' => ['message' => 'Failed to save file. Check folder permissions.', 'code' => 500]]);
    exit;
}

// Build the public URL to the uploaded file
// Detect base URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$base_path = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
// Since this file is at project root, just use SCRIPT_NAME's directory
$script_dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$public_url = $protocol . '://' . $host . $script_dir . '/' . $target_path;

// TinyMCE expects: { "location": "<url>" }
header('Content-Type: application/json');
echo json_encode(['location' => $public_url]);
exit;
