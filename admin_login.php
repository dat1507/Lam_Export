<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_products.php");
    exit;
}

require_once 'config/database.php';
$error = '';

if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    $error = "Your session expired due to inactivity. Please sign in again.";
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
            header("Location: admin_products.php");
            exit;
        } else {
            $error = "Incorrect password. Please try again.";
        }
    } else {
        $error = "No account found with that username.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In — Lam Export</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .bg-pattern {
            background-color: #0f172a;
            background-image: radial-gradient(circle at 20% 30%, rgba(30,58,138,0.5) 0%, transparent 50%),
                              radial-gradient(circle at 80% 70%, rgba(245,158,11,0.15) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Top Bar -->
            <div class="bg-gradient-to-r from-[#1e3a8a] to-[#1d4ed8] px-8 py-8 text-center">
                <div class="w-16 h-16 bg-white/10 border border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-amber-400 text-2xl"></i>
                </div>
                <h1 class="text-xl font-bold text-white">Lam Export</h1>
                <p class="text-blue-200 text-sm mt-1">Admin Portal — Authorized Access Only</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">

                <?php if ($error): ?>
                    <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        <i class="fas fa-exclamation-circle shrink-0"></i>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['timeout']) && $_GET['timeout'] == 1 && !$error): ?>
                    <div class="flex items-center gap-3 bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        <i class="fas fa-clock shrink-0"></i>
                        <span>Session expired. Please sign in again.</span>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-5" id="loginForm">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="username">Username</label>
                        <div class="relative">
                            <input type="text" id="username" name="username" required
                                   placeholder="Enter your username"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 pl-10 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-400 focus:outline-none transition bg-gray-50 focus:bg-white"
                                   autocomplete="username">
                            <i class="fas fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="password">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   placeholder="Enter your password"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 pl-10 pr-10 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-400 focus:outline-none transition bg-gray-50 focus:bg-white"
                                   autocomplete="current-password">
                            <i class="fas fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <button type="button" id="togglePassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                                <i class="fas fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit"
                            class="w-full bg-[#1e3a8a] hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2 mt-2">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-100 text-center text-xs text-gray-400">
                    <a href="index.php" class="hover:text-blue-600 transition inline-flex items-center gap-1">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Back to website
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer note -->
        <p class="text-center text-slate-500 text-xs mt-6">&copy; <?= date('Y') ?> Lam Export. All rights reserved.</p>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwdInput = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pwdInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>