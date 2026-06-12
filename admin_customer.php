<?php
session_start();
require_once 'config/database.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    
    try {
        if ($action == 'edit') {
            $id = $_POST['customer_id'];
            $name = trim($_POST['customer_name']);
            $phone = trim($_POST['telephone']);
            $address = trim($_POST['address'] ?? '');
            $type = trim($_POST['customer_type']);
            
            if ($type == 'wholesale' && empty($address)) {
                throw new Exception("Address is required for wholesale customers!");
            }
            
            $stmt = $db->prepare("UPDATE customers SET customer_name=?, telephone=?, address=?, customer_type=? WHERE customer_id=?");
            $stmt->bind_param("ssssi", $name, $phone, $address, $type, $id);
            
            if ($stmt->execute()) {
                $message = '<div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4 font-bold">✅ Information updated successfully!</div>';
            }
        }
        elseif ($action == 'delete') {
            $id = $_POST['customer_id'];
            $stmt = $db->prepare("DELETE FROM customers WHERE customer_id=?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 font-bold">🗑️ Customer deleted from system!</div>';
            }
        }
        elseif ($action == 'pay_debt') {
            $id = $_POST['customer_id'];
            $amount = floatval(str_replace(['.', ','], '', trim($_POST['pay_amount']))); // Lọc dấu phẩy/chấm
            
            if ($amount <= 0) throw new Exception("Debt payment amount must be greater than 0!");
            
            $stmt = $db->prepare("UPDATE customers SET total_debt = total_debt - ? WHERE customer_id=?");
            $stmt->bind_param("di", $amount, $id);
            if ($stmt->execute()) {
             $message = '<div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-4 font-bold">💵 Collected ' . number_format($amount) . 'đ debt payment successfully!</div>';
                // 1. Móc tên khách hàng ra từ Database
                $cus_result = $db->query("SELECT customer_name FROM customers WHERE customer_id = $id");
                $cus_row = $cus_result->fetch_assoc();
                $cus_name = $cus_row['customer_name'] ?? 'Unknown Name';

                // 2. Lấy session người đang thao tác
                if (session_status() === PHP_SESSION_NONE) { session_start(); }
                $current_user = $_SESSION['admin_username'] ?? 'Admin'; // Sửa chữ 'username' nếu cần
                
                // 3. Ghi log đầy đủ Tên + ID
                $details = "Collected " . number_format($amount) . " đ debt payment from customer: $cus_name (ID: $id)";
                logActivity($db, $current_user, 'Debt Collection', $details);
            }
        }
        elseif ($action == 'redeem_points') {
            $id = $_POST['customer_id'];
            $points_to_redeem = intval(trim($_POST['redeem_amount']));
            
            if ($points_to_redeem <= 0) throw new Exception("Points to redeem must be greater than 0!");
            
            // Lấy điểm hiện tại ra check
            $checkPts = $db->query("SELECT points FROM customers WHERE customer_id = $id")->fetch_assoc();
            if ($checkPts['points'] < $points_to_redeem) {
                throw new Exception("Customer does not have enough points! (Currently has: {$checkPts['points']} points)");
            }

            $stmt = $db->prepare("UPDATE customers SET points = points - ? WHERE customer_id=?");
            $stmt->bind_param("ii", $points_to_redeem, $id);
            if ($stmt->execute()) {
                $message = '<div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-4 font-bold">🎁 Deducted ' . number_format($points_to_redeem) . ' points (Redeemed successfully)!</div>';
            }
        }
    } catch (Exception $e) {
        if ($db->errno == 1062) {
            $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 font-bold">❌ Error: This phone number already exists in the system!</div>';
        } else {
            $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 font-bold">❌ Error: ' . $e->getMessage() . '</div>';
        }
    }
}

$search = $_GET['search'] ?? '';
$searchQuery = "";
if (!empty($search)) {
    $searchQuery = "WHERE customer_name LIKE '%" . $db->real_escape_string($search) . "%' OR telephone LIKE '%" . $db->real_escape_string($search) . "%'";
}

// Cấu hình phân trang
$limit = 15; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Đếm tổng số dòng để tính số trang
$countSql = "SELECT COUNT(customer_id) as total FROM customers $searchQuery";
$countResult = $db->query($countSql);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Truy vấn lấy dữ liệu theo trang hiện tại
$sql = "SELECT * FROM customers $searchQuery ORDER BY customer_id DESC LIMIT $limit OFFSET $offset";
$result = $db->query($sql);
$customers = [];
if ($result) {
    $customers = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="max-w-7xl mx-auto px-4 py-8 flex-1 h-screen overflow-y-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-[#1a2954]">👥 Customer Management</h1>
        
        <div class="flex gap-3 w-full md:w-auto">
            <form method="GET" class="flex flex-1">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Name or phone number..." class="border border-gray-300 rounded-l-lg p-2.5 outline-none focus:border-blue-500 w-full md:w-64">
                <button type="submit" class="bg-gray-200 px-4 rounded-r-lg hover:bg-gray-300 font-bold text-gray-700 transition"><i class="fas fa-search"></i></button>
            </form>
            
            <button onclick="openAddModal()" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg font-bold hover:bg-blue-700 shadow-md transition flex items-center whitespace-nowrap">
                <i class="fas fa-user-plus mr-2"></i> Add Customer
            </button>
        </div>
    </div>

    <?= $message ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-bold border-b">
                    <th class="p-4 w-12 text-center">ID</th>
                    <th class="p-4">Customer / Contact</th>
                    <th class="p-4 text-center">Type</th>
                    <th class="p-4 text-right">Points</th>
                    <th class="p-4 text-right">Debt (VND)</th>
                    <th class="p-4 text-center w-40">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                <?php if (count($customers) > 0): ?>
                    <?php foreach ($customers as $c): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center text-gray-500 font-medium">#<?= $c['customer_id'] ?></td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800 text-base"><?= htmlspecialchars($c['customer_name']) ?></div>
                            <div class="text-blue-600 font-medium"><i class="fas fa-phone-alt text-xs mr-1"></i> <?= htmlspecialchars($c['telephone']) ?></div>
                            <?php if (!empty($c['address'])): ?>
                                <div class="text-xs text-gray-500 truncate max-w-[250px]" title="<?= htmlspecialchars($c['address']) ?>"><i class="fas fa-map-marker-alt mr-1"></i> <?= htmlspecialchars($c['address']) ?></div>
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-center">
                            <?php if ($c['customer_type'] == 'wholesale'): ?>
                                <span class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-xs font-bold">Wholesale</span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold">Retail</span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-right">
                            <span class="font-bold text-orange-500 text-base"><?= number_format($c['points'] ?? 0) ?></span>
                        </td>
                        <td class="p-4 text-right">
                            <span class="font-bold <?= ($c['total_debt'] > 0) ? 'text-red-600' : 'text-gray-500' ?> text-base"><?= number_format($c['total_debt'] ?? 0) ?> đ</span>
                        </td>
                        <td class="p-4 text-center flex flex-wrap justify-center gap-2">
                            <?php if ($c['total_debt'] > 0): ?>
                                <button onclick='openDebtModal(<?= json_encode($c) ?>)' class="bg-emerald-50 text-emerald-600 p-2 rounded hover:bg-emerald-600 hover:text-white transition" title="Collect debt">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </button>
                            <?php endif; ?>
                            
                            <?php if ($c['points'] > 0): ?>
                                <button onclick='openPointModal(<?= json_encode($c) ?>)' class="bg-orange-50 text-orange-600 p-2 rounded hover:bg-orange-500 hover:text-white transition" title="Redeem points">
                                    <i class="fas fa-gift"></i>
                                </button>
                            <?php endif; ?>

                            <button onclick='openEditModal(<?= json_encode($c) ?>)' class="bg-blue-50 text-blue-600 p-2 rounded hover:bg-blue-600 hover:text-white transition" title="Edit details">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');" class="inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="customer_id" value="<?= $c['customer_id'] ?>">
                                <button type="submit" class="bg-red-50 text-red-500 p-2 rounded hover:bg-red-500 hover:text-white transition" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="p-10 text-center text-gray-500 italic">No customers found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($totalPages > 1): ?>
        <div class="px-4 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing <span class="font-bold"><?= $offset + 1 ?></span> to <span class="font-bold"><?= min($offset + $limit, $totalRows) ?></span> of <span class="font-bold"><?= $totalRows ?></span> customers
            </div>
            
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" 
                       class="relative inline-flex items-center px-4 py-2 border text-sm font-medium transition 
                       <?= ($i == $page) ? 'z-10 bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-100' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</div>

<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-[#1a2954] p-4 flex justify-between items-center text-white">
            <h3 class="font-bold text-lg"><i class="fas fa-user-plus mr-2"></i>Add Customer</h3>
            <button onclick="closeModal('addModal')" class="text-gray-300 hover:text-white"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form id="addCustomerForm" class="p-5 space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Customer Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" required placeholder="Enter name..." class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                <input type="text" name="phone" required placeholder="Enter phone number..." class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Customer Group</label>
                <select name="type" id="add_type" onchange="toggleAddressRequired('add_type', 'add_address')" class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="retail">Retail</option>
                    <option value="wholesale">Wholesale</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Address <span id="add_addr_star" class="text-red-500 hidden">*</span></label>
                <input type="text" name="address" id="add_address" placeholder="Required for Wholesale customers" class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mt-6 flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeModal('addModal')" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-blue-600 p-4 flex justify-between items-center text-white">
            <h3 class="font-bold text-lg"><i class="fas fa-edit mr-2"></i>Update Information</h3>
            <button onclick="closeModal('editModal')" class="text-white hover:text-gray-200"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form method="POST" class="p-5 space-y-4">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="customer_id" id="edit_id">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Customer Name <span class="text-red-500">*</span></label>
                <input type="text" name="customer_name" id="edit_name" required class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                <input type="text" name="telephone" id="edit_phone" required class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Customer Group</label>
                <select name="customer_type" id="edit_type" onchange="toggleAddressRequired('edit_type', 'edit_address')" class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="retail">Retail</option>
                    <option value="wholesale">Wholesale</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Address <span id="edit_addr_star" class="text-red-500 hidden">*</span></label>
                <input type="text" name="address" id="edit_address" placeholder="Required for Wholesale customers" class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mt-6 flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeModal('editModal')" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="debtModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-emerald-600 p-4 flex justify-between items-center text-white">
            <h3 class="font-bold text-lg"><i class="fas fa-hand-holding-usd mr-2"></i>Collect Debt</h3>
            <button onclick="closeModal('debtModal')" class="text-white hover:text-gray-200"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form method="POST" class="p-5 space-y-4">
            <input type="hidden" name="action" value="pay_debt">
            <input type="hidden" name="customer_id" id="debt_id">
            
            <div class="text-center bg-gray-50 p-3 rounded-lg border">
                Customer: <strong id="debt_cus_name" class="text-gray-800"></strong><br>
                Current Debt: <strong id="debt_current" class="text-red-600 text-xl"></strong> đ
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">How much is the customer paying? <span class="text-red-500">*</span></label>
                <input type="number" name="pay_amount" id="debt_pay_input" required min="1000" class="w-full border border-emerald-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-emerald-500 text-lg font-bold text-emerald-700 bg-emerald-50">
                <p class="text-xs text-gray-500 mt-1 italic">Enter the amount paid (VND)</p>
            </div>
            
            <div class="mt-6 flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeModal('debtModal')" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700">Confirm Collection</button>
            </div>
        </form>
    </div>
</div>

<div id="pointModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-orange-500 p-4 flex justify-between items-center text-white">
            <h3 class="font-bold text-lg"><i class="fas fa-gift mr-2"></i>Redeem Points</h3>
            <button onclick="closeModal('pointModal')" class="text-white hover:text-gray-200"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form method="POST" class="p-5 space-y-4">
            <input type="hidden" name="action" value="redeem_points">
            <input type="hidden" name="customer_id" id="point_id">
            
            <div class="text-center bg-orange-50 p-3 rounded-lg border border-orange-200">
                Customer: <strong id="point_cus_name" class="text-gray-800"></strong><br>
                Current Points: <strong id="point_current" class="text-orange-600 text-xl"></strong>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Redeem how many points? <span class="text-red-500">*</span></label>
                <input type="number" name="redeem_amount" id="point_redeem_input" required min="1" class="w-full border border-orange-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-orange-500 text-lg font-bold text-orange-600">
                <p class="text-xs text-gray-500 mt-1 italic">Enter the points to deduct for reward or discount</p>
            </div>
            
            <div class="mt-6 flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeModal('pointModal')" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-2.5 bg-orange-500 text-white font-bold rounded-lg hover:bg-orange-600">Deduct Points</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }

    // Ràng buộc JS: Khách sỉ bắt buộc nhập địa chỉ
    function toggleAddressRequired(selectId, inputId) {
        let type = document.getElementById(selectId).value;
        let input = document.getElementById(inputId);
        let star = document.getElementById(selectId === 'add_type' ? 'add_addr_star' : 'edit_addr_star');
        
        if (type === 'wholesale') {
            input.required = true;
            star.classList.remove('hidden');
        } else {
            input.required = false;
            star.classList.add('hidden');
        }
    }

    function openAddModal() {
        // 1. Reset sạch data cũ lỡ nhập dở
        document.getElementById('addCustomerForm').reset(); 
        // 2. Kích hoạt lại logic check địa chỉ (đưa về trạng thái mặc định của Khách Lẻ)
        toggleAddressRequired('add_type', 'add_address'); 
        // 3. Mở modal
        openModal('addModal');
    }

    function openEditModal(customer) {
        document.getElementById('edit_id').value = customer.customer_id;
        document.getElementById('edit_name').value = customer.customer_name;
        document.getElementById('edit_phone').value = customer.telephone;
        document.getElementById('edit_address').value = customer.address || '';
        document.getElementById('edit_type').value = customer.customer_type || 'retail';
        toggleAddressRequired('edit_type', 'edit_address');
        openModal('editModal');
    }

    function openDebtModal(customer) {
       let debtAmount = parseInt(customer.total_debt, 10);

        document.getElementById('debt_id').value = customer.customer_id;
        document.getElementById('debt_cus_name').innerText = customer.customer_name;
        
        // Hiển thị nợ hiện tại
        document.getElementById('debt_current').innerText = new Intl.NumberFormat('en-US').format(debtAmount);
        
        // Gán số tiền nguyên vào ô input
        document.getElementById('debt_pay_input').value = debtAmount; 
        document.getElementById('debt_pay_input').max = debtAmount; 
        
        openModal('debtModal');
    }

    function openPointModal(customer) {
        document.getElementById('point_id').value = customer.customer_id;
        document.getElementById('point_cus_name').innerText = customer.customer_name;
        document.getElementById('point_current').innerText = new Intl.NumberFormat('en-US').format(customer.points);
        document.getElementById('point_redeem_input').value = '';
        document.getElementById('point_redeem_input').max = customer.points; // Không cho đổi lố điểm đang có
        openModal('pointModal');
    }

document.getElementById('addCustomerForm').addEventListener('submit', function(e) {
    e.preventDefault(); 

    // Lấy toàn bộ dữ liệu từ form
    let formData = new FormData(this);

    fetch('ajax_add_customer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' || data.id) {
            // Đóng modal
            closeModal('addModal');
            
            alert('Customer added successfully!');
            
            // Load lại trang để danh sách cập nhật khách hàng mới
            location.reload(); 
        } else {
            alert('❌ Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ A system error occurred! Please check again.');
    });
});
</script>