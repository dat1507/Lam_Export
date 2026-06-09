<?php
require_once 'connect.php'; 
require_once 'admin_header.php';

$sql_suppliers = "SELECT * FROM suppliers ORDER BY name ASC";
$result_suppliers = mysqli_query($conn, $sql_suppliers);

// Lấy danh sách Sản phẩm
$sql_products = "
    SELECT 
        p.*, 
        c.category_name,
        CONCAT('Tồn: ', p.quantity) AS stock_text
    FROM products p 
    LEFT JOIN categories c ON p.category_id = c.id 
    ORDER BY p.product_name ASC
";
$result_products = mysqli_query($conn, $sql_products);
?>

<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">

    <div class="flex-1 flex flex-col md:flex-row h-full overflow-hidden bg-gray-50">
        
        <div class="w-full md:w-7/12 flex flex-col h-full p-4 md:p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Kho Sản Phẩm</h2>
            </div>

            <div class="mb-4 relative shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="posSearch" 
                    placeholder="Gõ mã, tên SP hoặc danh mục để tìm nhanh..." 
                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-lg font-medium text-gray-700">
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar pr-2 pb-20">
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="product_grid">
                    <?php 
                    mysqli_data_seek($result_products, 0);
                    while($pro = mysqli_fetch_assoc($result_products)): 
                        $search_string = mb_strtolower($pro['id'] . ' ' . $pro['product_name'] . ' ' . ($pro['category_name'] ?? ''), 'UTF-8');
                    ?>
                    <div class="product-card bg-white border border-gray-200 rounded-xl p-4 flex flex-col h-full shadow-sm hover:shadow-md transition relative" data-search="<?= $search_string ?>">
                        <div class="flex-1">
                            <div class="text-xs font-bold text-gray-500 mb-1">
                                Mã: <span class="text-blue-600 break-all text-[11px]"><?= $pro['id'] ?></span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-sm leading-tight mb-2" title="<?= $pro['product_name'] ?>">
                                <?= $pro['product_name'] ?>
                            </h3>
                            <div class="text-[#f5b041] font-extrabold mb-1">Bán: <?= number_format($pro['price'], 0, ',', '.') ?>đ</div>
                        </div>
                        
                        <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-500">
                                <?= $pro['stock_text'] ?>
                            </span>
                            <button id="btn_add_<?= trim($pro['id']) ?>" onclick="addToImport('<?= trim($pro['id']) ?>', '<?= htmlspecialchars(str_replace(["\r", "\n"], " ", trim($pro['product_name'])), ENT_QUOTES) ?>')" class="bg-emerald-100 text-emerald-700 hover:bg-emerald-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition">
                                <i class="fas fa-download"></i> Chọn
                            </button>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div id="no_product_msg" class="hidden text-center text-gray-500 mt-10 italic">Không tìm thấy sản phẩm nào!</div>
            </div>
        </div>

        <div class="w-full md:w-5/12 bg-white border-l border-gray-200 flex flex-col h-full shadow-lg z-20">
            <div class="p-4 border-b border-gray-100 bg-gray-50">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nhà cung cấp:</label>
                <div class="flex gap-2">
                    <select id="supplier_select" class="flex-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 text-sm font-medium">
                        <option value="0">--- Chọn nhà cung cấp ---</option>
                        <?php 
                        if($result_suppliers) {
                            mysqli_data_seek($result_suppliers, 0);
                            while($sup = mysqli_fetch_assoc($result_suppliers)): 
                        ?>
                            <option value="<?= $sup['id'] ?>"><?= $sup['name'] ?>  <?= $sup['phone'] ?></option>
                        <?php 
                            endwhile; 
                        }
                        ?>
                    </select>
                    <button onclick="document.getElementById('addSupplierModal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg transition shadow-sm" title="Thêm Nhà Cung Cấp Mới">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <input type="text" id="import_note" placeholder="Ghi chú phiếu nhập (VD: Lô hàng tháng 10)..." class="w-full mt-3 p-2 border border-gray-300 rounded-lg text-sm">
            </div>

            <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-white">
                <h3 class="font-bold text-lg text-gray-800">🧾 Chi tiết phiếu nhập</h3>
                <button onclick="clearImport()" class="text-sm text-red-500 hover:text-red-700 font-medium transition">
                    <i class="fas fa-trash-alt mr-1"></i>Hủy phiếu
                </button>
            </div>

            <div id="import_list" class="flex-1 p-4 overflow-y-auto space-y-3 custom-scrollbar">
                </div>

            <div class="p-4 bg-gray-50 border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Chiết khấu hóa đơn (VND)</label>
                    <input type="number" name="discount_amount" id="discount_amount" value="0" min="0" step="1000" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="calculateTotal()">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tiền thuế VAT (VND)</label>
                    <input type="number" name="tax_amount" id="tax_amount" value="0" min="0" step="1000" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="calculateTotal()">
                </div>
                <div class="flex justify-between text-xl font-bold text-emerald-600 mb-4">
                    <span>TỔNG TIỀN NHẬP:</span>
                    <span id="total_import_amount">0đ</span>
                </div>
                <button onclick="saveImport()" class="w-full bg-emerald-600 text-white font-bold py-3 rounded-xl shadow-md hover:bg-emerald-700 transition text-base uppercase">
                    <i class="fas fa-save mr-2"></i> HOÀN TẤT NHẬP KHO
                </button>
            </div>
        </div>
    </div>

    <script>
        let importCart = [];

        // Thêm SP vào phiếu nhập
        function addToImport(id, name) {
            let existingItem = importCart.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1;
            } else {
                // Nhập kho thì mặc định giá = 0
                importCart.push({ id, name, import_price: 0, qty: 1 });
            }
            renderImportCart();
        }

        // Cập nhật số lượng
        function updateQty(id, qty) {
            let item = importCart.find(item => item.id === id);
            if(item) {
                item.qty = parseInt(qty) || 1;
                renderImportCart();
            }
        }

     
        function updatePrice(id, price) {
            let item = importCart.find(item => item.id === id);
            if(item) {
                let priceStr = price.toString().trim();
                if (priceStr.includes(',')) {
                    priceStr = priceStr.replace(/\./g, '').replace(',', '.');
                }
                
                item.import_price = parseFloat(priceStr) || 0;
                renderImportCart();
            }
        }

        function removeFromImport(id) {
            importCart = importCart.filter(item => item.id !== id);
            renderImportCart();
        }

        function clearImport() {
            if(importCart.length === 0) return;
            if(confirm('Hủy phiếu nhập này?')) {
                importCart = [];
                renderImportCart();
            }
        }

        //giao diện giỏ nhập hàng
        function renderImportCart() {
            const list = document.getElementById('import_list');
            const totalEl = document.getElementById('total_import_amount');
            
            if (importCart.length === 0) {
                list.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full text-gray-400 mt-10">
                        <i class="fas fa-box-open text-4xl mb-3 opacity-50"></i>
                        <p class="italic">Chưa chọn sản phẩm nào...</p>
                    </div>`;
                totalEl.innerText = '0đ';
                return;
            }

            let total = 0;
            list.innerHTML = importCart.map(item => {
                let subtotal = item.import_price * item.qty;
                total += subtotal;
                return `
                <div class="bg-gray-50 border border-gray-200 p-3 rounded-xl relative group">
                    <button onclick="removeFromImport('${item.id}')" class="absolute -top-2 -right-2 bg-red-100 text-red-500 hover:bg-red-500 hover:text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-sm">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <h4 class="font-bold text-gray-800 text-sm leading-tight pr-4 mb-3">${item.name}</h4>
                    
                    <div class="flex gap-2 items-center">
                        <div class="flex-1">
                            <label class="text-[11px] text-gray-500 font-bold">Số lượng:</label>
                            <input type="number" min="1" value="${item.qty}" onchange="updateQty('${item.id}', this.value)" class="w-full p-1.5 text-center border border-gray-300 rounded font-bold text-sm focus:ring-emerald-500">
                        </div>
                        <div class="flex-[2]">
                            <label class="text-[11px] text-gray-500 font-bold">Giá vốn/SP (đ):</label>
                            <input type="text" value="${item.import_price}" onchange="updatePrice('${item.id}', this.value)" class="w-full p-1.5 text-right border border-gray-300 rounded font-bold text-sm text-blue-600 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div class="text-right mt-2 text-sm font-bold text-emerald-600">
                        Thành tiền: ${subtotal.toLocaleString('vi-VN')}đ
                    </div>
                </div>`;
            }).join('');
            
            calculateTotal();
        }

        // search
        document.getElementById('posSearch').addEventListener('input', function(e) {
            let keyword = e.target.value.toLowerCase().trim();
            let cards = document.querySelectorAll('.product-card');
            let hasVisible = false;

            cards.forEach(card => {
                let searchStr = card.getAttribute('data-search') || "";
                if (searchStr.includes(keyword)) {
                    card.style.display = 'flex';
                    hasVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('no_product_msg').style.display = hasVisible ? 'none' : 'block';
        });

        
        // Gửi dữ liệu về db
        function saveImport() {
            if (importCart.length === 0) return alert('Phiếu nhập trống!');
            
            const supplier_id = document.getElementById('supplier_select').value;
        
            if (!supplier_id || supplier_id === '0') {
                alert('Chưa chọn nhà cung cấp!');
                document.getElementById('supplier_select').focus(); 
                return; 
            }
        
            const note = document.getElementById('import_note').value;
            
            const discount = parseFloat(document.getElementById('discount_amount').value) || 0;
            const tax = parseFloat(document.getElementById('tax_amount').value) || 0;
            
            // total
            const total_amount = calculateTotal();
        
            const importData = {
                supplier_id: supplier_id,
                note: note,
                cart: importCart,
                total_amount: total_amount,
                discount_amount: discount, 
                tax_amount: tax       
            };
        
            fetch('ajax_import.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(importData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('✅Đã lưu phiếu nhập kho thành công! Mã phiếu: #' + data.import_id + '\nSố lượng hàng đã được cộng vào kho.');
                    location.reload();
                } else {
                    alert('❌Lỗi: ' + data.message);
                }
            });
        }

        function saveNewSupplier() {
            const name = document.getElementById('new_sup_name').value.trim();
            const phone = document.getElementById('new_sup_phone').value.trim();
            const address = document.getElementById('new_sup_address').value.trim();

            if (!name) {
                alert('Nhập Tên Nhà cung cấp chứ!');
                return;
            }

            // change btn text
            const btnSave = event.target;
            const originalText = btnSave.innerHTML;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lưu...';
            btnSave.disabled = true;

            fetch('ajax_add_supplier.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name: name, phone: phone, address: address })
            })
            .then(res => res.text()) 
            .then(text => {
                btnSave.innerHTML = originalText;
                btnSave.disabled = false;

                try {
                    const data = JSON.parse(text);
                    if (data.status === 'success') {
                        // 1. Tạo thẻ option mới
                        const select = document.getElementById('supplier_select');
                        const newOption = document.createElement('option');
                        newOption.value = data.id;
                        newOption.text = name + (phone ? ' - ' + phone : '');
                        
                        // 2. Nhét thẻ mới vào đuôi danh sách select
                        select.appendChild(newOption);
                        
                        // 3. Ép nó tự động chọn cái tên vừa thêm
                        select.value = data.id;

                        // 4. Dọn dẹp đóng Popup
                        document.getElementById('addSupplierModal').classList.add('hidden');
                        document.getElementById('new_sup_name').value = '';
                        document.getElementById('new_sup_phone').value = '';
                        document.getElementById('new_sup_address').value = '';
                        
                        // Thông báo
                        alert('✅ Đã thêm Nhà cung cấp: ' + name);
                    } else {
                        alert('❌ Server báo lỗi: ' + data.message);
                    }
                } catch (e) {
                    console.error('Lỗi phản hồi từ server:', text);
                    alert('❌ Có lỗi ngầm từ PHP');
                }
            })
            .catch(err => {
                btnSave.innerHTML = originalText;
                btnSave.disabled = false;
                alert('❌ Lỗi kết nối mạng!');
            });
        }

        // scanner barcode
        let barcodeBuffer = "";
        let lastKeyTime = Date.now();

        document.addEventListener('keydown', function(e) {
            // Không xử lý mã vạch khi đang mở hộp thoại Thêm Nhà Cung Cấp
            let addSupplierModal = document.getElementById('addSupplierModal');
            if (addSupplierModal && !addSupplierModal.classList.contains('hidden')) {
                return; 
            }

            let currentTime = Date.now();
            
            // Nhận diện tốc độ gõ siêu nhanh của máy quét (dưới 100ms mỗi ký tự)
            if (currentTime - lastKeyTime > 100) {
                barcodeBuffer = "";
            }
            lastKeyTime = currentTime;

            if (e.key.length === 1) {
                barcodeBuffer += e.key;
            }

            // Khi máy quét gửi ký tự Enter ở cuối mã
            if (e.key === 'Enter' && barcodeBuffer.length > 0) {
                e.preventDefault(); 
                
                let scannedCode = barcodeBuffer.trim();
                barcodeBuffer = ""; 
                
                // Tìm nút Chọn tương ứng với mã vừa quét
                let btnAdd = document.getElementById('btn_add_' + scannedCode);
                
                if (btnAdd) {
                    btnAdd.click(); 
                    
                    let searchBox = document.getElementById('posSearch');
                    if(document.activeElement === searchBox) {
                        searchBox.value = "";
                        searchBox.dispatchEvent(new Event('input')); // Kích hoạt lại hàm hiển thị lưới SP
                    }
                } else {
                    alert('⚠️ Không tìm thấy sản phẩm nào có mã: ' + scannedCode);
                }
            }
        });
        
        
        function calculateTotal() {
            let subTotal = importCart.reduce((sum, item) => sum + (item.import_price * item.qty), 0);
            
            let discount = parseFloat(document.getElementById('discount_amount').value) || 0;
            let tax = parseFloat(document.getElementById('tax_amount').value) || 0;
            
            let finalTotal = subTotal - discount + tax;
            
            if (finalTotal < 0) finalTotal = 0;
        
            // 4. In ra giao diện
            document.getElementById('total_import_amount').innerText = finalTotal.toLocaleString('vi-VN') + 'đ';
            
            return finalTotal; 
        }
    </script>

    <div id="addSupplierModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">➕ Thêm Nhà Cung Cấp Mới</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Tên NCC <span class="text-red-500">*</span></label>
                    <input type="text" id="new_sup_name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="VD: Công ty TNHH ABC...">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Số điện thoại</label>
                    <input type="text" id="new_sup_phone" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="VD: 0909123456">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Địa chỉ</label>
                    <input type="text" id="new_sup_address" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="VD: 123 Lê Lợi, Quận 1...">
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button onclick="document.getElementById('addSupplierModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition">Hủy</button>
                <button onclick="saveNewSupplier()" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition"><i class="fas fa-save mr-1"></i> Lưu lại</button>
            </div>
        </div>
    </div>
</body>
</html>