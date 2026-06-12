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
            echo json_encode(["status" => "success", "message" => "Promotion deleted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting: " . $stmt->error]);
        }
        $stmt->close();
    }
    $db->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}
?>