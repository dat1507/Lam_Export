<?php
require_once 'config/database.php';
require_once 'admin_header.php'; // Đã bao gồm check đăng nhập

$database = new Database();
$db = $database->getConnection();

// 1. Lấy danh sách Khách sỉ / Đại lý
$sql_customers = "SELECT * FROM customers WHERE customer_type = 'wholesale' ORDER BY customer_name ASC";
$result_customers = $db->query($sql_customers);
$customers = [];
if ($result_customers) {
    $customers = $result_customers->fetch_all(MYSQLI_ASSOC);
}

// 2. Lấy danh sách Sản phẩm
$sql_products = "SELECT id, product_name AS name, unit, wholesale_price, quantity AS stock FROM products ORDER BY id DESC";
$result_products = $db->query($sql_products);
$products = [];
if ($result_products) {
    $products = $result_products->fetch_all(MYSQLI_ASSOC);
}
?>

<style>
    #print_receipt_area { display: none; }
</style>

<div class="max-w-[1400px] mx-auto px-4 py-8 flex-1 h-screen overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#1a2954]">📦 Tạo Đơn Bán Sỉ</h1>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        
        <div class="lg:w-2/3 flex flex-col gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 relative">
                <div class="relative">
                    <input type="text" id="search_product" onkeyup="filterProducts()" placeholder="Nhập tên sản phẩm để lên đơn..." class="w-full border border-gray-300 rounded-lg p-3 pl-10 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <span class="absolute left-3 top-3 text-gray-400">🔎</span>
                </div>
                
                <div id="product_list" class="mt-1 max-h-60 overflow-y-auto border border-gray-200 rounded-lg hidden bg-white absolute w-[calc(100%-2rem)] z-50 shadow-xl top-full left-4">
                    <?php foreach ($products as $p): ?>
                        <?php 
                        $is_out_of_stock = ($p['stock'] <= 0); 
                        $display_name = htmlspecialchars($p['name']);
                        $safe_name = htmlspecialchars(addslashes($p['name']), ENT_QUOTES);
                        // Xử lý đơn vị tính (nếu trống thì để mặc định là rỗng)
                        $unit_val = isset($p['unit']) ? $p['unit'] : '';
                        $safe_unit = htmlspecialchars(addslashes($unit_val), ENT_QUOTES);
                        ?>
                        
                        <?php if (!$is_out_of_stock): ?>
                            <div id="item_add_<?= trim($p['id']) ?>" class="p-3 border-b hover:bg-blue-50 cursor-pointer flex justify-between items-center product-item transition" 
                                 onclick="addToCart('<?= trim($p['id']) ?>', '<?= $safe_name ?>', <?= $p['wholesale_price'] ?>, '<?= $safe_unit ?>')">
                                <div>
                                    <div class="font-bold text-gray-800"><?= $display_name ?></div>
                                    <div class="text-xs text-gray-500 mt-1">Tồn kho: <span class="font-bold text-blue-600"><?= htmlspecialchars($p['stock']) ?></span> <?= htmlspecialchars($unit_val) ?></div>
                                </div>
                                <div class="font-bold text-blue-600 text-right">
                                    <?= number_format($p['wholesale_price'], 0, ',', '.') ?> đ
                                </div>
                            </div>
                        <?php else: ?>
                            <div id="item_add_<?= trim($p['id']) ?>" data-disabled="true" data-name="<?= htmlspecialchars(trim($p['name']), ENT_QUOTES) ?>" class="p-3 border-b bg-gray-50 flex justify-between items-center product-item opacity-60 cursor-not-allowed">
                                <div>
                                    <div class="font-bold text-gray-500 line-through"><?= $display_name ?></div>
                                    <div class="text-xs text-red-500 mt-1 font-bold">Hết hàng</div>
                                </div>
                                <div class="font-bold text-gray-400 text-right">
                                    <?= number_format($p['wholesale_price'], 0, ',', '.') ?> đ
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-bold border-b">
                            <th class="p-3 w-12 text-center">STT</th>
                            <th class="p-3">Sản phẩm</th>
                            <th class="p-3 w-28 text-center">Số lượng</th>
                            <th class="p-3 w-32 text-center">Đơn giá sỉ</th>
                            <th class="p-3 w-36 text-right">Thành tiền</th>
                            <th class="p-3 w-12 text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="cart_body" class="text-sm divide-y divide-gray-200">
                        <tr><td colspan="6" class="p-10 text-center text-gray-400 font-medium">🛒 Chưa có sản phẩm nào trong đơn hàng.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:w-1/3 bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">🧾 Thông tin Đơn Sỉ</h2>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Khách sỉ / Đại lý <span class="text-red-500">*</span></label>
                <div class="flex gap-2">
                    <select id="customer_id" class="w-full overflow-hidden text-ellipsis whitespace-nowrap border border-gray-300 rounded p-2 outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="" data-address="">--- Chọn khách sỉ ---</option>
                        <?php foreach ($customers as $cus): ?>
                            <option value="<?= $cus['customer_id'] ?>" data-address="<?= isset($cus['address']) ? htmlspecialchars($cus['address']) : '' ?>">
                                <?= htmlspecialchars($cus['customer_name']) ?> - <?= htmlspecialchars($cus['telephone']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button onclick="openAddCustomerModal()" class="bg-blue-600 text-white px-4 rounded-lg hover:bg-blue-700 transition font-bold shadow-sm flex items-center gap-1" title="Thêm đại lý mới">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Thêm
                    </button>
                </div>
            </div>

            <div class="mb-4 bg-gray-50 p-3 rounded-lg border border-gray-200">
                <label class="block text-sm font-bold text-gray-700 mb-2">Hình thức giao dịch</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="transaction_type" value="Thanh toán liền" checked class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-medium">Thanh toán liền</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="transaction_type" value="Ký gửi" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-medium">Ký gửi</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Ghi chú (Tùy chọn)</label>
                <textarea id="order_note" rows="2" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ví dụ: Giao hỏa tốc, xuất VAT..."></textarea>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-100">
                <div class="flex justify-between mb-3 text-gray-600">
                    <span>Tổng tiền hàng:</span>
                    <span class="font-bold text-lg text-black" id="total_amount_display">0 đ</span>
                </div>
                
               <div class="flex justify-between items-center mb-1 text-green-700">
                    <span class="font-bold mt-1">Chiết khấu (%):</span>
                    <div class="relative">
                        <input type="number" id="discount_percent" oninput="calculateDebt()" value="0" min="0" max="100" class="w-24 text-right border border-green-300 rounded p-1.5 font-bold outline-none focus:ring-2 focus:ring-green-500 bg-white pr-7">
                        <span class="absolute right-2 top-2 text-green-600 font-bold">%</span>
                    </div>
                </div>
                
                <div class="flex justify-between mb-3 text-green-600 text-sm border-b border-blue-100 pb-2">
                    <span class="italic">Tiền được giảm:</span>
                    <span class="font-bold" id="discount_vnd_display">-0 đ</span>
                </div>

                <div class="flex justify-between mb-3 text-gray-800 border-t border-blue-200 pt-3">
                    <span class="font-bold">KHÁCH CẦN TRẢ:</span>
                    <span class="font-bold text-xl text-blue-800" id="final_amount_display">0 đ</span>
                </div>

                <div class="flex justify-between items-center mb-3 text-blue-800">
                    <span class="font-bold mt-1">Khách thanh toán:</span>
                    <input type="number" id="paid_amount" oninput="calculateDebt()" value="0" min="0" class="w-32 text-right border border-blue-300 rounded p-1.5 font-bold outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                </div>

                <div class="flex justify-between mt-3 pt-3 border-t border-blue-200 text-red-600">
                    <span class="font-bold">Tính vào công nợ:</span>
                    <span class="font-bold text-xl" id="debt_amount_display">0 đ</span>
                </div>
            </div>

            <button onclick="saveOrder()" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2 text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                Xuất Hóa Đơn
            </button>
        </div>
    </div>

    <div id="addCustomerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[100] transition-opacity">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl border border-blue-200">
            <h3 class="text-lg font-bold text-blue-800 mb-4 border-b pb-2">➕ Thêm Đại Lý Mới</h3>
            
            <div class="mb-3">
                <label class="block text-sm font-bold text-gray-700 mb-1">Tên đại lý <span class="text-red-500">*</span></label>
                <input type="text" id="new_cus_name" placeholder="Ví dụ: Đại lý Hà Nội..." class="w-full border border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
            </div>
            
            <div class="mb-3">
                <label class="block text-sm font-bold text-gray-700 mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                <input type="text" id="new_cus_phone" placeholder="Nhập SĐT..." class="w-full border border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-1">Địa chỉ <span class="text-red-500">*</span></label>
                <input type="text" id="new_cus_address" placeholder="Bắt buộc nhập địa chỉ..." class="w-full border border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
            </div>
            
            <div class="flex justify-end gap-3">
                <button onclick="closeAddCustomerModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-700 font-bold transition">Hủy</button>
                <button onclick="saveNewCustomer()" id="btn_save_cus" class="px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 text-white font-bold transition">Lưu & Chọn</button>
            </div>
        </div>
    </div>
</div>

<div id="print_receipt_area">
    <div class="receipt-header">
        <h2>HỘ KINH DOANH SHOP VÂN HÙNG</h2>
        <p><b>Chuyên phân phối hàng đạt chuẩn OCOP</b></p>
        <p>Đ/c: 05 Lý Thường Kiệt, Phường Quy Nhơn Nam,  Gia Lai, Việt Nam - ĐT: 0935 241158</p>
    </div>
    <div class="receipt-title">
        HÓA ĐƠN BÁN HÀNG / PHIẾU XUẤT KHO
    </div>
    <div class="receipt-info">
        <div><b>Khách hàng:</b> <span id="print_cus_name"></span></div>
        <div><b>Ngày in:</b> <span id="print_date"></span></div>
    </div>

    <div class="receipt-info" style="margin-top: -10px;">
        <div><b>Địa chỉ:</b> <span id="print_cus_address"></span></div>
    </div>

    <div class="receipt-info" style="margin-top: -10px;">
        <div><b>Hình thức:</b> <span id="print_trans_type"></span></div>
    </div>
    
    <table class="receipt-table">
        <thead>
            <tr>
                <th style="width: 5%">STT</th>
                <th style="width: 40%">Tên hàng hóa</th>
                <th style="width: 10%">ĐVT</th> <th style="width: 10%">Số lượng</th>
                <th style="width: 15%">Đơn giá (VNĐ)</th>
                <th style="width: 20%">Thành tiền (VNĐ)</th>
            </tr>
        </thead>
        <tbody id="print_cart_items">
        </tbody>
    </table>

    <div class="receipt-summary">
        <div class="summary-row">
            <span>Tổng tiền hàng:</span>
            <span id="print_total_order">0</span>
        </div>
        <div class="summary-row">
            <span>Chiết khấu được giảm:</span>
            <span id="print_discount">0</span>
        </div>
        <div class="summary-row bold">
            <span>KHÁCH CẦN TRẢ:</span>
            <span id="print_final_amount">0</span>
        </div>
        <div class="summary-row">
            <span>Khách đã thanh toán:</span>
            <span id="print_paid">0</span>
        </div>
        <div class="summary-row" style="color: #d93025; border-top: 1px dashed #000; padding-top: 5px;">
            <span>Ghi nợ:</span>
            <span id="print_debt">0</span>
        </div>
    </div>
</div>

<script>
    let cart = [];

    const searchInput = document.getElementById('search_product');
    const productList = document.getElementById('product_list');

    searchInput.addEventListener('focus', () => { productList.classList.remove('hidden'); });
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !productList.contains(event.target)) {
            productList.classList.add('hidden');
        }
    });

    function filterProducts() {
        let filter = searchInput.value.toLowerCase();
        let items = productList.getElementsByClassName('product-item');
        let hasVisible = false;

        for (let i = 0; i < items.length; i++) {
            let txtValue = items[i].textContent || items[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                items[i].style.display = "";
                hasVisible = true;
            } else {
                items[i].style.display = "none";
            }
        }
        productList.classList.toggle('hidden', !hasVisible && filter === '');
    }

    function addToCart(id, name, price, unit) {
        let existingItem = cart.find(item => item.id == id);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            cart.push({ id: id, name: name, price: parseFloat(price) || 0, qty: 1, unit: unit || '' });
        }
        searchInput.value = ''; 
        productList.classList.add('hidden'); 
        renderCart();
    }

    function updateQty(id, newQty) {
        let item = cart.find(item => item.id == id);
        if (item) {
            item.qty = parseInt(newQty) || 1;
            if (item.qty < 1) item.qty = 1;
            renderCart();
        }
    }

    function updatePrice(id, newPrice) {
        let item = cart.find(item => item.id == id);
        if (item) {
            item.price = parseFloat(newPrice) || 0;
            renderCart();
        }
    }

    function removeFromCart(id) {
        cart = cart.filter(item => item.id != id);
        renderCart();
    }

    function renderCart() {
        let tbody = document.getElementById('cart_body');
        tbody.innerHTML = '';

        if (cart.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="p-10 text-center text-gray-400 font-medium">🛒 Chưa có sản phẩm nào trong đơn hàng.</td></tr>';
            document.getElementById('total_amount_display').innerText = '0 đ';
            calculateDebt();
            return;
        }

        let totalOrder = 0;
        cart.forEach((item, index) => {
            let lineTotal = item.price * item.qty;
            totalOrder += lineTotal;

            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-3 text-center border-b text-gray-500">${index + 1}</td>
                <td class="p-3 font-semibold text-gray-800 border-b">
                    ${item.name} <br><span class="text-xs text-gray-400 font-normal">ĐVT: ${item.unit}</span>
                </td>
                <td class="p-3 text-center border-b">
                    <input type="number" min="1" value="${item.qty}" onchange="updateQty('${item.id}', this.value)" class="w-16 text-center border border-gray-300 rounded p-1 outline-none focus:ring-1 focus:ring-blue-500 bg-gray-50">
                </td>
                <td class="p-3 text-center border-b">
                    <input type="number" min="0" value="${item.price}" onchange="updatePrice('${item.id}', this.value)" class="w-24 text-right border border-orange-300 rounded p-1 outline-none focus:ring-1 focus:ring-orange-500 bg-orange-50 font-bold text-orange-700">
                </td>
                <td class="p-3 text-right font-bold text-blue-600 border-b">${lineTotal.toLocaleString('vi-VN')} đ</td>
                <td class="p-3 text-center border-b">
                    <button onclick="removeFromCart('${item.id}')" class="text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Xóa">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('total_amount_display').innerText = totalOrder.toLocaleString('vi-VN') + ' đ';
        calculateDebt();
    }

    function calculateDebt() {
        let totalOrder = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        
        let discountPercent = parseFloat(document.getElementById('discount_percent').value) || 0;
        if (discountPercent < 0) discountPercent = 0;
        if (discountPercent > 100) discountPercent = 100; 
        
        let discountVND = totalOrder * (discountPercent / 100);
        document.getElementById('discount_vnd_display').innerText = '-' + discountVND.toLocaleString('vi-VN') + ' đ';
        
        let finalAmount = totalOrder - discountVND;
        if (finalAmount < 0) finalAmount = 0;

        let paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
        
        let debt = finalAmount - paidAmount;
        if (debt < 0) debt = 0; 

        document.getElementById('final_amount_display').innerText = finalAmount.toLocaleString('vi-VN') + ' đ';
        document.getElementById('debt_amount_display').innerText = debt.toLocaleString('vi-VN') + ' đ';
    }

    function saveOrder() {
        if (cart.length === 0) {
            alert("Vui lòng chọn ít nhất 1 sản phẩm!");
            return;
        }

        let customer_id = document.getElementById('customer_id').value;
        if (customer_id === "") {
            alert("Vui lòng chọn khách sỉ / đại lý!");
            return;
        }

        let paid_amount = parseFloat(document.getElementById('paid_amount').value) || 0;
        let note = document.getElementById('order_note').value;
        
        let totalOrder = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        let discountPercent = parseFloat(document.getElementById('discount_percent').value) || 0;
        let discount_amount_vnd = totalOrder * (discountPercent / 100);

        let btn = document.querySelector('button[onclick="saveOrder()"]');
        btn.innerHTML = "⌛ ĐANG XỬ LÝ...";
        btn.disabled = true;

        fetch('ajax_save_wholesale.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                customer_id: customer_id,
                paid_amount: paid_amount,
                discount_amount: discount_amount_vnd,
                note: note,
                items: cart
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                let cusSelect = document.getElementById('customer_id');
                let selectedOption = cusSelect.options[cusSelect.selectedIndex];
                let customerText = selectedOption.text;
                // Lấy thông tin địa chỉ từ thuộc tính data-address
                let customerAddress = selectedOption.getAttribute('data-address');
                if(!customerAddress || customerAddress.trim() === '') {
                    customerAddress = "..............................................................................................................................";
                }

                let now = new Date();
                let printDate = now.toLocaleString('vi-VN');
                let transType = document.querySelector('input[name="transaction_type"]:checked').value;
                let totalAmountDisplay = document.getElementById('total_amount_display').innerText;

                let tbodyHTML = '';
                cart.forEach((item, index) => {
                    let lineTotal = item.price * item.qty;
                    tbodyHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.name}</td>
                            <td>${item.unit}</td> 
                            <td>${item.qty}</td>
                            <td>${item.price.toLocaleString('vi-VN')}</td>
                            <td>${lineTotal.toLocaleString('vi-VN')}</td>
                        </tr>
                    `;
                });

                let printWindow = window.open('', '_blank', 'width=900,height=900');
                
                printWindow.document.write('<html><head><title>Hóa Đơn - Hộ Kinh Doanh Shop Vân Hùng</title>');
                printWindow.document.write(`
                    <style>
                        body { font-family: 'Times New Roman', Times, serif; padding: 40px; color: #000; line-height: 1.5; position: relative; z-index: 1;}
                        .receipt-header { text-align: center; margin-bottom: 30px; }
                        .receipt-header h2 { font-size: 28px; font-weight: bold; margin: 0 0 10px 0; text-transform: uppercase;}
                        .receipt-header p { margin: 5px 0; font-size: 16px; }
                        .receipt-title { text-align: center; font-size: 24px; font-weight: bold; margin: 30px 0 20px; border-bottom: 2px solid #000; padding-bottom: 10px;}
                        .receipt-info { margin-bottom: 20px; font-size: 16px; display: flex; justify-content: space-between;}
                        .receipt-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 16px; }
                        .receipt-table th, .receipt-table td { border: 1px solid #000; padding: 12px; }
                        .receipt-table th { background-color: #f8f9fa; font-weight: bold; text-align: center; }
                        .receipt-table td:nth-child(1) { text-align: center; }
                        .receipt-table td:nth-child(2) { text-align: left; }
                        .receipt-table td:nth-child(3), .receipt-table td:nth-child(4), .receipt-table td:nth-child(5) { text-align: center; }
                        .receipt-table td:nth-child(6) { text-align: right; font-weight: bold;}
                        .receipt-summary { width: 55%; float: right; font-size: 16px; }
                        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
                        .summary-row.bold { font-weight: bold; font-size: 18px; border-top: 2px solid #000; padding-top: 10px; }
                        
                        .signature-area { display: flex; justify-content: space-between; margin-top: 50px; clear: both;}
                        .signature-box { text-align: center; font-weight: bold; font-size: 16px; width: 33%;}
                        .signature-box p { font-weight: normal; font-style: italic; margin-top: 5px; color: #555; }
                        
                        .receipt-footer { text-align: center; font-style: italic; font-size: 15px; margin-top: 120px; border-top: 1px dashed #ccc; padding-top: 15px;}
                        
                        /* Lệnh này để bắt buộc qua trang mới khi in Phiếu quản lý ký gửi */
                        .page-break { page-break-before: always; }
                    </style>
                `);
                printWindow.document.write('</head><body>');

                printWindow.document.write(`
                    <img src="gallery/lamexportlogo.jpg" 
                         style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); 
                                width: 60%; opacity: 0.1; z-index: -1; pointer-events: none;" 
                         alt="Watermark Lam Export" />
                `);

               if (transType === "Ký gửi") {
                        
                        let discountLabel = (typeof discountPercent !== 'undefined' && discountPercent > 0) 
                            ? ` (Chiết khấu ${discountPercent}%)` 
                            : '';

                        printWindow.document.write(`
                            <div class="receipt-header">
                                <h2>HỘ KINH DOANH SHOP VÂN HÙNG</h2>
                                <p><b>Chuyên phân phối hàng đạt chuẩn OCOP</b></p>
                                <p>Đ/c: 05 Lý Thường Kiệt, Phường Quy Nhơn Nam,  Gia Lai, Việt Nam - ĐT: 0935 241158</p>
                            </div>
                            <div class="receipt-title">HÓA ĐƠN KÝ GỬI</div>
                            <div class="receipt-info">
                                <div><b>Khách hàng:</b> ${customerText}</div>
                                <div><b>Ngày in:</b> ${printDate}</div>
                            </div>
                            <div class="receipt-info" style="margin-top: -10px;">
                                <div><b>Địa chỉ:</b> ${customerAddress}</div>
                            </div>
                            
                            <table class="receipt-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">STT</th>
                                        <th style="width: 40%">Tên hàng hóa</th>
                                        <th style="width: 10%">ĐVT</th>
                                        <th style="width: 10%">Số lượng</th>
                                        <th style="width: 15%">Đơn giá (VNĐ)</th>
                                        <th style="width: 20%">Thành tiền (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tbodyHTML}
                                </tbody>
                            </table>

                            <div class="receipt-summary" style="width: 100%; float: none;">
                               <div class="summary-row" style="justify-content: flex-end; gap: 30px; font-size: 18px;">
                                    <span>Tổng tiền hàng hóa:</span>
                                    <span>${totalAmountDisplay}</span>
                                </div>
                                <div class="summary-row bold" style="justify-content: flex-end; gap: 30px; font-size: 20px;">
                                    <span>TỔNG TIỀN HÓA ĐƠN${discountLabel}:</span>
                                    <span>${document.getElementById('final_amount_display').innerText}</span>
                                </div>
                                <div style="margin-top: 30px; font-size: 16px; font-weight: bold;">
                                    <p>Ngày thanh toán tiếp theo: ......................................................................................</p>
                                </div>
                            </div>

                            <div class="signature-area">
                                <div class="signature-box" style="width: 50%;">Đại diện Hộ Kinh Doanh Shop Vân Hùng<p>(Ký, ghi rõ họ tên)</p></div>
                                <div class="signature-box" style="width: 50%;">Khách hàng ký gửi<p>(Ký, ghi rõ họ tên)</p></div>
                            </div>

                            <div class="page-break"></div>

                            <div class="receipt-header" style="margin-top: 40px;">
                                <h2>HỘ KINH DOANH SHOP VÂN HÙNG</h2>
                            </div>
                            <div class="receipt-title">PHIẾU QUẢN LÝ ĐỊA ĐIỂM KÝ GỬI</div>
                            <div style="font-size: 18px; line-height: 2.5; padding: 0 20px;">
                                <p><b>Tên khách hàng / Đại lý:</b> ${customerText}</p>
                                <p><b>Địa chỉ đặt quầy ký gửi:</b> ${customerAddress}</p>
                                <p><b>Người phụ trách / Quản lý:</b> .................................................................... <b>SĐT:</b> ...........................................</p>
                                <p><b>Ngày bắt đầu ký gửi:</b> ${printDate.split(' ')[1] || printDate} -<b> Đến:</b> ...........................................</p>
                                <p><b>Ghi chú tình trạng quầy kệ:</b> ........................................................................................................................</p>
                                <p>..............................................................................................................................................................................</p>
                            </div>
                            
                            <div class="signature-area" style="margin-top: 80px;">
                                <div class="signature-box" style="width: 50%;">Đại diện Hộ Kinh Doanh Shop Vân Hùng<p>(Ký, ghi rõ họ tên)</p></div>
                                <div class="signature-box" style="width: 50%;">Người phụ trách địa điểm<p>(Ký, ghi rõ họ tên)</p></div>
                            </div>
                        `);
                    
                } else {
                    
                    document.getElementById('print_cart_items').innerHTML = tbodyHTML;
                    document.getElementById('print_cus_name').innerText = customerText;
                    document.getElementById('print_date').innerText = printDate;
                    document.getElementById('print_trans_type').innerText = transType;

                    if (document.getElementById('print_cus_address')) {
                        document.getElementById('print_cus_address').innerText = customerAddress || '...................................................';
                    }
                    
                    document.getElementById('print_total_order').innerText = totalAmountDisplay;
                    document.getElementById('print_discount').innerText = document.getElementById('discount_vnd_display').innerText;
                    document.getElementById('print_final_amount').innerText = document.getElementById('final_amount_display').innerText;
                    document.getElementById('print_paid').innerText = paid_amount.toLocaleString('vi-VN') + ' đ';
                    document.getElementById('print_debt').innerText = document.getElementById('debt_amount_display').innerText;

                    let billContent = document.getElementById('print_receipt_area').innerHTML;
                    
                    printWindow.document.write(billContent);
                    printWindow.document.write(`
                        <div class="signature-area">
                            <div class="signature-box">Người nhận hàng<p>(Ký, ghi rõ họ tên)</p></div>
                            <div class="signature-box">Người giao hàng<p>(Ký, ghi rõ họ tên)</p></div>
                            <div class="signature-box">Người lập phiếu<p>(Ký, ghi rõ họ tên)</p></div>
                        </div>
                        <div class="receipt-footer">Cảm ơn quý khách đã tin tưởng và ủng hộ Hộ Kinh Doanh Shop Vân Hùng!</div>
                    `);
                }

                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();

                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                    window.location.reload();
                }, 500);

            } else {
                alert("Lỗi: " + data.message);
                btn.innerHTML = "CHỐT ĐƠN SỈ";
                btn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert("Không thể kết nối với máy chủ!");
            btn.innerHTML = "CHỐT ĐƠN SỈ";
            btn.disabled = false;
        });
    }

    // Modal Events
    function openAddCustomerModal() {
        document.getElementById('addCustomerModal').classList.remove('hidden');
        document.getElementById('new_cus_name').focus();
    }

    function closeAddCustomerModal() {
        document.getElementById('addCustomerModal').classList.add('hidden');
        document.getElementById('new_cus_name').value = '';
        document.getElementById('new_cus_phone').value = '';
        document.getElementById('new_cus_address').value = ''; 
    }

    function saveNewCustomer() {
        let name = document.getElementById('new_cus_name').value.trim();
        let phone = document.getElementById('new_cus_phone').value.trim();
        let address = document.getElementById('new_cus_address').value.trim(); 

        if (!name || !phone || !address) {
            alert("❌ Vui lòng nhập đầy đủ: Tên, Số điện thoại VÀ Địa chỉ cho Đại lý!");
            return;
        }

        let btn = document.getElementById('btn_save_cus');
        btn.innerHTML = "Đang lưu..."; btn.disabled = true;

        let formData = new FormData();
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('address', address); 
        formData.append('type', 'wholesale'); 

        fetch('ajax_add_customer.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.id) { 
                let select = document.getElementById('customer_id');
                let option = document.createElement('option');
                option.value = data.id;
                option.text = name + ' - ' + phone;
                // Bơm địa chỉ vào data-address của Đại lý vừa mới tạo luôn
                option.setAttribute('data-address', address);
                
                select.appendChild(option);
                select.value = data.id; 
                closeAddCustomerModal();
                btn.innerHTML = "Lưu & Chọn"; btn.disabled = false;
            } else {
                alert("Lỗi: " + (data.error || "Không xác định"));
                btn.innerHTML = "Lưu & Chọn"; btn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert("Lỗi kết nối máy chủ!");
            btn.innerHTML = "Lưu & Chọn"; btn.disabled = false;
        });
    }

    let barcodeBuffer = "";
    let lastKeyTime = Date.now();

    document.addEventListener('keydown', function(e) {
        if (document.getElementById('addCustomerModal') && !document.getElementById('addCustomerModal').classList.contains('hidden')) {
            return; 
        }

        let currentTime = Date.now();
        if (currentTime - lastKeyTime > 100) {
            barcodeBuffer = "";
        }
        lastKeyTime = currentTime;

        if (e.key.length === 1) {
            barcodeBuffer += e.key;
        }

        if (e.key === 'Enter' && barcodeBuffer.length > 0) {
            e.preventDefault(); 
            let scannedCode = barcodeBuffer.trim();
            barcodeBuffer = ""; 
            
            let itemAdd = document.getElementById('item_add_' + scannedCode);
            if (itemAdd) {
                if (itemAdd.getAttribute('data-disabled') === "true") {
                    let spName = itemAdd.getAttribute('data-name') || scannedCode;
                    alert('❌ Không thể thêm: Sản phẩm [' + spName + '] hiện đã hết hàng trong kho!');
                } else {
                    itemAdd.click(); 
                    let searchBox = document.getElementById('search_product');
                    if(document.activeElement === searchBox) {
                        searchBox.value = "";
                        searchBox.dispatchEvent(new Event('keyup')); 
                    }
                }
            } else {
                alert('⚠️ Không tìm thấy sản phẩm nào có mã: ' + scannedCode);
            }
        }
    });
</script>

<?php 
// require_once 'admin_footer.php'; 
?>