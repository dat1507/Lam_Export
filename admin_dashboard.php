<?php
// admin_dashboard.php
session_start();
require 'connect.php';
require_once 'admin_header.php';

$today = date('Y-m-d');
$current_month = date('m');
$current_year = date('Y');
$month_name = date('F');

// Today's revenue & orders
$sql_today = "SELECT COUNT(order_id) as so_don, SUM(total_amount) as doanh_thu
              FROM orders
              WHERE DATE(order_date) = '$today' AND status != 'Đã hủy'";
$res_today = mysqli_query($conn, $sql_today);
$row_today = mysqli_fetch_assoc($res_today);
$doanh_thu_hom_nay = $row_today['doanh_thu'] ?? 0;
$so_don_hom_nay = $row_today['so_don'] ?? 0;

// Cost of goods today
$sql_cost = "
    SELECT SUM(od.quantity * COALESCE(
        (SELECT import_price
         FROM import_details idt
         WHERE idt.product_id COLLATE utf8mb4_unicode_ci = od.product_id
         ORDER BY idt.id DESC LIMIT 1), 0
    )) as tong_gia_von
    FROM order_details od
    JOIN orders o ON od.order_id = o.order_id
    WHERE DATE(o.order_date) = '$today' AND o.status COLLATE utf8mb4_unicode_ci != 'Đã hủy'
";
$res_cost = mysqli_query($conn, $sql_cost);
$tong_gia_von = mysqli_fetch_assoc($res_cost)['tong_gia_von'] ?? 0;
$loi_nhuan_hom_nay = $doanh_thu_hom_nay - $tong_gia_von;

// Monthly revenue
$sql_month = "SELECT SUM(total_amount) as doanh_thu_thang
              FROM orders
              WHERE MONTH(order_date) = '$current_month'
              AND YEAR(order_date) = '$current_year'
              AND status != 'Đã hủy'";
$res_month = mysqli_query($conn, $sql_month);
$doanh_thu_thang = mysqli_fetch_assoc($res_month)['doanh_thu_thang'] ?? 0;

// Total receivable debt
$sql_debt = "SELECT SUM(total_debt) as tong_no FROM customers";
$res_debt = mysqli_query($conn, $sql_debt);
$tong_cong_no = mysqli_fetch_assoc($res_debt)['tong_no'] ?? 0;

// Low stock products
$sql_low_stock = "SELECT product_name, quantity
                  FROM products
                  WHERE quantity != 'Liên hệ'
                  AND quantity REGEXP '^[0-9]+$'
                  AND CAST(quantity AS UNSIGNED) < 10
                  ORDER BY CAST(quantity AS UNSIGNED) ASC
                  LIMIT 5";
$res_low_stock = mysqli_query($conn, $sql_low_stock);

// Recent orders
$sql_recent = "SELECT order_id, customer_name, total_amount, status, order_date
               FROM orders ORDER BY order_date DESC LIMIT 5";
$res_recent = mysqli_query($conn, $sql_recent);
?>

<div class="p-6 max-w-7xl mx-auto">

    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Sales Dashboard</h1>
        <p class="text-sm text-slate-500 mt-0.5">Overview for today — <?= date('d F Y') ?></p>
    </div>

    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

        <!-- Today Revenue -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm flex items-start gap-4">
            <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                <i class="fas fa-money-bill-wave text-blue-600"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Today's Revenue</p>
                <p class="text-xl font-bold text-slate-800 mt-0.5 truncate"><?= number_format($doanh_thu_hom_nay, 0, ',', '.') ?>đ</p>
                <p class="text-xs text-slate-400 mt-0.5"><?= $so_don_hom_nay ?> order<?= $so_don_hom_nay != 1 ? 's' : '' ?> placed</p>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm flex items-start gap-4">
            <div class="w-11 h-11 bg-violet-100 rounded-xl flex items-center justify-center shrink-0">
                <i class="fas fa-chart-line text-violet-600"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide"><?= $month_name ?> Revenue</p>
                <p class="text-xl font-bold text-slate-800 mt-0.5 truncate"><?= number_format($doanh_thu_thang, 0, ',', '.') ?>đ</p>
                <p class="text-xs text-slate-400 mt-0.5">Month to date</p>
            </div>
        </div>

        <!-- Receivable Debt -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm flex items-start gap-4">
            <div class="w-11 h-11 bg-orange-100 rounded-xl flex items-center justify-center shrink-0">
                <i class="fas fa-book-open text-orange-600"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Total Receivable</p>
                <p class="text-xl font-bold text-red-600 mt-0.5 truncate"><?= number_format($tong_cong_no, 0, ',', '.') ?>đ</p>
                <p class="text-xs text-slate-400 mt-0.5">Outstanding debt</p>
            </div>
        </div>

        <!-- Today's Profit -->
        <div class="bg-white rounded-2xl border-l-4 border-l-emerald-500 border-slate-200 p-5 shadow-sm flex items-start gap-4">
            <div class="w-11 h-11 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                <i class="fas fa-hand-holding-dollar text-emerald-600"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Today's Profit</p>
                <p class="text-xl font-bold text-emerald-600 mt-0.5 truncate"><?= number_format($loi_nhuan_hom_nay, 0, ',', '.') ?>đ</p>
                <p class="text-xs text-slate-400 mt-0.5">COGS: <?= number_format($tong_gia_von, 0, ',', '.') ?>đ</p>
            </div>
        </div>
    </div>

    <!-- BOTTOM GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Low Stock Alert -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                <h3 class="text-sm font-bold text-slate-700">Low Stock Alert</h3>
            </div>
            <div class="divide-y divide-slate-50">
                <?php if (mysqli_num_rows($res_low_stock) > 0): ?>
                    <?php while ($row_stock = mysqli_fetch_assoc($res_low_stock)):
                        $qty = (int)$row_stock['quantity'];
                        $urgency = $qty <= 3 ? 'text-red-600 bg-red-50' : 'text-orange-600 bg-orange-50';
                    ?>
                    <div class="px-5 py-3.5 flex justify-between items-center hover:bg-slate-50 transition">
                        <span class="text-sm text-slate-700 font-medium truncate pr-4"><?= htmlspecialchars($row_stock['product_name']) ?></span>
                        <span class="<?= $urgency ?> text-xs font-bold px-2.5 py-1 rounded-full whitespace-nowrap border border-current/20">
                            <?= $qty ?> left
                        </span>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="px-5 py-8 text-center">
                        <i class="fas fa-check-circle text-emerald-400 text-2xl mb-2"></i>
                        <p class="text-sm text-slate-400">All products are well-stocked.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden lg:col-span-2">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <h3 class="text-sm font-bold text-slate-700">Recent Orders</h3>
                </div>
                <a href="admin_orders.php" class="text-xs text-blue-600 hover:underline font-medium">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-xs text-slate-500 uppercase tracking-wide">
                            <th class="px-5 py-3 text-left font-semibold">Order ID</th>
                            <th class="px-5 py-3 text-left font-semibold">Customer</th>
                            <th class="px-5 py-3 text-right font-semibold">Amount</th>
                            <th class="px-5 py-3 text-center font-semibold">Status</th>
                            <th class="px-5 py-3 text-right font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if ($res_recent && mysqli_num_rows($res_recent) > 0): ?>
                        <?php while ($order = mysqli_fetch_assoc($res_recent)):
                            $statusMap = [
                                'Đã hủy'         => ['label' => 'Cancelled',  'class' => 'text-red-600 bg-red-50 border-red-200'],
                                'Hoàn thành'      => ['label' => 'Completed',  'class' => 'text-emerald-600 bg-emerald-50 border-emerald-200'],
                                'Chờ xử lý'       => ['label' => 'Pending',    'class' => 'text-amber-600 bg-amber-50 border-amber-200'],
                                'Đang giao'       => ['label' => 'Shipping',   'class' => 'text-blue-600 bg-blue-50 border-blue-200'],
                            ];
                            $statusInfo = $statusMap[$order['status']] ?? ['label' => $order['status'], 'class' => 'text-slate-600 bg-slate-50 border-slate-200'];
                        ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3.5 font-mono text-xs text-slate-500">#<?= $order['order_id'] ?></td>
                            <td class="px-5 py-3.5 font-medium text-slate-700"><?= htmlspecialchars($order['customer_name'] ?? 'N/A') ?></td>
                            <td class="px-5 py-3.5 text-right font-semibold text-slate-800"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td class="px-5 py-3.5 text-center">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full border <?= $statusInfo['class'] ?>"><?= $statusInfo['label'] ?></span>
                            </td>
                            <td class="px-5 py-3.5 text-right text-xs text-slate-400"><?= date('d M Y', strtotime($order['order_date'])) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400 text-sm">No orders found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</main>
</body>
</html>