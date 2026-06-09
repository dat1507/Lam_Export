<?php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $database = new Database();
    $db = $database->getConnection();
    
    $id = (int)$_POST['id'];

    $query = "DELETE FROM promotions WHERE id = ?";
    
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Đã xóa mã khuyến mãi thành công!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi khi xóa: " . $stmt->error]);
        }
        $stmt->close();
    }
    $db->close();
} else {
    echo json_encode(["status" => "error", "message" => "Yêu cầu không hợp lệ!"]);
}
?>