<?php
require_once 'config/database.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();

$catQuery = "SELECT id as category_id, category_name as category FROM categories";
$catStmt = $db->query($catQuery);
$categories = $catStmt ? $catStmt->fetch_all(MYSQLI_ASSOC) : [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['is_sale']) && empty($_POST['sale_price'])) {
            throw new Exception("Sale Price is required when On Sale is checked");
        }

        $uploadDir = 'uploads/products/'; 
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        function uploadImage($fileInputName, $uploadDir) {
            if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
                $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']);
                $targetFilePath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFilePath)) {
                    return $targetFilePath; 
                }
            }
            return ''; 
        }

        $img1 = uploadImage('image_url', $uploadDir);
        $img2 = uploadImage('image_url_2', $uploadDir);
        $img3 = uploadImage('image_url_3', $uploadDir);
        $img4 = uploadImage('image_url_4', $uploadDir);

        // Chuẩn bị dữ liệu an toàn
        $id = $_POST['id'];
        $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
        $category = $_POST['category'];

        // XỬ LÝ TẠO DANH MỤC MỚI VÀO DATABASE
        if (empty($category_id) && !empty($category)) {
            $insertCatQuery = "INSERT INTO categories (category_name) VALUES (?)"; 
            $stmtCat = $db->prepare($insertCatQuery);
            $stmtCat->bind_param("s", $category);
            
            if ($stmtCat->execute()) {
                $category_id = $stmtCat->insert_id;
            } else {
                throw new Exception("Error creating new category: " . $stmtCat->error);
            }
        }

        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        
        $sale_price = !empty($_POST['sale_price']) ? $_POST['sale_price'] : 0;
        
        $quantity = "Liên hệ"; 
        
        $unit = $_POST['unit'];
        $status = $_POST['status'];
        $is_new = isset($_POST['is_new']) ? 1 : 0;
        $is_trending = isset($_POST['is_trending']) ? 1 : 0;
        $is_sale = isset($_POST['is_sale']) ? 1 : 0;
        $certifications = $_POST['certifications'];
        $des1 = $_POST['des1'];
        $des2 = $_POST['des2'];

        $query = "INSERT INTO products (
            id, category_id, category, product_name, price, sale_price, quantity, unit, 
            status, is_new, is_trending, is_sale, certifications, 
            des1, des2, image_url, image_url_2, image_url_3, image_url_4
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        
        // Ràng buộc dữ liệu (s=string, d=double, i=integer)
        $stmt->bind_param("ssssddsssiiisssssss", 
            $id, $category_id, $category, $product_name, $price, $sale_price, $quantity, $unit,
            $status, $is_new, $is_trending, $is_sale, $certifications,
            $des1, $des2, $img1, $img2, $img3, $img4
        );

        if ($stmt->execute()) {
            $action = "Add product";
            $details = "Added product: " . $product_name . " (ID: " . $id . ")";
            // logActivity($db, $_SESSION['admin_username'], $action, $details);
            
            $message = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 font-bold">🎉 Product created successfully!</div>';
        } else {
            throw new Exception("Error saving to Database: " . $stmt->error);
        }

    } catch(Exception $e) { 
        $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 font-bold">❌ Error: ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="max-w-7xl mx-auto px-4 py-8 w-full overflow-y-auto">
    
    <div class="flex items-center gap-4 mb-6">
        <a href="admin_products.php" class="text-gray-500 hover:text-blue-600 font-bold text-xl">⬅ Back</a>
        <h1 class="text-2xl font-bold text-[#1a2954]">Add New Product</h1>
    </div>

    <?= $message ?>

    <form action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 md:p-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-4">
                <h3 class="font-bold text-lg text-blue-800 border-b pb-2">Basic Information</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Product Code (ID) *</label>
                        <input type="text" name="id" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="e.g., CF01">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 bg-gray-50">
                            <option value="available">Available</option>
                            <option value="hidden">Hidden</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="product_name" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="e.g., L'amant Café Pack">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Selling Price (VND) *</label>
                        <input type="number" name="price" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="e.g., 150000">
                    </div>
                    <div>
                        <label id="salePriceLabel" class="block text-sm font-bold text-gray-700 mb-1">Sale Price (If any)</label>
                        <input type="number" id="salePriceInput" name="sale_price" disabled class="w-full border border-gray-300 rounded-lg p-2.5 bg-gray-100 cursor-not-allowed text-gray-500 transition-all focus:ring-2 focus:ring-blue-500" placeholder="e.g., 120000">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Stock (Default)</label>
                        <input type="text" name="quantity" value="Liên hệ" readonly class="w-full border border-gray-300 rounded-lg p-2.5 bg-gray-100 text-gray-500 font-bold cursor-not-allowed focus:ring-0" title="Can only be updated via Stock Import">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Unit</label>
                        <input type="text" name="unit" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="e.g., Pack, Box, Bottle">
                    </div>
                </div>

               <div class="col-span-1 md:col-span-2 bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category Classification *</label>
                    
                    <select id="categorySelect" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 bg-white font-medium text-gray-800 shadow-sm transition cursor-pointer">
                        <option value="" data-id="">-- Click to select category --</option>
                        
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['category']) ?>" data-id="<?= $cat['category_id'] ?>">
                                <?= htmlspecialchars($cat['category']) ?>
                            </option>
                        <?php endforeach; ?>
                        
                        <option value="new" class="font-bold text-blue-600 bg-blue-50">➕ CREATE NEW CATEGORY</option>
                    </select>

                    <input type="hidden" name="category" id="hiddenCategoryName">
                    <input type="hidden" name="category_id" id="hiddenCategoryId">

                    <div id="newCategoryBlock" class="hidden mt-4 pt-4 border-t border-gray-300">
                        <label class="block text-sm font-bold text-blue-700 mb-1">New Category Name *</label>
                        <div class="flex gap-2">
                            <input type="text" id="newCategoryName" class="w-full border border-blue-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 bg-white shadow-inner" placeholder="e.g., Specialty Tea, Pure Coffee...">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Certifications</label>
                    <input type="text" name="certifications" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="e.g., ISO, HACCP">
                </div>

                <div class="flex gap-6 mt-4 p-4 bg-gray-50 border rounded-lg">
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-blue-700">
                        <input type="checkbox" name="is_new" value="1" checked class="w-5 h-5 accent-blue-600"> New Product
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-red-600">
                        <input type="checkbox" name="is_trending" value="1" class="w-5 h-5 accent-red-600"> Trending
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-orange-500">
                        <input type="checkbox" id="isSaleCheckbox" name="is_sale" value="1" class="w-5 h-5 accent-orange-500"> On Sale
                    </label>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="font-bold text-lg text-blue-800 border-b pb-2">Images & Descriptions</h3>
                
                <div class="space-y-3 bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-xs text-blue-600 font-bold mb-2">Upload images from computer</p>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Main Image 1 *</label>
                        <input type="file" name="image_url" accept="image/*" required class="w-full border border-gray-300 rounded-lg p-2 bg-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Secondary Image 2</label>
                        <input type="file" name="image_url_2" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 bg-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Secondary Image 3</label>
                        <input type="file" name="image_url_3" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 bg-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Secondary Image 4</label>
                        <input type="file" name="image_url_4" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 bg-white text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                    <textarea name="des1" rows="5" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="Enter product description..."></textarea>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-4">
            <button type="reset" class="px-6 py-3 font-bold text-gray-600 bg-gray-200 rounded-xl hover:bg-gray-300 transition">Reset</button>
            <button type="submit" class="px-8 py-3 font-bold text-[#1a2954] bg-[#f5b041] rounded-xl shadow-lg hover:bg-yellow-500 transition text-lg">
                💾 SAVE PRODUCT
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
                // Khi tick: Mở khóa
                salePriceInput.disabled = false;
                salePriceInput.required = true;
                salePriceLabel.innerHTML = 'Sale Price (VND) <span class="text-red-600 text-lg">*</span>';
                
                // Đổi màu nền cho sáng lên
                salePriceInput.classList.remove('bg-gray-100', 'cursor-not-allowed', 'text-gray-500');
                salePriceInput.classList.add('bg-white', 'border-orange-500', 'bg-orange-50');
                salePriceInput.focus(); 
            } else {
                // Khi bỏ tick: Khóa lại
                salePriceInput.disabled = true;
                salePriceInput.required = false;
                salePriceInput.value = ''; // Xóa sạch dữ liệu cũ
                salePriceLabel.innerHTML = 'Sale Price (If any)';
                
                // Làm mờ đi
                salePriceInput.classList.add('bg-gray-100', 'cursor-not-allowed', 'text-gray-500');
                salePriceInput.classList.remove('bg-white', 'border-orange-500', 'bg-orange-50');
            }
        }

        // Chạy lần đầu khi load trang
        toggleSalePrice();
        // Bắt sự kiện mỗi khi click checkbox
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