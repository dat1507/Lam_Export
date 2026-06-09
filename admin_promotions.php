<?php
require_once 'config/database.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();

// Truy vấn lấy danh sách khuyến mãi (Sắp xếp mới nhất lên đầu)
$query = "SELECT * FROM promotions ORDER BY id DESC";
$result = $db->query($query);
?>

<div class="max-w-6xl mx-auto px-4 py-8 h-full flex flex-col">
    
    <div class="flex justify-between items-center mb-6 shrink-0">
        <h1 class="text-2xl font-bold text-[#1a2954]">🎁 Quản Lý Khuyến Mãi</h1>
        <div class="relative w-full md:w-1/3">
            <input type="text" id="searchPromo" placeholder="Gõ tên chương trình, hoặc mã code..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm uppercase-search">
        </div>
        <a href="admin_promotions_add.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
            <span>+</span> Thêm Mã Mới
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 flex-1 overflow-hidden flex flex-col relative">
        <div class="overflow-y-auto overflow-x-auto h-full">
            <table class="w-full text-left border-collapse">
                
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm sticky top-0 z-10 outline outline-1 outline-gray-200 shadow-sm">
                    <tr>
                        <th class="p-4 bg-gray-100">Mã CODE</th>
                        <th class="p-4 bg-gray-100">Chương trình</th>
                        <th class="p-4 bg-gray-100">Chi tiết ưu đãi</th>
                        <th class="p-4 bg-gray-100">Thời gian áp dụng</th>
                        <th class="p-4 text-center bg-gray-100">Trạng thái</th>
                        <th class="p-4 text-center bg-gray-100">Hành động</th>
                    </tr>
                </thead>
                
                <tbody id="promoTableBody" class="divide-y divide-gray-200">
                    <?php if($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-blue-600">
                                <span class="bg-blue-50 border border-blue-200 px-2 py-1 rounded text-sm tracking-wider">
                                    <?= htmlspecialchars($row['promo_code']) ?>
                                </span>
                            </td>
                            
                            <td class="p-4 font-medium text-[#1a2954] max-w-[200px] break-words whitespace-normal">
                                <?= htmlspecialchars($row['promo_name']) ?>
                            </td>
                            
                            <td class="p-4 text-gray-700 font-semibold">
                                <?php if($row['promo_type'] === 'discount_amount'): ?>
                                    <span class="text-red-500">Giảm <?= number_format($row['discount_val'], 0, ',', '.') ?>đ</span>
                                <?php elseif($row['promo_type'] === 'discount_percent'): ?>
                                    <span class="text-orange-500">Giảm <?= floatval($row['discount_val']) ?>%</span>
                                <?php elseif($row['promo_type'] === 'buy_x_get_y'): ?>
                                    <span class="text-purple-600">Mua <?= $row['buy_qty'] ?> Tặng <?= $row['get_qty'] ?></span>
                                <?php else: ?>
                                    Khác
                                <?php endif; ?>
                            </td>
                            
                            <td class="p-4 text-sm text-gray-600">
                                <?php 
                                    $start_db = $row['start_date'];
                                    $end_db = $row['end_date'];

                                    $start = (empty($start_db) || strpos($start_db, '0000-00-00') !== false) 
                                            ? '<span class="text-gray-400">__/__/____</span>' 
                                            : date('d/m/Y H:i', strtotime($start_db));

                                    $end = (empty($end_db) || strpos($end_db, '0000-00-00') !== false) 
                                        ? '<span class="text-gray-400">__/__/____</span>' 
                                        : date('d/m/Y H:i', strtotime($end_db));

                                    echo "Từ: <strong class='text-gray-800'>$start</strong><br>Đến: <strong class='text-gray-800'>$end</strong>";
                                    ?>
                            </td>
                            
                            <td class="p-4 text-center">
                                <?php if($row['is_active'] == 1): ?>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                        Đang chạy
                                    </span>
                                <?php else: ?>
                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                        Đã tắt
                                    </span>
                                <?php endif; ?>
                            </td>
                            
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="admin_promotions_edit.php?id=<?= $row['id'] ?>" class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1.5 rounded-md text-sm font-semibold transition">
                                        Sửa
                                    </a>
                                     <button onclick="deletePromotion(<?= $row['id'] ?>)" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1.5 rounded-md text-sm font-semibold transition">
                                        Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                Chưa có chương trình khuyến mãi nào
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchPromo').addEventListener('input', function() {
        let keyword = this.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#promoTableBody tr');
        
        rows.forEach(row => {
            if(row.cells.length === 1) return; 

            let rowText = row.innerText.toLowerCase();
            if(rowText.includes(keyword)) {
                row.style.display = ''; 
            } else {
                row.style.display = 'none'; 
            }
        });
    });

    function deletePromotion(id){
        if(confirm('Chắc chắn muốn xóa khuyến mãi này?')){
            let formData = new FormData();
            formData.append('id', id);
            fetch('ajax_delete_promotion.php', {
                method: 'POST',
                body: formData
            })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                alert(data.message);
                location.reload(); // Tải lại trang để mất dòng vừa xóa
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => console.error('Lỗi:', error));
    }   
    }
</script>

</body>
</html>