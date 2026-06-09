<?php
function logActivity($db, $username, $action, $details = "") {
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($ip == '::1') {
        $ip = '127.0.0.1'; 
    }

    $stmt = $db->prepare("INSERT INTO activity_logs (username, action, details, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $action, $details, $ip);
    
    if ($stmt->execute()) {
        return true;
    }
    return false;
}
?>