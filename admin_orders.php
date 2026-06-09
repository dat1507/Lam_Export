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
        <h2 class="text-3xl font-bold text-gray-800 mb-8">📜 Lịch Sử Hóa Đơn</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex justify-between items-center border border-gray-100">
                <form action="admin_orders.php" method="GET" class="flex w-full max-w-2xl gap-3">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" 
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                            placeholder="Gõ #MãĐơn (VD: #123) hoặc nhập Tên, SĐT khách..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    </div>
                    
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition whitespace-nowrap shadow-md">
                        Tìm Kiếm
                    </button>

                    <?php if(isset($_GET['search']) && $_GET['search'] !== ''): ?>
                        <a href="admin_orders.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition whitespace-nowrap flex items-center">
                            <i class="fas fa-times mr-1"></i> Hủy
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm border-b">
                        <th class="p-4 font-bold">Mã Đơn</th>
                        <th class="p-4 font-bold">Thời Gian</th>
                        <th class="p-4 font-bold">Khách Hàng</th>
                        <th class="p-4 font-bold">Số điện thoại</th>
                        <th class="p-4 font-bold text-right">Tổng Tiền</th>
                        <th class="p-4 font-bold text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php 
                        if($result_orders && mysqli_num_rows($result_orders) > 0):
                            while($order = mysqli_fetch_assoc($result_orders)): 
                                $date = date('d/m/Y H:i', strtotime($order['order_date']));
                                $customer_name_html = !empty($order['customer_name']) ? $order['customer_name'] : '<span class="text-gray-400 italic">Khách lẻ</span>';
                                $customer_name_text = !empty($order['customer_name']) ? $order['customer_name'] : 'Khách lẻ'; 
                                
                                $phone_html = !empty($order['telephone']) ? $order['telephone'] : '<span class="text-gray-400 italic">Trống</span>';

                                // XÁC ĐỊNH LOẠI ĐƠN HIỂN THỊ
                                $badge = '<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">Lẻ</span>';
                                if ($order['sale_type'] === 'wholesale') {
                                    if ($order['status'] === 'Còn nợ') {
                                        $badge = '<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-bold">Sỉ - Ký gửi</span>';
                                    } else {
                                        $badge = '<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Sỉ - TT Liền</span>';
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
                                        <i class="fas fa-trash-alt mr-1"></i> Hủy đơn
                                    </button>
                                        <button onclick="viewDetails(<?= $order['order_id'] ?>, '<?= $customer_name_text ?>', '<?= $date ?>', <?= $order['total_amount'] ?>, '<?= $order['sale_type'] ?>', <?= $order['discount_amount'] ?? 0 ?>, <?= $order['paid_amount'] ?? 0 ?>, <?= $order['debt_amount'] ?? 0 ?>)" class="text-blue-600 hover:text-blue-800 font-bold px-3 py-1 bg-blue-50 rounded-lg">
                                        Xem & In
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 italic">Chưa có hóa đơn nào được bán ra.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
                        

    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="bg-[#1a2954] p-4 text-white font-bold text-lg flex justify-between items-center">
                <span id="modalTitle">Chi Tiết Hóa Đơn</span>
                <button onclick="closeModal()" class="text-white hover:text-red-400 text-2xl leading-none">&times;</button>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1">
                <div id="loading" class="text-center text-gray-500 hidden py-8">Đang tải dữ liệu...</div>
                
                <table id="detailTable" class="w-full text-left border-collapse hidden">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm border-b">
                            <th class="p-3 font-bold">Sản phẩm</th>
                            <th class="p-3 font-bold text-center">SL</th>
                            <th class="p-3 font-bold text-right">Đơn giá</th>
                            <th class="p-3 font-bold text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="detailBody" class="divide-y divide-gray-200">
                        </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 border-t-2 border-gray-300">
                            <td colspan="3" class="p-3 font-bold text-right text-gray-700">TỔNG CỘNG:</td>
                            <td id="modalTotal" class="p-3 font-bold text-red-600 text-right text-lg">0đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="p-4 bg-gray-50 flex justify-end gap-3 border-t">
                <button onclick="reprintBill()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300">In lại Bill</button>
                <button onclick="closeModal()" class="px-6 py-2 bg-[#f5b041] text-[#1a2954] rounded-lg font-bold hover:bg-yellow-500">Đóng</button>
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
        title.innerText = `Chi Tiết Hóa Đơn #${orderId}`;
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
                                <td class="p-3 text-right">${parseInt(item.price).toLocaleString('vi-VN')}đ</td>
                                <td class="p-3 text-right font-bold">${parseInt(item.subtotal).toLocaleString('vi-VN')}đ</td>
                            </tr>
                        `;
                    }).join('');
                    
                    totalAmountEl.innerText = total.toLocaleString('vi-VN') + 'đ';
                } else {
                    tbody.innerHTML = `<tr><td colspan="4" class="p-4 text-center text-red-500">${data.message}</td></tr>`;
                    table.classList.remove('hidden');
                    currentPrintData = null;
                }
            })
            .catch(error => {
                loading.classList.add('hidden');
                alert("Có lỗi xảy ra khi tải dữ liệu!");
            });
    }

    // 4. HÀM IN HÓA ĐƠN
    function reprintBill() {
        if (!currentPrintData) {
            alert('Chưa có dữ liệu để in!');
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
                    Đ/C: 02 Trần Thị Kỉ, Phường Quy Nhơn Nam, Gia Lai<br>
                    SĐT: 0935.241.158
                </div>
                
                <div style="font-size: 13px; text-align: center; border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                    Hóa đơn: #${currentPrintData.orderId} - ${currentPrintData.orderDate}
                </div>
                
                <div style="font-size: 13px; margin-bottom: 10px; font-weight: bold;">
                    Khách hàng: ${currentPrintData.customerName}
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
                        ${currentPrintData.items.map(item => `
                            <tr>
                                <td style="padding: 4px 0;">${item.product_name}</td>
                                <td style="text-align: right; padding: 4px 12px 4px 0;">
                                    ${item.quantity}
                                </td>
                                <td style="text-align: right; padding: 4px 0; font-weight: bold;">
                                    ${parseInt(item.subtotal).toLocaleString('vi-VN')}
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                
                <div style="border-top: 1px dashed #000; margin-top: 10px; padding-top: 5px; text-align: right; font-size: 14px; font-weight: bold;">
                    TỔNG HÀNG: ${totalGoods.toLocaleString('vi-VN')}đ
                </div>
                
                ${currentPrintData.saleType === 'wholesale' ? `
                    <div style="text-align: right; font-size: 13px; margin-top: 5px;">
                        Chiết khấu: -${parseInt(currentPrintData.discountAmount || 0).toLocaleString('vi-VN')}đ
                    </div>
                    <div style="text-align: right; font-size: 15px; font-weight: bold; margin-top: 5px; border-top: 1px solid #000; padding-top: 5px;">
                        TỔNG HÓA ĐƠN: ${parseInt(currentPrintData.totalAmount).toLocaleString('vi-VN')}đ
                    </div>
                    <div style="text-align: right; font-size: 13px; margin-top: 5px;">
                        Đã thanh toán: ${parseInt(currentPrintData.paidAmount || 0).toLocaleString('vi-VN')}đ
                    </div>
                    <div style="text-align: right; font-size: 14px; font-weight: bold; margin-top: 5px;">
                        Còn nợ: ${parseInt(currentPrintData.debtAmount || 0).toLocaleString('vi-VN')}đ
                    </div>
                ` : `
                    <div style="text-align: right; font-size: 15px; font-weight: bold; margin-top: 5px; border-top: 1px solid #000; padding-top: 5px;">
                        TỔNG HÓA ĐƠN: ${parseInt(currentPrintData.totalAmount).toLocaleString('vi-VN')}đ
                    </div>
                `}
                <div style="text-align: center; font-size: 12px; margin-top: 15px; font-style: italic;">
                    LAM EXPORT - HTM TM&DV Quy Nhơn Xanh - LAM EXPORT<br>
                    Cảm ơn quý khách. Hẹn gặp lại!
                </div>
                
                <div style="text-align: center; font-size: 13px; margin-top: 8px; font-weight: bold; border-top: 1px solid #000; padding-top: 5px;">
                    *** BẢN IN LẠI ***
                </div>
            </div>
            `;

        let oldPrint = document.getElementById('print_section');
        if (oldPrint) oldPrint.remove();
        document.body.insertAdjacentHTML('beforeend', billHtml);
        
        window.print();
        alert('Đã in hóa đơn #' + currentPrintData.orderId + ' thành công');
        location.reload();
    }
    
    function cancelOrder(orderId) {
        if (!confirm('Bạn có chắc chắn muốn hủy hóa đơn #' + orderId + '?\nHệ thống sẽ tự động hoàn lại số lượng kho và trừ công nợ cho khách.')) {
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
                alert('Đã hủy đơn hàng thành công!');
                location.reload(); // Tải lại trang để thấy status thành "Đã hủy"
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Lỗi kết nối:', error);
            alert('Đã xảy ra lỗi hệ thống, vui lòng thử lại.');
        });
    }

    // Đóng Modal khi bấm ra ngoài
    modal.addEventListener('click', function(e) {
        if(e.target === this) closeModal();
    });
</script>
</body>
</html>