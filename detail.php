<?php 
$active_page = 'products'; 
include 'header.php'; 
require_once 'config/database.php';
require_once 'connect.php';
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
$row = []; // Khởi tạo mảng rỗng trước cho an toàn

if ($id !== '') {
    $safe_id = mysqli_real_escape_string($conn, $id);

    // Truy vấn lấy sản phẩm theo ID
    $sql = "SELECT * FROM products WHERE id = '$safe_id'";
    $result = mysqli_query($conn, $sql);

    // Nếu câu lệnh chạy thành công và tìm thấy 1 sản phẩm
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
}

if (empty($row)) {
    echo "<div class='min-h-screen flex flex-col items-center justify-center bg-gray-50'>
            <h2 class='text-3xl font-bold text-gray-700 mb-4'>Oops! Ối giời ơi!</h2>
            <p class='text-gray-500 mb-6'>Sản phẩm bạn tìm kiếm không tồn tại hoặc đã bị ẩn.</p>
            <a href='products.php' class='bg-[#1a2954] hover:bg-[#f5b041] transition text-white font-bold px-8 py-3 rounded-xl shadow-md'>
                ⬅ Quay lại cửa hàng
            </a>
          </div>";
    include 'footer.php';
    exit;
}
?>

<script>
    function changeMainImage(element, newSrc) {
        document.getElementById('main-product-image').src = newSrc;

        let thumbs = document.querySelectorAll('.thumb-item');
        thumbs.forEach(thumb => {
            thumb.classList.remove('border-[#f5b041]');
            thumb.classList.add('border-transparent');
        });

        element.classList.remove('border-transparent', 'hover:border-gray-300');
        element.classList.add('border-[#f5b041]');
    }
</script>

<div class="bg-gray-50 pt-8 pb-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        
        <nav class="flex mb-8 text-sm text-gray-500">
            <a href="index.php" class="hover:text-[#f5b041] transition">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="products.php" class="hover:text-[#f5b041] transition">Sản phẩm</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-medium"><?php echo htmlspecialchars($row['category'] ?? ''); ?></span>
        </nav>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
    <div class="flex flex-col md:flex-row">
        
        <div class="w-full md:w-1/2 p-6 md:p-10 border-b md:border-b-0 md:border-r border-gray-100 bg-white flex flex-col items-center relative">
            
            <div class="absolute top-8 left-8 flex flex-wrap gap-2 z-10">
                <?php if (!empty($row['certifications'])): ?>
                    <span class="bg-[#f5b041] text-[#1a2954] text-xs font-bold px-3 py-1.5 rounded-full uppercase shadow-sm">
                        <?php echo htmlspecialchars($row['certifications']); ?>
                    </span>
                <?php endif; ?>
                <?php if (isset($row['is_trending']) && $row['is_trending'] == 1): ?>
                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase shadow-sm animate-floating">
                        🔥 Trending
                    </span>
                <?php endif; ?>
            </div>

            <div class="w-full aspect-square rounded-2xl overflow-hidden mb-4 border border-gray-100 shadow-sm relative group">
                <img id="main-product-image" src="<?php echo htmlspecialchars($row['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($row['product_name']); ?>" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </div>

            <div class="grid grid-cols-4 gap-3 w-full">
                <div class="aspect-square rounded-lg overflow-hidden border-2 border-[#f5b041] cursor-pointer thumb-item transition-all" 
                     onclick="changeMainImage(this, '<?php echo htmlspecialchars($row['image_url']); ?>')">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>

                <?php if (!empty($row['image_url_2'])): ?>
                <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300 cursor-pointer thumb-item transition-all" 
                     onclick="changeMainImage(this, '<?php echo htmlspecialchars($row['image_url_2']); ?>')">
                    <img src="<?php echo htmlspecialchars($row['image_url_2']); ?>" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>
                <?php endif; ?>

                <?php if (!empty($row['image_url_3'])): ?>
                <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300 cursor-pointer thumb-item transition-all" 
                     onclick="changeMainImage(this, '<?php echo htmlspecialchars($row['image_url_3']); ?>')">
                    <img src="<?php echo htmlspecialchars($row['image_url_3']); ?>" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>
                <?php endif; ?>

                <?php if (!empty($row['image_url_4'])): ?>
                <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300 cursor-pointer thumb-item transition-all" 
                     onclick="changeMainImage(this, '<?php echo htmlspecialchars($row['image_url_4']); ?>')">
                    <img src="<?php echo htmlspecialchars($row['image_url_4']); ?>" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>
                <?php endif; ?>
            </div>
        </div> <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col justify-center">
            
            <p class="text-sm font-semibold text-[#f5b041] uppercase tracking-wider mb-2">
                <?php echo htmlspecialchars($row['category'] ?? 'Chưa phân loại'); ?>
            </p>
            
            <h1 class="text-3xl md:text-4xl font-bold text-[#1a2954] mb-4 leading-tight">
                <?php echo htmlspecialchars($row['product_name']); ?>
            </h1>

            <p class="text-sm text-gray-600 mb-6 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full <?php echo ($row['quantity'] <= 0 || $row['quantity'] === 'Liên hệ') ? 'bg-orange-500' : 'bg-green-500'; ?>"></span>
                Số lượng: <span class="font-bold text-gray-800"><?php echo quantity_check($row['quantity'] ?? 0) ?></span>
            </p>
            
            <div class="bg-gray-50 p-6 rounded-xl mb-8 border border-gray-100">
                <?php if (isset($row['is_sale']) && $row['is_sale'] == 1 && isset($row['sale_price']) && $row['sale_price'] > 0): ?>
                    <div class="flex items-end gap-3">
                        <span class="text-3xl md:text-4xl font-bold text-red-600">
                            <?php echo number_format($row['sale_price'], 0, ',', '.'); ?>đ 
                        </span>
                        <span class="text-lg text-gray-400 line-through mb-1">
                            <?php echo number_format($row['price'], 0, ',', '.'); ?>đ
                        </span>
                        <span class="text-gray-500 mb-1 ml-1">/ <?php echo htmlspecialchars($row['unit']); ?></span>
                    </div>
                <?php else: ?>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl md:text-4xl font-bold text-[#1a2954]">
                            <?php echo number_format($row['price'], 0, ',', '.'); ?>đ 
                        </span>
                        <span class="text-gray-500 mb-1 ml-1">/ <?php echo htmlspecialchars($row['unit']); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-4 mb-8 text-gray-600 leading-relaxed">
                <?php if (!empty($row['des1'])): ?>
                    <p>✨<?php echo nl2br(htmlspecialchars($row['des1'])); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($row['des2'])): ?>
                    <p> <?php echo nl2br(htmlspecialchars($row['des2'])); ?></p>
                <?php endif; ?>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                <button class="flex-1 bg-[#f5b041] hover:bg-[#ffc66a] text-[#1a2954] font-bold py-4 px-8 rounded-xl transition shadow-lg flex justify-center items-center gap-2 text-lg">
                    💬 Báo giá sỉ
                </button>
            </div>

        </div> </div> </div>
        
    </div>
</div>

<?php include 'footer.php'; ?>