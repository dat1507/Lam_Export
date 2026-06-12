<?php
require_once 'connect.php';
require_once 'admin_header.php';

// 1. Lấy từ khóa tìm kiếm
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql_orders = "
    SELECT o.order_id, o.total_amount, o.order_date, o.sale_type, o.status, o.paid_amount, o.debt_amount, o.discount_amount, c.customer_name, c.telephone 
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.customer_id
    WHERE o.status != 'Đã hủy'
";

// 3. Xử lý logic tìm kiếm thông minh
if ($search !== '') {
    $safe_search = mysqli_real_escape_string($conn, $search);
    
    if (strpos($safe_search, '#') === 0) {
        
        $order_id = substr($safe_search, 1);
        
        $sql_orders .= " AND o.order_id LIKE '%$order_id%'"; 
        
    } else {
        $sql_orders .= " AND (o.order_id LIKE '%$safe_search%' 
                            OR c.customer_name LIKE '%$safe_search%' 
                            OR c.telephone LIKE '%$safe_search%')";
    }
}

$sql_orders .= " ORDER BY o.order_date DESC";

$result_orders = mysqli_query($conn, $sql_orders);
?>

<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">

    <div class="flex-1 p-8 overflow-y-auto relative">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">📜 Order History</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex justify-between items-center border border-gray-100">
                <form action="admin_orders.php" method="GET" class="flex w-full max-w-2xl gap-3">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" 
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                            placeholder="Type #OrderID (e.g. #123) or enter customer Name, Phone..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    </div>
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition whitespace-nowrap shadow-md">
                        Search
                    </button>

                    <?php if(isset($_GET['search']) && $_GET['search'] !== ''): ?>
                        <a href="admin_orders.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition whitespace-nowrap flex items-center">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm border-b">
                        <th class="p-4 font-bold">Order ID</th>
                        <th class="p-4 font-bold">Date & Time</th>
                        <th class="p-4 font-bold">Customer</th>
                        <th class="p-4 font-bold">Phone Number</th>
                        <th class="p-4 font-bold text-right">Total Amount</th>
                        <th class="p-4 font-bold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php 
                        if($result_orders && mysqli_num_rows($result_orders) > 0):
                            while($order = mysqli_fetch_assoc($result_orders)): 
                                $date = date('d/m/Y H:i', strtotime($order['order_date']));
                                $customer_name_html = !empty($order['customer_name']) ? $order['customer_name'] : '<span class="text-gray-400 italic">Retail</span>';
                                $customer_name_text = !empty($order['customer_name']) ? $order['customer_name'] : 'Retail'; 
                                
                                $phone_html = !empty($order['telephone']) ? $order['telephone'] : '<span class="text-gray-400 italic">Empty</span>';

                                // XÁC ĐỊNH LOẠI ĐƠN HIỂN THỊ
                                $badge = '<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">Retail</span>';
                                if ($order['sale_type'] === 'wholesale') {
                                    if ($order['status'] === 'Còn nợ') {
                                        $badge = '<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-bold">Wholesale - Consignment</span>';
                                    } else {
                                        $badge = '<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Wholesale - Paid</span>';
                                    }
                                }
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-[#1a2954]">
                                    #<?= $order['order_id'] ?><br><div class="mt-1"><?= $badge ?></div>
                                </td>
                                <td class="p-4 text-gray-600"><?= $date ?></td>
                                <td class="p-4 font-medium"><?= $customer_name_html ?></td>
                                <td class="p-4 text-gray-600"><?= $phone_html ?></td>
                                <td class="p-4 font-bold text-red-600 text-right"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                                <td class="p-4 text-center">
                                    <button type="button" 
                                             onclick="cancelOrder(<?= $order['order_id'] ?>)" 
                                             class="text-red-600 hover:text-red-800 font-bold px-3 py-1 bg-red-50 hover:bg-red-100 rounded-lg transition mr-2">
                                        <i class="fas fa-trash-alt mr-1"></i> Cancel Order
                                    </button>
                                        <button onclick="viewDetails(<?= $order['order_id'] ?>, '<?= $customer_name_text ?>', '<?= $date ?>', <?= $order['total_amount'] ?>, '<?= $order['sale_type'] ?>', <?= $order['discount_amount'] ?? 0 ?>, <?= $order['paid_amount'] ?? 0 ?>, <?= $order['debt_amount'] ?? 0 ?>)" class="text-blue-600 hover:text-blue-800 font-bold px-3 py-1 bg-blue-50 rounded-lg">
                                        View & Print
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 italic">No invoices have been issued yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
                        

    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="bg-[#1a2954] p-4 text-white font-bold text-lg flex justify-between items-center">
                <span id="modalTitle">Order Details</span>
                <button onclick="closeModal()" class="text-white hover:text-red-400 text-2xl leading-none">&times;</button>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1">
                <div id="loading" class="text-center text-gray-500 hidden py-8">Loading data...</div>
                
                <table id="detailTable" class="w-full text-left border-collapse hidden">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm border-b">
                            <th class="p-3 font-bold">Product</th>
                            <th class="p-3 font-bold text-center">Qty</th>
                            <th class="p-3 font-bold text-right">Unit Price</th>
                            <th class="p-3 font-bold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailBody" class="divide-y divide-gray-200">
                        </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 border-t-2 border-gray-300">
                            <td colspan="3" class="p-3 font-bold text-right text-gray-700">GRAND TOTAL:</td>
                            <td id="modalTotal" class="p-3 font-bold text-red-600 text-right text-lg">0đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="p-4 bg-gray-50 flex justify-end gap-3 border-t">
                <button onclick="reprintBill()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300">Reprint Bill</button>
                <button onclick="closeModal()" class="px-6 py-2 bg-[#f5b041] text-[#1a2954] rounded-lg font-bold hover:bg-yellow-500">Close</button>
            </div>
        </div>
    </div>

    <script>
    const modal = document.getElementById('detailModal');
    const loading = document.getElementById('loading');
    const table = document.getElementById('detailTable');
    const tbody = document.getElementById('detailBody');
    const title = document.getElementById('modalTitle');
    const totalAmountEl = document.getElementById('modalTotal');

    let currentPrintData = null;

    function closeModal() {
        modal.classList.add('hidden');
    }

    function viewDetails(orderId, customerName, orderDate, totalAmount, saleType, discountAmount, paidAmount, debtAmount) {
        modal.classList.remove('hidden');
        title.innerText = `Order Details #${orderId}`;
        loading.classList.remove('hidden');
        table.classList.add('hidden');
        tbody.innerHTML = '';
        
        fetch(`ajax_get_order_details.php?id=${orderId}`)
            .then(res => res.json())
            .then(data => {
                loading.classList.add('hidden');
                
                if (data.status === 'success') {
                    table.classList.remove('hidden');
                    let total = 0;
                    
                    currentPrintData = {
                        orderId: orderId,
                        customerName: customerName,
                        orderDate: orderDate,
                        totalAmount: totalAmount,
                        saleType: saleType,
                        discountAmount: discountAmount,
                        paidAmount: paidAmount,
                        debtAmount: debtAmount,
                        items: data.details
                    };
                    
                    tbody.innerHTML = data.details.map(item => {
                        total += parseInt(item.subtotal);
                        return `
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">${item.product_name}</td>
                                <td class="p-3 text-center font-medium">${item.quantity}</td>
                                <td class="p-3 text-right">${parseInt(item.price).toLocaleString('en-US')}đ</td>
                                <td class="p-3 text-right font-bold">${parseInt(item.subtotal).toLocaleString('en-US')}đ</td>
                            </tr>
                        `;
                    }).join('');
                    
                    totalAmountEl.innerText = total.toLocaleString('en-US') + 'đ';
                } else {
                    tbody.innerHTML = `<tr><td colspan="4" class="p-4 text-center text-red-500">${data.message}</td></tr>`;
                    table.classList.remove('hidden');
                    currentPrintData = null;
                }
            })
            .catch(error => {
                loading.classList.add('hidden');
                alert("An error occurred while loading data!");
            });
    }

    // 4. HÀM IN HÓA ĐƠN
    function reprintBill() {
        if (!currentPrintData) {
            alert('No data to print!');
            return; 
        }

        // Tính tổng tiền hàng ban đầu (trước khi trừ chiết khấu)
        let totalGoods = parseInt(currentPrintData.totalAmount) + parseInt(currentPrintData.discountAmount || 0);

        let billHtml = `
            <style type="text/css" media="print">
                @page { 
                    margin: 0; 
                }
                body { 
                    margin: 0; 
                }
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
                    Add: 02 Tran Thi Ki, Quy Nhon Nam Ward, Gia Lai<br>
                    TEL: 0935.241.158
                </div>
                
                <div style="font-size: 13px; text-align: center; border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                    Invoice: #${currentPrintData.orderId} - ${currentPrintData.orderDate}
                </div>
                
                <div style="font-size: 13px; margin-bottom: 10px; font-weight: bold;">
                    Customer: ${currentPrintData.customerName}
                </div>
                
                <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px dashed #000;">
                            <th style="text-align: left; padding: 4px 0;">Product</th>
                            <th style="text-align: right; padding: 4px 12px 4px 0; width: 40px;">Qty</th>
                            <th style="text-align: right; padding: 4px 0;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${currentPrintData.items.map(item => `
                            <tr>
                                <td style="padding: 4px 0;">${item.product_name}</td>
                                <td style="text-align: right; padding: 4px 12px 4px 0;">
                                    ${item.quantity}
                                </td>
                                <td style="text-align: right; padding: 4px 0; font-weight: bold;">
                                    ${parseInt(item.subtotal).toLocaleString('en-US')}
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                
                <div style="border-top: 1px dashed #000; margin-top: 10px; padding-top: 5px; text-align: right; font-size: 14px; font-weight: bold;">
                    SUBTOTAL: ${totalGoods.toLocaleString('en-US')}đ
                </div>
                
                ${currentPrintData.saleType === 'wholesale' ? `
                    <div style="text-align: right; font-size: 13px; margin-top: 5px;">
                        Discount: -${parseInt(currentPrintData.discountAmount || 0).toLocaleString('en-US')}đ
                    </div>
                    <div style="text-align: right; font-size: 15px; font-weight: bold; margin-top: 5px; border-top: 1px solid #000; padding-top: 5px;">
                        GRAND TOTAL: ${parseInt(currentPrintData.totalAmount).toLocaleString('en-US')}đ
                    </div>
                    <div style="text-align: right; font-size: 13px; margin-top: 5px;">
                        Paid Amount: ${parseInt(currentPrintData.paidAmount || 0).toLocaleString('en-US')}đ
                    </div>
                    <div style="text-align: right; font-size: 14px; font-weight: bold; margin-top: 5px;">
                        Debt Amount: ${parseInt(currentPrintData.debtAmount || 0).toLocaleString('en-US')}đ
                    </div>
                ` : `
                    <div style="text-align: right; font-size: 15px; font-weight: bold; margin-top: 5px; border-top: 1px solid #000; padding-top: 5px;">
                        GRAND TOTAL: ${parseInt(currentPrintData.totalAmount).toLocaleString('en-US')}đ
                    </div>
                `}
                <div style="text-align: center; font-size: 12px; margin-top: 15px; font-style: italic;">
                    LAM EXPORT - HTM TM&DV Quy Nhơn Xanh - LAM EXPORT<br>
                    Thank you. See you again!
                </div>
                
                <div style="text-align: center; font-size: 13px; margin-top: 8px; font-weight: bold; border-top: 1px solid #000; padding-top: 5px;">
                    *** REPRINT ***
                </div>
            </div>
            `;

        let oldPrint = document.getElementById('print_section');
        if (oldPrint) oldPrint.remove();
        document.body.insertAdjacentHTML('beforeend', billHtml);
        
        window.print();
        alert('Printed invoice #' + currentPrintData.orderId + ' successfully');
        location.reload();
    }
    
    function cancelOrder(orderId) {
        if (!confirm('Are you sure you want to cancel invoice #' + orderId + '?\nThe system will automatically restore stock levels and adjust the customer\'s debt.')) {
            return;
        }

        // Tạo form data để gửi đi
        let formData = new URLSearchParams();
        formData.append('order_id', orderId);

        fetch('ajax_cancel_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order cancelled successfully!');
                location.reload(); // Tải lại trang để thấy status thành "Đã hủy"
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            alert('A system error occurred, please try again.');
        });
    }

    // Đóng Modal khi bấm ra ngoài
    modal.addEventListener('click', function(e) {
        if(e.target === this) closeModal();
    });
</script>
</body>
</html>