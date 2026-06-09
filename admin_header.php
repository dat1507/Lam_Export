<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$timeout_duration = 900; 
if (isset($_SESSION['last_activity'])) {
    $elapsed_time = time() - $_SESSION['last_activity'];
    if ($elapsed_time > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: admin_login.php?timeout=1");
        exit;
    }
}
$_SESSION['last_activity'] = time();

require_once 'logger.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="vi">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lam Export - Bảng Điều Khiển</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body > *:not(#print_section) { display: none !important; }
            #print_section, #print_section * { visibility: visible; }
            #print_section { position: absolute; left: 0; top: 0; width: 80mm; padding: 10px; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">

    <div class="w-64 bg-[#1a2954] text-white flex flex-col h-full shadow-xl z-10 shrink-0">
        <div class="p-6 text-2xl font-bold border-b border-blue-800 text-[#f5b041]">Lam Export Admin</div>
        <div class="p-4 border-t border-blue-800 mt-auto w-full">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#f5b041] text-[#1a2954] flex items-center justify-center font-bold text-lg uppercase shadow-md">
                    <?= substr($_SESSION['admin_username'], 0, 1) ?>
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs text-blue-300 uppercase tracking-wider">Đang đăng nhập</p>
                    <p class="font-bold text-white truncate text-sm" title="<?= htmlspecialchars($_SESSION['admin_username']) ?>">
                        <?= htmlspecialchars($_SESSION['admin_username']) ?>
                    </p>
                </div>
            </div>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="admin_pos.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_pos.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                🛒 Lên Đơn bán lẻ
            </a>
            <a href="admin_wholesale.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_wholesale.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                🛒🛒 Lên Đơn bán sỉ
            </a>
            <a href="admin_products.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_products.php' || $current_page == 'admin_product_add.php' || $current_page == 'admin_product_edit.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                📦 Quản lý Sản phẩm
            </a>
            <a href="admin_import.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_import.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                📦 Nhập kho
            </a>
            <a href="admin_orders.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_orders.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                📜 Lịch sử Hóa đơn
            </a>
            <a href="admin_logs.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_logs.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                🕵️ Xem lịch sử hoạt động
            </a>
            <a href="admin_promotions.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_promotions.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                Quản lý khuyến mãi
            </a>
            <a href="admin_customer.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_customer.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                👥 Quản lý khách hàng
            </a>
            <a href="admin_dashboard.php" class="block py-2.5 px-4 rounded transition <?= ($current_page == 'admin_dashboard.php') ? 'bg-[#f5b041] text-[#1a2954] font-bold' : 'hover:bg-blue-800' ?>">
                Xem doanh số
            </a>
            <a href="index.php" class="block py-2.5 px-4 rounded transition hover:bg-blue-800 mt-8 border border-blue-400 text-center">
                ⬅ Xem trang web
            </a>
           
             <a href="admin_logout.php" class="flex items-center justify-center gap-2 w-full py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition font-bold text-sm shadow">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </nav>
    </div>
<?php
