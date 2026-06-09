<?php
// admin_dashboard.php
session_start();
require 'connect.php'; 
require_once 'admin_header.php';

$today = date('Y-m-d');
$current_month = date('m');
$current_year = date('Y');


$sql_today = "SELECT COUNT(order_id) as so_don, SUM(total_amount) as doanh_thu 
              FROM orders 
              WHERE DATE(order_date) = '$today' AND status != 'Đã hủy'";
$res_today = mysqli_query($conn, $sql_today);
$row_today = mysqli_fetch_assoc($res_today);
$doanh_thu_hom_nay = $row_today['doanh_thu'] ?? 0;
$so_don_hom_nay = $row_today['so_don'] ?? 0;


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

$sql_month = "SELECT SUM(total_amount) as doanh_thu_thang 
              FROM orders 
              WHERE MONTH(order_date) = '$current_month' 
              AND YEAR(order_date) = '$current_year' 
              AND status != 'Đã hủy'";
$res_month = mysqli_query($conn, $sql_month);
$doanh_thu_thang = mysqli_fetch_assoc($res_month)['doanh_thu_thang'] ?? 0;

$sql_debt = "SELECT SUM(total_debt) as tong_no FROM customers";
$res_debt = mysqli_query($conn, $sql_debt);
$tong_cong_no = mysqli_fetch_assoc($res_debt)['tong_no'] ?? 0;

$sql_low_stock = "SELECT product_name, quantity 
                  FROM products 
                  WHERE quantity != 'Liên hệ' 
                  AND quantity REGEXP '^[0-9]+$' 
                  AND CAST(quantity AS UNSIGNED) < 10 
                  ORDER BY CAST(quantity AS UNSIGNED) ASC 
                  LIMIT 5";
$res_low_stock = mysqli_query($conn, $sql_low_stock);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Thống Kê</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-7xl mx-auto px-4 md:px-10 mt-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tổng quan Kinh doanh</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="p-4 bg-blue-100 rounded-lg text-blue-600 mr-4">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Doanh thu hôm nay</p>
                    <p class="text-2xl font-bold text-gray-800"><?= number_format($doanh_thu_hom_nay, 0, ',', '.') ?>đ</p>
                    <p class="text-xs text-gray-400 mt-1"><?= $so_don_hom_nay ?> đơn hàng mới</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="p-4 bg-purple-100 rounded-lg text-purple-600 mr-4">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Doanh thu Tháng <?= $current_month ?></p>
                    <p class="text-2xl font-bold text-gray-800"><?= number_format($doanh_thu_thang, 0, ',', '.') ?>đ</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="p-4 bg-orange-100 rounded-lg text-orange-600 mr-4">
                    <i class="fas fa-book-open text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Tổng nợ cần thu</p>
                    <p class="text-2xl font-bold text-red-600"><?= number_format($tong_cong_no, 0, ',', '.') ?>đ</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center border-b-4 border-b-green-500">
                <div class="p-4 bg-green-100 rounded-lg text-green-600 mr-4">
                    <i class="fas fa-hand-holding-dollar text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Lợi nhuận hôm nay</p>
                    <p class="text-2xl font-bold text-green-600"><?= number_format($loi_nhuan_hom_nay, 0, ',', '.') ?>đ</p>
                    <p class="text-xs text-gray-400 mt-1">
                        Giá vốn: <?= number_format($tong_gia_von, 0, ',', '.') ?>đ
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:col-span-1 border-t-4 border-t-red-500">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Sắp hết hàng
                </h3>
                
                <?php if (mysqli_num_rows($res_low_stock) > 0): ?>
                    <ul class="divide-y divide-gray-100">
                        <?php while ($row_stock = mysqli_fetch_assoc($res_low_stock)): ?>
                        <li class="py-3 flex justify-between items-center">
                            <span class="text-gray-700 text-sm font-medium truncate pr-4"><?= $row_stock['product_name'] ?></span>
                            <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-xs font-bold whitespace-nowrap">Còn <?= $row_stock['quantity'] ?></span>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500 text-sm text-center py-4">Chưa có mặt hàng nào sắp hết.</p>
                <?php endif; ?>
            </div>

        
        </div>

    </div>

</body>
</html>