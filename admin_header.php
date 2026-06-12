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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lam Export — Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        @media print {
            body > *:not(#print_section) { display: none !important; }
            #print_section, #print_section * { visibility: visible; }
            #print_section { position: absolute; left: 0; top: 0; width: 80mm; padding: 10px; }
        }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-100 antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0f172a] text-slate-300 flex flex-col h-full shadow-2xl z-10 shrink-0">

        <!-- Logo -->
        <div class="px-6 py-5 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center shrink-0">
                    <i class="fas fa-boxes text-blue-900 text-sm"></i>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Lam Export</p>
                    <p class="text-xs text-slate-500">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Nav Items -->
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-3 py-2 mt-1">Orders</p>
            <a href="admin_pos.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_pos.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-cash-register w-4 text-center opacity-70"></i>
                <span>Retail POS</span>
            </a>
            <a href="admin_wholesale.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_wholesale.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-truck-loading w-4 text-center opacity-70"></i>
                <span>Wholesale Order</span>
            </a>
            <a href="admin_orders.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_orders.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-file-invoice w-4 text-center opacity-70"></i>
                <span>Order History</span>
            </a>

            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-3 py-2 mt-3">Inventory</p>
            <a href="admin_products.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= (in_array($current_page, ['admin_products.php','admin_product_add.php','admin_product_edit.php'])) ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-box w-4 text-center opacity-70"></i>
                <span>Products</span>
            </a>
            <a href="admin_import.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_import.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-warehouse w-4 text-center opacity-70"></i>
                <span>Stock Import</span>
            </a>
            <a href="admin_promotions.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_promotions.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-tags w-4 text-center opacity-70"></i>
                <span>Promotions</span>
            </a>

            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-3 py-2 mt-3">Reports</p>
            <a href="admin_dashboard.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_dashboard.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-chart-bar w-4 text-center opacity-70"></i>
                <span>Sales Dashboard</span>
            </a>
            <a href="admin_customer.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_customer.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-users w-4 text-center opacity-70"></i>
                <span>Customers</span>
            </a>
            <a href="admin_logs.php" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all <?= ($current_page == 'admin_logs.php') ? 'bg-amber-400 text-blue-900' : 'hover:bg-white/5 hover:text-white' ?>">
                <i class="fas fa-history w-4 text-center opacity-70"></i>
                <span>Activity Log</span>
            </a>
        </nav>

        <!-- User + Actions -->
        <div class="border-t border-white/5 p-3 space-y-2 shrink-0">
            <a href="index.php" target="_blank"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-white/5 transition">
                <i class="fas fa-external-link-alt w-4 text-center opacity-70"></i>
                <span>View Website</span>
            </a>
            <div class="flex items-center gap-3 px-3 py-2 rounded-lg bg-white/5 border border-white/5">
                <div class="w-8 h-8 rounded-full bg-amber-400 text-blue-900 flex items-center justify-center font-bold text-sm uppercase shrink-0">
                    <?= substr($_SESSION['admin_username'], 0, 1) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-slate-500">Signed in as</p>
                    <p class="text-sm font-semibold text-white truncate"><?= htmlspecialchars($_SESSION['admin_username']) ?></p>
                </div>
            </div>
            <a href="admin_logout.php"
               class="flex items-center justify-center gap-2 w-full py-2 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition text-sm font-semibold">
                <i class="fas fa-sign-out-alt"></i>
                Sign Out
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA (opened by each admin page) -->
    <main class="flex-1 overflow-y-auto overflow-x-hidden">
        <div class="sticky top-0 z-10 bg-slate-100/80 backdrop-blur-sm border-b border-slate-200 px-6 py-3 flex items-center justify-between">
            <div class="text-sm text-slate-500">
                <span class="font-semibold text-slate-700"><?= date('l, d F Y') ?></span>
            </div>
            <div class="flex items-center gap-3 text-sm text-slate-500">
                <i class="fas fa-circle text-emerald-400 text-xs"></i>
                System Online
            </div>
        </div>
<?php
