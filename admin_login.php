<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_products.php"); 
    exit;
}

require_once 'config/database.php';
$error = '';

if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    $error = "Phiên làm việc đã hết hạn do không hoạt động. Vui lòng đăng nhập lại!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
       
        if (password_verify($password, $user['password']) || $password === $user['password']) {
            
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            
            header("Location: admin_products.php"); // Chuyển hướng sau khi đăng nhập
            exit;
        } else {
            $error = "❌ Sai mật khẩu!";
        }
    } else {
        $error = "❌ Tài khoản không tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản Trị</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full border-t-4 border-blue-600">
        <h2 class="text-3xl font-bold text-center text-[#1a2954] mb-8">LAM EXPORT<br>ADMIN LOGIN</h2>
        
        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 font-bold text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tên đăng nhập</label>
                <input type="text" name="username" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Nhập username...">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mật khẩu</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Nhập mật khẩu...">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                ĐĂNG NHẬP
            </button>
        </form>
    </div>

</body>
</html>