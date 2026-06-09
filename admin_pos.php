<?php
require_once 'connect.php'; 
require_once 'admin_header.php';

// Đoạn này sau này sẽ chuyển hẳn vào Controller
$sql_customers = "SELECT * FROM customers ORDER BY customer_name ASC";
$result_customers = mysqli_query($conn, $sql_customers);

$sql_promos = "SELECT promo_code, buy_qty, get_qty FROM promotions WHERE is_active = 1 AND promo_type = 'buy_x_get_y'";
$result_promos = mysqli_query($conn, $sql_promos);

$promo_rules_array = [];

if ($result_promos) {
    while ($row = mysqli_fetch_assoc($result_promos)) {
        $promo_rules_array[strtoupper($row['promo_code'])] = [
            'buy' => (int)$row['buy_qty'],
            'get' => (int)$row['get_qty']
        ];
    }
}

$promo_rules_json = json_encode($promo_rules_array);
$sql_products = "
    SELECT 
        p.*, 
        c.category_name,
        IF(p.quantity <= 0, 'Hết hàng', CONCAT('Tồn: ', p.quantity)) AS stock_text
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
                <h2 class="text-2xl font-bold text-gray-800">Sản phẩm</h2>
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
                        $is_out_of_stock = $pro['quantity'] <= 0;
                        $final_price = (isset($pro['is_sale']) && $pro['is_sale'] == 1) && !empty($pro['sale_price']) ? $pro['sale_price'] : $pro['price'];
                    ?>
                    <div class="product-card bg-white border border-gray-200 rounded-xl p-4 flex flex-col h-full shadow-sm hover:shadow-md transition relative" data-search="<?= $search_string ?>">
                        <div class="flex-1">
                            <div class="text-xs font-bold text-gray-500 mb-1">
                                Mã: <span class="text-blue-600 break-all text-[11px]"><?= $pro['id'] ?></span>
                            </div>
                            
                            <h3 class="font-bold text-gray-800 text-sm leading-tight mb-2" title="<?= $pro['product_name'] ?>">
                                <?= $pro['product_name'] ?>
                            </h3>
                            
                            <?php if (isset($pro['is_sale']) && $pro['is_sale'] == 1 && !empty($pro['sale_price'])): ?>
                                <div class="text-red-500 font-extrabold mb-1">
                                    <?= number_format($final_price, 0, ',', '.') ?>đ
                                    <span class="text-xs text-gray-400 font-normal line-through ml-1"><?= number_format($pro['price'], 0, ',', '.') ?>đ</span>
                                </div>
                            <?php else: ?>
                                <div class="text-[#f5b041] font-extrabold mb-1"><?= number_format($final_price, 0, ',', '.') ?>đ</div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs font-medium <?= $is_out_of_stock ? 'text-red-500' : 'text-gray-500' ?>">
                                <?= $pro['stock_text'] ?>
                            </span>
                            
                           <?php if(!$is_out_of_stock): ?>
                                <button id="btn_add_<?= htmlspecialchars(trim($pro['id']), ENT_QUOTES) ?>" 
                                        onclick="addToCart(<?= htmlspecialchars(json_encode(trim($pro['id'])), ENT_QUOTES) ?>, <?= htmlspecialchars(json_encode(trim($pro['product_name'])), ENT_QUOTES) ?>, <?= (float)$final_price ?: 0 ?>, <?= (int)$pro['quantity'] ?: 0 ?>)" 
                                        class="bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition">
                                    <i class="fas fa-plus"></i> Thêm
                                </button>
                            <?php else: ?>
                                <button id="btn_add_<?= trim($pro['id']) ?>" disabled data-name="<?= htmlspecialchars(trim($pro['product_name']), ENT_QUOTES) ?>" class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded-lg text-sm font-bold cursor-not-allowed">
                                    Hết
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div id="no_product_msg" class="hidden text-center text-gray-500 mt-10 italic">Không tìm thấy sản phẩm nào!</div>
            </div>
        </div>

        <div class="w-full md:w-5/12 bg-white border-l border-gray-200 flex flex-col h-full shadow-lg z-20">
            <div class="p-4 border-b border-gray-100 bg-gray-50">
                <div class="flex gap-2">
                    <select id="customer_select" class="flex-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                        <option value="0">Khách Vãng Lai</option>
                        <?php 
                        mysqli_data_seek($result_customers, 0);
                        while($cus = mysqli_fetch_assoc($result_customers)): 
                        ?>
                            <option value="<?= $cus['customer_id'] ?>"><?= $cus['customer_name'] ?> - <?= $cus['telephone'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button onclick="openModal()" class="bg-blue-600 text-white px-3 py-2 rounded-lg font-bold hover:bg-blue-700 transition text-sm" title="Thêm khách mới">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>

            <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-white">
                <h3 class="font-bold text-lg text-gray-800">🧾 Đơn hàng hiện tại</h3>
                <button onclick="clearCart()" class="text-sm text-red-500 hover:text-red-700 font-medium transition">
                    <i class="fas fa-trash-alt mr-1"></i>Hủy đơn
                </button>
            </div>

            <div id="cart_list" class="flex-1 p-4 overflow-y-auto space-y-3 custom-scrollbar">
                </div>

            <div class="p-4 bg-gray-50 border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-bold text-gray-700">Mã Khuyến Mãi:</span>
                    <div class="flex gap-2">
                        <input type="text" id="promo_code" placeholder="MUA10TANG1" 
                            class="w-32 px-3 py-1.5 border border-gray-300 rounded-lg text-sm uppercase focus:outline-none focus:border-blue-500 transition">
                        <button id="btn_apply_promo" onclick="applyPromo()" class="bg-green-100 text-green-700 hover:bg-green-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition">
                            Áp dụng
                        </button>
                    </div>
                </div>

                <div id="promo_discount_display" class="hidden flex justify-between items-center mb-2 text-green-600 text-sm font-bold">
                    <span>Tiền trừ từ voucher:</span>
                    <span id="promo_amount">-0đ</span>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-bold text-gray-700">Giảm giá (%):</span>
                    <input type="number" id="discount_percent" min="0" max="100" value="0" oninput="renderCart()" 
                            class="w-20 px-3 py-1.5 border border-gray-300 rounded-lg text-right font-bold focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>
                
                <div class="flex justify-between text-xl font-bold text-red-600 mb-4">
                    <span>TỔNG TIỀN:</span>
                    <span id="total_amount">0đ</span>
                </div>
                
                <div class="flex gap-3">
                    <button onclick="saveDraftAlert()" class="flex-1 bg-gray-200 text-gray-800 font-bold py-3 rounded-xl hover:bg-gray-300 transition text-sm">
                        <i class="fas fa-save mr-1"></i> Lưu Nháp
                    </button>
                    <button onclick="checkout()" class="flex-[2] bg-[#f5b041] text-[#1a2954] font-bold py-3 rounded-xl shadow-md hover:shadow-lg transition text-base uppercase">
                        Thanh toán & In
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="customerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="bg-[#1a2954] p-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-lg"><i class="fas fa-user-plus mr-2"></i>Thêm khách hàng mới</h3>
                <button onclick="closeModal()" class="text-gray-300 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên khách hàng <span class="text-red-500">*</span></label>
                    <input type="text" id="new_name" placeholder="Nhập tên khách..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                    <input type="text" id="new_phone" placeholder="Nhập số điện thoại..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button onclick="closeModal()" class="px-5 py-2 text-gray-600 font-medium hover:bg-gray-200 rounded-lg transition">Hủy</button>
                <button onclick="saveCustomer()" class="px-5 py-2 bg-[#f5b041] text-[#1a2954] font-bold rounded-lg hover:shadow-md transition">Lưu khách hàng</button>
            </div>
        </div>
    </div>
   <script>
        let cart = [];
        let globalPromoDiscount = 0; 
        let globalFinalTotal = 0;
        
        const PROMO_RULES = <?= $promo_rules_json; ?>; 
        let activePromoCode = ""; 

        console.log("Mã khuyến mãi hiện có:", PROMO_RULES);
        window.onload = function() {
            let savedCart = localStorage.getItem('posDraftCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
            }
            renderCart();
        };

        function applyPromo(){
            let inputEl = document.getElementById('promo_code');
            let btnEl = document.getElementById('btn_apply_promo');
            let inputCode = inputEl.value.trim().toUpperCase();

            if (activePromoCode !== "") {
                activePromoCode = "";
                inputEl.value = "";
                inputEl.disabled = false; 
                btnEl.innerText = "Áp dụng"; 
                btnEl.className = "bg-green-100 text-green-700 hover:bg-green-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition";
                renderCart();
                return;
            }

            if (inputCode === "") {
                return;
            }

            if (PROMO_RULES[inputCode]) {
                activePromoCode = inputCode;
                inputEl.disabled = true;
                btnEl.innerText = "Hủy mã"; 
                btnEl.className = "bg-red-100 text-red-700 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition"; // Đổi màu nút sang đỏ
                renderCart();
            } else {
                alert('Mã khuyến mãi không hợp lệ hoặc đã hết hạn!');
                inputEl.value = "";
                renderCart();
            }
        }


        function saveDraft() {
            localStorage.setItem('posDraftCart', JSON.stringify(cart));
        }

        function saveDraftAlert() {
            saveDraft();
            alert('Đã lưu nháp! Bạn có thể tải lại trang mà không mất đơn.');
        }

        function clearCart() {
            if(cart.length === 0) return;
            if(confirm('Xóa đơn hàng này?')) {
                cart = [];
                saveDraft();
                renderCart();
            }
        }

        function addToCart(id, name, price, stock) {
            price = parseInt(price);
            stock = parseInt(stock);

            let existingItem = cart.find(item => item.id === id);
            let currentQty = existingItem ? existingItem.qty : 0;

            if (currentQty + 1 > stock) {
                alert(`Kho không đủ! Hiện chỉ còn ${stock} sản phẩm.`);
                return;
            }

            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cart.push({ id, name, price, qty: 1, stock });
            }

            saveDraft();
            renderCart();
        }

        function changeQty(id, change) {
            let existingItem = cart.find(item => item.id === id);
            if(!existingItem) return;

            let newQty = existingItem.qty + change;
            
            if (newQty <= 0) {
                removeFromCart(id); 
                return;
            }

            if (newQty > existingItem.stock) {
                alert(`Chỉ có thể bán tối đa ${existingItem.stock} sản phẩm này!`);
                return;
            }

            existingItem.qty = newQty;
            saveDraft();
            renderCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            saveDraft();
            renderCart();
        }

        function renderCart() {
            const list = document.getElementById('cart_list');
            const totalEl = document.getElementById('total_amount');
            const subTotalEl = document.getElementById('sub_total_amount');
            const discountInput = document.getElementById('discount_percent');
            
            let discountPercent = parseFloat(discountInput ? discountInput.value : 0) || 0;
            const promoDisplay = document.getElementById('promo_discount_display');
            const promoAmountEl = document.getElementById('promo_amount');

            if (cart.length === 0) {
                list.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full text-gray-400 mt-10">
                        <i class="fas fa-shopping-basket text-4xl mb-3 opacity-50"></i>
                        <p class="italic">Chưa có món nào...</p>
                    </div>`;
                totalEl.innerText = '0đ';
                if (subTotalEl) subTotalEl.classList.add('hidden');
                return;
            }
        
            let total = 0;
            list.innerHTML = cart.map(item => {
                total += item.price * item.qty;
                return `
                <div class="bg-gray-50 border border-gray-100 p-3 rounded-xl relative group">
                    <button onclick="removeFromCart('${item.id}')" class="absolute -top-2 -right-2 bg-red-100 text-red-500 hover:bg-red-500 hover:text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-sm">
                        <i class="fas fa-times"></i>
                    </button>
                    <h4 class="font-bold text-gray-800 text-sm leading-tight pr-4 mb-2">${item.name}</h4>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-[#1a2954] text-sm">${(item.price * item.qty).toLocaleString('vi-VN')}đ</div>
                        <div class="flex items-center bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <button onclick="changeQty('${item.id}', -1)" class="px-2 py-1 text-gray-600 hover:bg-gray-100 border-r"><i class="fas fa-minus text-xs"></i></button>
                            <span class="w-8 text-center text-sm font-bold bg-gray-50">${item.qty}</span>
                            <button onclick="changeQty('${item.id}', 1)" class="px-2 py-1 text-gray-600 hover:bg-gray-100 border-l"><i class="fas fa-plus text-xs"></i></button>
                        </div>
                    </div>
                </div>`;
            }).join('');

            // Reset tiền KM về 0 trước khi tính lại
            globalPromoDiscount = 0;
    
            if (activePromoCode !== "" && PROMO_RULES[activePromoCode]) {
                let rule = PROMO_RULES[activePromoCode];
                let flatItems = [];
                cart.forEach(item => {
                    for(let i=0; i<item.qty; i++) { flatItems.push(item.price); }
                });

                let totalQty = flatItems.length;
                let requiredQty = rule.buy + rule.get;

                if (totalQty >= requiredQty) {
                    let numCombos = Math.floor(totalQty / requiredQty);
                    let freeQty = numCombos * rule.get;
                    
                    flatItems.sort((a, b) => a - b);
                    for(let i=0; i<freeQty; i++) {
                        globalPromoDiscount += flatItems[i]; 
                    }
                    
                    promoAmountEl.innerText = '-' + globalPromoDiscount.toLocaleString('vi-VN') + 'đ';
                    promoDisplay.classList.remove('hidden');
                } else {
                    promoDisplay.classList.add('hidden');
                }
            } else {
                promoDisplay.classList.add('hidden');
            }
            
            if (discountPercent > 100) discountPercent = 100;
            if (discountPercent < 0) discountPercent = 0;
        
            let discountAmount = (total * discountPercent) / 100;
            
            globalFinalTotal = total - discountAmount - globalPromoDiscount;
            if(globalFinalTotal < 0) globalFinalTotal = 0;
        
            totalEl.innerText = globalFinalTotal.toLocaleString('vi-VN') + 'đ';
            
            if (discountPercent > 0 && subTotalEl) {
                subTotalEl.innerText = total.toLocaleString('vi-VN') + 'đ';
                subTotalEl.classList.remove('hidden');
            } else if (subTotalEl) {
                subTotalEl.classList.add('hidden');
            }
        }

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

        function openModal() { document.getElementById('customerModal').classList.remove('hidden'); }
        function closeModal() { document.getElementById('customerModal').classList.add('hidden'); }

        function saveCustomer() {
            const name = document.getElementById('new_name').value;
            const phone = document.getElementById('new_phone').value;
            if (!name || !phone) return alert('Nhập đủ thông tin khách!');

            const formData = new FormData();
            formData.append('name', name);
            formData.append('phone', phone);

            fetch('ajax_add_customer.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.id) {
                    const select = document.getElementById('customer_select');
                    const opt = new Option(`${name} - ${phone}`, data.id);
                    select.add(opt);
                    select.value = data.id;
                    closeModal();
                    alert('Đã thêm khách mới thành công!');
                }
            });
        }

        function checkout() {
            if (cart.length === 0) return alert('Giỏ hàng trống!');

            const customer_id = document.getElementById('customer_select').value;
            const total_amount = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

            const orderData = {
                customer_id: customer_id,
                cart: cart,
                total_amount: globalFinalTotal
            };

            fetch('ajax_checkout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(orderData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    preparePrint(data.order_id);
                    window.print(); 
                    
                    // Lên đơn thành công thì xóa bản nháp đi
                    localStorage.removeItem('posDraftCart');
                    cart = [];
                    renderCart();
                    alert('Đã thanh toán và lưu hóa đơn #' + data.order_id);
                    location.reload();
                } else {
                    alert('Lỗi lưu hóa đơn!');
                }
            });
        }

        // Hàm vẽ hóa đơn trước khi in
        function preparePrint(orderId) {
            const customerName = document.getElementById('customer_select').options[document.getElementById('customer_select').selectedIndex].text;
            const now = new Date().toLocaleString('vi-VN');
            
            let billHtml = `
                <style type="text/css" id="print_style_temp" media="print">
                    @page { margin: 0; }
                    body { margin: 0; }
                    #print_section * {
                        color: #000000 !important;
                        -webkit-font-smoothing: none !important;
                        text-rendering: optimizeSpeed !important;
                    }
                </style>
                
                <div id="print_section" style="width: 80mm; padding: 10px; font-family: Arial, Helvetica, sans-serif; background: #fff; color: #000;">
                    <div style="text-align: center; font-weight: bold; font-size: 16px; margin-bottom: 5px;">
                        LAM EXPORT - HTM TM&DV Quy Nhơn Xanh
                    </div>
                    <div style="text-align: center; font-size: 13px; margin-bottom: 10px;">
                        Đ/C: 02 Trần Thị Kỉ, Phường Quy Nhơn Nam, Gia Lai<br>
                        SĐT: 0935.241.158
                    </div>
                    
                    <div style="font-size: 13px; text-align: center; border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                        Hóa đơn: #${orderId} - ${now}
                    </div>
                    <div style="font-size: 13px; margin-bottom: 10px; font-weight: bold;">
                        Khách hàng: ${customerName}
                    </div>
                    
                    <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px dashed #000;">
                                <th style="text-align: left; padding: 4px 0;">Sản Phẩm</th>
                                <th style="text-align: right; padding: 4px 12px 4px 0; width: 40px;">SL</th>
                                <th style="text-align: right; padding: 4px 0;">T.Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${cart.map(item => `
                                <tr>
                                    <td style="padding: 4px 0;">${item.name}</td>
                                    <td style="text-align: right; padding: 4px 12px 4px 0;">${item.qty}</td>
                                    <td style="text-align: right; padding: 4px 0; font-weight: bold;">
                                        ${(item.price * item.qty).toLocaleString('vi-VN')}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                    
                    <div style="border-top: 1px dashed #000; margin-top: 10px; padding-top: 10px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span>Tổng phụ:</span>
                            <span>${cart.reduce((sum, item) => sum + (item.price * item.qty), 0).toLocaleString('vi-VN')}</span>
                        </div>
                        
                        ${globalPromoDiscount > 0 ? `
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px; color: #555;">
                            <span>Voucher (${activePromoCode}):</span>
                            <span>-${globalPromoDiscount.toLocaleString('vi-VN')}</span>
                        </div>` : ''}
                        
                        ${(document.getElementById('discount_percent').value > 0) ? `
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px; color: #555;">
                            <span>Giảm giá (${document.getElementById('discount_percent').value}%):</span>
                            <span>-${((cart.reduce((sum, item) => sum + (item.price * item.qty), 0) * document.getElementById('discount_percent').value) / 100).toLocaleString('vi-VN')}</span>
                        </div>` : ''}
                    </div>

                    <div style="border-top: 1px solid #000; padding-top: 5px; display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
                        <span>TỔNG THU:</span>
                        <span>${globalFinalTotal.toLocaleString('vi-VN')}đ</span>
                    </div>

                    <div style="text-align: center; font-size: 12px; margin-top: 15px; font-style: italic;">
                        LAM EXPORT - HTM TM&DV Quy Nhơn Xanh<br>
                        Cảm ơn quý khách. Hẹn gặp lại!
                </div>
            `;

            let oldPrint = document.getElementById('print_section');
            let oldStyle = document.getElementById('print_style_temp');
            if (oldPrint) oldPrint.remove();
            if (oldStyle) oldStyle.remove();
            
            document.body.insertAdjacentHTML('beforeend', billHtml);
        }        

        let barcodeBuffer = "";
        let lastKeyTime = Date.now();

        document.addEventListener('keydown', function(e) {
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
                
                let btnAdd = document.getElementById('btn_add_' + scannedCode);
                
                if (btnAdd) {
                    if (btnAdd.hasAttribute('disabled') || btnAdd.disabled) {
                        let spName = btnAdd.getAttribute('data-name') || scannedCode;
                        alert('Không thể thêm: Sản phẩm [' + spName + '] hiện đã hết hàng trong kho!');
                    } else {
                        // Nếu còn hàng thì gọi click bình thường
                        btnAdd.click(); 
                        
                        let searchBox = document.getElementById('posSearch');
                        if(document.activeElement === searchBox) {
                            searchBox.value = "";
                            searchBox.dispatchEvent(new Event('input')); 
                        }
                    }
                } else {
                    alert('Không tìm thấy sản phẩm nào có mã: ' + scannedCode);
                }
            }
        });
    </script>
</body>
</html>