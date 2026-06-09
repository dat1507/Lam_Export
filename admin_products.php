<?php
require_once 'config/database.php';
require_once 'models/Product.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$stmt = $product->getAllProducts();
?>

<div class="max-w-6xl mx-auto px-4 py-8 h-full flex flex-col">
    
    <div class="flex justify-between items-center mb-6 shrink-0">
        <h1 class="text-2xl font-bold text-[#1a2954]">📦 Quản Lý Sản Phẩm</h1>
        <div class="relative w-full md:w-1/3">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500">🔍</span>
            </div>
            <input type="text" id="searchProduct" placeholder="Gõ tên, ID, hoặc giá để tìm nhanh..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
        </div>
        <a href="admin_product_add.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
            <span>+</span> Thêm Sản Phẩm Mới
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 flex-1 overflow-hidden flex flex-col relative">
        <div class="overflow-y-auto overflow-x-auto h-full">
            <table class="w-full text-left border-collapse">
                
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm sticky top-0 z-10 outline outline-1 outline-gray-200 shadow-sm">
                    <tr>
                        <th class="p-4 bg-gray-100">ID</th>
                        <th class="p-4 bg-gray-100">Hình ảnh</th>
                        <th class="p-4 bg-gray-100">Tên Sản Phẩm</th>
                        <th class="p-4 bg-gray-100">Giá bán</th>
                        <th class="p-4 text-center bg-gray-100">Kho</th>
                        <th class="p-4 text-center bg-gray-100">Trạng thái</th>
                        <th class="p-4 text-center bg-gray-100">Hành động</th>
                    </tr>
                </thead>
                
                <tbody id="productTableBody" class="divide-y divide-gray-200">
                    <?php while ($row = $stmt->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-bold text-gray-600">#<?= $row['id'] ?></td>
                        <td class="p-4">
                            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Img" class="w-12 h-12 rounded object-cover border bg-white">
                        </td>
                        <td class="p-4 font-medium text-[#1a2954] max-w-[250px] break-words whitespace-normal">
                            <?= htmlspecialchars($row['product_name']) ?>
                        </td>
                        <td class="p-4 text-red-600 font-bold">
                            <?= number_format($row['price'], 0, ',', '.') ?>đ
                        </td>
                        <td class="p-4 text-center">
                            <span class="font-bold"><?= quantity_check($row['quantity']) ?></span>
                        </td>
                        <td class="p-4 text-center">
                            <?php if($row['status'] === 'available'): ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                    Hiển thị (Web)
                                </span>
                            <?php else: ?>
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                    Đang Ẩn
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="print_barcode.php?id=<?= $row['id'] ?>" target="_blank" title="In tem mã vạch"
                                   class="bg-purple-100 text-purple-700 hover:bg-purple-200 px-3 py-1.5 rounded-md text-sm font-semibold transition flex items-center gap-1">
                                    🖨️ In Tem
                                </a>
                                <a href="admin_product_edit.php?id=<?= $row['id'] ?>" class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1.5 rounded-md text-sm font-semibold transition">
                                    Sửa
                                </a>
                                <form action="admin_product_delete.php" method="POST" onsubmit="return confirm('Có chắc muốn ẩn sản phẩm này khỏi website không?');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1.5 rounded-md text-sm font-semibold transition">
                                        Ẩn/Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div> 
<script>
    // Script Tìm kiếm sản phẩm siêu tốc không cần load lại trang
    document.getElementById('searchProduct').addEventListener('input', function() {
        let keyword = this.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#productTableBody tr');
        
        rows.forEach(row => {
            let rowText = row.innerText.toLowerCase();
            if(rowText.includes(keyword)) {
                row.style.display = ''; // Hiện
            } else {
                row.style.display = 'none'; // Ẩn
            }
        });
    });
</script>
</body>
</html>