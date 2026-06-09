<?php
require_once 'config/database.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();
$message = '';

if (!isset($_GET['id'])) {
    die("Không tìm thấy ID sản phẩm cần sửa!");
}
$product_id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Sản phẩm không tồn tại!");
}

$catQuery = "SELECT id as category_id, category_name as category FROM categories";
$catStmt = $db->query($catQuery);
$categories = $catStmt->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $uploadDir = 'uploads/products/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        if (!function_exists('uploadImage')) {
            function uploadImage($fileInputName, $uploadDir) {
                if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
                    $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']);
                    $targetFilePath = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFilePath)) {
                        return $targetFilePath;
                    }
                }
                return false; 
            }
        }

        // Lấy ID mới và ID cũ
        $new_id = trim($_POST['new_id']);
        $original_id = trim($_POST['original_id']);

        if ($new_id !== $original_id) {
            $checkStmt = $db->prepare("SELECT id FROM products WHERE id = ?");
            $checkStmt->bind_param("s", $new_id);
            $checkStmt->execute();
            if ($checkStmt->get_result()->num_rows > 0) {
                throw new Exception("Mã sản phẩm (ID) '{$new_id}' đã tồn tại! Vui lòng chọn mã khác.");
            }
        }

        $img1 = uploadImage('image_url', $uploadDir) ?: $_POST['old_image_url'];
        $img2 = uploadImage('image_url_2', $uploadDir) ?: $_POST['old_image_url_2'];
        $img3 = uploadImage('image_url_3', $uploadDir) ?: $_POST['old_image_url_3'];
        $img4 = uploadImage('image_url_4', $uploadDir) ?: $_POST['old_image_url_4'];

        $category_name = !empty($_POST['category']) ? trim($_POST['category']) : '';
        $cat_id = !empty($_POST['category_id']) ? trim($_POST['category_id']) : null;

        if (!empty($category_name) && empty($cat_id)) {
            $insertCatStmt = $db->prepare("INSERT INTO categories (category_name) VALUES (?)");
            $insertCatStmt->bind_param("s", $category_name);
            
            if ($insertCatStmt->execute()) {
                $cat_id = $insertCatStmt->insert_id; // Lấy ID vừa tạo
            } else {
                throw new Exception("Lỗi khi lưu Danh mục mới vào DB: " . $insertCatStmt->error);
            }
        }

        $query = "UPDATE products SET 
            id = ?, category_id = ?, category = ?, product_name = ?, 
            price = ?, sale_price = ?, quantity = ?, unit = ?, 
            status = ?, is_new = ?, is_trending = ?, is_sale = ?, 
            certifications = ?, des1 = ?, des2 = ?, 
            image_url = ?, image_url_2 = ?, image_url_3 = ?, image_url_4 = ?,
            updated_at = NOW()
            WHERE id = ?";

        $updateStmt = $db->prepare($query);
       
        $sale_price = !empty($_POST['sale_price']) ? $_POST['sale_price'] : 0;
        $is_new = isset($_POST['is_new']) ? 1 : 0;
        $is_trending = isset($_POST['is_trending']) ? 1 : 0;
        $is_sale = isset($_POST['is_sale']) ? 1 : 0;


        $updateStmt->bind_param("sssssssssiiissssssss", 
            $new_id, $cat_id, $category_name, $_POST['product_name'], $_POST['price'], 
            $sale_price, $_POST['quantity'], $_POST['unit'], $_POST['status'], 
            $is_new, $is_trending, $is_sale, $_POST['certifications'], 
            $_POST['des1'], $_POST['des2'], $img1, $img2, $img3, $img4, $original_id
        );

        if ($updateStmt->execute()) {
            $message = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-bold">Cập nhật thành công!</div>';
            
            $details = "Đã cập nhật thông tin sản phẩm: " . $_POST['product_name'];
            if ($new_id !== $original_id) {
                $details .= " (Có thay đổi Mã SP: " . $original_id . " ➔ " . $new_id . ")";
            }
            
            $admin_user = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin_KhongXacDinh'; 
            $action = "Sửa sản phẩm";
            
            $logQuery = "INSERT INTO activity_logs (username, action, details) VALUES (?, ?, ?)";
            $logStmt = $db->prepare($logQuery);
            if ($logStmt) {
                $logStmt->bind_param("sss", $admin_user, $action, $details);
                $logStmt->execute();
            }
            
            $product_id = $new_id;

            $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("s", $product_id);
            $stmt->execute();
            $product = $stmt->get_result()->fetch_assoc();
            
            $catStmt = $db->query($catQuery);
            $categories = $catStmt->fetch_all(MYSQLI_ASSOC);
        } else {
             throw new Exception("Lỗi khi cập nhật sản phẩm: " . $updateStmt->error);
        }
    } catch(Exception $e) {
        $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 font-bold">❌ Lỗi: ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="max-w-7xl mx-auto px-4 py-8 flex-1 h-screen overflow-y-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="admin_products.php" class="text-gray-500 hover:text-blue-600 font-bold text-xl">⬅ Trở về</a>
        <h1 class="text-2xl font-bold text-[#1a2954]">Sửa Sản Phẩm: <?= htmlspecialchars($product['product_name']) ?></h1>
    </div>

    <?= $message ?>

    <form action="?id=<?= urlencode($product_id) ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md border p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-4">
                <h3 class="font-bold text-lg text-blue-800 border-b pb-2">Thông tin cơ bản</h3>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Mã SP (ID) *</label>
                    <input type="text" name="new_id" value="<?= htmlspecialchars($product['id']) ?>" required class="w-full border rounded-lg p-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                    <input type="hidden" name="original_id" value="<?= htmlspecialchars($product['id']) ?>">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Tên Sản Phẩm *</label>
                    <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required class="w-full border rounded-lg p-2.5">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Giá bán *</label>
                        <input type="number" name="price" value="<?= $product['price'] ?>" required class="w-full border rounded-lg p-2.5">
                    </div>
                    <div>
                        <label id="salePriceLabel" class="block text-sm font-bold text-gray-700">Giá Sale</label>
                        <input type="number" id="salePriceInput" name="sale_price" value="<?= $product['sale_price'] ?>" class="w-full border rounded-lg p-2.5 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Trạng thái</label>
                        <select name="status" class="w-full border rounded-lg p-2.5">
                            <option value="available" <?= $product['status'] == 'available' ? 'selected' : '' ?>>Hiển thị</option>
                            <option value="hidden" <?= $product['status'] == 'hidden' ? 'selected' : '' ?>>Ẩn</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Tồn Kho</label>
                        <input type="text" name="quantity" value="<?= $product['quantity'] ?>" readonly class="w-full border border-gray-300 rounded p-2.5 bg-gray-200 cursor-not-allowed font-bold text-gray-600" title="Số lượng chỉ được thay đổi thông qua chức năng Nhập Kho">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Đơn vị tính</label>
                        <input type="text" name="unit" value="<?= htmlspecialchars($product['unit']) ?>" class="w-full border rounded-lg p-2.5" placeholder="VD: Gói, Hộp, Chai">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Chứng nhận</label>
                        <input type="text" name="certifications" value="<?= htmlspecialchars($product['certifications']) ?>" class="w-full border rounded-lg p-2.5" placeholder="VD: ISO, HACCP">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Phân loại Danh mục *</label>
                    <select id="categorySelect" required class="w-full border rounded-lg p-2.5 bg-white">
                        <option value="" data-id="">-- Chọn danh mục --</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['category']) ?>" data-id="<?= $cat['category_id'] ?>" <?= (trim($product['category_id']) == trim($cat['category_id'])) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['category']) ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="new" class="font-bold text-blue-600 bg-blue-50">➕ TẠO DANH MỤC MỚI</option>
                    </select>

                    <input type="hidden" name="category" id="hiddenCategoryName" value="<?= htmlspecialchars($product['category']) ?>">
                    <input type="hidden" name="category_id" id="hiddenCategoryId" value="<?= htmlspecialchars($product['category_id']) ?>">

                    <div id="newCategoryBlock" class="hidden mt-2">
                        <input type="text" id="newCategoryName" class="w-full border rounded-lg p-2.5 bg-white border-blue-400" placeholder="Nhập tên Danh mục mới (VD: Trà đặc sản) *">
                    </div>
                </div>
                
                <div class="flex gap-6 mt-4 p-4 bg-gray-50 border rounded-lg">
                    <label><input type="checkbox" name="is_new" value="1" <?= $product['is_new'] ? 'checked' : '' ?>> SP Mới</label>
                    <label><input type="checkbox" name="is_trending" value="1" <?= $product['is_trending'] ? 'checked' : '' ?>> Đang HOT</label>
                    <label><input type="checkbox" id="isSaleCheckbox" name="is_sale" value="1" <?= $product['is_sale'] ? 'checked' : '' ?>> Đang Sale</label>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="font-bold text-lg text-blue-800 border-b pb-2">Hình ảnh & Bài viết</h3>
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-xs text-blue-600 mb-2 font-bold">(Để trống nếu không muốn đổi ảnh)</p>
                    <input type="hidden" name="old_image_url" value="<?= $product['image_url'] ?>">
                    <input type="hidden" name="old_image_url_2" value="<?= $product['image_url_2'] ?>">
                    <input type="hidden" name="old_image_url_3" value="<?= $product['image_url_3'] ?>">
                    <input type="hidden" name="old_image_url_4" value="<?= $product['image_url_4'] ?>">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Đổi Ảnh Chính 1</label>
                        <div class="flex items-center gap-3 mt-1">
                            <input type="file" name="image_url" accept="image/*" class="flex-1 border border-gray-300 bg-white p-2 rounded-lg text-sm">
                            <?php if(!empty($product['image_url'])): ?> 
                                <img src="<?= htmlspecialchars($product['image_url']) ?>" class="h-12 w-12 object-cover rounded border border-gray-300 bg-white"> 
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Đổi Ảnh phụ 2</label>
                        <div class="flex items-center gap-3 mt-1">
                            <input type="file" name="image_url_2" accept="image/*" class="flex-1 border border-gray-300 bg-white p-2 rounded-lg text-sm">
                            <?php if(!empty($product['image_url_2'])): ?> 
                                <img src="<?= htmlspecialchars($product['image_url_2']) ?>" class="h-12 w-12 object-cover rounded border border-gray-300 bg-white"> 
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Đổi Ảnh phụ 3</label>
                        <div class="flex items-center gap-3 mt-1">
                            <input type="file" name="image_url_3" accept="image/*" class="flex-1 border border-gray-300 bg-white p-2 rounded-lg text-sm">
                             <?php if(!empty($product['image_url_3'])): ?> 
                                <img src="<?= htmlspecialchars($product['image_url_3']) ?>" class="h-12 w-12 object-cover rounded border border-gray-300 bg-white"> 
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Đổi Ảnh phụ 4</label>
                        <div class="flex items-center gap-3 mt-1">
                            <input type="file" name="image_url_4" accept="image/*" class="flex-1 border border-gray-300 bg-white p-2 rounded-lg text-sm">
                             <?php if(!empty($product['image_url_4'])): ?> 
                                <img src="<?= htmlspecialchars($product['image_url_4']) ?>" class="h-12 w-12 object-cover rounded border border-gray-300 bg-white"> 
                            <?php endif; ?>
                        </div>
                    </div>
                </div> 
                <div>
                    <label class="block text-sm font-bold text-gray-700">Mô tả ngắn</label>
                    <textarea name="des1" rows="3" class="w-full border rounded-lg p-2.5"><?= htmlspecialchars($product['des1']) ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Mô tả chi tiết</label>
                    <textarea name="des2" rows="4" class="w-full border rounded-lg p-2.5"><?= htmlspecialchars($product['des2']) ?></textarea>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t text-right">
            <button type="submit" class="px-8 py-3 font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-md text-lg">
                <i class="fas fa-save mr-2"></i> LƯU THAY ĐỔI
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isSaleCheckbox = document.getElementById('isSaleCheckbox');
        const salePriceInput = document.getElementById('salePriceInput');
        const salePriceLabel = document.getElementById('salePriceLabel');

        function toggleSalePrice() {
            if (isSaleCheckbox.checked) {
                salePriceInput.disabled = false;
                salePriceInput.required = true;
                salePriceLabel.innerHTML = 'Giá Sale <span class="text-red-600">*</span>';
                salePriceInput.classList.remove('bg-gray-200', 'cursor-not-allowed');
                salePriceInput.classList.add('bg-white');
            } else {
                salePriceInput.disabled = true;
                salePriceInput.required = false;
                salePriceLabel.innerHTML = 'Giá Sale';
                salePriceInput.classList.add('bg-gray-200', 'cursor-not-allowed');
                salePriceInput.classList.remove('bg-white');
            }
        }

        toggleSalePrice();
        isSaleCheckbox.addEventListener('change', toggleSalePrice);


        const categorySelect = document.getElementById('categorySelect');
        const hiddenCategoryName = document.getElementById('hiddenCategoryName');
        const hiddenCategoryId = document.getElementById('hiddenCategoryId');
        const newCategoryBlock = document.getElementById('newCategoryBlock');
        const newCategoryName = document.getElementById('newCategoryName');

        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const catId = selectedOption.getAttribute('data-id');
                const catValue = this.value;

                if (catValue === 'new') {
                    newCategoryBlock.classList.remove('hidden');
                    newCategoryName.setAttribute('name', 'category');
                    newCategoryName.required = true;
                    
                    hiddenCategoryName.removeAttribute('name');
                    hiddenCategoryId.removeAttribute('name');
                    hiddenCategoryId.value = ''; 
                    
                    newCategoryName.focus();
                } else {
                    newCategoryBlock.classList.add('hidden');
                    
                    hiddenCategoryName.value = catValue; 
                    hiddenCategoryId.value = catId;
                    
                    hiddenCategoryName.setAttribute('name', 'category');
                    hiddenCategoryId.setAttribute('name', 'category_id');
                    
                    newCategoryName.removeAttribute('name');
                    newCategoryName.required = false;
                }
            });
        }
    });
</script>