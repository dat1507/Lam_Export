-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2026 at 05:32 AM
-- Server version: 10.11.18-MariaDB-log
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamexpor_nguyenlamdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `username`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng Sachi phủ phô mai', NULL, '2026-03-23 15:59:22'),
(2, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ rong biển', NULL, '2026-03-23 15:59:28'),
(3, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng Sachi phủ phô mai', NULL, '2026-03-23 16:03:36'),
(4, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nước dừa (Vị Quê)', NULL, '2026-03-23 16:27:40'),
(5, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng gạo mè (Vị Quê)', NULL, '2026-03-23 16:27:47'),
(6, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #1) | NCC: Sachi | Gồm: SP: SACHI-07 (SL: 250), SP: SACHI-08 (SL: 250), SP: SACHI-01 (SL: 3250), SP: SACHI-02 (SL: 850), SP: SACHI-03 (SL: 100), SP: SACHI-04 (SL: 100), SP: SACHI-05 (SL: 100), SP: SACHI-06 (SL: 100) | Tổng: 36.296.305,00đ | Ghi chú: + Tiền thuế GTGT: 2.671.410đ', '42.118.117.239', '2026-03-23 17:12:12'),
(7, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Nguyễn Xuân Hiếu - Anya 5 sao (SĐT: 0374436402, Đ/c: 44 An Dương Vương.)', '42.118.117.239', '2026-03-23 17:15:50'),
(9, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Vân (hàng xóm) (SĐT: Liên hệ Zalo, Đ/c: Hàng xóm 05 Lý Thường Kiệt)', '14.245.204.254', '2026-03-24 03:27:23'),
(10, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Hồng ăn vặt (SĐT: 0934988925, Đ/c: Hẻm Hai Bà Trưng ăn vặt)', '14.245.204.254', '2026-03-24 03:36:20'),
(11, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Phương (SĐT: 0935659794, Đ/c: 03 Lý Thường Kiệt)', '14.245.204.254', '2026-03-24 03:37:07'),
(12, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cường - Anya 4 sao (SĐT: 0389959799, Đ/c: 03 Nguyễn Trung Tín)', '14.245.204.254', '2026-03-24 04:18:59'),
(13, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #2) | Đại lý: Hồng ăn vặt | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 15), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 15), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 10) | Tổng: 1.620.000đ | Đã thu: 1.620.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.245.204.254', '2026-03-24 04:30:01'),
(14, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Tám Trà (SĐT: 0342297299, Đ/c: 37 Phạm Hồng Thái)', '113.172.52.106', '2026-03-24 06:02:01'),
(15, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Hằng (SĐT: 0987907957, Đ/c: 28 Ngô Mây)', '113.172.52.106', '2026-03-24 06:02:40'),
(16, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Trang Thông (SĐT: 0931985975, Đ/c: 180 Ngô Mây)', '113.172.52.106', '2026-03-24 06:03:21'),
(17, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ rong biển', NULL, '2026-03-24 06:05:44'),
(18, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #3) | Đại lý: Tám Trà | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 50) | Tổng: 310.000đ | Đã thu: 310.000đ | Còn nợ: 0đ | Ghi chú: ship qua 37 Phạm Hồng Thái', '14.245.204.254', '2026-03-24 06:09:12'),
(19, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #4) | Đại lý: Trang Thông | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 5), Snack bánh tráng nướng Sachi phủ rong biển (SL: 5), Snack bánh tráng nướng Sachi phủ khô bò (SL: 5), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 5), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 5), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 5) | Tổng: 360.000đ | Đã thu: 360.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.245.204.254', '2026-03-24 06:13:51'),
(20, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #2) | NCC: Sachi | Gồm: SP: SACHI-09 (SL: 48) | Tổng: 235.200,00đ | Ghi chú: Không có', '14.245.204.254', '2026-03-24 06:26:20'),
(21, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #5) | Đại lý: Hằng | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 10), Snack bánh tráng nướng Sachi phủ khô bò (SL: 10), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 10), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 10), Bánh tráng cuốn gạo giòn Sachi (100g) (SL: 10) | Tổng: 1.268.000đ | Đã thu: 1.268.000đ | Còn nợ: 0đ | Ghi chú: ship qua 28 Ngô Mây, chưa chiết khấu 10%', '14.245.204.254', '2026-03-24 06:30:39'),
(22, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Lưu (SĐT: 0988947488, Đ/c: Quán nhậu Năm Hiền)', '14.245.204.254', '2026-03-24 06:35:49'),
(23, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #6) | Đại lý: Lưu | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 50) | Tổng: 340.000đ | Đã thu: 340.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.245.204.254', '2026-03-24 06:36:09'),
(24, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #7) | Đại lý: Cường - Anya 4 sao | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 250), Snack bánh tráng nướng Sachi phủ rong biển (SL: 250) | Tổng: 4.800.000đ | Đã thu: 0đ | Còn nợ: 4.800.000đ | Ghi chú: Không có', '113.172.52.106', '2026-03-24 06:50:58'),
(25, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #8) | Đại lý: Nguyễn Xuân Hiếu - Anya 5 sao | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 250), Snack bánh tráng nướng Sachi phủ rong biển (SL: 250) | Tổng: 4.800.000đ | Đã thu: 0đ | Còn nợ: 4.800.000đ | Ghi chú: Không có', '113.172.52.106', '2026-03-24 06:51:54'),
(26, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ khô bò', NULL, '2026-03-24 08:45:59'),
(27, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ khô bò', NULL, '2026-03-24 08:46:12'),
(28, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ chà bông gà', NULL, '2026-03-24 08:46:20'),
(29, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ tôm nướng', NULL, '2026-03-24 08:46:29'),
(30, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ mực nướng', NULL, '2026-03-24 08:46:38'),
(31, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng gạo mè (Vị Quê)', NULL, '2026-03-24 10:08:21'),
(32, 'lamadmin', 'Thêm khách hàng', 'Thêm khách lẻ mới: Khương (SĐT: 0935654199)', '14.245.204.254', '2026-03-24 10:08:59'),
(33, 'lamadmin', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #9 - Tổng tiền: 100.000đ', '14.245.204.254', '2026-03-24 10:09:07'),
(34, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng cuốn gạo giòn Sachi (100g)', NULL, '2026-03-24 10:51:11'),
(35, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #10) | Đại lý: Phương | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 50), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 50) | Tổng: 1.620.000đ | Đã thu: 1.620.000đ | Còn nợ: 0đ | Ghi chú: đã giao', '14.245.204.254', '2026-03-25 03:00:40'),
(36, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #11) | Đại lý: Vân (hàng xóm) | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 50) | Tổng: 1.620.000đ | Đã thu: 1.620.000đ | Còn nợ: 0đ | Ghi chú: đã giao', '14.245.204.254', '2026-03-25 03:02:30'),
(37, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cô Vy Chủ nhà hàng Bình Dân quán (SĐT: 0903348111, Đ/c: 57-59 Đặng Văn Ngữ)', '113.172.52.106', '2026-04-01 07:29:02'),
(38, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #12) | Đại lý: Cô Vy Chủ nhà hàng Bình Dân quán | Gồm: Bánh tráng nước dừa (Vị Quê) (SL: 50), Bánh tráng gạo mè (Vị Quê) (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1) | Tổng: 680.000đ | Đã thu: 0đ | Còn nợ: 680.000đ | Ghi chú: 5 túi snack phô mai + 1 rong biển + 1 bò + 1 gà + 1 mực  + 1 tôm được khuyến mãi', '113.172.52.106', '2026-04-01 07:31:02'),
(39, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #12. Hệ thống đã tự động hoàn kho và trừ nợ (680.000 đ).', '113.172.52.106', '2026-04-01 07:32:17'),
(40, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #13) | Đại lý: Cô Vy Chủ nhà hàng Bình Dân quán | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 50), Bánh tráng nước dừa (Vị Quê) (SL: 50), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 5) | Tổng: 680.000đ | Đã thu: 680.000đ | Còn nợ: 0đ | Ghi chú: Snack sachi khuyến mãi', '113.172.52.106', '2026-04-01 07:33:33'),
(41, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #13. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.172.52.106', '2026-04-01 08:35:45'),
(42, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #14) | Đại lý: Cô Vy Chủ nhà hàng Bình Dân quán | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 33), Bánh tráng nước dừa (Vị Quê) (SL: 67), Snack bánh tráng Sachi phủ phô mai (SL: 5), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1) | Tổng: 680.000đ | Đã thu: 680.000đ | Còn nợ: 0đ | Ghi chú: Snack Sachi 6 vị hàng tặng', '113.172.52.106', '2026-04-01 08:36:46'),
(43, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Anh Huy Giám Đốc Nhà Hàng (SĐT: 0979596799, Đ/c: 03 Trần Phú)', '113.172.52.106', '2026-04-01 08:44:11'),
(44, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #15) | Đại lý: Anh Huy Giám Đốc Nhà Hàng | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 100), Bánh tráng nước dừa (Vị Quê) (SL: 100) | Tổng: 1.224.000đ | Đã thu: 0đ | Còn nợ: 1.224.000đ | Ghi chú: Đã giao vào ngày 26/03', '113.172.52.106', '2026-04-01 08:45:24'),
(45, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Chào mẫu/Dùng Thử (SĐT: none, Đ/c: none)', '113.172.52.106', '2026-04-01 08:46:15'),
(46, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #16) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 7) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.172.52.106', '2026-04-01 08:46:17'),
(47, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #17) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Bánh tráng nước dừa (Vị Quê) (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 8), Snack bánh tráng nướng Sachi phủ rong biển (SL: 8), Snack bánh tráng nướng Sachi phủ khô bò (SL: 8), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 8), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 8), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 8) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: khách ở sg, chào mẫu', '113.172.52.106', '2026-04-02 08:19:20'),
(48, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #3) | NCC: Sachi | Gồm: SP: SACHI-01 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: hàng khuyến mãi', '113.172.52.106', '2026-04-04 08:18:01'),
(49, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #4) | NCC: Sachi | Gồm: SP: SACHI-05 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: khuyến mãi', '113.172.52.106', '2026-04-04 08:18:18'),
(50, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #5) | NCC: Sachi | Gồm: SP: SACHI-02 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: khuyến mãi', '113.172.52.106', '2026-04-04 08:18:31'),
(51, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #6) | NCC: Sachi | Gồm: SP: SACHI-06 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: khuyến mãi', '113.172.52.106', '2026-04-04 08:18:41'),
(52, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #7) | NCC: Sachi | Gồm: SP: SACHI-03 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.172.52.106', '2026-04-04 08:18:45'),
(53, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #8) | NCC: Sachi | Gồm: SP: SACHI-04 (SL: 42) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: khuyến mãi', '113.172.52.106', '2026-04-04 08:18:53'),
(54, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Khách của Sở (chị Khương gt) (SĐT: 012345678, Đ/c: none)', '113.172.52.106', '2026-04-06 13:48:18'),
(55, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #18) | Đại lý: Khách của Sở (chị Khương gt) | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 8), Snack bánh tráng nướng Sachi phủ rong biển (SL: 8), Snack bánh tráng nướng Sachi phủ khô bò (SL: 8), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 8), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 8) | Tổng: 630.000đ | Đã thu: 0đ | Còn nợ: 630.000đ | Ghi chú: Khách của sở, chị Khương giới thiệu mua vãng lai', '113.172.52.106', '2026-04-06 13:49:59'),
(56, 'lamadmin', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Vân & Phương hàng xóm (ID: 5)', '109.41.241.199', '2026-04-07 07:40:07'),
(57, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #9) | NCC: Vân & Phương hàng xóm | Gồm: SP: SACHI-05 (SL: 41), SP: SACHI-04 (SL: 40), SP: SACHI-03 (SL: 37), SP: SACHI-06 (SL: 47), SP: SACHI-02 (SL: 47), SP: SACHI-01 (SL: 21) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Trả hàng', '109.41.241.199', '2026-04-07 07:41:45'),
(58, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng cuốn gạo giòn Sachi (100g)', NULL, '2026-04-11 16:39:44'),
(59, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng cuốn gạo giòn Sachi (100g)', NULL, '2026-04-11 19:04:48'),
(60, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nước dừa (Vị Quê)', NULL, '2026-04-13 10:27:43'),
(61, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nước dừa (Vị Quê)', NULL, '2026-04-13 10:28:12'),
(62, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nước dừa (Vị Quê)', NULL, '2026-04-13 10:28:14'),
(63, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng gạo mè (Vị Quê)', NULL, '2026-04-13 10:28:38'),
(64, 'lamadmin', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #19 - Tổng tiền: 420.000đ', '194.95.87.11', '2026-04-13 10:43:13'),
(65, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #20) | Đại lý: Hằng | Gồm: Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 50) | Tổng: 900.000đ | Đã thu: 0đ | Còn nợ: 900.000đ | Ghi chú: Không có', '194.95.87.11', '2026-04-13 10:47:03'),
(66, 'lamadmin', 'Thu công nợ', 'Thu 900,000 đ tiền công nợ của khách: Hằng (ID: 7)', '194.95.87.11', '2026-04-14 12:18:08'),
(67, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #21) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 17), Snack bánh tráng nướng Sachi phủ rong biển (SL: 12), Snack bánh tráng nướng Sachi phủ khô bò (SL: 12), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 31), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 5) | Tổng: 508.200đ | Đã thu: 508.200đ | Còn nợ: 0đ | Ghi chú: Chủ mua để tặng/dùng thử', '194.95.87.11', '2026-04-14 12:43:28'),
(68, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #10) | NCC: Sachi | Gồm: SP: SACHI-07 (SL: 1300), SP: SACHI-08 (SL: 500), SP: SACHI-04 (SL: 50), SP: SACHI-03 (SL: 50), SP: SACHI-06 (SL: 50), SP: SACHI-05 (SL: 50) | Tổng: 12.020.400đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Lô hàng ngày 16/04/2026', '14.191.196.21', '2026-04-16 02:42:06'),
(69, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #22) | Đại lý: Tám Trà | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 100) | Tổng: 650.000đ | Đã thu: 0đ | Còn nợ: 650.000đ | Ghi chú: Không có', '14.191.196.21', '2026-04-16 02:48:20'),
(70, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Nhà hàng 114 Xuân Diệu - Anh Tài (SĐT: 0933117585, Đ/c: 114 Xuân Diệu)', '14.191.196.21', '2026-04-16 03:30:22'),
(71, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #23) | Đại lý: Nhà hàng 114 Xuân Diệu - Anh Tài | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 50), Bánh tráng nước dừa (Vị Quê) (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 10), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ rong biển (SL: 10), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 10), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 10) | Tổng: 1.105.000đ | Đã thu: 1.105.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.191.196.21', '2026-04-16 03:34:51'),
(72, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Thanh Liêm (SĐT: 0914737888, Đ/c: 30 Nguyễn Tất Thành)', '14.191.196.21', '2026-04-16 03:35:57'),
(73, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #24) | Đại lý: Thanh Liêm | Gồm: Bánh tráng nước dừa (Vị Quê) (SL: 50), Bánh tráng gạo mè (Vị Quê) (SL: 50) | Tổng: 680.000đ | Đã thu: 680.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.191.196.21', '2026-04-16 03:36:24'),
(74, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #25) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 5) | Tổng: 34.000đ | Đã thu: 34.000đ | Còn nợ: 0đ | Ghi chú: Vân mua hàng chào mẫu khách', '14.191.196.21', '2026-04-16 03:39:05'),
(75, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #22. Hệ thống đã tự động hoàn kho và trừ nợ (650.000 đ).', '14.191.196.21', '2026-04-16 03:42:24'),
(76, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #26) | Đại lý: Tám Trà | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 100) | Tổng: 680.000đ | Đã thu: 680.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.191.196.21', '2026-04-16 03:43:13'),
(77, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Siêu thị Gia Hội (SĐT: Giahoi3233@gmail.com, Đ/c: Lô 32,33F Tố hữu, p.Quy Nhơn, Tỉnh Gia Lai)', '113.170.129.73', '2026-04-16 18:56:47'),
(78, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #27) | Đại lý: Siêu thị Gia Hội | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 25), Bánh tráng nước dừa (Vị Quê) (SL: 25) | Tổng: 325.000đ | Đã thu: 0đ | Còn nợ: 325.000đ | Ghi chú: Không có', '113.170.129.73', '2026-04-16 18:57:22'),
(79, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #27. Hệ thống đã tự động hoàn kho và trừ nợ (325.000 đ).', '113.170.129.73', '2026-04-16 18:58:40'),
(80, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #28) | Đại lý: Siêu thị Gia Hội | Gồm: Bánh tráng nước dừa (Vị Quê) (SL: 25), Bánh tráng gạo mè (Vị Quê) (SL: 25) | Tổng: 325.000đ | Đã thu: 325.000đ | Còn nợ: 0đ | Ghi chú: Không có', '113.170.129.73', '2026-04-16 18:59:12'),
(81, 'lamadmin2', 'Thu công nợ', 'Thu 630,000 đ tiền công nợ của khách: Khách của Sở (chị Khương gt) (ID: 15)', '113.170.129.73', '2026-04-16 19:01:41'),
(82, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí (SĐT: 0987662934, Đ/c: 222-224 Nguyễn Thái Học, Quy Nhơn)', '113.170.129.73', '2026-04-18 02:23:28'),
(83, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #29) | Đại lý: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 50), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 50), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 50) | Tổng: 2.422.500đ | Đã thu: 2.422.500đ | Còn nợ: 0đ | Ghi chú: thanh toán đủ trong vòng 3 ngày sẽ đc nhận chiết khấu 5% (21/04)', '113.170.129.73', '2026-04-18 02:25:03'),
(84, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #11) | NCC: Sachi | Gồm: SP: SACHI-04 (SL: 100), SP: SACHI-03 (SL: 100), SP: SACHI-06 (SL: 100), SP: SACHI-05 (SL: 100) | Tổng: 2.851.200đ (Thuế: 211.200đ, CK: 0đ) | Ghi chú: Nhập hàng 18/04/2026', '84.17.57.122', '2026-04-19 03:45:04'),
(85, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #30) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 2), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Bánh tráng gạo mè (Vị Quê) (SL: 1), Bánh tráng nước dừa (Vị Quê) (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: dùng thử, tặng khách (18/04/2026)', '84.17.57.122', '2026-04-19 03:48:19'),
(86, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #12) | NCC: Sachi | Gồm: SP: SACHI-10 (SL: 200) | Tổng: 1.200.000đ (Thuế: 88.800đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-04-20 10:01:47'),
(87, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #31) | Đại lý: Vân (hàng xóm) | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 10), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 10), Snack bánh tráng nướng Sachi phủ khô bò (SL: 10), Snack bánh tráng nướng Sachi phủ rong biển (SL: 10), Snack bánh tráng Sachi phủ phô mai (SL: 10), Bánh tráng nước dừa (Vị Quê) (SL: 5), Bánh tráng gạo mè (Vị Quê) (SL: 5), Đậu phộng tỏi ớt (SL: 10) | Tổng: 780.000đ | Đã thu: 0đ | Còn nợ: 780.000đ | Ghi chú: ngày 22/04 thanh toán', '113.170.129.73', '2026-04-20 10:04:07'),
(88, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Tạp Hóa Thy Nhân (SĐT: 0905623695, Đ/c: 490 Nguyễn Thái Học)', '113.170.129.73', '2026-04-20 10:06:26'),
(89, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #32) | Đại lý: Tạp Hóa Thy Nhân | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 25), Bánh tráng nước dừa (Vị Quê) (SL: 25), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 10), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 10), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 10), Snack bánh tráng nướng Sachi phủ khô bò (SL: 10), Snack bánh tráng nướng Sachi phủ rong biển (SL: 10), Snack bánh tráng Sachi phủ phô mai (SL: 10), Đậu phộng tỏi ớt (SL: 20) | Tổng: 995.000đ | Đã thu: 995.000đ | Còn nợ: 0đ | Ghi chú: Không có', '113.170.129.73', '2026-04-20 10:17:05'),
(90, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #33) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1), Bánh tráng gạo mè (Vị Quê) (SL: 1), Bánh tráng nước dừa (Vị Quê) (SL: 1), Đậu phộng tỏi ớt (SL: 1) | Tổng: 85.000đ | Đã thu: 85.000đ | Còn nợ: 0đ | Ghi chú: lỗi đơn ngày 17/04 bán khách vãng lai', '113.170.129.73', '2026-04-20 10:24:23'),
(91, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng Sachi phủ phô mai', NULL, '2026-04-20 10:40:14'),
(92, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nước dừa (Vị Quê)', NULL, '2026-04-20 12:32:15'),
(93, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ tôm nướng', NULL, '2026-04-20 12:32:56'),
(94, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng Sachi phủ phô mai', NULL, '2026-04-20 12:33:07'),
(95, 'lamadmin', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #34 - Tổng tiền: 113.000đ', '194.95.87.11', '2026-04-20 12:37:50'),
(96, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #33. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.170.129.73', '2026-04-21 01:04:42'),
(97, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #35 - Tổng tiền: 113.000đ', '14.245.204.254', '2026-04-21 07:50:48'),
(98, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #34. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.245.204.254', '2026-04-21 07:54:57'),
(99, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (250gram)', NULL, '2026-04-21 10:29:43'),
(100, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-04-21 10:30:01'),
(101, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant truyền thống (500gram)', NULL, '2026-04-21 21:11:20'),
(102, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (250gram)', NULL, '2026-04-21 21:12:32'),
(103, 'lamadmin', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-04-21 21:15:59'),
(104, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #37) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Kho Vinhomes - chào mẫu khách FARMSHOP - PARK 5 VINHOMES CENTRAL PARK', '113.170.129.73', '2026-04-22 03:49:27'),
(105, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #37. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.170.129.73', '2026-04-22 03:49:44'),
(106, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #38) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1), Bánh tráng nước dừa (Vị Quê) (SL: 1), Bánh tráng gạo mè (Vị Quê) (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Kho Landmark - Chào mẫu shop  FARMSHOP Park 5 -', '113.170.129.73', '2026-04-22 03:52:39'),
(107, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Combo Pie (Có thay đổi Mã SP: CAKE_01 ➔ BÁNH NGỌT_01)', NULL, '2026-04-22 08:31:39'),
(108, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Combo Pie (Có thay đổi Mã SP: BÁNH NGỌT_0 ➔ BÁNH NGỌT_01)', NULL, '2026-04-22 08:32:16'),
(109, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Combo Pie (Có thay đổi Mã SP: BÁNH NGỌT_0 ➔ CPIE_01)', NULL, '2026-04-22 08:35:51'),
(110, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Hura layercake vị bơ sữa (Có thay đổi Mã SP: CAKE_02 ➔ HURA_01)', NULL, '2026-04-22 08:36:15'),
(111, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Hura layercake vị dâu (Có thay đổi Mã SP: CAKE_03 ➔ HURA_02)', NULL, '2026-04-22 08:36:36'),
(112, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Kami Tảo Biển (Có thay đổi Mã SP: CAKE_04 ➔ KAMI_01)', NULL, '2026-04-22 08:36:56'),
(113, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic ', NULL, '2026-04-22 09:11:41'),
(114, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Hura layercake vị dâu', NULL, '2026-04-23 07:59:15'),
(115, 'lamadmin', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Quy Nhơn Xanh (ID: 6)', '194.95.87.11', '2026-04-23 08:08:39'),
(116, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #13) | NCC: Quy Nhơn Xanh | Gồm: SP: KOHANU_01 (SL: 26), SP: LAMA_05 (SL: 25), SP: LAMA_02 (SL: 2), SP: LAMA_01 (SL: 1), SP: LAMA_04 (SL: 13), SP: LAMA_07 (SL: 2), SP: LAMA_06 (SL: 3), SP: KG_01 (SL: 6) | Tổng: 8.675.000đ (Thuế: 0đ, CK: 2.168.000đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.87.11', '2026-04-23 08:09:23'),
(117, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Hạt Macca Bazan (Có thay đổi Mã SP: KOHANU_01 ➔ KOHA_01)', NULL, '2026-04-23 08:48:59'),
(118, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #14) | NCC: Quy Nhơn Xanh | Gồm: SP: LAMA_01 (SL: 9), SP: LAMA_02 (SL: 1), SP: CPIE_01 (SL: 44), SP: HURA_02 (SL: 23), SP: HURA_01 (SL: 10), SP: TQ_01 (SL: 3) | Tổng: 4.416.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.87.11', '2026-04-23 09:03:27'),
(119, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #15) | NCC: Quy Nhơn Xanh | Gồm: SP: KOHA_01 (SL: 4) | Tổng: 480.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.87.11', '2026-04-23 09:05:27'),
(120, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #16) | NCC: Quy Nhơn Xanh | Gồm: SP: KAMI_01 (SL: 14), SP: CPIE_01 (SL: 14) | Tổng: 1.198.400đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.83.201', '2026-04-23 09:52:46'),
(121, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #17) | NCC: Quy Nhơn Xanh | Gồm: SP: QNX_01 (SL: 5) | Tổng: 360.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.83.201', '2026-04-23 10:18:01'),
(122, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #18) | NCC: Quy Nhơn Xanh | Gồm: SP: DUL_02 (SL: 14) | Tổng: 1.008.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '194.95.83.201', '2026-04-23 10:22:11'),
(123, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #39 - Tổng tiền: 2.810.000đ', '14.245.204.254', '2026-04-23 10:24:40'),
(124, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #40 - Tổng tiền: 1.360.000đ', '14.245.204.254', '2026-04-23 10:26:18'),
(125, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #41 - Tổng tiền: 84.000đ', '14.245.204.254', '2026-04-23 10:27:12'),
(126, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #42 - Tổng tiền: 200.000đ', '14.245.204.254', '2026-04-23 10:27:25'),
(127, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Hạt Macca Bazan', NULL, '2026-04-24 02:36:30'),
(128, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Hura layercake vị bơ sữa', NULL, '2026-04-24 02:41:06'),
(129, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Tinh Bột Nghệ (250gram)', NULL, '2026-04-24 02:48:38'),
(130, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Tinh Bột Nghệ (250gram)', NULL, '2026-04-24 02:48:54'),
(131, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #43 - Tổng tiền: 100.000đ', '14.245.204.254', '2026-04-24 02:56:53'),
(132, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #43. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.170.129.73', '2026-04-24 03:22:00'),
(133, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #44) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 5), Bánh tráng nước dừa (Vị Quê) (SL: 5) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: khách sạn Hải Âu', '113.170.129.73', '2026-04-24 03:22:19'),
(134, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #45) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Bánh tráng nước dừa (Vị Quê) (SL: 1), Bánh tráng gạo mè (Vị Quê) (SL: 1), Đậu phộng tỏi ớt (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Khách sạn Fleur de Lys', '113.170.129.73', '2026-04-24 03:26:24'),
(135, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cty Lộc Tín (SĐT: ., Đ/c: .)', '14.245.204.254', '2026-04-24 10:18:47'),
(136, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #46) | Đại lý: Cty Lộc Tín | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 50), Bánh tráng nước dừa (Vị Quê) (SL: 50) | Tổng: 650.000đ | Đã thu: 650.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.245.204.254', '2026-04-24 10:21:57'),
(137, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #47) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: chào mẫu khách sg', '113.170.129.73', '2026-04-25 08:15:36'),
(148, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #53) | Đại lý: Nhà hàng 114 Xuân Diệu - Anh Tài | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 150), Bánh tráng nước dừa (Vị Quê) (SL: 25) | Tổng: 1.020.000đ | Đã thu: 0đ | Còn nợ: 1.020.000đ | Ghi chú: Tặng nhà hàng 114 Xuân Diệu 25 gói mè', '113.170.129.73', '2026-04-27 09:04:06'),
(149, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Vợ Sụi (SĐT: 0901134487, Đ/c: 212 Nguyễn Thị Minh Khai, Quy Nhơn)', '113.170.129.73', '2026-04-27 12:59:13'),
(150, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #54) | Đại lý: Vợ Sụi | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 26), Bánh tráng nước dừa (Vị Quê) (SL: 26) | Tổng: 339.986đ | Đã thu: 340.000đ | Còn nợ: 0đ | Ghi chú: Khuyến mãi 1 gói mè 1 gói dừa', '113.170.129.73', '2026-04-27 13:04:11'),
(151, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #55) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: chào mẫu dùng thử, chị Linh GL Intel', '113.170.129.73', '2026-04-27 13:06:06'),
(152, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #56) | Đại lý: Vợ Sụi | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 25), Bánh tráng nước dừa (Vị Quê) (SL: 25) | Tổng: 340.000đ | Đã thu: 340.000đ | Còn nợ: 0đ | Ghi chú: Không có', '14.245.204.254', '2026-04-28 01:46:15'),
(153, 'khuong', 'Thêm khách hàng', 'Thêm khách lẻ mới: cô Nhi chủ spa (SĐT: 0984364654)', '14.245.204.254', '2026-04-28 01:49:48'),
(154, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #57 - Tổng tiền: 90.480đ', '14.245.204.254', '2026-04-28 01:49:52'),
(155, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #58) | Đại lý: Anh Huy Giám Đốc Nhà Hàng 03 Trần Phú | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 300), Bánh tráng nước dừa (Vị Quê) (SL: 50) | Tổng: 2.040.000đ | Đã thu: 0đ | Còn nợ: 2.040.000đ | Ghi chú: tặng 1 thùng dừa', '113.170.129.73', '2026-04-28 04:44:27'),
(156, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe vị nguyên bản 3in1 (1,6kg)', NULL, '2026-04-28 09:48:15'),
(157, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cà phê latte (không ngọt) (Có thay đổi Mã SP: LAMA_103 ➔ LAMA_10)', NULL, '2026-04-29 08:10:14'),
(158, 'lamadmin2', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #59 - Tổng tiền: 243.000đ', '149.40.54.137', '2026-04-29 10:36:56'),
(159, 'lamadmin2', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #60 - Tổng tiền: 297.000đ', '149.40.54.137', '2026-04-29 10:38:35'),
(160, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #61) | Đại lý: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 20), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 20), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 20), Snack bánh tráng nướng Sachi phủ khô bò (SL: 20), Snack bánh tráng nướng Sachi phủ rong biển (SL: 20), Snack bánh tráng Sachi phủ phô mai (SL: 20) | Tổng: 1.020.000đ | Đã thu: 0đ | Còn nợ: 1.020.000đ | Ghi chú: Không có', '149.40.54.137', '2026-04-29 10:44:15'),
(161, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #59. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '149.40.54.137', '2026-04-29 10:46:18'),
(162, 'lamadmin2', 'Thu công nợ', 'Thu 780,000 đ tiền công nợ của khách: Vân (hàng xóm) (ID: 2)', '113.170.129.73', '2026-05-03 10:17:25'),
(163, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #62) | Đại lý: Hằng 28 Ngô Mây | Gồm: Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 20), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 20), Snack bánh tráng nướng Sachi phủ khô bò (SL: 20), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 20), Snack bánh tráng nướng Sachi phủ rong biển (SL: 20), Bánh tráng gạo mè (Vị Quê) (SL: 5) | Tổng: 900.000đ | Đã thu: 0đ | Còn nợ: 900.000đ | Ghi chú: Không có', '113.170.129.73', '2026-05-04 04:17:24'),
(164, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #63 - Tổng tiền: 510.000đ', '14.245.204.254', '2026-05-04 09:01:40'),
(165, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #64 - Tổng tiền: 28.000đ', '14.245.204.254', '2026-05-04 10:07:49'),
(166, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Tinh Bột Nghệ Sẻ (250gram)', NULL, '2026-05-04 10:49:51'),
(167, 'lamadmin2', 'Thu công nợ', 'Thu 900,000 đ tiền công nợ của khách: Hằng 28 Ngô Mây (ID: 7)', '113.170.129.73', '2026-05-05 08:58:10'),
(168, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #19) | NCC: Sachi | Gồm: SP: SACHI-03 (SL: 39), SP: SACHI-04 (SL: 37), SP: SACHI-06 (SL: 42), SP: SACHI-02 (SL: 39), SP: SACHI-05 (SL: 66) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng được tặng làm chương trình', '113.170.129.73', '2026-05-05 09:29:49'),
(169, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Mật ong Bee T', NULL, '2026-05-05 09:35:26'),
(170, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Mật ong Bee T 500ml', NULL, '2026-05-05 09:39:07'),
(171, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Tinh bột nghệ mật ong rừng (Có thay đổi Mã SP: ANLAO_02 ➔ ANLAO_03)', NULL, '2026-05-05 09:39:31'),
(172, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Thôn Xuân Bắc, xã An Hòa, tỉnh Gia Lai (ID: 7)', '113.170.129.73', '2026-05-05 09:44:24'),
(173, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #20) | NCC: Thôn Xuân Bắc, xã An Hòa, tỉnh Gia Lai | Gồm: SP: ANLAO_02 (SL: 10) | Tổng: 1.330.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-05 09:46:54'),
(174, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Mật ong Bee T 500ml', NULL, '2026-05-05 09:47:14'),
(175, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #21) | NCC: Thôn Xuân Bắc, xã An Hòa, tỉnh Gia Lai | Gồm: SP: TQ_02 (SL: 10) | Tổng: 700.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-05 09:48:57'),
(176, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: CAZIN (ID: 8)', '113.170.129.73', '2026-05-05 10:07:56'),
(177, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Viên tinh nghệ mật ong rừng', NULL, '2026-05-06 08:13:52'),
(178, 'lamadmin2', 'Thu công nợ', 'Thu 1,020,000 đ tiền công nợ của khách: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí (ID: 19)', '113.170.129.73', '2026-05-06 08:27:11'),
(179, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Bánh Thuyền Hạt -  chị Kiều (ID: 9)', '113.170.129.73', '2026-05-06 08:32:54'),
(180, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Macca-Kon Hà Nừng (ID: 10)', '113.170.129.73', '2026-05-06 08:33:11'),
(181, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Trà nụ hoa hòe, dầu mè, đậu phộng - Lai (ID: 11)', '113.170.129.73', '2026-05-06 08:35:20'),
(182, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Nghệ, mật ong - Thảo (ID: 12)', '113.170.129.73', '2026-05-06 08:35:34'),
(183, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Bún, miến - Đông (ID: 13)', '113.170.129.73', '2026-05-06 08:35:54'),
(184, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: CF Đak Yang (nhà máy) (ID: 14)', '113.170.129.73', '2026-05-06 08:36:48'),
(185, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #22) | NCC: Trà nụ hoa hòe, dầu mè, đậu phộng - Lai | Gồm: SP: DUL_01 (SL: 10), SP: DUL_02 (SL: 1) | Tổng: 833.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:30:44'),
(186, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #23) | NCC: CAZIN | Gồm: SP: CAZIN_01 (SL: 3), SP: CAZIN_02 (SL: 5) | Tổng: 784.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:33:08'),
(187, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #24) | NCC: Quy Nhơn Xanh | Gồm: SP: QNX_01 (SL: 2) | Tổng: 126.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:35:08'),
(188, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #25) | NCC: Lamant | Gồm: SP: TQ_01 (SL: 1) | Tổng: 140.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:38:28'),
(189, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #26) | NCC: Lamant | Gồm: SP: LAMA_03 (SL: 3), SP: LAMA_04 (SL: 12), SP: LAMA_09 (SL: 27), SP: LAMA_05 (SL: 3), SP: LAMA_11 (SL: 40), SP: LAMA_13 (SL: 24), SP: LAMA_12 (SL: 24), SP: LAMA_10 (SL: 24), SP: LAMA_08 (SL: 3) | Tổng: 7.239.400đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:55:19'),
(190, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #27) | NCC: Trà nụ hoa hòe, dầu mè, đậu phộng - Lai | Gồm: SP: DULAH_01 (SL: 5) | Tổng: 297.500đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 09:57:56'),
(191, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic hộp thiếc', NULL, '2026-05-06 10:02:16'),
(192, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #28) | NCC: Lamant | Gồm: SP: LAMA_08 (SL: 1) | Tổng: 230.300đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-06 10:09:42'),
(193, 'lamadmin2', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: HTX Hoài Ân - anh Việt (ID: 15)', '113.170.129.73', '2026-05-07 08:34:28'),
(194, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #29) | NCC: HTX Hoài Ân - anh Việt | Gồm: SP: QNX_01 (SL: 15) | Tổng: 1.039.500đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-07 08:36:13'),
(195, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #30) | NCC: HTX Hoài Ân - anh Việt | Gồm: SP: GAO_01 (SL: 2) | Tổng: 230.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-07 08:39:58'),
(196, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Snack bánh tráng nướng Sachi phủ tôm nướng', NULL, '2026-05-07 08:49:09'),
(197, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Chùa Hiển Nam (SĐT: 12345678, Đ/c: 03 Trần Thị Kỷ)', '113.170.129.73', '2026-05-12 08:08:42'),
(198, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #65) | Đại lý: Chùa Hiển Nam | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 100), Bánh tráng cuốn gạo giòn Sachi (100g) (SL: 10), Bánh tráng nước dừa (Vị Quê) (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 100), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Đậu phộng tỏi ớt (SL: 20) | Tổng: 2.135.400đ | Đã thu: 0đ | Còn nợ: 2.135.400đ | Ghi chú: bill 1 bánh tráng và đậu phộng (chùa Hiển Nam)', '113.170.129.73', '2026-05-12 08:13:55'),
(199, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #66 - Tổng tiền: 85.000đ', '14.245.204.254', '2026-05-12 09:12:32'),
(200, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #67 - Tổng tiền: 190.000đ', '14.245.204.254', '2026-05-12 09:20:31'),
(201, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Thuyền Hạt Khánh Giang 200g Gói', NULL, '2026-05-12 09:42:30'),
(202, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh Thuyền Hạt Khánh Giang 200g Gói', NULL, '2026-05-12 09:44:17'),
(203, 'khuong', 'Xóa sản phẩm', 'Đã xóa sản phẩm: Bún ngô (ID: #KICA_01)', '14.245.204.254', '2026-05-12 10:14:22'),
(204, 'lamadmin2', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cô Ngọc (SĐT: 0906754550, Đ/c: Trường Quốc Tế SG)', '113.170.129.73', '2026-05-12 13:05:51'),
(205, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #68) | Đại lý: Cô Ngọc | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 50), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 50), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 100) | Tổng: 3.000.000đ | Đã thu: 3.000.000đ | Còn nợ: 0đ | Ghi chú: Không có', '113.170.129.73', '2026-05-12 13:07:10'),
(206, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #31) | NCC: Quy Nhơn Xanh | Gồm: SP: PA_03 (SL: 6) | Tổng: 168.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.245.204.254', '2026-05-13 08:20:34'),
(207, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Dầu đậu phộng Dullah 1l', NULL, '2026-05-13 09:01:02'),
(208, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Dầu đậu phộng Dullah 1l', NULL, '2026-05-13 09:01:26'),
(209, 'lamadmin2', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bún khô (Có thay đổi Mã SP: KIKAFOOD_02 ➔ KICAFOOD_02)', NULL, '2026-05-13 09:07:24'),
(210, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #32) | NCC: Quy Nhơn Xanh | Gồm: SP: TN_01 (SL: 9), SP: PA_03 (SL: 11), SP: PA_01 (SL: 11), SP: PA_02 (SL: 10), SP: ANLAO_01 (SL: 4) | Tổng: 2.121.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-13 09:25:34'),
(211, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Hũ bánh Phục Linh', NULL, '2026-05-13 10:30:25'),
(212, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nhúng Gạo mè đen Sachi', NULL, '2026-05-14 09:15:06'),
(213, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nhúng Gạo mè đen Sachi', NULL, '2026-05-14 09:21:11'),
(214, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bún khô', NULL, '2026-05-14 09:28:38'),
(215, 'khuong', 'Xóa sản phẩm', 'Đã xóa sản phẩm: Dầu đậu phộng Dullah 1l (ID: DULAH_02)', '14.233.144.151', '2026-05-14 09:41:37'),
(216, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Dầu đậu phộng  (Có thay đổi Mã SP: DULAH_03 ➔ DULAH_02)', NULL, '2026-05-14 09:41:57'),
(217, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Trà Tía Tô 80g', NULL, '2026-05-14 09:44:23'),
(218, 'khuong', 'Xóa sản phẩm', 'Đã xóa sản phẩm: Gói trà tía tô CAZIN ...g (ID: CAZIN_04)', '14.233.144.151', '2026-05-14 09:44:39'),
(219, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Viên tinh nghệ mật ong rừng 150g', NULL, '2026-05-14 09:45:08'),
(220, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh tráng nhúng Gạo mè đen Sachi 120g', NULL, '2026-05-14 09:48:35'),
(221, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #69 - Tổng tiền: 140.000đ', '14.233.144.151', '2026-05-14 10:09:07'),
(222, 'lamadmin2', 'Nhập hàng', 'Nhập kho (Phiếu #33) | NCC: Sachi | Gồm: SP: SACHI-02 (SL: 50) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '113.170.129.73', '2026-05-14 10:29:05'),
(223, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #71) | Đại lý: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 50), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 50), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 400) | Tổng: 5.525.000đ | Đã thu: 0đ | Còn nợ: 5.525.000đ | Ghi chú: Không có', '113.170.129.73', '2026-05-14 10:30:09'),
(224, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #72) | Đại lý: Chùa Hiển Nam | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 550) | Tổng: 3.905.000đ | Đã thu: 0đ | Còn nợ: 3.905.000đ | Ghi chú: đơn snack chùa hiển nam giá gốc', '113.170.129.73', '2026-05-14 10:32:13'),
(225, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #73) | Đại lý: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 50) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: hàng KM', '113.170.129.73', '2026-05-14 10:38:34'),
(226, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #74) | Đại lý: Chào mẫu/Dùng Thử | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 1), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 1), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 1), Snack bánh tráng nướng Sachi phủ khô bò (SL: 1), Snack bánh tráng nướng Sachi phủ rong biển (SL: 1), Snack bánh tráng Sachi phủ phô mai (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.170.129.73', '2026-05-14 10:42:33'),
(227, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #72. Hệ thống đã tự động hoàn kho và trừ nợ (3.905.000 đ).', '113.170.129.73', '2026-05-14 10:48:47'),
(228, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #71. Hệ thống đã tự động hoàn kho và trừ nợ (5.525.000 đ).', '113.170.129.73', '2026-05-14 10:49:12'),
(229, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #75) | Đại lý: Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí | Gồm: Snack bánh tráng nướng Sachi phủ mực nướng (SL: 50), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 50), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 50), Snack bánh tráng nướng Sachi phủ khô bò (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Snack bánh tráng Sachi phủ phô mai (SL: 350) | Tổng: 5.100.000đ | Đã thu: 0đ | Còn nợ: 5.100.000đ | Ghi chú: Không có', '113.170.129.73', '2026-05-14 10:51:01'),
(230, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #76) | Đại lý: Chùa Hiển Nam | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 550) | Tổng: 3.905.000đ | Đã thu: 0đ | Còn nợ: 3.905.000đ | Ghi chú: Không có', '113.170.129.73', '2026-05-14 11:47:34'),
(231, 'lamadmin2', 'Hủy đơn hàng', 'Hủy hóa đơn #76. Hệ thống đã tự động hoàn kho và trừ nợ (3.905.000 đ).', '113.170.129.73', '2026-05-14 11:48:22'),
(232, 'lamadmin2', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #77) | Đại lý: Chùa Hiển Nam | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 550) | Tổng: 3.905.000đ | Đã thu: 0đ | Còn nợ: 3.905.000đ | Ghi chú: Kí gửi từ thiện chùa Hiển Nam, giá gốc', '113.170.129.73', '2026-05-14 11:48:48'),
(233, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bún khô', NULL, '2026-05-15 09:07:21'),
(234, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #78 - Tổng tiền: 190.000đ', '14.233.144.151', '2026-05-15 09:25:01'),
(235, 'khuong', 'Thêm khách hàng', 'Thêm khách lẻ mới: Cô Vân (SĐT: 0935241158)', '14.233.144.151', '2026-05-15 09:49:42'),
(236, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #79 - Tổng tiền: 700.000đ', '14.233.144.151', '2026-05-15 09:50:32'),
(237, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #79. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-15 09:51:41'),
(238, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #80 - Tổng tiền: 490.000đ', '14.233.144.151', '2026-05-15 10:54:37'),
(239, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #34) | NCC: Trà nụ hoa hòe, dầu mè, đậu phộng - Lai | Gồm: SP: DULAH_02 (SL: 5) | Tổng: 455.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Ngày 24 tháng 4 năm 2026', '14.233.144.151', '2026-05-16 08:10:59'),
(240, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #81 - Tổng tiền: 70.000đ', '14.233.144.151', '2026-05-16 08:45:27'),
(241, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Trà nụ hoa hòe - Hộp thiếc (Có thay đổi Mã SP: DUL_01 ➔ DULAH_03)', NULL, '2026-05-16 09:52:23'),
(242, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Trà nụ hoa hòe - Túi lọc (Có thay đổi Mã SP: DUL_02 ➔ DULAH_04)', NULL, '2026-05-16 09:52:49'),
(243, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Rượu xoa bóp 420ml (Có thay đổi Mã SP: THANHLIEM_0 ➔ THANHLIEM_01)', NULL, '2026-05-16 10:28:15'),
(244, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Rượu xoa bóp 420ml (Có thay đổi Mã SP: THANHLIEM_0 ➔ THANHLIEM_01)', NULL, '2026-05-16 10:28:37'),
(245, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Rượu xoa bóp 420ml (Có thay đổi Mã SP: THANHLIEM_0 ➔ TL_01)', NULL, '2026-05-16 10:29:15');
INSERT INTO `activity_logs` (`id`, `username`, `action`, `details`, `ip_address`, `created_at`) VALUES
(246, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #35) | NCC: CAZIN | Gồm: SP: CAZIN_03 (SL: 30) | Tổng: 1.200.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-19 01:41:26'),
(247, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #82 - Tổng tiền: 65.000đ', '14.233.144.151', '2026-05-19 01:41:41'),
(248, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #83 - Tổng tiền: 1.980.000đ', '14.233.144.151', '2026-05-19 02:06:28'),
(249, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #84 - Tổng tiền: 570.000đ', '14.233.144.151', '2026-05-19 02:54:07'),
(250, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #84. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-19 03:01:49'),
(251, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh canh rau củ vị LÁ CẨM', NULL, '2026-05-19 03:47:41'),
(252, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: VIDATA (ID: 16)', '14.233.144.151', '2026-05-19 03:54:00'),
(253, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #36) | NCC: VIDATA | Gồm: SP: VIDATA_02 (SL: 2), SP: VIDATA_05 (SL: 1), SP: VIDATA_03 (SL: 1), SP: VIDATA_04 (SL: 1) | Tổng: 175.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-19 03:57:14'),
(254, 'lamadmin', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Anya (ID: 17)', '92.208.106.166', '2026-05-20 08:34:32'),
(255, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #37) | NCC: Anya | Gồm: SP: SACHI-02 (SL: 3) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Đổi hàng ngày 18/5 lấy 3 rong biển đổi phô mai', '92.208.106.166', '2026-05-20 08:35:16'),
(256, 'lamadmin', 'Thêm khách hàng', 'Thêm khách sỉ mới: Tuấn Chợ Đêm (SĐT: 0905510657, Đ/c: Chợ Đêm)', '92.208.106.166', '2026-05-20 08:39:13'),
(257, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #38) | NCC: Anya | Gồm: SP: SACHI-02 (SL: 147) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Đổi hàng ngày 18/5 lấy 3 rong biển đổi phô mai', '92.208.106.166', '2026-05-20 08:40:58'),
(258, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #87) | Đại lý: Tuấn Chợ Đêm | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 50), Snack bánh tráng nướng Sachi phủ rong biển (SL: 50), Bánh tráng nước dừa (Vị Quê) (SL: 25), Bánh tráng gạo mè (Vị Quê) (SL: 25), Đậu phộng tỏi ớt (SL: 30) | Tổng: 1.560.000đ | Đã thu: 0đ | Còn nợ: 1.560.000đ | Ghi chú: Free ship + 1 kệ i nóc 4 tầng', '92.208.106.166', '2026-05-20 08:43:36'),
(259, 'lamadmin', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #88) | Đại lý: Cường - Anya 4 sao | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 150) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: đổi 3 thùng rong biển sang 3 thùng phô mai', '92.208.106.166', '2026-05-20 08:49:39'),
(260, 'lamadmin', 'Nhập hàng', 'Nhập kho (Phiếu #39) | NCC: Quy Nhơn Xanh | Gồm: SP: DULAH_03 (SL: 30), SP: DULAH_04 (SL: 15), SP: DULAH_01 (SL: 5) | Tổng: 3.552.500đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Hàng đã nhập từ trước', '92.208.106.166', '2026-05-20 08:59:39'),
(261, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #40) | NCC: VIDATA | Gồm: SP: VIDATA_01 (SL: 5) | Tổng: 175.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:01:04'),
(262, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #41) | NCC: Quy Nhơn Xanh | Gồm: SP: PL_01 (SL: 34) | Tổng: 1.547.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:04:02'),
(263, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: KICAFOOD (ID: 18)', '14.233.144.151', '2026-05-21 02:09:26'),
(264, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #42) | NCC: KICAFOOD | Gồm: SP: KICAFOOD_01 (SL: 10), SP: KICAFOOD_02 (SL: 10) | Tổng: 400.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 2/5/2026', '14.233.144.151', '2026-05-21 02:09:33'),
(265, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Bánh thuyền hạt HỘP 200G', NULL, '2026-05-21 02:10:44'),
(266, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #43) | NCC: Bánh Thuyền Hạt -  chị Kiều | Gồm: SP: KG_01 (SL: 14), SP: KG_03 (SL: 10), SP: KG_02 (SL: 10) | Tổng: 2.302.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 10/5/2026', '14.233.144.151', '2026-05-21 02:13:33'),
(267, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Rượu xoa bóp THANHLIEM 420ml', NULL, '2026-05-21 02:15:11'),
(268, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Rượu xoa bóp THANHLIEM 100ml', NULL, '2026-05-21 02:15:34'),
(269, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: CÔNG TY TNHH Vĩnh Hiệp (ID: 19)', '14.233.144.151', '2026-05-21 02:19:43'),
(270, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #44) | NCC: CÔNG TY TNHH Vĩnh Hiệp | Gồm: SP: VH_01 (SL: 3) | Tổng: 210.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:19:52'),
(271, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: Mười Dũng (ID: 20)', '14.233.144.151', '2026-05-21 02:22:07'),
(272, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #45) | NCC: Mười Dũng | Gồm: SP: MD_01 (SL: 9) | Tổng: 630.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:22:13'),
(273, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: THANHLIEM (ID: 21)', '14.233.144.151', '2026-05-21 02:31:22'),
(274, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #46) | NCC: THANHLIEM | Gồm: SP: TL_02 (SL: 7), SP: TL_01 (SL: 2) | Tổng: 1.085.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: Không có', '14.233.144.151', '2026-05-21 02:31:29'),
(275, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #47) | NCC: CAZIN | Gồm: SP: CAZIN_04 (SL: 4) | Tổng: 126.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:35:53'),
(276, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #48) | NCC: Trà nụ hoa hòe, dầu mè, đậu phộng - Lai | Gồm: SP: DULAH_06 (SL: 3), SP: DULAH_05 (SL: 8), SP: DULAH_07 (SL: 2) | Tổng: 2.240.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 02:42:56'),
(277, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #49) | NCC: Nghệ, mật ong - Thảo | Gồm: SP: ANLAO_03 (SL: 2) | Tổng: 210.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '14.233.144.151', '2026-05-21 03:29:43'),
(278, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #89 - Tổng tiền: 14.000đ', '14.233.144.151', '2026-05-21 07:46:31'),
(279, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #90 - Tổng tiền: 14.000đ', '14.233.144.151', '2026-05-21 07:47:06'),
(280, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #91 - Tổng tiền: 14.000đ', '14.233.144.151', '2026-05-21 08:45:29'),
(281, 'lamadmin2', 'Thu công nợ', 'Thu 1,104,000 đ tiền công nợ của khách: Nguyễn Xuân Hiếu - Anya 5 sao (ID: 1)', '113.170.129.73', '2026-05-21 08:56:09'),
(282, 'lamadmin2', 'Thu công nợ', 'Thu 604,800 đ tiền công nợ của khách: Cường - Anya 4 sao (ID: 5)', '113.170.129.73', '2026-05-21 08:56:46'),
(283, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #92 - Tổng tiền: 42.000đ', '14.233.144.151', '2026-05-22 09:33:23'),
(284, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #93 - Tổng tiền: 10.000đ', '14.233.144.151', '2026-05-23 02:16:09'),
(285, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #94 - Tổng tiền: 195.000đ', '14.233.144.151', '2026-05-25 02:13:44'),
(286, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cô Tâm (SĐT: 0918268889, Đ/c: 35 lê xuân trữ)', '14.233.144.151', '2026-05-25 07:55:43'),
(287, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #95) | Đại lý: Cô Tâm | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 450) | Tổng: 3.150.000đ | Đã thu: 0đ | Còn nợ: 3.150.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-25 07:56:23'),
(288, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #96) | Đại lý: Cô Tâm | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 450) | Tổng: 3.150.000đ | Đã thu: 0đ | Còn nợ: 3.150.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-25 07:57:22'),
(289, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #96. Hệ thống đã tự động hoàn kho và trừ nợ (3.150.000 đ).', '14.233.144.151', '2026-05-25 07:58:06'),
(290, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #98 - Tổng tiền: 1.419.200đ', '14.233.144.151', '2026-05-26 09:01:53'),
(291, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cô Hoa (SĐT: 0787164491, Đ/c: 141 Trần Cao Vân)', '14.233.144.151', '2026-05-26 09:37:55'),
(292, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #102) | Đại lý: Cô Hoa | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 25), Snack bánh tráng nướng Sachi phủ rong biển (SL: 25) | Tổng: 450.000đ | Đã thu: 0đ | Còn nợ: 450.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-26 09:38:22'),
(293, 'lamadmin2', 'Thu công nợ', 'Thu 3,264,000 đ tiền công nợ của khách: Anh Huy Giám Đốc Nhà Hàng 03 Trần Phú (ID: 12)', '113.170.129.35', '2026-05-26 15:08:30'),
(294, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: Cô Lợi (SĐT: 0915203034, Đ/c: 86 Hà Huy Tập)', '14.233.144.151', '2026-05-27 01:34:15'),
(295, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #103) | Đại lý: Cô Lợi | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 300) | Tổng: 2.100.000đ | Đã thu: 0đ | Còn nợ: 2.100.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-27 01:34:48'),
(296, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #104 - Tổng tiền: 190.000đ', '14.233.144.151', '2026-05-27 01:48:38'),
(297, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #105 - Tổng tiền: 48.000đ', '14.233.144.151', '2026-05-27 01:53:07'),
(298, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #105. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-27 02:09:21'),
(299, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #104. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-27 02:09:39'),
(300, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #106 - Tổng tiền: 48.000đ', '14.233.144.151', '2026-05-27 02:10:12'),
(301, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #107 - Tổng tiền: 1.045.600đ', '14.233.144.151', '2026-05-27 02:18:35'),
(302, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #107. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-27 02:24:32'),
(303, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #108 - Tổng tiền: 1.767.000đ', '14.233.144.151', '2026-05-27 02:28:58'),
(304, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #108. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '14.233.144.151', '2026-05-27 02:29:55'),
(305, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #109 - Tổng tiền: 1.413.600đ', '14.233.144.151', '2026-05-27 02:36:20'),
(306, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #50) | NCC: Sachi | Gồm: SP: SACHI-07 (SL: 150), SP: SACHI-08 (SL: 250) | Tổng: 2.720.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 20/5/2026', '14.233.144.151', '2026-05-27 03:26:39'),
(307, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #110) | Đại lý: Nhà hàng 114 Xuân Diệu - Anh Tài | Gồm: Bánh tráng gạo mè (Vị Quê) (SL: 150), Bánh tráng nước dừa (Vị Quê) (SL: 100) | Tổng: 1.700.000đ | Đã thu: 0đ | Còn nợ: 1.700.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-27 03:28:02'),
(308, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #95. Hệ thống đã tự động hoàn kho và trừ nợ (3.150.000 đ).', '14.233.144.151', '2026-05-27 08:08:58'),
(309, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #111) | Đại lý: Cô Tâm | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 490) | Tổng: 3.430.000đ | Đã thu: 0đ | Còn nợ: 3.430.000đ | Ghi chú: Không có', '14.233.144.151', '2026-05-27 08:11:29'),
(310, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #113 - Tổng tiền: 14.000đ', '14.233.144.151', '2026-05-28 03:47:52'),
(311, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #114 - Tổng tiền: 0đ', '14.233.144.151', '2026-05-28 03:48:39'),
(312, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #115 - Tổng tiền: 9.000đ', '14.233.144.151', '2026-05-28 03:49:49'),
(313, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #116 - Tổng tiền: 4.560.000đ', '14.233.144.151', '2026-05-31 03:56:10'),
(314, 'khuong', 'Thêm khách hàng', 'Thêm khách lẻ mới: Hồng (SĐT: 123456)', '14.233.144.151', '2026-06-01 09:07:46'),
(315, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #117 - Tổng tiền: 320.000đ', '14.233.144.151', '2026-06-01 09:07:55'),
(316, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #118 - Tổng tiền: 406.400đ', '14.233.144.151', '2026-06-01 12:41:48'),
(317, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe vị nguyên bản 3in1 (1,6kg)', NULL, '2026-06-02 03:10:45'),
(318, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic hộp thiếc', NULL, '2026-06-02 08:27:53'),
(319, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic hộp thiếc', NULL, '2026-06-02 08:29:10'),
(320, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #118. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.174.244.222', '2026-06-02 08:45:38'),
(321, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #119 - Tổng tiền: 246.400đ', '113.174.244.222', '2026-06-02 08:46:53'),
(322, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #98. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.174.244.222', '2026-06-02 09:13:52'),
(323, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #51) | NCC: Bún, miến - Đông | Gồm: SP: PA_01 (SL: 1) | Tổng: 2.800đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '113.174.244.222', '2026-06-02 10:02:30'),
(324, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #120 - Tổng tiền: 10.225.000đ', '113.174.244.222', '2026-06-02 10:11:01'),
(325, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #121 - Tổng tiền: 903.200đ', '113.174.244.222', '2026-06-02 10:22:22'),
(326, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #122 - Tổng tiền: 1.165.000đ', '113.174.244.222', '2026-06-02 10:27:47'),
(327, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #123 - Tổng tiền: 400.000đ', '113.174.244.222', '2026-06-03 07:57:27'),
(328, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: Đại lý (SĐT: 0123456, Đ/c: 123456)', '113.174.244.222', '2026-06-04 01:49:54'),
(329, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #124) | Đại lý: Đại lý | Gồm: Cà phê Lamant truyền thống (500gram) (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: note', '113.174.244.222', '2026-06-04 01:50:02'),
(330, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #125) | Đại lý: Đại lý | Gồm: Cà phê Lamant phin nhẹ (500gram) (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.174.244.222', '2026-06-04 01:54:41'),
(331, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #52) | NCC: Lamant | Gồm: SP: LAMA_02 (SL: 1) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '113.174.244.222', '2026-06-04 01:55:34'),
(332, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #126 - Tổng tiền: 1.648.000đ', '113.174.244.222', '2026-06-04 02:05:20'),
(333, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-06-04 02:20:18'),
(334, 'khuong', 'Xóa sản phẩm', 'Đã xóa sản phẩm: Cà phê Lamant phin nhẹ (250gram) (ID: LAMA_02)', '113.174.244.222', '2026-06-04 02:21:23'),
(335, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant truyền thống (500gram)', NULL, '2026-06-04 02:21:35'),
(336, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant PHIN truyền thống (1KG) (Có thay đổi Mã SP: LAMA_03 ➔ LAMA_02)', NULL, '2026-06-04 02:23:09'),
(337, 'khuong', 'Xóa sản phẩm', 'Đã xóa sản phẩm: Cà phê Phin Truyền Thống-1KG (ID: LAMA_14)', '113.174.244.222', '2026-06-04 02:23:20'),
(338, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant PHIN truyền thống (1KG)', NULL, '2026-06-04 02:24:19'),
(339, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe vị nguyên bản 3in1 (Có thay đổi Mã SP: LAMA_04 ➔ LAMA_03)', NULL, '2026-06-04 02:24:39'),
(340, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant cafe túi lọc đặc sản (Có thay đổi Mã SP: LAMA_05 ➔ LAMA_04)', NULL, '2026-06-04 02:24:59'),
(341, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic  (Có thay đổi Mã SP: LAMA_06 ➔ LAMA_05)', NULL, '2026-06-04 02:25:20'),
(342, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe Fine Organic hộp thiếc (Có thay đổi Mã SP: LAMA_07 ➔ LAMA_06)', NULL, '2026-06-04 02:25:48'),
(343, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Lamant Cafe vị nguyên bản 3in1 (1,6kg) (Có thay đổi Mã SP: LAMA_08 ➔ LAMA_07)', NULL, '2026-06-04 02:26:05'),
(344, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cappuchino dừa (Có thay đổi Mã SP: LAMA_09 ➔ LAMA_08)', NULL, '2026-06-04 02:26:25'),
(345, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cà phê latte (không ngọt) (Có thay đổi Mã SP: LAMA_10 ➔ LAMA_9)', NULL, '2026-06-04 02:26:44'),
(346, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Pure Black (Có thay đổi Mã SP: LAMA_11 ➔ LAMA_09)', NULL, '2026-06-04 02:28:40'),
(347, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cappuchino Socola (Có thay đổi Mã SP: LAMA_12 ➔ LAMA_10)', NULL, '2026-06-04 02:29:21'),
(348, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cà phê sữa đá (Có thay đổi Mã SP: LAMA_13 ➔ LAMA_11)', NULL, '2026-06-04 02:29:40'),
(349, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant Cà phê latte (không ngọt) (Có thay đổi Mã SP: LAMA_9 ➔ LAMA_12)', NULL, '2026-06-04 02:29:55'),
(350, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-06-04 02:33:47'),
(351, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #53) | NCC: Lamant | Gồm: SP: LAMA_02 (SL: 10), SP: LAMA_01 (SL: 20) | Tổng: 6.210.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 2/6/2026', '113.174.244.222', '2026-06-04 02:43:46'),
(352, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-06-04 02:45:13'),
(353, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-06-04 03:03:47'),
(354, 'khuong', 'Thêm Nhà cung cấp', 'Thêm nhanh NCC: HAIHACO (ID: 22)', '113.174.244.222', '2026-06-06 01:25:45'),
(355, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #54) | NCC: HAIHACO | Gồm: SP: HAIHA_01 (SL: 20), SP: HAIHA_02 (SL: 20), SP: HAIHA_03 (SL: 20) | Tổng: 2.140.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 3/6/2026', '113.174.244.222', '2026-06-06 01:27:49'),
(356, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #127 - Tổng tiền: 195.000đ', '113.174.244.222', '2026-06-09 02:21:13'),
(357, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #128) | Đại lý: Đại lý | Gồm: Trà nụ hoa hòe - Hộp thiếc (SL: 3) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.174.244.222', '2026-06-09 08:20:11'),
(358, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #129) | Đại lý: Đại lý | Gồm: Cà phê Lamant Cà phê sữa đá (SL: 1), Cà phê Lamant Cappuchino Socola (SL: 2), Cà phê Lamant Cappuchino dừa (SL: 3), Trà Hương Bưởi (SL: 1), Bánh Thuyền Hạt Khánh Giang 200g Gói (SL: 1), Bánh thuyền hạt HỘP 200G (SL: 2), Bún Tươi Phương Anh - 300g (SL: 2), Bún bò Huế cao cấp Phương Anh - 300g (SL: 6) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: NOTE', '113.174.244.222', '2026-06-09 08:34:16'),
(359, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #130) | Đại lý: Đại lý | Gồm: Trà Gò Loi (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.174.244.222', '2026-06-09 08:37:59'),
(360, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #128. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.174.244.222', '2026-06-09 08:41:20'),
(361, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #129. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.174.244.222', '2026-06-09 08:41:24'),
(362, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #130. Hệ thống đã tự động hoàn kho và trừ nợ (0 đ).', '113.174.244.222', '2026-06-09 08:41:29'),
(363, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #131) | Đại lý: Đại lý | Gồm: Trà nụ hoa hòe - Hộp thiếc (SL: 3), Cà phê Lamant Cà phê sữa đá (SL: 1), Cà phê Lamant Cappuchino Socola (SL: 2), Cà phê Lamant Cappuchino dừa (SL: 3), Lamant Cafe vị nguyên bản 3in1 (SL: 9), Bánh Thuyền Hạt Khánh Giang 200g Gói (SL: 1), Bánh thuyền hạt HỘP 200G (SL: 2), Bún bò Huế cao cấp Phương Anh - 300g (SL: 6), Bún Tươi Phương Anh - 300g (SL: 2) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.174.244.222', '2026-06-09 09:36:20'),
(364, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #132) | Đại lý: Đại lý | Gồm: Trà Gò Loi (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: Không có', '113.174.244.222', '2026-06-09 10:13:52'),
(365, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #133 - Tổng tiền: 196.000đ', '113.174.244.222', '2026-06-09 10:15:00'),
(366, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #55) | NCC: Bánh Thuyền Hạt -  chị Kiều | Gồm: SP: KG_01 (SL: 40), SP: KG_03 (SL: 20), SP: KG_02 (SL: 8) | Tổng: 4.580.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 3/6/2026', '113.174.244.222', '2026-06-09 10:34:09'),
(367, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #56) | NCC: Macca-Kon Hà Nừng | Gồm: SP: KOHA_01 (SL: 28) | Tổng: 2.940.000đ (Thuế: 0đ, CK: 0đ) | Ghi chú: 4/6/2026', '113.174.244.222', '2026-06-09 10:38:56'),
(368, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #134) | Đại lý: Đại lý | Gồm: Trà Hương Bưởi (SL: 1) | Tổng: 0đ | Đã thu: 0đ | Còn nợ: 0đ | Ghi chú: note', '113.174.244.222', '2026-06-09 10:40:08'),
(369, 'khuong', 'Nhập hàng', 'Nhập kho (Phiếu #57) | NCC: Bún, miến - Đông | Gồm: SP: PA_01 (SL: 2) | Tổng: 0đ (Thuế: 0đ, CK: 0đ) | Ghi chú: HÀNG NHẬP TỪ TRƯỚC', '113.174.244.222', '2026-06-09 10:42:24'),
(370, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #135 - Tổng tiền: 1.149.996đ', '113.174.244.222', '2026-06-10 02:24:55'),
(371, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #136 - Tổng tiền: 14.000đ', '113.174.244.222', '2026-06-10 03:18:50'),
(372, 'khuong', 'Thêm khách hàng', 'Thêm khách lẻ mới: Ánh đẹp gái (SĐT: 0000000)', '113.174.244.222', '2026-06-10 03:19:17'),
(373, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #137 - Tổng tiền: 14.000đ', '113.174.244.222', '2026-06-10 03:19:20'),
(374, 'khuong', 'Thanh toán hóa đơn', 'Đã thanh toán đơn hàng #138 - Tổng tiền: 30.000đ', '113.174.244.222', '2026-06-10 03:20:45'),
(375, 'khuong', 'Thêm khách hàng', 'Thêm khách sỉ mới: CF NYNA (SĐT: 009900, Đ/c: 223 TBH)', '113.174.244.222', '2026-06-10 08:05:41'),
(376, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #139) | Đại lý: CF NYNA | Gồm: Snack bánh tráng Sachi phủ phô mai (SL: 5), Snack bánh tráng nướng Sachi phủ rong biển (SL: 5), Snack bánh tráng nướng Sachi phủ khô bò (SL: 5), Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 5), Snack bánh tráng nướng Sachi phủ tôm nướng (SL: 5), Snack bánh tráng nướng Sachi phủ mực nướng (SL: 5) | Tổng: 300.000đ | Đã thu: 0đ | Còn nợ: 300.000đ | Ghi chú: Không có', '113.174.244.222', '2026-06-10 08:07:59'),
(377, 'khuong', 'Hủy đơn hàng', 'Hủy hóa đơn #139. Hệ thống đã tự động hoàn kho và trừ nợ (300.000 đ).', '113.174.244.222', '2026-06-10 08:39:31'),
(378, 'khuong', 'Tạo đơn sỉ', 'Bán sỉ (Đơn #140) | Đại lý: CF NYNA | Gồm: Snack bánh tráng nướng Sachi phủ chà bông gà (SL: 5), Snack bánh tráng Sachi phủ phô mai (SL: 5) | Tổng: 100.000đ | Đã thu: 0đ | Còn nợ: 100.000đ | Ghi chú: Không có', '113.174.244.222', '2026-06-10 08:40:32'),
(379, 'khuong', 'Sửa sản phẩm', 'Đã cập nhật thông tin sản phẩm: Cà phê Lamant phin nhẹ (500gram)', NULL, '2026-06-10 08:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(16, 'Bánh canh'),
(10, 'Bánh Ngọt'),
(3, 'Bánh Tráng Nhúng'),
(4, 'Bánh Tráng Nướng'),
(5, 'Bún'),
(7, 'Cà Phê'),
(13, 'Dầu ăn'),
(17, 'Gạo'),
(11, 'Hạt'),
(20, 'Kẹo'),
(15, 'Mật ong'),
(18, 'NGŨ CỐC'),
(19, 'rượu '),
(1, 'Snack (ăn vặt)'),
(14, 'Tiêu'),
(12, 'Tinh Bột'),
(6, 'Trà');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_type` enum('retail','wholesale') DEFAULT 'retail',
  `total_debt` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `telephone`, `address`, `customer_name`, `points`, `created_at`, `customer_type`, `total_debt`) VALUES
(1, '0374436402', '44 An Dương Vương', 'Nguyễn Xuân Hiếu - Anya 5 sao', 0, '2026-03-23 17:15:50', 'wholesale', 3696000.00),
(2, 'Liên hệ Zalo', 'Hàng xóm 05 Lý Thường Kiệt', 'Vân (hàng xóm)', 0, '2026-03-24 03:27:23', 'wholesale', 0.00),
(3, '0934988925', 'Hẻm Hai Bà Trưng ăn vặt', 'Hồng ăn vặt', 0, '2026-03-24 03:36:20', 'wholesale', 0.00),
(4, '0935659794', '03 Lý Thường Kiệt', 'Phương', 0, '2026-03-24 03:37:07', 'wholesale', 0.00),
(5, '0389959799', '03 Nguyễn Trung Tín', 'Cường - Anya 4 sao', 0, '2026-03-24 04:18:59', 'wholesale', 4195200.00),
(6, '0342297299', '37 Phạm Hồng Thái', 'Tám Trà', 0, '2026-03-24 06:02:01', 'wholesale', 0.00),
(7, '0987907957', '28 Ngô Mây', 'Hằng 28 Ngô Mây', 0, '2026-03-24 06:02:40', 'wholesale', 0.00),
(8, '0931985975', '180 Ngô Mây', 'Trang Thông', 0, '2026-03-24 06:03:21', 'wholesale', 0.00),
(9, '0988947488', 'Quán nhậu Năm Hiền', 'Lưu', 0, '2026-03-24 06:35:49', 'wholesale', 0.00),
(10, '0935654199', '', 'Khương', 0, '2026-03-24 10:08:59', 'retail', 0.00),
(11, '0903348111', '57-59 Đặng Văn Ngữ', 'Cô Vy Chủ nhà hàng Bình Dân quán', 0, '2026-04-01 07:29:02', 'wholesale', 0.00),
(12, '0979596799', '03 Trần Phú', 'Anh Huy Giám Đốc Nhà Hàng 03 Trần Phú', 0, '2026-04-01 08:44:11', 'wholesale', 0.00),
(13, 'none', 'none', 'Chào mẫu/Dùng Thử', 0, '2026-04-01 08:46:15', 'wholesale', 0.00),
(15, '012345678', 'none', 'Khách của Sở (chị Khương gt)', 0, '2026-04-06 13:48:18', 'wholesale', 0.00),
(16, '0933117585', '114 Xuân Diệu', 'Nhà hàng 114 Xuân Diệu - Anh Tài', 0, '2026-04-16 03:30:22', 'wholesale', 2720000.00),
(17, '0914737888', '30 Nguyễn Tất Thành', 'Thanh Liêm', 0, '2026-04-16 03:35:57', 'wholesale', 0.00),
(18, 'Giahoi3233@gmail.com', 'Lô 32,33F Tố hữu, p.Quy Nhơn, Tỉnh Gia Lai', 'Siêu thị Gia Hội', 0, '2026-04-16 18:56:47', 'wholesale', 0.00),
(19, '0987662934', '222-224 Nguyễn Thái Học, Quy Nhơn', 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 0, '2026-04-18 02:23:28', 'wholesale', 5100000.00),
(20, '0905623695', '490 Nguyễn Thái Học', 'Tạp Hóa Thy Nhân', 0, '2026-04-20 10:06:26', 'wholesale', 0.00),
(21, '.', '.', 'Cty Lộc Tín', 0, '2026-04-24 10:18:47', 'wholesale', 0.00),
(22, '0901134487', '212 Nguyễn Thị Minh Khai, Quy Nhơn', 'Vợ Sụi', 0, '2026-04-27 12:59:13', 'wholesale', 0.00),
(23, '0984364654', '', 'cô Nhi chủ spa', 0, '2026-04-28 01:49:48', 'retail', 0.00),
(25, '12345678', '03 Trần Thị Kỷ', 'Chùa Hiển Nam', 0, '2026-05-12 08:08:42', 'wholesale', 6040400.00),
(26, '0906754550', 'Trường Quốc Tế SG', 'Cô Ngọc', 0, '2026-05-12 13:05:51', 'wholesale', 0.00),
(27, '0935241158', '', 'Cô Vân', 0, '2026-05-15 09:49:42', 'retail', 0.00),
(57, '0905510657', 'Chợ Đêm', 'Tuấn Chợ Đêm', 0, '2026-05-20 08:39:13', 'wholesale', 1560000.00),
(58, '0918268889', '35 lê xuân trữ', 'Cô Tâm', 0, '2026-05-25 07:55:43', 'wholesale', 3430000.00),
(59, '0787164491', '141 Trần Cao Vân', 'Cô Hoa', 0, '2026-05-26 09:37:55', 'wholesale', 450000.00),
(60, '0915203034', '86 Hà Huy Tập', 'Cô Lợi', 0, '2026-05-27 01:34:15', 'wholesale', 2100000.00),
(70, '123456', '', 'Hồng', 0, '2026-06-01 09:07:46', 'retail', 0.00),
(71, '0123456', '123456', 'Đại lý', 0, '2026-06-04 01:49:54', 'wholesale', 0.00),
(72, '0000000', '', 'Ánh đẹp gái', 0, '2026-06-10 03:19:17', 'retail', 0.00),
(74, '009900', '223 TBH', 'CF NYNA', 0, '2026-06-10 08:05:41', 'wholesale', 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `import_date` datetime DEFAULT current_timestamp(),
  `note` text DEFAULT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imports`
--

INSERT INTO `imports` (`id`, `supplier_id`, `total_amount`, `import_date`, `note`, `discount_amount`, `tax_amount`) VALUES
(1, 3, 36296305.00, '2026-03-24 00:12:12', '+ Tiền thuế GTGT: 2.671.410đ', 0.00, 0.00),
(2, 3, 235200.00, '2026-03-24 13:26:20', '', 0.00, 0.00),
(3, 3, 0.00, '2026-04-04 15:18:01', 'hàng khuyến mãi', 0.00, 0.00),
(4, 3, 0.00, '2026-04-04 15:18:18', 'khuyến mãi', 0.00, 0.00),
(5, 3, 0.00, '2026-04-04 15:18:31', 'khuyến mãi', 0.00, 0.00),
(6, 3, 0.00, '2026-04-04 15:18:41', 'khuyến mãi', 0.00, 0.00),
(7, 3, 0.00, '2026-04-04 15:18:45', '', 0.00, 0.00),
(8, 3, 0.00, '2026-04-04 15:18:53', 'khuyến mãi', 0.00, 0.00),
(9, 5, 0.00, '2026-04-07 14:41:45', 'Trả hàng', 0.00, 0.00),
(10, 3, 12020400.00, '2026-04-16 09:42:06', 'Lô hàng ngày 16/04/2026', 0.00, 0.00),
(11, 3, 2851200.00, '2026-04-19 10:45:04', 'Nhập hàng 18/04/2026', 0.00, 211200.00),
(12, 3, 1200000.00, '2026-04-20 17:01:47', '', 0.00, 88800.00),
(13, 6, 8675000.00, '2026-04-23 15:09:23', 'Hàng đã nhập từ trước', 2168000.00, 0.00),
(14, 6, 4416000.00, '2026-04-23 16:03:27', 'Hàng đã nhập từ trước', 0.00, 0.00),
(15, 6, 480000.00, '2026-04-23 16:05:27', 'Hàng đã nhập từ trước', 0.00, 0.00),
(16, 6, 1198400.00, '2026-04-23 16:52:46', 'Hàng đã nhập từ trước', 0.00, 0.00),
(17, 6, 360000.00, '2026-04-23 17:18:01', 'Hàng đã nhập từ trước', 0.00, 0.00),
(18, 6, 1008000.00, '2026-04-23 17:22:11', 'Hàng đã nhập từ trước', 0.00, 0.00),
(19, 3, 0.00, '2026-05-05 16:29:49', 'Hàng được tặng làm chương trình', 0.00, 0.00),
(20, 7, 1330000.00, '2026-05-05 16:46:54', '', 0.00, 0.00),
(21, 7, 700000.00, '2026-05-05 16:48:57', '', 0.00, 0.00),
(22, 11, 833000.00, '2026-05-06 16:30:44', '', 0.00, 0.00),
(23, 8, 784000.00, '2026-05-06 16:33:08', '', 0.00, 0.00),
(24, 6, 126000.00, '2026-05-06 16:35:08', '', 0.00, 0.00),
(25, 4, 140000.00, '2026-05-06 16:38:28', '', 0.00, 0.00),
(26, 4, 7239400.00, '2026-05-06 16:55:19', '', 0.00, 0.00),
(27, 11, 297500.00, '2026-05-06 16:57:56', '', 0.00, 0.00),
(28, 4, 230300.00, '2026-05-06 17:09:42', '', 0.00, 0.00),
(29, 15, 1039500.00, '2026-05-07 15:36:13', '', 0.00, 0.00),
(30, 15, 230000.00, '2026-05-07 15:39:58', '', 0.00, 0.00),
(31, 6, 168000.00, '2026-05-13 15:20:34', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(32, 6, 2121000.00, '2026-05-13 16:25:34', '', 0.00, 0.00),
(33, 3, 0.00, '2026-05-14 17:29:05', '', 0.00, 0.00),
(34, 11, 455000.00, '2026-05-16 15:10:59', 'Ngày 24 tháng 4 năm 2026', 0.00, 0.00),
(35, 8, 1200000.00, '2026-05-19 08:41:26', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(36, 16, 175000.00, '2026-05-19 10:57:14', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(37, 17, 0.00, '2026-05-20 15:35:16', 'Đổi hàng ngày 18/5 lấy 3 rong biển đổi phô mai', 0.00, 0.00),
(38, 17, 0.00, '2026-05-20 15:40:58', 'Đổi hàng ngày 18/5 lấy 3 rong biển đổi phô mai', 0.00, 0.00),
(39, 6, 3552500.00, '2026-05-20 15:59:39', 'Hàng đã nhập từ trước', 0.00, 0.00),
(40, 16, 175000.00, '2026-05-21 09:01:04', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(41, 6, 1547000.00, '2026-05-21 09:04:02', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(42, 18, 400000.00, '2026-05-21 09:09:33', '2/5/2026', 0.00, 0.00),
(43, 9, 2302000.00, '2026-05-21 09:13:33', '10/5/2026', 0.00, 0.00),
(44, 19, 210000.00, '2026-05-21 09:19:52', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(45, 20, 630000.00, '2026-05-21 09:22:13', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(46, 21, 1085000.00, '2026-05-21 09:31:29', '', 0.00, 0.00),
(47, 8, 126000.00, '2026-05-21 09:35:53', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(48, 11, 2240000.00, '2026-05-21 09:42:56', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(49, 12, 210000.00, '2026-05-21 10:29:43', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(50, 3, 2720000.00, '2026-05-27 10:26:39', '20/5/2026', 0.00, 0.00),
(51, 13, 2800.00, '2026-06-02 17:02:30', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(52, 4, 0.00, '2026-06-04 08:55:34', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00),
(53, 4, 6210000.00, '2026-06-04 09:43:46', '2/6/2026', 0.00, 0.00),
(54, 22, 2140000.00, '2026-06-06 08:27:49', '3/6/2026', 0.00, 0.00),
(55, 9, 4580000.00, '2026-06-09 17:34:09', '3/6/2026', 0.00, 0.00),
(56, 10, 2940000.00, '2026-06-09 17:38:56', '4/6/2026', 0.00, 0.00),
(57, 13, 0.00, '2026-06-09 17:42:24', ' HÀNG NHẬP TỪ TRƯỚC', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `import_details`
--

CREATE TABLE `import_details` (
  `id` int(11) NOT NULL,
  `import_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `import_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import_details`
--

INSERT INTO `import_details` (`id`, `import_id`, `product_id`, `quantity`, `import_price`, `subtotal`) VALUES
(1, 1, 'SACHI-07', 250, 5925.92, 1481480.00),
(2, 1, 'SACHI-08', 250, 5925.92, 1481480.00),
(3, 1, 'SACHI-01', 3250, 7407.41, 24074082.50),
(4, 1, 'SACHI-02', 850, 7407.41, 6296298.50),
(5, 1, 'SACHI-03', 100, 7407.41, 740741.00),
(6, 1, 'SACHI-04', 100, 7407.41, 740741.00),
(7, 1, 'SACHI-05', 100, 7407.41, 740741.00),
(8, 1, 'SACHI-06', 100, 7407.41, 740741.00),
(9, 2, 'SACHI-09', 48, 4900.00, 235200.00),
(10, 3, 'SACHI-01', 42, 0.00, 0.00),
(11, 4, 'SACHI-05', 42, 0.00, 0.00),
(12, 5, 'SACHI-02', 42, 0.00, 0.00),
(13, 6, 'SACHI-06', 42, 0.00, 0.00),
(14, 7, 'SACHI-03', 42, 0.00, 0.00),
(15, 8, 'SACHI-04', 42, 0.00, 0.00),
(16, 9, 'SACHI-05', 41, 0.00, 0.00),
(17, 9, 'SACHI-04', 40, 0.00, 0.00),
(18, 9, 'SACHI-03', 37, 0.00, 0.00),
(19, 9, 'SACHI-06', 47, 0.00, 0.00),
(20, 9, 'SACHI-02', 47, 0.00, 0.00),
(21, 9, 'SACHI-01', 21, 0.00, 0.00),
(22, 10, 'SACHI-07', 1300, 5886.00, 7651800.00),
(23, 10, 'SACHI-08', 500, 5886.00, 2943000.00),
(24, 10, 'SACHI-04', 50, 7128.00, 356400.00),
(25, 10, 'SACHI-03', 50, 7128.00, 356400.00),
(26, 10, 'SACHI-06', 50, 7128.00, 356400.00),
(27, 10, 'SACHI-05', 50, 7128.00, 356400.00),
(28, 11, 'SACHI-04', 100, 6600.00, 660000.00),
(29, 11, 'SACHI-03', 100, 6600.00, 660000.00),
(30, 11, 'SACHI-06', 100, 6600.00, 660000.00),
(31, 11, 'SACHI-05', 100, 6600.00, 660000.00),
(32, 12, 'SACHI-10', 200, 5556.00, 1111200.00),
(33, 13, 'KOHANU_01', 26, 150000.00, 3900000.00),
(34, 13, 'LAMA_05', 25, 185000.00, 4625000.00),
(35, 13, 'LAMA_02', 2, 90000.00, 180000.00),
(36, 13, 'LAMA_01', 1, 170000.00, 170000.00),
(37, 13, 'LAMA_04', 13, 50000.00, 650000.00),
(38, 13, 'LAMA_07', 2, 119000.00, 238000.00),
(39, 13, 'LAMA_06', 3, 190000.00, 570000.00),
(40, 13, 'KG_01', 6, 85000.00, 510000.00),
(41, 14, 'LAMA_01', 9, 136000.00, 1224000.00),
(42, 14, 'LAMA_02', 1, 72000.00, 72000.00),
(43, 14, 'CPIE_01', 44, 36000.00, 1584000.00),
(44, 14, 'HURA_02', 23, 32000.00, 736000.00),
(45, 14, 'HURA_01', 10, 32000.00, 320000.00),
(46, 14, 'TQ_01', 3, 160000.00, 480000.00),
(47, 15, 'KOHA_01', 4, 120000.00, 480000.00),
(48, 16, 'KAMI_01', 14, 28000.00, 392000.00),
(49, 16, 'CPIE_01', 14, 57600.00, 806400.00),
(50, 17, 'QNX_01', 5, 72000.00, 360000.00),
(51, 18, 'DUL_02', 14, 72000.00, 1008000.00),
(52, 19, 'SACHI-03', 39, 0.00, 0.00),
(53, 19, 'SACHI-04', 37, 0.00, 0.00),
(54, 19, 'SACHI-06', 42, 0.00, 0.00),
(55, 19, 'SACHI-02', 39, 0.00, 0.00),
(56, 19, 'SACHI-05', 66, 0.00, 0.00),
(57, 20, 'ANLAO_02', 10, 133000.00, 1330000.00),
(58, 21, 'TQ_02', 10, 70000.00, 700000.00),
(59, 22, 'DUL_01', 10, 77000.00, 770000.00),
(60, 22, 'DUL_02', 1, 63000.00, 63000.00),
(61, 23, 'CAZIN_01', 3, 98000.00, 294000.00),
(62, 23, 'CAZIN_02', 5, 98000.00, 490000.00),
(63, 24, 'QNX_01', 2, 63000.00, 126000.00),
(64, 25, 'TQ_01', 1, 140000.00, 140000.00),
(65, 26, 'LAMA_03', 3, 129500.00, 388500.00),
(66, 26, 'LAMA_04', 12, 35000.00, 420000.00),
(67, 26, 'LAMA_09', 27, 38500.00, 1039500.00),
(68, 26, 'LAMA_05', 3, 129500.00, 388500.00),
(69, 26, 'LAMA_11', 40, 38500.00, 1540000.00),
(70, 26, 'LAMA_13', 24, 38500.00, 924000.00),
(71, 26, 'LAMA_12', 24, 38500.00, 924000.00),
(72, 26, 'LAMA_10', 24, 38500.00, 924000.00),
(73, 26, 'LAMA_08', 3, 230300.00, 690900.00),
(74, 27, 'DULAH_01', 5, 59500.00, 297500.00),
(75, 28, 'LAMA_08', 1, 230300.00, 230300.00),
(76, 29, 'QNX_01', 15, 69300.00, 1039500.00),
(77, 30, 'GAO_01', 2, 115000.00, 230000.00),
(78, 31, 'PA_03', 6, 28000.00, 168000.00),
(79, 32, 'TN_01', 9, 21000.00, 189000.00),
(80, 32, 'PA_03', 11, 28000.00, 308000.00),
(81, 32, 'PA_01', 11, 28000.00, 308000.00),
(82, 32, 'PA_02', 10, 28000.00, 280000.00),
(83, 32, 'ANLAO_01', 4, 259000.00, 1036000.00),
(84, 33, 'SACHI-02', 50, 0.00, 0.00),
(85, 34, 'DULAH_02', 5, 91000.00, 455000.00),
(86, 35, 'CAZIN_03', 30, 40000.00, 1200000.00),
(87, 36, 'VIDATA_02', 2, 35000.00, 70000.00),
(88, 36, 'VIDATA_05', 1, 35000.00, 35000.00),
(89, 36, 'VIDATA_03', 1, 35000.00, 35000.00),
(90, 36, 'VIDATA_04', 1, 35000.00, 35000.00),
(91, 37, 'SACHI-02', 3, 0.00, 0.00),
(92, 38, 'SACHI-02', 147, 0.00, 0.00),
(93, 39, 'DULAH_03', 30, 77000.00, 2310000.00),
(94, 39, 'DULAH_04', 15, 63000.00, 945000.00),
(95, 39, 'DULAH_01', 5, 59500.00, 297500.00),
(96, 40, 'VIDATA_01', 5, 35000.00, 175000.00),
(97, 41, 'PL_01', 34, 45500.00, 1547000.00),
(98, 42, 'KICAFOOD_01', 10, 23000.00, 230000.00),
(99, 42, 'KICAFOOD_02', 10, 17000.00, 170000.00),
(100, 43, 'KG_01', 14, 68000.00, 952000.00),
(101, 43, 'KG_03', 10, 65000.00, 650000.00),
(102, 43, 'KG_02', 10, 70000.00, 700000.00),
(103, 44, 'VH_01', 3, 70000.00, 210000.00),
(104, 45, 'MD_01', 9, 70000.00, 630000.00),
(105, 46, 'TL_02', 7, 105000.00, 735000.00),
(106, 46, 'TL_01', 2, 175000.00, 350000.00),
(107, 47, 'CAZIN_04', 4, 31500.00, 126000.00),
(108, 48, 'DULAH_06', 3, 196000.00, 588000.00),
(109, 48, 'DULAH_05', 8, 175000.00, 1400000.00),
(110, 48, 'DULAH_07', 2, 126000.00, 252000.00),
(111, 49, 'ANLAO_03', 2, 105000.00, 210000.00),
(112, 50, 'SACHI-07', 150, 6800.00, 1020000.00),
(113, 50, 'SACHI-08', 250, 6800.00, 1700000.00),
(114, 51, 'PA_01', 1, 2800.00, 2800.00),
(115, 52, 'LAMA_02', 1, 0.00, 0.00),
(116, 53, 'LAMA_02', 10, 288000.00, 2880000.00),
(117, 53, 'LAMA_01', 20, 166500.00, 3330000.00),
(118, 54, 'HAIHA_01', 20, 39000.00, 780000.00),
(119, 54, 'HAIHA_02', 20, 39000.00, 780000.00),
(120, 54, 'HAIHA_03', 20, 29000.00, 580000.00),
(121, 55, 'KG_01', 40, 68000.00, 2720000.00),
(122, 55, 'KG_03', 20, 65000.00, 1300000.00),
(123, 55, 'KG_02', 8, 70000.00, 560000.00),
(124, 56, 'KOHA_01', 28, 105000.00, 2940000.00),
(125, 57, 'PA_01', 2, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT 'Khách mua tại quầy',
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) DEFAULT 0.00,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Đã thanh toán',
  `sale_type` enum('retail','wholesale') DEFAULT 'retail',
  `paid_amount` decimal(15,2) DEFAULT 0.00,
  `debt_amount` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `customer_name`, `total_amount`, `discount_amount`, `order_date`, `status`, `sale_type`, `paid_amount`, `debt_amount`) VALUES
(2, 3, 'Hồng ăn vặt', 1620000.00, 180000.00, '2026-03-24 04:30:01', 'Đã thanh toán', 'wholesale', 1620000.00, 0.00),
(3, 6, 'Tám Trà', 310000.00, 0.00, '2026-03-24 06:09:12', 'Đã thanh toán', 'wholesale', 310000.00, 0.00),
(4, 8, 'Trang Thông', 360000.00, 0.00, '2026-03-24 06:13:51', 'Đã thanh toán', 'wholesale', 360000.00, 0.00),
(5, 7, 'Hằng', 1268000.00, 0.00, '2026-03-24 06:30:39', 'Đã thanh toán', 'wholesale', 1268000.00, 0.00),
(6, 9, 'Lưu', 340000.00, 0.00, '2026-03-24 06:36:09', 'Đã thanh toán', 'wholesale', 340000.00, 0.00),
(7, 5, 'Cường - Anya 4 sao', 4800000.00, 1200000.00, '2026-03-24 06:50:58', 'Còn nợ', 'wholesale', 0.00, 4800000.00),
(8, 1, 'Nguyễn Xuân Hiếu - Anya 5 sao', 4800000.00, 1200000.00, '2026-03-24 06:51:54', 'Còn nợ', 'wholesale', 0.00, 4800000.00),
(9, 10, 'Khách mua tại quầy', 100000.00, 0.00, '2026-03-24 10:09:07', 'Đã thanh toán', 'retail', 0.00, 0.00),
(10, 4, 'Phương', 1620000.00, 180000.00, '2026-03-25 03:00:40', 'Đã thanh toán', 'wholesale', 1620000.00, 0.00),
(11, 2, 'Vân (hàng xóm)', 1620000.00, 180000.00, '2026-03-25 03:02:30', 'Đã thanh toán', 'wholesale', 1620000.00, 0.00),
(12, 11, 'Cô Vy Chủ nhà hàng Bình Dân quán', 680000.00, 0.00, '2026-04-01 07:31:02', 'Đã hủy', 'wholesale', 0.00, 0.00),
(13, 11, 'Cô Vy Chủ nhà hàng Bình Dân quán', 680000.00, 0.00, '2026-04-01 07:33:33', 'Đã hủy', 'wholesale', 680000.00, 0.00),
(14, 11, 'Cô Vy Chủ nhà hàng Bình Dân quán', 680000.00, 0.00, '2026-04-01 08:36:46', 'Đã thanh toán', 'wholesale', 680000.00, 0.00),
(15, 12, 'Anh Huy Giám Đốc Nhà Hàng', 1224000.00, 136000.00, '2026-04-01 08:45:24', 'Còn nợ', 'wholesale', 0.00, 1224000.00),
(16, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-01 08:46:17', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(17, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-02 08:19:20', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(18, 15, 'Khách của Sở (chị Khương gt)', 630000.00, 70000.00, '2026-04-06 13:49:59', 'Còn nợ', 'wholesale', 0.00, 630000.00),
(19, 0, 'Khách mua tại quầy', 420000.00, 0.00, '2026-04-13 10:43:13', 'Đã thanh toán', 'retail', 0.00, 0.00),
(20, 7, 'Hằng', 900000.00, 0.00, '2026-04-13 10:47:03', 'Còn nợ', 'wholesale', 0.00, 900000.00),
(21, 13, 'Chào mẫu/Dùng Thử', 508200.00, 0.00, '2026-04-14 12:43:28', 'Đã thanh toán', 'wholesale', 508200.00, 0.00),
(22, 6, 'Tám Trà', 650000.00, 0.00, '2026-04-16 02:48:20', 'Đã hủy', 'wholesale', 0.00, 0.00),
(23, 16, 'Nhà hàng 114 Xuân Diệu - Anh Tài', 1105000.00, 0.00, '2026-04-16 03:34:51', 'Đã thanh toán', 'wholesale', 1105000.00, 0.00),
(24, 17, 'Thanh Liêm', 680000.00, 0.00, '2026-04-16 03:36:24', 'Đã thanh toán', 'wholesale', 680000.00, 0.00),
(25, 13, 'Chào mẫu/Dùng Thử', 34000.00, 0.00, '2026-04-16 03:39:05', 'Đã thanh toán', 'wholesale', 34000.00, 0.00),
(26, 6, 'Tám Trà', 680000.00, 0.00, '2026-04-16 03:43:13', 'Đã thanh toán', 'wholesale', 680000.00, 0.00),
(27, 18, 'Siêu thị Gia Hội', 325000.00, 0.00, '2026-04-16 18:57:22', 'Đã hủy', 'wholesale', 0.00, 0.00),
(28, 18, 'Siêu thị Gia Hội', 325000.00, 0.00, '2026-04-16 18:59:12', 'Đã thanh toán', 'wholesale', 325000.00, 0.00),
(29, 19, 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 2422500.00, 127500.00, '2026-04-18 02:25:03', 'Đã thanh toán', 'wholesale', 2422500.00, 0.00),
(30, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-19 03:48:19', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(31, 2, 'Vân (hàng xóm)', 780000.00, 0.00, '2026-04-20 10:04:07', 'Còn nợ', 'wholesale', 0.00, 780000.00),
(32, 20, 'Tạp Hóa Thy Nhân', 995000.00, 0.00, '2026-04-20 10:17:05', 'Đã thanh toán', 'wholesale', 995000.00, 0.00),
(33, 13, 'Chào mẫu/Dùng Thử', 85000.00, 0.00, '2026-04-20 10:24:23', 'Đã hủy', 'wholesale', 85000.00, 0.00),
(34, 0, 'Khách mua tại quầy', 113000.00, 0.00, '2026-04-20 12:37:50', 'Đã hủy', 'retail', 0.00, 0.00),
(35, 0, 'Khách mua tại quầy', 113000.00, 0.00, '2026-04-21 07:50:48', 'Đã thanh toán', 'retail', 0.00, 0.00),
(37, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-22 03:49:27', 'Đã hủy', 'wholesale', 0.00, 0.00),
(38, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-22 03:52:39', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(39, 0, 'Khách mua tại quầy', 2810000.00, 0.00, '2026-04-23 10:24:40', 'Đã thanh toán', 'retail', 0.00, 0.00),
(40, 0, 'Khách mua tại quầy', 1360000.00, 0.00, '2026-04-23 10:26:18', 'Đã thanh toán', 'retail', 0.00, 0.00),
(41, 0, 'Khách mua tại quầy', 84000.00, 0.00, '2026-04-23 10:27:12', 'Đã thanh toán', 'retail', 0.00, 0.00),
(42, 0, 'Khách mua tại quầy', 200000.00, 0.00, '2026-04-23 10:27:25', 'Đã thanh toán', 'retail', 0.00, 0.00),
(43, 13, 'Khách mua tại quầy', 100000.00, 0.00, '2026-04-24 02:56:53', 'Đã hủy', 'retail', 0.00, 0.00),
(44, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-24 03:22:19', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(45, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-24 03:26:24', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(46, 21, 'Cty Lộc Tín', 650000.00, 0.00, '2026-04-24 10:21:57', 'Đã thanh toán', 'wholesale', 650000.00, 0.00),
(47, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-25 08:15:36', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(48, 0, 'Khách mua tại quầy', 154000.00, 0.00, '2026-04-25 21:33:39', 'Đã hủy', 'retail', 0.00, 0.00),
(49, 0, 'Khách mua tại quầy', 154000.00, 0.00, '2026-04-25 21:33:39', 'Đã hủy', 'retail', 0.00, 0.00),
(50, 0, 'Khách mua tại quầy', 154000.00, 0.00, '2026-04-25 21:36:57', 'Đã hủy', 'retail', 0.00, 0.00),
(51, 0, 'Khách mua tại quầy', 90000.00, 0.00, '2026-04-25 21:53:44', 'Đã hủy', 'retail', 0.00, 0.00),
(52, 0, 'Khách mua tại quầy', 450000.00, 0.00, '2026-04-25 22:03:49', 'Đã hủy', 'retail', 0.00, 0.00),
(53, 16, 'Nhà hàng 114 Xuân Diệu - Anh Tài', 1020000.00, 0.00, '2026-04-27 09:04:06', 'Còn nợ', 'wholesale', 0.00, 1020000.00),
(54, 22, 'Vợ Sụi', 339986.40, 13613.60, '2026-04-27 13:04:11', 'Đã thanh toán', 'wholesale', 340000.00, 0.00),
(55, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-04-27 13:06:06', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(56, 22, 'Vợ Sụi', 340000.00, 0.00, '2026-04-28 01:46:15', 'Đã thanh toán', 'wholesale', 340000.00, 0.00),
(57, 23, 'Khách mua tại quầy', 90480.00, 0.00, '2026-04-28 01:49:52', 'Đã thanh toán', 'retail', 0.00, 0.00),
(58, 12, 'Anh Huy Giám Đốc Nhà Hàng 03 Trần Phú', 2040000.00, 0.00, '2026-04-28 04:44:27', 'Còn nợ', 'wholesale', 0.00, 2040000.00),
(59, 0, 'Khách mua tại quầy', 243000.00, 0.00, '2026-04-29 10:36:56', 'Đã hủy', 'retail', 0.00, 0.00),
(60, 0, 'Khách mua tại quầy', 297000.00, 0.00, '2026-04-29 10:38:35', 'Đã thanh toán', 'retail', 0.00, 0.00),
(61, 19, 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 1020000.00, 0.00, '2026-04-29 10:44:15', 'Còn nợ', 'wholesale', 0.00, 1020000.00),
(62, 7, 'Hằng 28 Ngô Mây', 900000.00, 0.00, '2026-05-04 04:17:24', 'Còn nợ', 'wholesale', 0.00, 900000.00),
(63, 0, 'Khách mua tại quầy', 510000.00, 0.00, '2026-05-04 09:01:40', 'Đã thanh toán', 'retail', 0.00, 0.00),
(64, 0, 'Khách mua tại quầy', 28000.00, 0.00, '2026-05-04 10:07:49', 'Đã thanh toán', 'retail', 0.00, 0.00),
(65, 25, 'Chùa Hiển Nam', 2135400.00, 0.00, '2026-05-12 08:13:55', 'Còn nợ', 'wholesale', 0.00, 2135400.00),
(66, 0, 'Khách mua tại quầy', 85000.00, 0.00, '2026-05-12 09:12:32', 'Đã thanh toán', 'retail', 0.00, 0.00),
(67, 0, 'Khách mua tại quầy', 190000.00, 0.00, '2026-05-12 09:20:31', 'Đã thanh toán', 'retail', 0.00, 0.00),
(68, 26, 'Cô Ngọc', 3000000.00, 0.00, '2026-05-12 13:07:10', 'Đã thanh toán', 'wholesale', 3000000.00, 0.00),
(69, 0, 'Khách mua tại quầy', 140000.00, 0.00, '2026-05-14 10:09:07', 'Đã thanh toán', 'retail', 0.00, 0.00),
(71, 19, 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 5525000.00, 0.00, '2026-05-14 10:30:09', 'Đã hủy', 'wholesale', 0.00, 0.00),
(72, 25, 'Chùa Hiển Nam', 3905000.00, 0.00, '2026-05-14 10:32:13', 'Đã hủy', 'wholesale', 0.00, 0.00),
(73, 19, 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 0.00, 0.00, '2026-05-14 10:38:34', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(74, 13, 'Chào mẫu/Dùng Thử', 0.00, 0.00, '2026-05-14 10:42:32', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(75, 19, 'Nhà sách Văn Hóa Giáo Dục Gia Lai Vạn Trí', 5100000.00, 0.00, '2026-05-14 10:51:01', 'Còn nợ', 'wholesale', 0.00, 5100000.00),
(76, 25, 'Chùa Hiển Nam', 3905000.00, 0.00, '2026-05-14 11:47:34', 'Đã hủy', 'wholesale', 0.00, 0.00),
(77, 25, 'Chùa Hiển Nam', 3905000.00, 0.00, '2026-05-14 11:48:48', 'Còn nợ', 'wholesale', 0.00, 3905000.00),
(78, 0, 'Khách mua tại quầy', 190000.00, 0.00, '2026-05-15 09:25:01', 'Đã thanh toán', 'retail', 0.00, 0.00),
(79, 27, 'Khách mua tại quầy', 700000.00, 0.00, '2026-05-15 09:50:32', 'Đã hủy', 'retail', 0.00, 0.00),
(80, 27, 'Khách mua tại quầy', 490000.00, 0.00, '2026-05-15 10:54:37', 'Đã thanh toán', 'retail', 0.00, 0.00),
(81, 0, 'Khách mua tại quầy', 70000.00, 0.00, '2026-05-16 08:45:27', 'Đã thanh toán', 'retail', 0.00, 0.00),
(82, 0, 'Khách mua tại quầy', 65000.00, 0.00, '2026-05-19 01:41:41', 'Đã thanh toán', 'retail', 0.00, 0.00),
(83, 0, 'Khách mua tại quầy', 1980000.00, 0.00, '2026-05-19 02:06:28', 'Đã thanh toán', 'retail', 0.00, 0.00),
(84, 0, 'Khách mua tại quầy', 570000.00, 0.00, '2026-05-19 02:54:07', 'Đã hủy', 'retail', 0.00, 0.00),
(87, 57, 'Tuấn Chợ Đêm', 1560000.00, 0.00, '2026-05-20 08:43:36', 'Còn nợ', 'wholesale', 0.00, 1560000.00),
(88, 5, 'Cường - Anya 4 sao', 0.00, 0.00, '2026-05-20 08:49:39', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(89, 0, 'Khách mua tại quầy', 14000.00, 0.00, '2026-05-21 07:46:31', 'Đã thanh toán', 'retail', 0.00, 0.00),
(90, 0, 'Khách mua tại quầy', 14000.00, 0.00, '2026-05-21 07:47:06', 'Đã thanh toán', 'retail', 0.00, 0.00),
(91, 0, 'Khách mua tại quầy', 14000.00, 0.00, '2026-05-21 08:45:29', 'Đã thanh toán', 'retail', 0.00, 0.00),
(92, 0, 'Khách mua tại quầy', 42000.00, 0.00, '2026-05-22 09:33:23', 'Đã thanh toán', 'retail', 0.00, 0.00),
(93, 0, 'Khách mua tại quầy', 10000.00, 0.00, '2026-05-23 02:16:09', 'Đã thanh toán', 'retail', 0.00, 0.00),
(94, 0, 'Khách mua tại quầy', 195000.00, 0.00, '2026-05-25 02:13:44', 'Đã thanh toán', 'retail', 0.00, 0.00),
(95, 58, 'Cô Tâm', 3150000.00, 0.00, '2026-05-25 07:56:23', 'Đã hủy', 'wholesale', 0.00, 0.00),
(96, 58, 'Cô Tâm', 3150000.00, 0.00, '2026-05-25 07:57:22', 'Đã hủy', 'wholesale', 0.00, 0.00),
(98, 0, 'Khách mua tại quầy', 1419200.00, 0.00, '2026-05-26 09:01:53', 'Đã hủy', 'retail', 0.00, 0.00),
(102, 59, 'Cô Hoa', 450000.00, 0.00, '2026-05-26 09:38:22', 'Còn nợ', 'wholesale', 0.00, 450000.00),
(103, 60, 'Cô Lợi', 2100000.00, 0.00, '2026-05-27 01:34:48', 'Còn nợ', 'wholesale', 0.00, 2100000.00),
(104, 27, 'Khách mua tại quầy', 190000.00, 0.00, '2026-05-27 01:48:38', 'Đã hủy', 'retail', 0.00, 0.00),
(105, 27, 'Khách mua tại quầy', 48000.00, 0.00, '2026-05-27 01:53:07', 'Đã hủy', 'retail', 0.00, 0.00),
(106, 27, 'Khách mua tại quầy', 48000.00, 0.00, '2026-05-27 02:10:12', 'Đã thanh toán', 'retail', 0.00, 0.00),
(107, 27, 'Khách mua tại quầy', 1045600.00, 0.00, '2026-05-27 02:18:35', 'Đã hủy', 'retail', 0.00, 0.00),
(108, 27, 'Khách mua tại quầy', 1767000.00, 0.00, '2026-05-27 02:28:58', 'Đã hủy', 'retail', 0.00, 0.00),
(109, 27, 'Khách mua tại quầy', 1413600.00, 0.00, '2026-05-27 02:36:20', 'Đã thanh toán', 'retail', 0.00, 0.00),
(110, 16, 'Nhà hàng 114 Xuân Diệu - Anh Tài', 1700000.00, 0.00, '2026-05-27 03:28:02', 'Còn nợ', 'wholesale', 0.00, 1700000.00),
(111, 58, 'Cô Tâm', 3430000.00, 0.00, '2026-05-27 08:11:29', 'Còn nợ', 'wholesale', 0.00, 3430000.00),
(113, 27, 'Khách mua tại quầy', 14000.00, 0.00, '2026-05-28 03:47:52', 'Đã thanh toán', 'retail', 0.00, 0.00),
(114, 13, 'Khách mua tại quầy', 0.00, 0.00, '2026-05-28 03:48:39', 'Đã thanh toán', 'retail', 0.00, 0.00),
(115, 0, 'Khách mua tại quầy', 9000.00, 0.00, '2026-05-28 03:49:49', 'Đã thanh toán', 'retail', 0.00, 0.00),
(116, 10, 'Khách mua tại quầy', 4560000.00, 0.00, '2026-05-31 03:56:10', 'Đã thanh toán', 'retail', 0.00, 0.00),
(117, 70, 'Khách mua tại quầy', 320000.00, 0.00, '2026-06-01 09:07:55', 'Đã thanh toán', 'retail', 0.00, 0.00),
(118, 27, 'Khách mua tại quầy', 406400.00, 0.00, '2026-06-01 12:41:48', 'Đã hủy', 'retail', 0.00, 0.00),
(119, 27, 'Khách mua tại quầy', 246400.00, 0.00, '2026-06-02 08:46:53', 'Đã thanh toán', 'retail', 0.00, 0.00),
(120, 10, 'Khách mua tại quầy', 10225000.00, 0.00, '2026-06-02 10:11:01', 'Đã thanh toán', 'retail', 0.00, 0.00),
(121, 27, 'Khách mua tại quầy', 903200.00, 0.00, '2026-06-02 10:22:22', 'Đã thanh toán', 'retail', 0.00, 0.00),
(122, 10, 'Khách mua tại quầy', 1165000.00, 0.00, '2026-06-02 10:27:47', 'Đã thanh toán', 'retail', 0.00, 0.00),
(123, 10, 'Khách mua tại quầy', 400000.00, 0.00, '2026-06-03 07:57:27', 'Đã thanh toán', 'retail', 0.00, 0.00),
(124, 71, 'Đại lý', 0.00, 0.00, '2026-06-04 01:50:02', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(125, 71, 'Đại lý', 0.00, 0.00, '2026-06-04 01:54:41', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(126, 0, 'Khách mua tại quầy', 1648000.00, 0.00, '2026-06-04 02:05:20', 'Đã thanh toán', 'retail', 0.00, 0.00),
(127, 0, 'Khách mua tại quầy', 195000.00, 0.00, '2026-06-09 02:21:13', 'Đã thanh toán', 'retail', 0.00, 0.00),
(128, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 08:20:11', 'Đã hủy', 'wholesale', 0.00, 0.00),
(129, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 08:34:16', 'Đã hủy', 'wholesale', 0.00, 0.00),
(130, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 08:37:59', 'Đã hủy', 'wholesale', 0.00, 0.00),
(131, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 09:36:20', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(132, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 10:13:52', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(133, 0, 'Khách mua tại quầy', 196000.00, 0.00, '2026-06-09 10:15:00', 'Đã thanh toán', 'retail', 0.00, 0.00),
(134, 71, 'Đại lý', 0.00, 0.00, '2026-06-09 10:40:08', 'Đã thanh toán', 'wholesale', 0.00, 0.00),
(135, 10, 'Khách mua tại quầy', 1149996.00, 0.00, '2026-06-10 02:24:55', 'Đã thanh toán', 'retail', 0.00, 0.00),
(136, 27, 'Khách mua tại quầy', 14000.00, 0.00, '2026-06-10 03:18:50', 'Đã thanh toán', 'retail', 0.00, 0.00),
(137, 72, 'Khách mua tại quầy', 14000.00, 0.00, '2026-06-10 03:19:20', 'Đã thanh toán', 'retail', 0.00, 0.00),
(138, 0, 'Khách mua tại quầy', 30000.00, 0.00, '2026-06-10 03:20:45', 'Đã thanh toán', 'retail', 0.00, 0.00),
(139, 74, 'CF NYNA', 300000.00, 0.00, '2026-06-10 08:07:59', 'Đã hủy', 'wholesale', 0.00, 0.00),
(140, 74, 'CF NYNA', 100000.00, 0.00, '2026-06-10 08:40:32', 'Còn nợ', 'wholesale', 0.00, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `subtotal`) VALUES
(1, 1, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 100, 14000, 1400000),
(2, 1, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 14000, 700000),
(3, 1, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 100, 14000, 1400000),
(4, 2, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 12000, 600000),
(5, 2, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 12000, 600000),
(6, 2, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 15, 12000, 180000),
(7, 2, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 15, 12000, 180000),
(8, 2, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 12000, 120000),
(9, 2, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 10, 12000, 120000),
(10, 3, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6200, 310000),
(11, 4, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 12000, 60000),
(12, 4, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 5, 12000, 60000),
(13, 4, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 5, 12000, 60000),
(14, 4, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 12000, 60000),
(15, 4, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 5, 12000, 60000),
(16, 4, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 5, 12000, 60000),
(18, 5, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 12000, 600000),
(19, 5, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 10, 12000, 120000),
(20, 5, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 10, 12000, 120000),
(21, 5, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 10, 12000, 120000),
(22, 5, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 12000, 120000),
(23, 5, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 10, 12000, 120000),
(24, 5, 'SACHI-09', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 10, 6800, 68000),
(25, 6, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6800, 340000),
(26, 7, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 250, 12000, 3000000),
(27, 7, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 250, 12000, 3000000),
(28, 8, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 250, 12000, 3000000),
(29, 8, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 250, 12000, 3000000),
(30, 9, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 10, 10000, 100000),
(31, 10, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 50, 12000, 600000),
(32, 10, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 50, 12000, 600000),
(33, 10, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 50, 12000, 600000),
(34, 11, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 12000, 600000),
(35, 11, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 12000, 600000),
(36, 11, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 50, 12000, 600000),
(37, 12, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 6800, 340000),
(38, 12, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6800, 340000),
(39, 12, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(40, 12, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(41, 12, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(42, 12, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(43, 12, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(44, 13, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6800, 340000),
(45, 13, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 6800, 340000),
(46, 13, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(47, 13, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(48, 13, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(49, 13, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(50, 13, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(51, 13, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 0, 0),
(52, 14, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 33, 6800, 224400),
(53, 14, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 67, 6800, 455600),
(54, 14, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 0, 0),
(55, 14, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(56, 14, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(57, 14, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(58, 14, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(59, 14, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(60, 15, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 100, 6800, 680000),
(61, 15, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 100, 6800, 680000),
(62, 16, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 7, 0, 0),
(63, 17, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 0, 0),
(64, 17, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 8, 0, 0),
(65, 17, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 8, 0, 0),
(66, 17, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 8, 0, 0),
(67, 17, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 8, 0, 0),
(68, 17, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 8, 0, 0),
(69, 17, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 8, 0, 0),
(70, 18, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 8, 14000, 112000),
(71, 18, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 8, 14000, 112000),
(72, 18, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 8, 14000, 112000),
(73, 18, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 8, 14000, 112000),
(74, 18, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 14000, 140000),
(75, 18, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 8, 14000, 112000),
(76, 19, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(77, 19, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 5, 14000, 70000),
(78, 19, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 5, 14000, 70000),
(79, 19, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 5, 14000, 70000),
(80, 19, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 5, 14000, 70000),
(81, 19, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 14000, 70000),
(82, 20, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 9000, 450000),
(83, 20, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 9000, 450000),
(84, 21, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 17, 6600, 112200),
(85, 21, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 12, 6600, 79200),
(86, 21, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 12, 6600, 79200),
(87, 21, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 31, 6600, 204600),
(88, 21, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 6600, 33000),
(89, 22, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 100, 6500, 650000),
(90, 23, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6800, 340000),
(91, 23, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 6800, 340000),
(92, 23, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 10, 8500, 85000),
(93, 23, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 8500, 85000),
(94, 23, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 10, 8500, 85000),
(95, 23, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 10, 8500, 85000),
(96, 23, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 10, 8500, 85000),
(97, 24, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 6800, 340000),
(98, 24, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6800, 340000),
(99, 25, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 6800, 34000),
(100, 26, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 100, 6800, 680000),
(101, 27, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 25, 6500, 162500),
(102, 27, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 6500, 162500),
(103, 28, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 6500, 162500),
(104, 28, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 25, 6500, 162500),
(105, 29, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 50, 8500, 425000),
(106, 29, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 50, 8500, 425000),
(107, 29, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 50, 8500, 425000),
(108, 29, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 50, 8500, 425000),
(109, 29, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 8500, 425000),
(110, 29, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 8500, 425000),
(111, 30, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 2, 0, 0),
(112, 30, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(113, 30, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 0, 0),
(114, 30, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 0, 0),
(115, 31, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 10, 10000, 100000),
(116, 31, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 10000, 100000),
(117, 31, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 10, 10000, 100000),
(118, 31, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 10, 10000, 100000),
(119, 31, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 10, 10000, 100000),
(120, 31, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 10, 10000, 100000),
(121, 31, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 5, 10000, 50000),
(122, 31, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 10000, 50000),
(123, 31, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 8000, 80000),
(124, 32, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 25, 6500, 162500),
(125, 32, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 6500, 162500),
(126, 32, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 10, 8500, 85000),
(127, 32, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 10, 8500, 85000),
(128, 32, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 10, 8500, 85000),
(129, 32, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 10, 8500, 85000),
(130, 32, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 10, 8500, 85000),
(131, 32, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 10, 8500, 85000),
(132, 32, 'SACHI-10', 'Đậu phộng tỏi ớt', 20, 8000, 160000),
(133, 33, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 10000, 10000),
(134, 33, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 10000, 10000),
(135, 33, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 10000, 10000),
(136, 33, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 10000, 10000),
(137, 33, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 10000, 10000),
(138, 33, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 10000, 10000),
(139, 33, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 7500, 7500),
(140, 33, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 7500, 7500),
(141, 33, 'SACHI-10', 'Đậu phộng tỏi ớt', 1, 10000, 10000),
(142, 34, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 10000, 10000),
(143, 34, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(144, 34, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 14000, 14000),
(145, 34, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 14000, 14000),
(146, 34, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(147, 34, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(148, 34, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(149, 34, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 14000, 14000),
(150, 34, 'SACHI-10', 'Đậu phộng tỏi ớt', 1, 9000, 9000),
(151, 35, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 14000, 14000),
(152, 35, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(153, 35, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(154, 35, 'SACHI-10', 'Đậu phộng tỏi ớt', 1, 9000, 9000),
(155, 35, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 10000, 10000),
(156, 35, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(157, 35, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 14000, 14000),
(158, 35, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(159, 35, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 14000, 14000),
(160, 37, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(161, 37, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(162, 37, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(163, 37, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(164, 37, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(165, 37, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(166, 38, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(167, 38, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(168, 38, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(169, 38, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(170, 38, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(171, 38, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(172, 38, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 0, 0),
(173, 38, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 0, 0),
(174, 39, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 10, 10000, 100000),
(175, 39, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 10, 10000, 100000),
(176, 39, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 10, 14000, 140000),
(177, 39, 'LAMA_02', 'Cà phê Lamant phin nhẹ (250gram)', 2, 90000, 180000),
(178, 39, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 4, 50000, 200000),
(179, 39, 'LAMA_05', 'Lamant cafe túi lọc đặc sản', 2, 185000, 370000),
(180, 39, 'KG_01', 'Bánh thuyền hạt', 4, 85000, 340000),
(181, 39, 'KOHA_01', 'Hạt Macca Bazan', 4, 150000, 600000),
(182, 39, 'CPIE_01', 'Bánh Combo Pie', 2, 45000, 90000),
(183, 39, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 2, 40000, 80000),
(184, 39, 'KAMI_01', 'Bánh Kami Tảo Biển', 2, 35000, 70000),
(185, 39, 'QNX_01', 'Trà Hương Bưởi', 4, 90000, 360000),
(186, 39, 'DUL_02', 'Trà nụ hoa hòe - Túi lọc', 2, 90000, 180000),
(187, 40, 'LAMA_01', 'Cà phê Lamant phin nhẹ (500gram)', 8, 170000, 1360000),
(188, 41, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 14000, 14000),
(189, 41, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 14000, 14000),
(190, 41, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 14000, 14000),
(191, 41, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(192, 41, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(193, 41, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(194, 42, 'TQ_01', 'Tinh Bột Nghệ (500gram)', 1, 200000, 200000),
(195, 43, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 10000, 50000),
(196, 43, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 5, 10000, 50000),
(197, 44, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 0, 0),
(198, 44, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 5, 0, 0),
(199, 45, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(200, 45, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(201, 45, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(202, 45, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(203, 45, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(204, 45, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(205, 45, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 0, 0),
(206, 45, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 0, 0),
(207, 45, 'SACHI-10', 'Đậu phộng tỏi ớt', 1, 0, 0),
(208, 46, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 50, 6500, 325000),
(209, 46, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 6500, 325000),
(210, 47, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(211, 47, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(212, 47, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(213, 47, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(214, 47, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(215, 47, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(216, 48, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 11, 14000, 154000),
(217, 49, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 11, 14000, 154000),
(218, 50, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 11, 14000, 154000),
(219, 51, 'SACHI-10', 'Đậu phộng tỏi ớt', 11, 9000, 99000),
(220, 52, 'CPIE_01', 'Bánh Combo Pie', 11, 45000, 495000),
(221, 53, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 150, 6800, 1020000),
(222, 53, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 0, 0),
(223, 54, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 26, 6800, 176800),
(224, 54, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 26, 6800, 176800),
(225, 55, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(226, 55, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(227, 55, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(228, 55, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(229, 55, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(230, 55, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(231, 56, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 25, 6800, 170000),
(232, 56, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 6800, 170000),
(233, 57, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 14000, 14000),
(234, 57, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 14000, 14000),
(235, 57, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 14000, 14000),
(236, 57, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(237, 57, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(238, 57, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(239, 57, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(240, 57, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 10000, 10000),
(241, 58, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 300, 6800, 2040000),
(242, 58, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 0, 0),
(243, 59, 'SACHI-09', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 2, 10000, 20000),
(244, 59, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 2, 14000, 28000),
(245, 59, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 2, 14000, 28000),
(246, 59, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 2, 14000, 28000),
(247, 59, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 2, 14000, 28000),
(248, 59, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 2, 14000, 28000),
(249, 59, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(250, 59, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 2, 10000, 20000),
(251, 59, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 2, 10000, 20000),
(252, 60, 'SACHI-09', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 2, 10000, 20000),
(253, 60, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 2, 14000, 28000),
(254, 60, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 2, 14000, 28000),
(255, 60, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 2, 14000, 28000),
(256, 60, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 2, 14000, 28000),
(257, 60, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 2, 14000, 28000),
(258, 60, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(259, 60, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 10000, 50000),
(260, 60, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 5, 10000, 50000),
(261, 61, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 20, 8500, 170000),
(262, 61, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 20, 8500, 170000),
(263, 61, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 20, 8500, 170000),
(264, 61, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 20, 8500, 170000),
(265, 61, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 20, 8500, 170000),
(266, 61, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 20, 8500, 170000),
(267, 62, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 20, 9000, 180000),
(268, 62, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 20, 9000, 180000),
(269, 62, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 20, 9000, 180000),
(270, 62, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 20, 9000, 180000),
(271, 62, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 20, 9000, 180000),
(272, 62, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 5, 0, 0),
(273, 63, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 14000, 70000),
(274, 63, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 5, 14000, 70000),
(275, 63, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 5, 14000, 70000),
(276, 63, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 5, 14000, 70000),
(277, 63, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 5, 14000, 70000),
(278, 63, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(279, 63, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 9000, 90000),
(280, 64, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 2, 14000, 28000),
(281, 65, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 100, 5900, 590000),
(282, 65, 'SACHI-09', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 10, 6300, 63000),
(283, 65, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 50, 5900, 295000),
(284, 65, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 100, 7100, 710000),
(285, 65, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 7100, 355000),
(286, 65, 'SACHI-10', 'Đậu phộng tỏi ớt', 20, 6120, 122400),
(287, 66, 'DULAH_01', 'Dầu mè đen', 1, 85000, 85000),
(288, 67, 'ANLAO_02', 'Mật ong Bee T 250ml', 1, 190000, 190000),
(289, 68, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 50, 10000, 500000),
(290, 68, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 50, 10000, 500000),
(291, 68, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 50, 10000, 500000),
(292, 68, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 50, 10000, 500000),
(293, 68, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 10000, 500000),
(294, 68, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 100, 5000, 500000),
(295, 69, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(296, 69, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 5, 14000, 70000),
(298, 71, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 50, 8500, 425000),
(299, 71, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 50, 8500, 425000),
(300, 71, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 50, 8500, 425000),
(301, 71, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 50, 8500, 425000),
(302, 71, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 8500, 425000),
(303, 71, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 400, 8500, 3400000),
(304, 72, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 550, 7100, 3905000),
(305, 73, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 0, 0),
(306, 74, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 0, 0),
(307, 74, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 0, 0),
(308, 74, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 1, 0, 0),
(309, 74, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 0, 0),
(310, 74, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 0, 0),
(311, 74, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 0, 0),
(312, 75, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 50, 8500, 425000),
(313, 75, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 50, 8500, 425000),
(314, 75, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 50, 8500, 425000),
(315, 75, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 50, 8500, 425000),
(316, 75, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 8500, 425000),
(317, 75, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 350, 8500, 2975000),
(318, 76, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 550, 7100, 3905000),
(319, 77, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 550, 7100, 3905000),
(320, 78, 'ANLAO_02', 'Mật ong Bee T 250ml', 1, 190000, 190000),
(321, 79, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 14000, 700000),
(322, 80, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 14000, 700000),
(323, 81, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 14000, 70000),
(324, 82, 'CAZIN_03', 'Trà Tía Tô 80g', 1, 65000, 65000),
(325, 83, 'LAMA_10', 'Cà phê Lamant Cà phê latte (không ngọt)', 6, 55000, 330000),
(326, 83, 'LAMA_05', 'Lamant cafe túi lọc đặc sản', 6, 185000, 1110000),
(327, 83, 'DULAH_04', 'Trà nụ hoa hòe - Túi lọc', 6, 90000, 540000),
(328, 84, 'KOHA_01', 'Hạt Macca Bazan', 1, 150000, 150000),
(329, 84, 'DULAH_04', 'Trà nụ hoa hòe - Túi lọc', 1, 90000, 90000),
(330, 84, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 2, 110000, 220000),
(331, 84, 'LAMA_09', 'Cà phê Lamant Cappuchino dừa', 1, 55000, 55000),
(332, 84, 'LAMA_10', 'Cà phê Lamant Cà phê latte (không ngọt)', 1, 55000, 55000),
(335, 87, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 50, 10000, 500000),
(336, 87, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 50, 10000, 500000),
(337, 87, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 25, 7000, 175000),
(338, 87, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 25, 7000, 175000),
(339, 87, 'SACHI-10', 'Đậu phộng tỏi ớt', 30, 7000, 210000),
(340, 88, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 150, 0, 0),
(341, 89, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(342, 90, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(343, 91, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(344, 92, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 1, 14000, 14000),
(345, 92, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 1, 14000, 14000),
(346, 92, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(347, 93, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(348, 94, 'GAO_01', 'Gạo Hoài Ân, túi 5kg', 1, 135000, 135000),
(349, 94, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 3, 10000, 30000),
(350, 94, 'TN_01', 'Phở ăn liền Trường Nam', 1, 30000, 30000),
(351, 95, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 450, 7000, 3150000),
(352, 96, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 450, 7000, 3150000),
(353, 98, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 4, 40000, 160000),
(354, 98, 'KAMI_01', 'Bánh Kami Tảo Biển', 4, 35000, 140000),
(355, 98, 'CPIE_01', 'Bánh Combo Pie', 4, 45000, 180000),
(356, 98, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 8, 14000, 112000),
(357, 98, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 8, 14000, 112000),
(358, 98, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 8, 10000, 80000),
(359, 98, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 8, 10000, 80000),
(360, 98, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 4, 50000, 200000),
(361, 98, 'PL_01', 'Hũ bánh Phục Linh', 4, 65000, 260000),
(362, 98, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 9000, 90000),
(363, 98, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 2, 85000, 170000),
(364, 98, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 2, 95000, 190000),
(368, 102, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 25, 9000, 225000),
(369, 102, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 25, 9000, 225000),
(370, 103, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 300, 7000, 2100000),
(371, 104, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 2, 95000, 190000),
(372, 105, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(373, 105, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 10000, 10000),
(374, 105, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(375, 105, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(376, 106, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 1, 10000, 10000),
(377, 106, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 1, 10000, 10000),
(378, 106, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 1, 14000, 14000),
(379, 106, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(380, 107, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 4, 40000, 160000),
(381, 107, 'KAMI_01', 'Bánh Kami Tảo Biển', 4, 35000, 140000),
(382, 107, 'CPIE_01', 'Bánh Combo Pie', 4, 45000, 180000),
(383, 107, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 4, 14000, 56000),
(384, 107, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 4, 14000, 56000),
(385, 107, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 8, 10000, 80000),
(386, 107, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 8, 10000, 80000),
(387, 107, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 9000, 90000),
(388, 107, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 1, 85000, 85000),
(389, 107, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 4, 95000, 380000),
(390, 108, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 4, 40000, 160000),
(391, 108, 'KAMI_01', 'Bánh Kami Tảo Biển', 4, 35000, 140000),
(392, 108, 'CPIE_01', 'Bánh Combo Pie', 4, 45000, 180000),
(393, 108, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 8, 10000, 80000),
(394, 108, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 8, 10000, 80000),
(395, 108, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 4, 14000, 56000),
(396, 108, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 4, 14000, 56000),
(397, 108, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 9000, 90000),
(398, 108, 'PL_01', 'Hũ bánh Phục Linh', 4, 65000, 260000),
(399, 108, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 4, 50000, 200000),
(400, 108, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 1, 85000, 85000),
(401, 108, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 4, 95000, 380000),
(402, 109, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 4, 40000, 160000),
(403, 109, 'KAMI_01', 'Bánh Kami Tảo Biển', 4, 35000, 140000),
(404, 109, 'CPIE_01', 'Bánh Combo Pie', 4, 45000, 180000),
(405, 109, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 8, 10000, 80000),
(406, 109, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 8, 10000, 80000),
(407, 109, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 4, 14000, 56000),
(408, 109, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 4, 14000, 56000),
(409, 109, 'SACHI-10', 'Đậu phộng tỏi ớt', 10, 9000, 90000),
(410, 109, 'PL_01', 'Hũ bánh Phục Linh', 4, 65000, 260000),
(411, 109, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 1, 85000, 85000),
(412, 109, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 4, 95000, 380000),
(413, 109, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 4, 50000, 200000),
(414, 110, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 150, 6800, 1020000),
(415, 110, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 100, 6800, 680000),
(416, 111, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 490, 7000, 3430000),
(417, 113, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(418, 114, 'LAMA_09', 'Cà phê Lamant Cappuchino dừa', 1, 55000, 55000),
(419, 115, 'SACHI-10', 'Đậu phộng tỏi ớt', 1, 9000, 9000),
(420, 116, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 4, 85000, 340000),
(421, 116, 'KG_01', 'Bánh thuyền hạt HỘP 200G', 4, 85000, 340000),
(422, 116, 'PA_03', 'Bún bò Huế cao cấp Phương Anh - 300g', 6, 40000, 240000),
(423, 116, 'LAMA_10', 'Cà phê Lamant Cà phê latte (không ngọt)', 4, 55000, 220000),
(424, 116, 'LAMA_05', 'Lamant cafe túi lọc đặc sản', 4, 185000, 740000),
(425, 116, 'LAMA_11', 'Cà phê Lamant Pure Black', 4, 55000, 220000),
(426, 116, 'TQ_02', 'Tinh Bột Nghệ Sẻ (250gram)', 4, 100000, 400000),
(427, 116, 'KOHA_01', 'Hạt Macca Bazan', 6, 150000, 900000),
(428, 116, 'PL_01', 'Hũ bánh Phục Linh', 4, 65000, 260000),
(429, 116, 'DULAH_04', 'Trà nụ hoa hòe - Túi lọc', 6, 90000, 540000),
(430, 116, 'QNX_01', 'Trà Hương Bưởi', 4, 90000, 360000),
(431, 117, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 2, 110000, 220000),
(432, 117, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 2, 50000, 100000),
(433, 118, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(434, 118, 'MD_01', 'Trà Gò Loi', 2, 100000, 200000),
(435, 118, 'DULAH_07', 'Trà nụ hoa hòe SOJA TEA 200gr', 1, 180000, 180000),
(436, 118, 'VH_01', 'Tiêu đen hữu cơ', 1, 100000, 100000),
(437, 118, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(438, 119, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 1, 14000, 14000),
(439, 119, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(440, 119, 'VH_01', 'Tiêu đen hữu cơ', 1, 100000, 100000),
(441, 119, 'DULAH_07', 'Trà nụ hoa hòe SOJA TEA 200gr', 1, 180000, 180000),
(442, 120, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 14, 110000, 1540000),
(443, 120, 'CAZIN_03', 'Trà Tía Tô 80g', 7, 65000, 455000),
(444, 120, 'LAMA_04', 'Lamant Cafe vị nguyên bản 3in1', 6, 50000, 300000),
(445, 120, 'LAMA_09', 'Cà phê Lamant Cappuchino dừa', 8, 55000, 440000),
(446, 120, 'LAMA_12', 'Cà phê Lamant Cappuchino Socola', 7, 55000, 385000),
(447, 120, 'LAMA_10', 'Cà phê Lamant Cà phê latte (không ngọt)', 7, 55000, 385000),
(448, 120, 'LAMA_13', 'Cà phê Lamant Cà phê sữa đá', 7, 55000, 385000),
(449, 120, 'LAMA_05', 'Lamant cafe túi lọc đặc sản', 7, 185000, 1295000),
(450, 120, 'KG_01', 'Bánh thuyền hạt HỘP 200G', 10, 85000, 850000),
(451, 120, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 4, 85000, 340000),
(452, 120, 'HURA_02', 'Bánh Hura layercake vị dâu', 7, 40000, 280000),
(453, 120, 'PL_01', 'Hũ bánh Phục Linh', 14, 65000, 910000),
(454, 120, 'PA_01', 'Bún khô Phương Anh - 300g', 12, 40000, 480000),
(455, 120, 'PA_02', 'Bún Tươi Phương Anh - 300g', 2, 40000, 80000),
(456, 120, 'KOHA_01', 'Hạt Macca Bazan', 14, 150000, 2100000),
(457, 121, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 1, 95000, 95000),
(458, 121, 'PL_01', 'Hũ bánh Phục Linh', 3, 65000, 195000),
(459, 121, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 6, 10000, 60000),
(460, 121, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 6, 10000, 60000),
(461, 121, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 8, 14000, 112000),
(462, 121, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 8, 14000, 112000),
(463, 121, 'HURA_01', 'Bánh Hura layercake vị bơ sữa', 3, 40000, 120000),
(464, 121, 'CPIE_01', 'Bánh Combo Pie', 6, 45000, 270000),
(465, 121, 'KAMI_01', 'Bánh Kami Tảo Biển', 3, 35000, 105000),
(466, 122, 'CPIE_01', 'Bánh Combo Pie', 1, 45000, 45000),
(467, 122, 'KAMI_01', 'Bánh Kami Tảo Biển', 1, 35000, 35000),
(468, 122, 'HURA_02', 'Bánh Hura layercake vị dâu', 1, 40000, 40000),
(469, 122, 'KOHA_01', 'Hạt Macca Bazan', 1, 150000, 150000),
(470, 122, 'KG_02', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 1, 95000, 95000),
(471, 122, 'CAZIN_03', 'Trà Tía Tô 80g', 1, 65000, 65000),
(472, 122, 'QNX_01', 'Trà Hương Bưởi', 1, 90000, 90000),
(473, 122, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 1, 110000, 110000),
(474, 122, 'PL_01', 'Hũ bánh Phục Linh', 2, 65000, 130000),
(475, 122, 'LAMA_05', 'Lamant cafe túi lọc đặc sản', 1, 185000, 185000),
(476, 122, 'LAMA_10', 'Cà phê Lamant Cà phê latte (không ngọt)', 1, 55000, 55000),
(477, 122, 'LAMA_13', 'Cà phê Lamant Cà phê sữa đá', 1, 55000, 55000),
(478, 122, 'LAMA_09', 'Cà phê Lamant Cappuchino dừa', 1, 55000, 55000),
(479, 122, 'LAMA_12', 'Cà phê Lamant Cappuchino Socola', 1, 55000, 55000),
(480, 123, 'TQ_01', 'Tinh Bột Nghệ (500gram)', 2, 200000, 400000),
(481, 124, 'LAMA_03', 'Cà phê Lamant truyền thống (500gram)', 1, 0, 0),
(482, 125, 'LAMA_01', 'Cà phê Lamant phin nhẹ (500gram)', 1, 0, 0),
(483, 126, 'SACHI-09', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 10, 10000, 100000),
(484, 126, 'SACHI-07', 'Bánh tráng gạo mè (Vị Quê)', 10, 10000, 100000),
(485, 126, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 10, 10000, 100000),
(486, 126, 'MD_01', 'Trà Gò Loi', 2, 100000, 200000),
(487, 126, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 15, 14000, 210000),
(488, 126, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 15, 14000, 210000),
(489, 126, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 15, 14000, 210000),
(490, 126, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 15, 14000, 210000),
(491, 126, 'LAMA_03', 'Cà phê Lamant truyền thống (500gram)', 2, 185000, 370000),
(492, 126, 'LAMA_01', 'Cà phê Lamant phin nhẹ (500gram)', 1, 170000, 170000),
(493, 126, 'LAMA_02', 'Cà phê Lamant phin nhẹ (250gram)', 2, 90000, 180000),
(494, 127, 'DULAH_01', 'Dầu mè đen', 1, 85000, 85000),
(495, 127, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 1, 110000, 110000),
(496, 128, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 3, 0, 0),
(497, 129, 'LAMA_11', 'Cà phê Lamant Cà phê sữa đá', 1, 0, 0),
(498, 129, 'LAMA_10', 'Cà phê Lamant Cappuchino Socola', 2, 0, 0),
(499, 129, 'LAMA_08', 'Cà phê Lamant Cappuchino dừa', 3, 0, 0),
(500, 129, 'QNX_01', 'Trà Hương Bưởi', 1, 0, 0),
(501, 129, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 1, 0, 0),
(502, 129, 'KG_01', 'Bánh thuyền hạt HỘP 200G', 2, 0, 0),
(503, 129, 'PA_02', 'Bún Tươi Phương Anh - 300g', 2, 0, 0),
(504, 129, 'PA_03', 'Bún bò Huế cao cấp Phương Anh - 300g', 6, 0, 0),
(505, 130, 'MD_01', 'Trà Gò Loi', 1, 0, 0),
(506, 131, 'DULAH_03', 'Trà nụ hoa hòe - Hộp thiếc', 3, 0, 0),
(507, 131, 'LAMA_11', 'Cà phê Lamant Cà phê sữa đá', 1, 0, 0),
(508, 131, 'LAMA_10', 'Cà phê Lamant Cappuchino Socola', 2, 0, 0),
(509, 131, 'LAMA_08', 'Cà phê Lamant Cappuchino dừa', 3, 0, 0),
(510, 131, 'LAMA_03', 'Lamant Cafe vị nguyên bản 3in1', 9, 0, 0),
(511, 131, 'KG_03', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 1, 0, 0),
(512, 131, 'KG_01', 'Bánh thuyền hạt HỘP 200G', 2, 0, 0),
(513, 131, 'PA_03', 'Bún bò Huế cao cấp Phương Anh - 300g', 6, 0, 0),
(514, 131, 'PA_02', 'Bún Tươi Phương Anh - 300g', 2, 0, 0),
(515, 132, 'MD_01', 'Trà Gò Loi', 1, 0, 0),
(516, 133, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 14000, 70000),
(517, 133, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 5, 14000, 70000),
(518, 133, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 5, 14000, 70000),
(519, 133, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 5, 14000, 70000),
(520, 134, 'QNX_01', 'Trà Hương Bưởi', 1, 0, 0),
(521, 135, 'LAMA_08', 'Cà phê Lamant Cappuchino dừa', 2, 55000, 110000),
(522, 135, 'KOHA_01', 'Hạt Macca Bazan', 2, 150000, 300000),
(523, 135, 'LAMA_01', 'Cà phê Lamant phin nhẹ (500gram)', 4, 184999, 739996),
(524, 136, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(525, 137, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 1, 14000, 14000),
(526, 138, 'SACHI-08', 'Bánh tráng nước dừa (Vị Quê)', 3, 10000, 30000),
(527, 139, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 10000, 50000),
(528, 139, 'SACHI-02', 'Snack bánh tráng nướng Sachi phủ rong biển', 5, 10000, 50000),
(529, 139, 'SACHI-03', 'Snack bánh tráng nướng Sachi phủ khô bò', 5, 10000, 50000),
(530, 139, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 10000, 50000),
(531, 139, 'SACHI-05', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 5, 10000, 50000),
(532, 139, 'SACHI-06', 'Snack bánh tráng nướng Sachi phủ mực nướng', 5, 10000, 50000),
(533, 140, 'SACHI-04', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 5, 10000, 50000),
(534, 140, 'SACHI-01', 'Snack bánh tráng Sachi phủ phô mai', 5, 10000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `wholesale_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `des1` varchar(1000) DEFAULT NULL,
  `des2` varchar(1000) DEFAULT NULL,
  `unit` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_url_2` varchar(255) DEFAULT NULL,
  `image_url_3` varchar(255) DEFAULT NULL,
  `image_url_4` varchar(255) DEFAULT NULL,
  `certifications` varchar(100) NOT NULL,
  `is_new` tinyint(1) DEFAULT 1,
  `quantity` varchar(100) DEFAULT 'Liên hệ',
  `status` enum('available','hidden') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_trending` tinyint(1) NOT NULL DEFAULT 0,
  `is_sale` tinyint(1) DEFAULT 0,
  `sale_price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `category`, `product_name`, `price`, `wholesale_price`, `des1`, `des2`, `unit`, `image_url`, `image_url_2`, `image_url_3`, `image_url_4`, `certifications`, `is_new`, `quantity`, `status`, `created_at`, `updated_at`, `is_trending`, `is_sale`, `sale_price`) VALUES
('ANLAO_01', 15, 'Mật ong', 'Mật ong Bee T 500ml', 370000, 0.00, '', '', 'Chai', 'uploads/products/1777080611_mật ong.jpg', '', '', '', '', 1, '4', 'available', '2026-04-25 01:30:11', '2026-05-05 09:47:14', 0, 0, 0),
('ANLAO_02', 15, 'Mật ong', 'Mật ong Bee T 250ml', 190000, 0.00, '', '', '', 'uploads/products/1777974190_Mật ong An Lão 250ml.jpg', '', '', '', '', 1, '8', 'available', '2026-05-05 09:43:10', NULL, 0, 0, 0),
('ANLAO_03', 12, 'Tinh Bột', 'Viên tinh nghệ mật ong rừng 150g', 150000, 0.00, '', '', 'Hủ', 'uploads/products/1777108596_viên ting nghệ mật ong rừng.jpg', '', '', '', '', 1, '2', 'available', '2026-04-25 09:16:36', '2026-05-14 09:45:08', 0, 0, 0),
('CAZIN_01', 12, 'Tinh Bột', 'bột Sâm đất võ', 140000, 0.00, '', '', 'Hủ', 'uploads/products/1777108168_bột sâm đỏ.jpg', '', '', '', '', 1, '3', 'available', '2026-04-25 09:09:28', NULL, 0, 0, 0),
('CAZIN_02', 12, 'Tinh Bột', 'Bột Trà Dung Xanh', 140000, 0.00, '', '', '', 'uploads/products/1777108491_bột trà dung xanh.jpg', '', '', '', '', 1, '5', 'available', '2026-04-25 09:14:51', NULL, 0, 0, 0),
('CAZIN_03', 6, 'Trà', 'Trà Tía Tô 80g', 65000, 0.00, '', '', '', 'uploads/products/1778580096_z7797295213809_e20be102f6fe85d7cb6cfcfda0bc57bf.jpg', '', '', '', '', 1, '21', 'available', '2026-05-12 10:01:36', '2026-05-14 09:44:23', 0, 0, 0),
('CAZIN_04', 6, 'Trà', 'TRÀ DUNG ', 45000, 0.00, '', '', 'Gói', 'uploads/products/1778757767_20240722_162433.jpeg', '', '', '', '', 1, '4', 'available', '2026-05-14 11:22:47', NULL, 0, 0, 0),
('CPIE_01', 10, 'BÁNH NGỌT', 'Bánh Combo Pie', 45000, 0.00, '', '', 'Hộp', 'uploads/products/1776845195_bánh combo pie.jpg', '', '', '', '', 1, '45', 'available', '2026-04-22 08:06:35', '2026-04-22 08:35:51', 0, 0, 0),
('DULAH_01', 13, 'Dầu ăn', 'Dầu mè đen', 85000, 0.00, '', '', 'Chai', 'uploads/products/1776929956_dầu mè đen.jpg', '', '', '', '', 1, '8', 'available', '2026-04-23 07:39:16', NULL, 0, 0, 0),
('DULAH_02', 13, 'Dầu ăn', 'Dầu đậu phộng ', 130000, 0.00, '', '', 'Chai', 'uploads/products/1778750008_z7797344469832_1982fe1c14715efe1354b6a19c5e9735.jpg', '', '', '', '', 1, '5', 'available', '2026-05-14 09:13:28', '2026-05-14 09:41:57', 0, 0, 0),
('DULAH_03', 6, 'Trà', 'Trà nụ hoa hòe - Hộp thiếc', 110000, 0.00, '', '', 'Hộp', 'uploads/products/1776002494_tranuhoahe.jpg', '', '', '', '', 0, '19', 'available', '2026-04-12 14:01:34', '2026-05-16 09:52:23', 0, 0, 0),
('DULAH_04', 6, 'Trà', 'Trà nụ hoa hòe - Túi lọc', 90000, 0.00, '', '', 'Hộp', 'uploads/products/1776002670_tranuhoahe2.jpg', '', '', '', '', 0, '16', 'available', '2026-04-12 14:04:30', '2026-05-16 09:52:49', 0, 0, 0),
('DULAH_05', 6, 'Trà', 'SOJA TEA plus cordyceps 78g', 250000, 0.00, '', '', 'Hộp', 'uploads/products/1778925236_684025945_1480178940554803_6500311963324576626_n (1).jpg', '', '', '', '', 1, '8', 'available', '2026-05-16 09:53:56', NULL, 0, 0, 0),
('DULAH_06', 6, 'Trà', 'SOJA TEA net weight 100g', 280000, 0.00, '', '', 'Hủ', 'uploads/products/1778925344_701003053_965072506161516_7088325680327546922_n.jpg', '', '', '', '', 1, '3', 'available', '2026-05-16 09:55:44', NULL, 0, 0, 0),
('DULAH_07', 6, 'Trà', 'Trà nụ hoa hòe SOJA TEA 200gr', 180000, 0.00, '', '', 'Túi', 'uploads/products/1778925695_686955540_981370731033143_7589351490834691668_n (1).jpg', '', '', '', '', 1, '1', 'available', '2026-05-16 10:01:35', NULL, 0, 0, 0),
('GAO_01', 17, 'Gạo', 'Gạo Hoài Ân, túi 5kg', 135000, 0.00, '', '', 'Túi', 'uploads/products/1778143161_Gạo.jpg', '', '', '', '', 1, '1', 'available', '2026-05-07 08:39:21', NULL, 0, 0, 0),
('HAIHA_01', 10, 'Bánh Ngọt', 'Bánh LONGPIE kem marshmallow phủ socola hương cốm 288G', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1780478879_BÁNH LONGPIE CỐM.jpg', '', '', '', '', 1, '20', 'available', '2026-06-03 09:27:59', NULL, 0, 0, 0),
('HAIHA_02', 10, 'Bánh Ngọt', 'Bánh LongPie vị dâu tây 88g', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1780478937_BANHSD DÂU LONGPIE.jpeg', '', '', '', '', 1, '20', 'available', '2026-06-03 09:28:57', NULL, 0, 0, 0),
('HAIHA_03', 20, 'Kẹo', 'Kẹo Sofee Chocolate Toffee 250G', 45000, 0.00, '', '', 'Túi', 'uploads/products/1780479039_SOFFE.jfif', '', '', '', '', 1, '20', 'available', '2026-06-03 09:30:39', NULL, 0, 0, 0),
('HURA_01', 10, 'BÁNH NGỌT', 'Bánh Hura layercake vị bơ sữa', 40000, 0.00, '', '', 'Hộp', 'uploads/products/1776998466_hura.jpg', '', '', '', '', 1, '1', 'available', '2026-04-22 08:10:29', '2026-04-24 02:41:06', 0, 0, 0),
('HURA_02', 10, 'BÁNH NGỌT', 'Bánh Hura layercake vị dâu', 40000, 0.00, '', '', 'Hộp', 'uploads/products/1776931155_hura dâu.jpg', '', '', '', '', 1, '15', 'available', '2026-04-22 08:12:13', '2026-04-23 07:59:15', 0, 0, 0),
('KAMI_01', 10, 'BÁNH NGỌT', 'Bánh Kami Tảo Biển', 35000, 0.00, '', '', 'Hộp', 'uploads/products/1776845610_Kami tảo biển.jpg', '', '', '', '', 1, '4', 'available', '2026-04-22 08:13:30', '2026-04-22 08:36:56', 0, 0, 0),
('KG_01', 11, 'Hạt', 'Bánh thuyền hạt HỘP 200G', 85000, 0.00, '', '', 'Hộp', 'uploads/products/1776853177_bánh thuyền hạt.jpg', '', '', '', '', 1, '40', 'available', '2026-04-22 10:19:37', '2026-05-21 02:10:44', 0, 0, 0),
('KG_02', 18, 'NGŨ CỐC', 'BỘT NGŨ CỐC 8 LOẠI HẠT KHÁNH GIANG', 95000, 0.00, '', '', 'Hộp', 'uploads/products/1778578609_z55608225927402d4f3578b385a0d6de830555c7d0c6b2-08070628082024UUVMN.jpg', '', '', '', '', 1, '12', 'available', '2026-05-12 09:36:49', NULL, 0, 0, 0),
('KG_03', 11, 'Hạt', 'Bánh Thuyền Hạt Khánh Giang 200g Gói', 85000, 0.00, '', '', 'Túi', 'uploads/products/1778579057_unnamed.jpg', '', '', '', '', 1, '20', 'available', '2026-05-12 09:41:33', '2026-05-12 09:44:17', 0, 0, 0),
('KICAFOOD_01', 5, 'Bún', 'Bún ngô', 35000, 0.00, '', '', 'Túi', 'uploads/products/1778580961_6fb9d66a-2d2e-401e-b945-bb98373bee13.jfif', '', '', '', '', 1, '10', 'available', '2026-05-12 10:16:01', NULL, 0, 0, 0),
('KICAFOOD_02', 5, 'Bún', 'Bún khô', 27000, 0.00, '', '', 'Gói', 'uploads/products/1778836041_bunkho250_59f932e397c74b0cb686d0f4ee3c0b0f_27dba41e96cd450aa4a12f2e653526bd_1024x1024.jpg', '', '', '', '', 1, '10', 'available', '2026-05-13 09:07:07', '2026-05-15 09:07:21', 0, 0, 0),
('KOHA_01', 11, 'Hạt', 'Hạt Macca Bazan', 150000, 0.00, '', '', 'Hộp', 'uploads/products/1776998190_macca.jpg', '', '', '', '', 1, '31', 'available', '2026-04-22 10:18:19', '2026-04-24 02:36:30', 0, 0, 0),
('LAMA_01', 7, 'Cà phê', 'Cà phê Lamant phin nhẹ (500gram)', 185000, 0.00, '', '', 'Gói', 'uploads/products/1780539618_z7891471584948_0e7b168008933cb613a55a6e9f10f6bc.jpg', '', '', '', '', 1, '16', 'available', '2026-04-21 10:18:02', '2026-06-10 08:45:36', 0, 0, 0),
('LAMA_02', 7, 'Cà phê', 'Cà phê Lamant PHIN truyền thống (1KG)', 320000, 0.00, '', '', 'Gói', 'uploads/products/1780539859_z7891540797381_fc1ee7898247443021811a0a874c0134.jpg', '', '', '', '', 1, '10', 'available', '2026-04-21 10:35:35', '2026-06-04 02:24:19', 0, 0, 0),
('LAMA_03', 7, 'Cà phê', 'Lamant Cafe vị nguyên bản 3in1', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1776829169_ff702a06cc774d291466.jpg', '', '', '', '', 1, '0', 'available', '2026-04-22 03:39:29', '2026-06-04 02:24:39', 0, 0, 0),
('LAMA_04', 7, 'Cà phê', 'Lamant cafe túi lọc đặc sản', 185000, 0.00, '', '', '', 'uploads/products/1776831302_cafe túi lọc đặc sản.jpg', '', '', '', '', 1, '8', 'available', '2026-04-22 04:15:02', '2026-06-04 02:24:59', 0, 0, 0),
('LAMA_05', 7, 'Cà phê', 'Lamant Cafe Fine Organic ', 190000, 0.00, '', '', 'Hộp', 'uploads/products/1776848856_Lamant Fine Organic.jpg', '', '', '', '', 1, '3', 'available', '2026-04-22 09:07:36', '2026-06-04 02:25:20', 0, 0, 0),
('LAMA_06', 7, 'Cà phê', 'Lamant Cafe Fine Organic hộp thiếc', 119000, 0.00, '', '', 'Hộp', 'uploads/products/1780388950_z7891580091521_b673f6d87160dc92c9247a73d890397d.jpg', '', '', '', '', 1, '2', 'available', '2026-04-22 09:15:49', '2026-06-04 02:25:48', 0, 0, 0),
('LAMA_07', 7, 'Cà Phê', 'Lamant Cafe vị nguyên bản 3in1 (1,6kg)', 329000, 0.00, '', '', 'Túi', 'uploads/products/1780369845_z7891573479495_d1dc3cf0a7883ce36e0104aa33a44dc4.jpg', '', '', '', '', 1, '4', 'available', '2026-04-28 03:30:49', '2026-06-04 02:26:05', 0, 0, 0),
('LAMA_08', 7, 'Cà Phê', 'Cà phê Lamant Cappuchino dừa', 55000, 0.00, '', '', 'Hộp', 'uploads/products/1777449847_671717617_122176848854413656_1210361457345295439_n.jpg', '', '', '', '', 0, '12', 'available', '2026-04-29 08:04:07', '2026-06-04 02:26:25', 0, 0, 0),
('LAMA_09', 7, 'Cà Phê', 'Cà phê Lamant Pure Black', 55000, 0.00, '', '', 'Hộp', 'uploads/products/1777450192_671487648_122176848728413656_4595149763384939500_n.jpg', '', '', '', '', 0, '36', 'available', '2026-04-29 08:09:52', '2026-06-04 02:28:40', 0, 0, 0),
('LAMA_10', 7, 'Cà Phê', 'Cà phê Lamant Cappuchino Socola', 55000, 0.00, '', '', 'Hộp', 'uploads/products/1777450488_674119319_122176848644413656_4311362708365223197_n.jpg', '', '', '', '', 1, '14', 'available', '2026-04-29 08:14:48', '2026-06-04 02:29:21', 0, 0, 0),
('LAMA_11', 7, 'Cà Phê', 'Cà phê Lamant Cà phê sữa đá', 55000, 0.00, '', '', 'Hộp', 'uploads/products/1777450696_674731507_122176848788413656_4884152114822880902_n.jpg', '', '', '', '', 1, '15', 'available', '2026-04-29 08:18:16', '2026-06-04 02:29:40', 0, 0, 0),
('LAMA_12', 7, 'Cà Phê', 'Cà phê Lamant Cà phê latte (không ngọt)', 55000, 0.00, '', '', 'Hộp', 'uploads/products/1777450033_673881198_122176849058413656_7285879195037560491_n.jpg', '', '', '', '', 0, '6', 'available', '2026-04-29 08:07:13', '2026-06-04 02:29:55', 0, 0, 0),
('MD_01', 6, 'Trà', 'Trà Gò Loi', 100000, 0.00, '', '', 'Túi', 'uploads/products/1778919711_701745675_2804412793246349_5791910614990492581_n (1).jpg', '', '', '', '', 1, '6', 'available', '2026-05-16 08:21:51', NULL, 0, 0, 0),
('PA_01', 5, 'Bún', 'Bún khô Phương Anh - 300g', 40000, 0.00, 'Sản phẩm Bún Khô thương hiệu Phương Anh được chế biến và sản xuất với tiêu chuẩn 2 không đã được kiểm định và xuất khẩu số lượng lớn: \r\n- Không sử dụng bất kỳ chất phụ gia nào khác (100% từ gạo) \r\n- Không sử dụng hóa chất nào khác như chất tạo màu, chất tẩy trắng gạo. Đảm bảo màu trắng tự nhiên của sợi bún Chế biến được nhiều món ngon hằng ngày từ sản phẩm bún tươi Phương Anh.', '', 'Bì', 'uploads/products/1776001663_bunkhophuonganh.jpg', '', '', '', '', 0, '2', 'available', '2026-04-12 13:47:43', NULL, 0, 0, 0),
('PA_02', 5, 'Bún', 'Bún Tươi Phương Anh - 300g', 40000, 0.00, 'Sản phẩm Bún Tươi thương hiệu Phương Anh được chế biến và sản xuất với tiêu chuẩn 2 không đã được kiểm định và xuất khẩu số lượng lớn: \r\n- Không sử dụng bất kỳ chất phụ gia nào khác (100% từ gạo) \r\n- Không sử dụng hóa chất nào khác như chất tạo màu, chất tẩy trắng gạo. Đảm bảo màu trắng tự nhiên của sợi bún Chế biến được nhiều món ngon hằng ngày từ sản phẩm bún tươi Phương Anh.', '', 'Bì', 'uploads/products/1776001783_buntuoiphuonganh.jpg', '', '', '', '', 0, '6', 'available', '2026-04-12 13:49:43', NULL, 0, 0, 0),
('PA_03', 5, 'Bún', 'Bún bò Huế cao cấp Phương Anh - 300g', 40000, 0.00, 'Sản phẩm Bún Bò Huế thương hiệu Phương Anh được chế biến và sản xuất với tiêu chuẩn 2 không đã được kiểm định và xuất khẩu số lượng lớn: \r\n- Không sử dụng bất kỳ chất phụ gia nào khác (100% từ gạo).\r\n- Không sử dụng hóa chất nào khác như chất tạo màu, chất tẩy trắng gạo. Đảm bảo màu trắng tự nhiên của sợi bún Chế biến được nhiều món ngon hằng ngày từ sản phẩm bún tươi Phương Anh Bún Bò Huế Phương Anh Chuẩn Hương Vị Việt.\r\n', '', 'Hộp', 'uploads/products/1776001903_bunbohuephuonganh.jpg', '', '', '', '', 0, '5', 'available', '2026-04-12 13:51:43', NULL, 0, 0, 0),
('PL_01', 10, 'Bánh Ngọt', 'Hũ bánh Phục Linh', 65000, 0.00, '', '', 'Hủ', 'uploads/products/1778668225_690732593_1324848932858908_8367896265759935599_n.jpg', '', '', '', '', 1, '7', 'available', '2026-05-13 09:03:21', '2026-05-13 10:30:25', 0, 0, 0),
('QNX_01', 6, 'Trà', 'Trà Hương Bưởi', 90000, 0.00, '', '', 'Hủ', 'uploads/products/1776935475_Trà hương bưởi.jpg', '', '', '', '', 1, '12', 'available', '2026-04-23 09:11:15', NULL, 0, 0, 0),
('SACHI-01', 1, 'Snack (ăn vặt)', 'Snack bánh tráng Sachi phủ phô mai', 14000, 0.00, '', '', 'Bì', 'uploads/products/1774281126_banhtrangsachiphomai1.jpg', '', '', '', 'Ocop', 1, '114', 'available', '2026-03-23 15:52:06', '2026-04-20 12:33:07', 1, 0, 0),
('SACHI-02', 1, 'Snack (ăn vặt)', 'Snack bánh tráng nướng Sachi phủ rong biển', 14000, 0.00, '', '', 'Bì', 'uploads/products/1774332344_Snack Sachi Rong biển.webp', '', '', '', '', 1, '53', 'available', '2026-03-23 15:53:56', NULL, 0, 0, 0),
('SACHI-03', 1, 'Snack (ăn vặt)', 'Snack bánh tráng nướng Sachi phủ khô bò', 14000, 0.00, '', '', 'Bì', 'uploads/products/1774341972_Snack Sachi vị khô bò.webp', '', '', '', '', 1, '168', 'available', '2026-03-23 16:00:22', NULL, 1, 0, 0),
('SACHI-04', 1, 'Snack (ăn vặt)', 'Snack bánh tráng nướng Sachi phủ chà bông gà', 14000, 0.00, '', '', 'Bì', 'uploads/products/1774341980_Snack Sachi vị chà bông gà.webp', '', '', '', '', 1, '140', 'available', '2026-03-23 16:01:15', NULL, 1, 0, 0),
('SACHI-05', 1, 'Snack (ăn vặt)', 'Snack bánh tráng nướng Sachi phủ tôm nướng', 14000, 0.00, '', '', 'Bì', 'uploads/products/1778143749_Snack Sachi vị Tôm.webp', '', '', '', '', 1, '129', 'available', '2026-03-23 16:02:31', '2026-05-07 08:49:09', 1, 0, 0),
('SACHI-06', 1, 'Snack (ăn vặt)', 'Snack bánh tráng nướng Sachi phủ mực nướng', 14000, 0.00, '', '', 'Bì', 'uploads/products/1774341998_Snack Sachi vị mực nướng.webp', '', '', '', '', 1, '139', 'available', '2026-03-23 16:03:22', NULL, 0, 0, 0),
('SACHI-07', 4, 'Bánh Tráng Nướng', 'Bánh tráng gạo mè (Vị Quê)', 10000, 0.00, '', '', 'Bì', 'uploads/products/1776076118_banhtranggaomevique.jpg', '', '', '', '', 1, '296', 'available', '2026-03-23 16:25:53', '2026-04-13 10:28:38', 0, 0, 0),
('SACHI-08', 4, 'Bánh Tráng Nướng', 'Bánh tráng nước dừa (Vị Quê)', 10000, 0.00, '', '', 'Bì', 'uploads/products/1776076094_banhtrangduavique.jpg', '', '', '', '', 1, '154', 'available', '2026-03-23 16:26:49', '2026-04-20 12:32:15', 0, 0, 0),
('SACHI-09', 3, 'Bánh Tráng Nhúng', 'Bánh tráng cuốn gạo giòn Sachi (100g)', 10000, 0.00, '', '', 'Bì', 'uploads/products/1775925584_banhtrangcuongaogion100g.jpg', '', '', '', '', 1, '16', 'available', '2026-03-24 06:21:45', '2026-04-11 19:04:48', 1, 0, 0),
('SACHI-10', 1, 'Snack (ăn vặt)', 'Đậu phộng tỏi ớt', 9000, 0.00, '', '', 'Bì', 'uploads/products/1776676477_dauphongtoiot.jpg', '', '', '', '', 1, '97', 'available', '2026-04-20 09:14:37', NULL, 0, 0, 0),
('SACHI_11', 3, 'Bánh Tráng Nhúng', 'Bánh tráng nhúng Gạo mè đen Sachi 120g', 28000, 0.00, '', '', '', 'uploads/products/1778750471_M_____en_bb99.jpg', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-13 09:20:40', '2026-05-14 09:48:35', 0, 0, 0),
('SACHI_12', 3, 'Bánh Tráng Nhúng', 'BÁNH TRÁNG CUỐN MÈ ĐEN 200G ', 20000, 0.00, '', '', 'Gói', 'uploads/products/1778750438_L.webp', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-14 09:20:38', NULL, 0, 0, 0),
('SACHI_13', 4, 'Bánh Tráng Nướng', 'Bánh Tráng Dừa Nướng Giòn Sachi 70G', 10000, 0.00, '', '', 'Túi', 'uploads/products/1779501441_290020072000_ced86e06da9643d7ae5782b19c218efe_master.png', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-23 01:57:21', NULL, 0, 0, 0),
('SACHI_14', 4, 'Bánh Tráng Nướng', 'Bánh Tráng Gạo Mè Sachi Nướng Giòn 70G', 10000, 0.00, '', '', 'Túi', 'uploads/products/1779501516_gạo mè.webp', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-23 01:58:36', NULL, 0, 0, 0),
('SACHI_15', 4, 'Bánh Tráng Nướng', 'Bánh Tráng Nướng Giòn Sachi Vị Rong Biển 70G', 10000, 0.00, '', '', 'Túi', 'uploads/products/1779501648_vn-11134207-7ras8-mcr8z664byr169.webp', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-23 02:00:48', NULL, 0, 0, 0),
('SACHI_16', 4, 'Bánh Tráng Nướng', 'Bánh Tráng Ruốc Biển Nướng Giòn Sachi 70G', 10000, 0.00, '', '', 'Túi', 'uploads/products/1779501750_ruốc.webp', '', '', '', '', 1, 'Liên hệ', 'available', '2026-05-23 02:02:30', NULL, 0, 0, 0),
('TL_01', 19, 'rượu', 'Rượu xoa bóp THANHLIEM 420ml', 250000, 0.00, '', '', '', 'uploads/products/1778927041_538916809_1319934300142081_181729953526006439_n (1).jpg', '', '', '', '', 1, '2', 'available', '2026-05-16 10:24:01', '2026-05-21 02:15:11', 0, 0, 0),
('TL_02', 19, 'rượu', 'Rượu xoa bóp THANHLIEM 100ml', 150000, 0.00, '', '', 'Chai', 'uploads/products/1778927408_sanpham2.png', '', '', '', '', 1, '7', 'available', '2026-05-16 10:30:08', '2026-05-21 02:15:34', 0, 0, 0),
('TN_01', 5, 'Bún', 'Phở ăn liền Trường Nam', 30000, 0.00, '', '', '', 'uploads/products/1777082533_phở ăn liền trường nam.jpg', '', '', '', '', 1, '8', 'available', '2026-04-25 02:02:13', NULL, 0, 0, 0),
('TQ_01', 12, 'Tinh Bột', 'Tinh Bột Nghệ (500gram)', 200000, 0.00, '', '', 'Hủ', 'uploads/products/1776854719_tinh bột nghệ.jpg', '', '', '', '', 1, '1', 'available', '2026-04-22 10:45:19', NULL, 0, 0, 0),
('TQ_02', 12, 'Tinh Bột', 'Tinh Bột Nghệ Sẻ (250gram)', 100000, 0.00, '', '', '', 'uploads/products/1776998903_tinh bột nghệ sả.jpg', '', '', '', '', 1, '6', 'available', '2026-04-24 02:48:23', '2026-05-04 10:49:51', 0, 0, 0),
('VH_01', 14, 'Tiêu', 'Tiêu đen hữu cơ', 100000, 0.00, '', '', 'Hộp', 'uploads/products/1776999223_tiêu đen hữu cơ hộp thiếc nhỏ.jpg', '', '', '', '', 1, '2', 'available', '2026-04-24 02:53:43', NULL, 0, 0, 0),
('VIDATA_01', 16, 'Bánh canh', 'Bánh canh mì rau củ', 50000, 0.00, '', '', '', 'uploads/products/1777081973_bánh canh mì.jpg', '', '', '', '', 1, '5', 'available', '2026-04-25 01:52:53', NULL, 0, 0, 0),
('VIDATA_02', 16, 'Bánh canh', 'Bánh canh rau củ vị BÍ ĐỎ', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1779162114_BÍ ĐỎ.jpg', '', '', '', '', 1, '2', 'available', '2026-05-19 03:41:54', NULL, 0, 0, 0),
('VIDATA_03', 16, 'Bánh canh', 'Bánh canh rau củ vị LÁ CẨM', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1779162461_LÁ CẨM.jpg', '', '', '', '', 1, '1', 'available', '2026-05-19 03:42:49', '2026-05-19 03:47:41', 0, 0, 0),
('VIDATA_04', 16, 'Bánh canh', 'Bánh canh rau củ vị MÈ ĐEN', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1779162211_MÈ ĐEN.jpg', '', '', '', '', 1, '1', 'available', '2026-05-19 03:43:31', NULL, 0, 0, 0),
('VIDATA_05 ', 16, 'Bánh canh', 'Bánh canh rau củ vị HOA ĐẬU BIẾC', 50000, 0.00, '', '', 'Hộp', 'uploads/products/1779162261_HOA ĐẬU BIẾC.jpg', '', '', '', '', 1, '1', 'available', '2026-05-19 03:44:21', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `promo_code` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `min_order_value` decimal(10,0) NOT NULL,
  `promo_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promo_type` enum('buy_x_get_y','discount_percent','discount_amount') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `buy_qty` int(11) DEFAULT 0,
  `get_qty` int(11) DEFAULT 0,
  `discount_val` decimal(10,2) DEFAULT 0.00,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `usage_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `promo_code`, `min_order_value`, `promo_name`, `promo_type`, `buy_qty`, `get_qty`, `discount_val`, `start_date`, `end_date`, `is_active`, `usage_limit`) VALUES
(10, 'SACHIMUA10TANG1', 0, 'Sachi tặng quà cuối tháng', 'buy_x_get_y', 10, 1, 0.00, '2026-04-25 23:15:00', '2026-04-30 12:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
(2, 'Thùy Dung', '', '', '2026-03-16 14:09:40'),
(3, 'Sachi', '', '', '2026-03-16 14:09:46'),
(4, 'Lamant', NULL, NULL, '2026-03-16 14:10:27'),
(5, 'Vân & Phương hàng xóm', '', '', '2026-04-07 14:40:07'),
(6, 'Quy Nhơn Xanh', '', '02 Trần Thị Kỉ', '2026-04-23 15:08:39'),
(7, 'Thôn Xuân Bắc, xã An Hòa, tỉnh Gia Lai', '0976573290', 'Thôn Xuân Bắc, xã An Hòa, tỉnh Gia Lai', '2026-05-05 16:44:24'),
(8, 'CAZIN', '0914417583', 'Tăng Lợi, Canh Vinh, Gia Lai', '2026-05-05 17:07:56'),
(9, 'Bánh Thuyền Hạt -  chị Kiều', '0964435009', '', '2026-05-06 15:32:54'),
(10, 'Macca-Kon Hà Nừng', '0868518399', '', '2026-05-06 15:33:11'),
(11, 'Trà nụ hoa hòe, dầu mè, đậu phộng - Lai', '0376064215', '', '2026-05-06 15:35:20'),
(12, 'Nghệ, mật ong - Thảo', '0976573290', '', '2026-05-06 15:35:34'),
(13, 'Bún, miến - Đông', '0355195012', '', '2026-05-06 15:35:54'),
(14, 'CF Đak Yang (nhà máy)', '+84369181413', '', '2026-05-06 15:36:48'),
(15, 'HTX Hoài Ân - anh Việt', '097 5715977', '', '2026-05-07 15:34:28'),
(16, 'VIDATA', '0934788790', 'Thôn 1, Xã Bình Nghi, Huyện Tây Sơn, Tỉnh Bình Định, Việt Nam', '2026-05-19 10:54:00'),
(17, 'Anya', '', '', '2026-05-20 15:34:32'),
(18, 'KICAFOOD', '0985692156', 'Ân Hảo Đông, Hoài Ân, Bình Định', '2026-05-21 09:09:26'),
(19, 'CÔNG TY TNHH Vĩnh Hiệp', '02693759778', '404 Lê Duẩn, Phường Thắng Lợi, Pleiku, Gia Lai, Việt Nam', '2026-05-21 09:19:43'),
(20, 'Mười Dũng', '0862473425', 'Tân Thịnh, Ân Tường Tây, Hoài Ân Bình Định', '2026-05-21 09:22:07'),
(21, 'THANHLIEM', '0914355588', '128 Trương Dương, phường Nguyễn Văn Cừ, Tp Quy Nhơn Bình Định, Việt Nam', '2026-05-21 09:31:22'),
(22, 'HAIHACO', '02438632041', '25-27 Trương Định, p Trương Mai, Hà Nội', '2026-06-06 08:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
(2, 'lamadmin', 'lam23102005'),
(3, 'thanhvan', '14021975'),
(4, 'khuong', 'admin123456'),
(5, 'lamadmin2', 'admin12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `unique_telephone` (`telephone`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_details`
--
ALTER TABLE `import_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_code` (`promo_code`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `import_details`
--
ALTER TABLE `import_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
