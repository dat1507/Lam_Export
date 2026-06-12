<?php
// File: api_search.php
// Real-time product search endpoint
// Usage: GET /api_search.php?q=keyword
// Returns: JSON array of up to 10 matching products

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once 'connect.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($q) < 1) {
    echo json_encode([]);
    exit;
}

// Sanitize input
$keyword = '%' . $conn->real_escape_string($q) . '%';

$sql = "SELECT id, product_name, category, price, unit, image_url
        FROM products
        WHERE status = 'available'
          AND (product_name LIKE ? OR category LIKE ?)
        ORDER BY is_trending DESC, id DESC
        LIMIT 10";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $keyword, $keyword);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'id'           => (int)$row['id'],
        'product_name' => $row['product_name'],
        'category'     => $row['category'] ?? '',
        'price'        => (float)$row['price'],
        'unit'         => $row['unit'] ?? '',
        'image_url'    => $row['image_url'] ?? 'gallery/no-image.png',
    ];
}

$stmt->close();
echo json_encode($products, JSON_UNESCAPED_UNICODE);
