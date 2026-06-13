<?php
require_once 'connect.php';
require_once 'admin_header.php';

// ── AUTO-CREATE + MIGRATE wholesale_requests TABLE ──
$conn->query("
    CREATE TABLE IF NOT EXISTS wholesale_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id VARCHAR(11) NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        customer_name VARCHAR(150) NOT NULL,
        phone_number VARCHAR(50) NOT NULL,
        requested_quantity INT NOT NULL DEFAULT 1,
        notes TEXT,
        request_status ENUM('Pending','Confirmed','Rejected') NOT NULL DEFAULT 'Pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
// Migrate: fix column type if table was created with INT product_id
@$conn->query("ALTER TABLE wholesale_requests MODIFY COLUMN product_id VARCHAR(11) NOT NULL");

// ── ACTIVE TAB ──
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'orders';

// ── ORDERS QUERY ──
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql_orders = "
    SELECT o.order_id, o.total_amount, o.order_date, o.sale_type, o.status,
           o.paid_amount, o.debt_amount, o.discount_amount,
           c.customer_name, c.telephone
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.customer_id
    WHERE o.status != 'Đã hủy'
";
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

// ── WHOLESALE REQUESTS QUERY ──
$wq_status_filter = isset($_GET['wq_status']) ? trim($_GET['wq_status']) : '';
$wq_search        = isset($_GET['wq_search']) ? trim($_GET['wq_search']) : '';

$sql_wq = "SELECT * FROM wholesale_requests WHERE 1=1";
if ($wq_status_filter !== '') {
    $safe_status = $conn->real_escape_string($wq_status_filter);
    $sql_wq .= " AND request_status = '$safe_status'";
}
if ($wq_search !== '') {
    $safe_wq_search = $conn->real_escape_string($wq_search);
    $sql_wq .= " AND (customer_name LIKE '%$safe_wq_search%'
                    OR product_name LIKE '%$safe_wq_search%'
                    OR phone_number LIKE '%$safe_wq_search%'
                    OR id LIKE '%$safe_wq_search%')";
}
$sql_wq .= " ORDER BY created_at DESC";
$result_wq = mysqli_query($conn, $sql_wq);

// ── WQ STATS ──
$wq_stats = ['total' => 0, 'Pending' => 0, 'Confirmed' => 0, 'Rejected' => 0];
$res_stats = mysqli_query($conn, "SELECT request_status, COUNT(*) AS cnt FROM wholesale_requests GROUP BY request_status");
if ($res_stats) {
    while ($s = mysqli_fetch_assoc($res_stats)) {
        $wq_stats[$s['request_status']] = (int)$s['cnt'];
        $wq_stats['total'] += (int)$s['cnt'];
    }
}
?>

<div class="flex-1 p-6 overflow-y-auto">

    <!-- ══ TAB NAVIGATION ══ -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                <?= $active_tab === 'wholesale' ? '📦 Wholesale Requests' : '📋 Order History' ?>
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">
                <?= $active_tab === 'wholesale' ? 'Manage and review all wholesale quote requests from customers.' : 'View and manage all completed orders.' ?>
            </p>
        </div>

        <!-- Tab Switcher Pill -->
        <div class="flex gap-1 bg-white border border-slate-200 rounded-xl p-1 shadow-sm">
            <a href="admin_orders.php?tab=orders<?= $search ? '&search='.urlencode($search) : '' ?>"
               class="px-5 py-2 rounded-lg text-sm font-semibold transition <?= $active_tab === 'orders' ? 'bg-[#1e3a8a] text-white shadow' : 'text-slate-500 hover:text-slate-800' ?>">
                <i class="fas fa-list-ul mr-1.5"></i>Orders
            </a>
            <a href="admin_orders.php?tab=wholesale"
               class="relative px-5 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2 <?= $active_tab === 'wholesale' ? 'bg-amber-400 text-blue-900 shadow' : 'text-slate-500 hover:text-slate-800' ?>">
                <i class="fas fa-file-signature mr-1"></i>Wholesale Requests
                <?php if ($wq_stats['Pending'] > 0): ?>
                    <span class="bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center leading-none px-1"><?= $wq_stats['Pending'] ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <!-- ══════════════════════════════════════════ -->
    <!--             ORDERS TAB                    -->
    <!-- ══════════════════════════════════════════ -->
    <div id="tabOrders" class="<?= $active_tab !== 'orders' ? 'hidden' : '' ?>">

        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-xl shadow-sm mb-5 border border-slate-200">
            <form action="admin_orders.php" method="GET" class="flex gap-3 items-center">
                <input type="hidden" name="tab" value="orders">
                <div class="relative flex-1 max-w-xl">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="search"
                           value="<?= htmlspecialchars($search) ?>"
                           placeholder="Type #OrderID, Customer Name or Phone..."
                           class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-[#1e3a8a] text-white text-sm font-semibold rounded-lg hover:bg-blue-800 transition shadow-sm">Search</button>
                <?php if ($search): ?>
                    <a href="admin_orders.php?tab=orders" class="px-4 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-lg hover:bg-slate-200 transition">
                        <i class="fas fa-times mr-1"></i>Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 uppercase text-xs border-b border-slate-200">
                        <th class="px-5 py-3.5 font-bold">Order ID</th>
                        <th class="px-5 py-3.5 font-bold">Date & Time</th>
                        <th class="px-5 py-3.5 font-bold">Customer</th>
                        <th class="px-5 py-3.5 font-bold">Phone</th>
                        <th class="px-5 py-3.5 font-bold text-right">Total Amount</th>
                        <th class="px-5 py-3.5 font-bold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php
                    if ($result_orders && mysqli_num_rows($result_orders) > 0):
                        while ($order = mysqli_fetch_assoc($result_orders)):
                            $date = date('d/m/Y H:i', strtotime($order['order_date']));
                            $customer_name_html = !empty($order['customer_name']) ? htmlspecialchars($order['customer_name']) : '<span class="text-slate-400 italic">Retail</span>';
                            $customer_name_text = !empty($order['customer_name']) ? $order['customer_name'] : 'Retail';
                            $phone_html = !empty($order['telephone']) ? htmlspecialchars($order['telephone']) : '<span class="text-slate-400 italic">—</span>';
                            $badge = '<span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-[11px] font-bold">Retail</span>';
                            if ($order['sale_type'] === 'wholesale') {
                                if ($order['status'] === 'Còn nợ') {
                                    $badge = '<span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full text-[11px] font-bold">Wholesale · Consignment</span>';
                                } else {
                                    $badge = '<span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-[11px] font-bold">Wholesale · Paid</span>';
                                }
                            }
                    ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3.5">
                                <span class="font-bold text-[#1a2954] font-mono text-sm">#<?= $order['order_id'] ?></span>
                                <div class="mt-1"><?= $badge ?></div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600"><?= $date ?></td>
                            <td class="px-5 py-3.5 font-semibold text-slate-800"><?= $customer_name_html ?></td>
                            <td class="px-5 py-3.5 text-sm text-slate-500"><?= $phone_html ?></td>
                            <td class="px-5 py-3.5 font-bold text-red-600 text-right text-sm"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td class="px-5 py-3.5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="viewDetails(<?= $order['order_id'] ?>, '<?= addslashes($customer_name_text) ?>', '<?= $date ?>', <?= $order['total_amount'] ?>, '<?= $order['sale_type'] ?>', <?= $order['discount_amount'] ?? 0 ?>, <?= $order['paid_amount'] ?? 0 ?>, <?= $order['debt_amount'] ?? 0 ?>)"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-semibold rounded-lg transition">
                                        <i class="fas fa-eye"></i> View & Print
                                    </button>
                                    <button onclick="cancelOrder(<?= $order['order_id'] ?>)"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold rounded-lg transition">
                                        <i class="fas fa-ban"></i> Cancel
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="6" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-400">
                                    <i class="fas fa-inbox text-4xl"></i>
                                    <p class="text-sm font-medium">No orders found.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /tabOrders -->


    <!-- ══════════════════════════════════════════ -->
    <!--        WHOLESALE REQUESTS TAB             -->
    <!-- ══════════════════════════════════════════ -->
    <div id="tabWholesale" class="<?= $active_tab !== 'wholesale' ? 'hidden' : '' ?>">

        <!-- ── STATS CARDS ── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <?php
            $stat_cards = [
                ['label' => 'Total Requests', 'value' => $wq_stats['total'],     'icon' => 'fa-layer-group',     'color' => 'blue',    'filter' => ''],
                ['label' => 'Pending',         'value' => $wq_stats['Pending'],   'icon' => 'fa-hourglass-half',  'color' => 'amber',   'filter' => 'Pending'],
                ['label' => 'Confirmed',        'value' => $wq_stats['Confirmed'],'icon' => 'fa-check-circle',    'color' => 'emerald', 'filter' => 'Confirmed'],
                ['label' => 'Rejected',         'value' => $wq_stats['Rejected'], 'icon' => 'fa-times-circle',    'color' => 'red',     'filter' => 'Rejected'],
            ];
            $colorMap = [
                'blue'    => ['bg' => 'bg-blue-50',    'icon' => 'bg-blue-100 text-blue-600',    'value' => 'text-blue-700',    'border' => 'border-blue-200'],
                'amber'   => ['bg' => 'bg-amber-50',   'icon' => 'bg-amber-100 text-amber-600',   'value' => 'text-amber-700',   'border' => 'border-amber-200'],
                'emerald' => ['bg' => 'bg-emerald-50', 'icon' => 'bg-emerald-100 text-emerald-600','value' => 'text-emerald-700','border' => 'border-emerald-200'],
                'red'     => ['bg' => 'bg-red-50',     'icon' => 'bg-red-100 text-red-600',       'value' => 'text-red-700',     'border' => 'border-red-200'],
            ];
            foreach ($stat_cards as $card):
                $c  = $colorMap[$card['color']];
                $isActive = ($wq_status_filter === $card['filter']);
            ?>
            <a href="admin_orders.php?tab=wholesale&wq_status=<?= urlencode($card['filter']) ?><?= $wq_search ? '&wq_search='.urlencode($wq_search) : '' ?>"
               class="bg-white rounded-2xl border <?= $c['border'] ?> p-5 shadow-sm flex items-center gap-4 hover:shadow-md transition group <?= $isActive ? 'ring-2 ring-offset-1 ring-'.($card['color']==='blue'?'blue':$card['color']).'-400' : '' ?>">
                <div class="w-12 h-12 <?= $c['icon'] ?> rounded-xl flex items-center justify-center shrink-0">
                    <i class="fas <?= $card['icon'] ?> text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide"><?= $card['label'] ?></p>
                    <p class="text-2xl font-extrabold <?= $c['value'] ?> mt-0.5"><?= $card['value'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- ── FILTER + SEARCH BAR ── -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 mb-5">
            <div class="px-5 py-3.5 flex flex-wrap items-center gap-3 justify-between border-b border-slate-100">

                <!-- Segmented Filter Pills -->
                <div class="flex gap-1.5 flex-wrap">
                    <?php
                    $pill_options = ['' => 'All', 'Pending' => 'Pending', 'Confirmed' => 'Confirmed', 'Rejected' => 'Rejected'];
                    $pill_colors  = [
                        ''          => 'bg-[#1e3a8a] text-white',
                        'Pending'   => 'bg-amber-500 text-white',
                        'Confirmed' => 'bg-emerald-600 text-white',
                        'Rejected'  => 'bg-red-600 text-white',
                    ];
                    foreach ($pill_options as $val => $label):
                        $isActive   = ($wq_status_filter === $val);
                        $activeCls  = $isActive ? $pill_colors[$val] : 'bg-slate-100 text-slate-600 hover:bg-slate-200';
                    ?>
                    <a href="admin_orders.php?tab=wholesale&wq_status=<?= urlencode($val) ?><?= $wq_search ? '&wq_search='.urlencode($wq_search) : '' ?>"
                       class="px-4 py-1.5 rounded-full text-sm font-semibold transition <?= $activeCls ?>">
                        <?= $label ?>
                        <?php if ($val !== '' && $wq_stats[$val] > 0): ?>
                            <span class="ml-1 opacity-80">(<?= $wq_stats[$val] ?>)</span>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <!-- Search -->
                <form method="GET" action="admin_orders.php" class="flex gap-2">
                    <input type="hidden" name="tab" value="wholesale">
                    <input type="hidden" name="wq_status" value="<?= htmlspecialchars($wq_status_filter) ?>">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="wq_search" value="<?= htmlspecialchars($wq_search) ?>"
                               placeholder="Search by name, phone, product, ID..."
                               class="pl-8 pr-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 w-64 transition">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-[#1e3a8a] text-white text-sm font-semibold rounded-lg hover:bg-blue-800 transition">Search</button>
                    <?php if ($wq_search): ?>
                        <a href="admin_orders.php?tab=wholesale&wq_status=<?= urlencode($wq_status_filter) ?>"
                           class="px-3 py-2 bg-slate-100 text-slate-600 text-sm font-medium rounded-lg hover:bg-slate-200 transition flex items-center gap-1">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- ── WHOLESALE REQUESTS TABLE ── -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[860px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 uppercase text-xs border-b border-slate-200">
                            <th class="px-5 py-3.5 font-bold w-20">ID</th>
                            <th class="px-5 py-3.5 font-bold w-36">Type</th>
                            <th class="px-5 py-3.5 font-bold">Customer</th>
                            <th class="px-5 py-3.5 font-bold">Phone</th>
                            <th class="px-5 py-3.5 font-bold">Product</th>
                            <th class="px-5 py-3.5 font-bold text-center w-20">Qty</th>
                            <th class="px-5 py-3.5 font-bold text-center w-28">Status</th>
                            <th class="px-5 py-3.5 font-bold w-36">Submitted</th>
                            <th class="px-5 py-3.5 font-bold text-center w-44">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                    <?php if ($result_wq && mysqli_num_rows($result_wq) > 0):
                        while ($wq = mysqli_fetch_assoc($result_wq)):
                            $status_cls = match($wq['request_status']) {
                                'Pending'   => 'bg-amber-100 text-amber-700 border-amber-200',
                                'Confirmed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                'Rejected'  => 'bg-red-100 text-red-700 border-red-200',
                                default     => 'bg-slate-100 text-slate-600 border-slate-200'
                            };
                            $status_dot = match($wq['request_status']) {
                                'Pending'   => 'bg-amber-400',
                                'Confirmed' => 'bg-emerald-500',
                                'Rejected'  => 'bg-red-500',
                                default     => 'bg-slate-400'
                            };
                            $notes_js   = addslashes(htmlspecialchars($wq['notes'] ?? ''));
                            $product_js = addslashes(htmlspecialchars($wq['product_name']));
                            $cust_js    = addslashes(htmlspecialchars($wq['customer_name']));
                            $phone_js   = addslashes(htmlspecialchars($wq['phone_number']));
                            $date_fmt   = date('d M Y, H:i', strtotime($wq['created_at']));
                            $updated_fmt = $wq['updated_at'] ? date('d M Y, H:i', strtotime($wq['updated_at'])) : $date_fmt;
                            $product_id_js = addslashes(htmlspecialchars($wq['product_id']));
                    ?>
                        <tr class="hover:bg-slate-50/70 transition" id="row-<?= $wq['id'] ?>">
                            <!-- ID -->
                            <td class="px-5 py-4">
                                <span class="font-mono text-xs text-slate-500 font-semibold">#WQ<?= str_pad($wq['id'], 4, '0', STR_PAD_LEFT) ?></span>
                            </td>
                            <!-- Type Badge -->
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100 text-[11px] font-bold px-2.5 py-1 rounded-full whitespace-nowrap">
                                    <i class="fas fa-handshake text-[10px]"></i> Wholesale
                                </span>
                            </td>
                            <!-- Customer -->
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-800 text-sm leading-tight"><?= htmlspecialchars($wq['customer_name']) ?></p>
                            </td>
                            <!-- Phone -->
                            <td class="px-5 py-4 text-sm text-slate-500"><?= htmlspecialchars($wq['phone_number']) ?></td>
                            <!-- Product -->
                            <td class="px-5 py-4">
                                <p class="text-sm text-slate-700 font-medium max-w-[180px] truncate" title="<?= htmlspecialchars($wq['product_name']) ?>">
                                    <?= htmlspecialchars($wq['product_name']) ?>
                                </p>
                                <p class="text-[11px] text-slate-400 font-mono mt-0.5"><?= htmlspecialchars($wq['product_id']) ?></p>
                            </td>
                            <!-- Qty -->
                            <td class="px-5 py-4 text-center">
                                <span class="font-bold text-slate-800 text-sm"><?= number_format($wq['requested_quantity']) ?></span>
                                <span class="text-slate-400 text-xs ml-0.5">units</span>
                            </td>
                            <!-- Status -->
                            <td class="px-5 py-4 text-center">
                                <span id="status-badge-<?= $wq['id'] ?>"
                                      class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full border <?= $status_cls ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $status_dot ?>"></span>
                                    <?= $wq['request_status'] ?>
                                </span>
                            </td>
                            <!-- Date -->
                            <td class="px-5 py-4">
                                <p class="text-xs text-slate-600 font-medium"><?= $date_fmt ?></p>
                            </td>
                            <!-- Actions -->
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-1.5" id="action-btns-<?= $wq['id'] ?>">
                                    <!-- View -->
                                    <button onclick="openWqDetail(<?= $wq['id'] ?>, '<?= $cust_js ?>', '<?= $phone_js ?>', '<?= $product_js ?>', '<?= $product_id_js ?>', <?= $wq['requested_quantity'] ?>, '<?= $notes_js ?>', '<?= $date_fmt ?>', '<?= $updated_fmt ?>', '<?= $wq['request_status'] ?>')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-semibold rounded-lg transition" title="View Detail">
                                        <i class="fas fa-eye"></i> View
                                    </button>

                                    <?php if ($wq['request_status'] === 'Pending'): ?>
                                    <!-- Confirm -->
                                    <button id="btn-confirm-<?= $wq['id'] ?>"
                                            onclick="handleWqAction(<?= $wq['id'] ?>, 'Confirmed')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-semibold rounded-lg transition" title="Confirm Request">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <!-- Reject -->
                                    <button id="btn-reject-<?= $wq['id'] ?>"
                                            onclick="handleWqAction(<?= $wq['id'] ?>, 'Rejected')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold rounded-lg transition" title="Reject Request">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php elseif ($wq['request_status'] === 'Confirmed'): ?>
                                    <span class="text-[11px] text-emerald-600 font-semibold"><i class="fas fa-check-circle mr-1"></i>Done</span>
                                    <?php else: ?>
                                    <span class="text-[11px] text-red-500 font-semibold"><i class="fas fa-ban mr-1"></i>Closed</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="9" class="py-20 text-center">
                                <div class="flex flex-col items-center gap-4 text-slate-400">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-file-signature text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-600">No wholesale requests found</p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            <?= $wq_status_filter ? "No {$wq_status_filter} requests match your criteria." : 'Wholesale quote requests from customers will appear here.' ?>
                                        </p>
                                    </div>
                                    <?php if ($wq_status_filter || $wq_search): ?>
                                    <a href="admin_orders.php?tab=wholesale" class="px-4 py-2 bg-slate-800 text-white text-xs font-semibold rounded-lg hover:bg-slate-700 transition">
                                        Clear Filters
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /bg-white table wrapper -->

    </div><!-- /tabWholesale -->

</div><!-- /flex-1 p-6 -->


<!-- ══════════════════════════════════════════ -->
<!--       ORDER DETAIL MODAL (Retail/WS)      -->
<!-- ══════════════════════════════════════════ -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh]">
        <div class="bg-[#1a2954] px-6 py-4 rounded-t-2xl flex items-center justify-between shrink-0">
            <div>
                <p id="modalTitle" class="text-white font-bold text-base"></p>
            </div>
            <button onclick="closeModal()" class="text-blue-300 hover:text-white text-2xl leading-none transition">&times;</button>
        </div>

        <div id="modalSummary" class="px-6 py-4 border-b border-slate-100 bg-slate-50 shrink-0 grid grid-cols-3 gap-4 text-sm hidden">
            <div><p class="text-xs text-slate-400 uppercase font-semibold">Sale Type</p><p id="ms-type" class="font-bold text-slate-800 mt-0.5"></p></div>
            <div><p class="text-xs text-slate-400 uppercase font-semibold">Discount</p><p id="ms-discount" class="font-bold text-emerald-600 mt-0.5"></p></div>
            <div><p class="text-xs text-slate-400 uppercase font-semibold">Debt</p><p id="ms-debt" class="font-bold text-red-600 mt-0.5"></p></div>
        </div>

        <div class="p-6 overflow-y-auto flex-1">
            <div id="loading" class="text-center text-slate-500 hidden py-8"><i class="fas fa-circle-notch fa-spin mr-2"></i>Loading...</div>
            <table id="detailTable" class="w-full text-left border-collapse hidden">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 uppercase text-xs border-b">
                        <th class="p-3 font-bold">Product</th>
                        <th class="p-3 font-bold text-center">Qty</th>
                        <th class="p-3 font-bold text-right">Unit Price</th>
                        <th class="p-3 font-bold text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="detailBody" class="divide-y divide-slate-100"></tbody>
                <tfoot>
                    <tr class="bg-slate-50 border-t-2 border-slate-200">
                        <td colspan="3" class="p-3 font-bold text-right text-slate-700">GRAND TOTAL:</td>
                        <td id="modalTotal" class="p-3 font-extrabold text-red-600 text-right text-base">0đ</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="p-4 bg-slate-50 rounded-b-2xl flex justify-end gap-3 border-t border-slate-100 shrink-0">
            <button onclick="reprintBill()" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-300 transition text-sm"><i class="fas fa-print mr-1"></i>Reprint</button>
            <button onclick="closeModal()" class="px-5 py-2 bg-amber-400 text-blue-900 rounded-lg font-bold hover:bg-amber-500 transition text-sm">Close</button>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════ -->
<!--    WHOLESALE REQUEST DETAIL MODAL         -->
<!-- ══════════════════════════════════════════ -->
<div id="wqDetailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg flex flex-col max-h-[90vh]">
        <!-- Header -->
        <div class="bg-[#1a2954] px-6 py-4 rounded-t-2xl flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-signature text-blue-900 text-sm"></i>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Wholesale Request</p>
                    <p id="wqd-id" class="text-blue-300 text-xs font-mono mt-0.5"></p>
                </div>
            </div>
            <button onclick="document.getElementById('wqDetailModal').classList.add('hidden')"
                    class="text-blue-300 hover:text-white text-2xl leading-none transition">&times;</button>
        </div>

        <!-- Status Banner -->
        <div id="wqd-status-banner" class="px-6 py-3 flex items-center gap-3 border-b shrink-0"></div>

        <!-- Body -->
        <div class="p-6 overflow-y-auto flex-1 space-y-5">

            <!-- Customer Info -->
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2.5">Customer Information</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide">Name</p>
                        <p id="wqd-customer" class="text-sm font-bold text-slate-800 mt-0.5 truncate"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide">Phone</p>
                        <p id="wqd-phone" class="text-sm font-bold text-slate-800 mt-0.5"></p>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2.5">Product Request</p>
                <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 flex items-start gap-3">
                    <div class="w-9 h-9 bg-[#1e3a8a] rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fas fa-cube text-white text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p id="wqd-product" class="text-sm font-bold text-slate-800 leading-snug"></p>
                        <p id="wqd-product-id" class="text-xs text-slate-400 font-mono mt-0.5"></p>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="text-xs text-slate-500">Requested Quantity:</span>
                            <span id="wqd-qty" class="text-sm font-extrabold text-[#1e3a8a]"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2.5">Additional Notes</p>
                <div id="wqd-notes" class="bg-slate-50 rounded-xl px-4 py-3 text-sm text-slate-600 min-h-[48px] whitespace-pre-wrap leading-relaxed"></div>
            </div>

            <!-- Timeline -->
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2.5">Timeline</p>
                <div class="flex flex-col gap-0">
                    <div class="flex items-start gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0"><i class="fas fa-paper-plane text-[11px]"></i></div>
                            <div class="w-px flex-1 bg-slate-200 my-1" style="min-height:20px"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-xs font-semibold text-slate-700">Request Submitted</p>
                            <p id="wqd-created" class="text-xs text-slate-400 mt-0.5"></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0" id="wqd-timeline-icon"></div>
                        <div>
                            <p class="text-xs font-semibold text-slate-700" id="wqd-timeline-label"></p>
                            <p id="wqd-updated" class="text-xs text-slate-400 mt-0.5"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="px-6 py-4 bg-slate-50 rounded-b-2xl border-t border-slate-100 flex items-center justify-between shrink-0">
            <button onclick="document.getElementById('wqDetailModal').classList.add('hidden')"
                    class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-300 transition text-sm">Close</button>
            <div id="wqd-actions" class="flex gap-2"></div>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════ -->
<!--       CONFIRM/REJECT DIALOG MODAL         -->
<!-- ══════════════════════════════════════════ -->
<div id="wqConfirmDialog" class="hidden fixed inset-0 bg-black bg-opacity-60 z-[60] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
        <div id="wqcd-icon" class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4"></div>
        <h3 id="wqcd-title" class="text-lg font-extrabold text-slate-800 mb-2"></h3>
        <p id="wqcd-desc" class="text-sm text-slate-500 mb-5 leading-relaxed"></p>
        <!-- Reject reason (shown only for reject) -->
        <div id="wqcd-reason-wrap" class="hidden mb-4 text-left">
            <label class="text-xs font-semibold text-slate-600 mb-1 block">Reject Reason <span class="text-slate-400 font-normal">(optional)</span></label>
            <textarea id="wqcd-reason" rows="2" placeholder="e.g. Out of stock, minimum order not met..."
                      class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 resize-none"></textarea>
        </div>
        <div class="flex gap-3 justify-center">
            <button onclick="document.getElementById('wqConfirmDialog').classList.add('hidden')"
                    class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-semibold hover:bg-slate-200 transition text-sm flex-1">Cancel</button>
            <button id="wqcd-confirm-btn"
                    class="px-5 py-2.5 rounded-xl font-bold transition text-sm flex-1 text-white"></button>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════ -->
<!--       TOAST NOTIFICATION                  -->
<!-- ══════════════════════════════════════════ -->
<div id="wqToast" class="hidden fixed bottom-6 right-6 z-[70] flex items-center gap-3 bg-white border border-slate-200 rounded-xl shadow-xl px-5 py-3.5 min-w-[280px] max-w-sm transition-all">
    <div id="wqToastIcon" class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-sm"></div>
    <div class="flex-1">
        <p id="wqToastMsg" class="text-sm font-semibold text-slate-800"></p>
    </div>
    <button onclick="hideToast()" class="text-slate-400 hover:text-slate-600 transition text-lg leading-none">&times;</button>
</div>


<script>
/* ═══════════════════════════════════════════════════════ */
/*                  ORDER HISTORY JS                       */
/* ═══════════════════════════════════════════════════════ */
const modal    = document.getElementById('detailModal');
const loading  = document.getElementById('loading');
const table    = document.getElementById('detailTable');
const tbody    = document.getElementById('detailBody');
const title    = document.getElementById('modalTitle');
const totalEl  = document.getElementById('modalTotal');
let currentPrintData = null;

function closeModal() { modal.classList.add('hidden'); }

modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

function viewDetails(orderId, customerName, orderDate, totalAmount, saleType, discountAmount, paidAmount, debtAmount) {
    modal.classList.remove('hidden');
    title.innerText = `Order Details  #${orderId}`;
    loading.classList.remove('hidden');
    table.classList.add('hidden');
    document.getElementById('modalSummary').classList.add('hidden');
    tbody.innerHTML = '';

    fetch(`ajax_get_order_details.php?id=${orderId}`)
        .then(r => r.json())
        .then(data => {
            loading.classList.add('hidden');
            if (data.status === 'success') {
                // Summary bar
                const summary = document.getElementById('modalSummary');
                summary.classList.remove('hidden');
                document.getElementById('ms-type').textContent     = saleType === 'wholesale' ? 'Wholesale' : 'Retail';
                document.getElementById('ms-discount').textContent  = parseInt(discountAmount||0).toLocaleString('en-US') + 'đ';
                document.getElementById('ms-debt').textContent      = parseInt(debtAmount||0).toLocaleString('en-US') + 'đ';

                table.classList.remove('hidden');
                let total = 0;
                currentPrintData = { orderId, customerName, orderDate, totalAmount, saleType, discountAmount, paidAmount, debtAmount, items: data.details };
                tbody.innerHTML = data.details.map(item => {
                    total += parseInt(item.subtotal);
                    return `<tr class="hover:bg-slate-50">
                        <td class="p-3 text-sm">${item.product_name}</td>
                        <td class="p-3 text-center font-medium text-sm">${item.quantity}</td>
                        <td class="p-3 text-right text-sm">${parseInt(item.price).toLocaleString('en-US')}đ</td>
                        <td class="p-3 text-right font-bold text-sm">${parseInt(item.subtotal).toLocaleString('en-US')}đ</td>
                    </tr>`;
                }).join('');
                totalEl.innerText = total.toLocaleString('en-US') + 'đ';
            } else {
                tbody.innerHTML = `<tr><td colspan="4" class="p-6 text-center text-red-500 text-sm">${data.message}</td></tr>`;
                table.classList.remove('hidden');
                currentPrintData = null;
            }
        })
        .catch(() => { loading.classList.add('hidden'); alert('Error loading order data.'); });
}

function reprintBill() {
    if (!currentPrintData) { alert('No data to print!'); return; }
    let totalGoods = parseInt(currentPrintData.totalAmount) + parseInt(currentPrintData.discountAmount || 0);
    let billHtml = `
        <style type="text/css" media="print">@page { margin: 0; } body { margin: 0; } #print_section * { color: #000 !important; }</style>
        <div id="print_section" style="width:80mm;padding:10px;font-family:Arial,Helvetica,sans-serif;background:#fff;color:#000;">
            <div style="text-align:center;font-weight:bold;font-size:16px;margin-bottom:5px;">LAM EXPORT - HTM TM&DV Quy Nhơn Xanh</div>
            <div style="text-align:center;font-size:13px;margin-bottom:10px;">Add: 02 Tran Thi Ki, Quy Nhon Nam Ward, Gia Lai<br>TEL: 0935.241.158</div>
            <div style="font-size:13px;text-align:center;border-bottom:1px dashed #000;padding-bottom:5px;margin-bottom:5px;">Invoice: #${currentPrintData.orderId} - ${currentPrintData.orderDate}</div>
            <div style="font-size:13px;margin-bottom:10px;font-weight:bold;">Customer: ${currentPrintData.customerName}</div>
            <table style="width:100%;font-size:13px;border-collapse:collapse;">
                <thead><tr style="border-bottom:1px dashed #000;"><th style="text-align:left;padding:4px 0;">Product</th><th style="text-align:right;padding:4px 12px 4px 0;width:40px;">Qty</th><th style="text-align:right;padding:4px 0;">Subtotal</th></tr></thead>
                <tbody>${currentPrintData.items.map(i => `<tr><td style="padding:4px 0;">${i.product_name}</td><td style="text-align:right;padding:4px 12px 4px 0;">${i.quantity}</td><td style="text-align:right;padding:4px 0;font-weight:bold;">${parseInt(i.subtotal).toLocaleString('en-US')}</td></tr>`).join('')}</tbody>
            </table>
            <div style="border-top:1px dashed #000;margin-top:10px;padding-top:5px;text-align:right;font-size:14px;font-weight:bold;">SUBTOTAL: ${totalGoods.toLocaleString('en-US')}đ</div>
            ${currentPrintData.saleType==='wholesale' ? `<div style="text-align:right;font-size:13px;margin-top:5px;">Discount: -${parseInt(currentPrintData.discountAmount||0).toLocaleString('en-US')}đ</div><div style="text-align:right;font-size:15px;font-weight:bold;margin-top:5px;border-top:1px solid #000;padding-top:5px;">GRAND TOTAL: ${parseInt(currentPrintData.totalAmount).toLocaleString('en-US')}đ</div><div style="text-align:right;font-size:13px;margin-top:5px;">Paid: ${parseInt(currentPrintData.paidAmount||0).toLocaleString('en-US')}đ</div><div style="text-align:right;font-size:14px;font-weight:bold;margin-top:5px;">Debt: ${parseInt(currentPrintData.debtAmount||0).toLocaleString('en-US')}đ</div>` : `<div style="text-align:right;font-size:15px;font-weight:bold;margin-top:5px;border-top:1px solid #000;padding-top:5px;">GRAND TOTAL: ${parseInt(currentPrintData.totalAmount).toLocaleString('en-US')}đ</div>`}
            <div style="text-align:center;font-size:12px;margin-top:15px;font-style:italic;">Thank you. See you again!</div>
            <div style="text-align:center;font-size:13px;margin-top:8px;font-weight:bold;border-top:1px solid #000;padding-top:5px;">*** REPRINT ***</div>
        </div>`;
    let old = document.getElementById('print_section');
    if (old) old.remove();
    document.body.insertAdjacentHTML('beforeend', billHtml);
    window.print();
    alert('Printed invoice #' + currentPrintData.orderId + ' successfully');
    location.reload();
}

function cancelOrder(orderId) {
    if (!confirm('Cancel invoice #' + orderId + '?\nStock levels and customer debt will be adjusted automatically.')) return;
    const formData = new URLSearchParams();
    formData.append('order_id', orderId);
    fetch('ajax_cancel_order.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: formData })
        .then(r => r.json())
        .then(data => {
            if (data.success) { alert('Order cancelled successfully!'); location.reload(); }
            else alert('Error: ' + data.message);
        })
        .catch(() => alert('A system error occurred. Please try again.'));
}


/* ═══════════════════════════════════════════════════════ */
/*              WHOLESALE REQUESTS JS                      */
/* ═══════════════════════════════════════════════════════ */

// ── Toast ──
function showToast(msg, type = 'success') {
    const toast    = document.getElementById('wqToast');
    const msgEl    = document.getElementById('wqToastMsg');
    const iconEl   = document.getElementById('wqToastIcon');
    msgEl.textContent = msg;
    if (type === 'success') {
        iconEl.className = 'w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-sm bg-emerald-100 text-emerald-600';
        iconEl.innerHTML = '<i class="fas fa-check"></i>';
    } else {
        iconEl.className = 'w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-sm bg-red-100 text-red-600';
        iconEl.innerHTML = '<i class="fas fa-times"></i>';
    }
    toast.classList.remove('hidden');
    setTimeout(hideToast, 4000);
}
function hideToast() { document.getElementById('wqToast').classList.add('hidden'); }

// ── Open Detail Modal ──
function openWqDetail(id, customer, phone, product, productId, qty, notes, created, updated, status) {
    document.getElementById('wqd-id').textContent        = '#WQ' + String(id).padStart(4, '0');
    document.getElementById('wqd-customer').textContent  = customer;
    document.getElementById('wqd-phone').textContent     = phone;
    document.getElementById('wqd-product').textContent   = product;
    document.getElementById('wqd-product-id').textContent = productId;
    document.getElementById('wqd-qty').textContent       = parseInt(qty).toLocaleString() + ' units';
    document.getElementById('wqd-notes').textContent     = notes || 'No additional notes.';
    document.getElementById('wqd-created').textContent   = created;
    document.getElementById('wqd-updated').textContent   = updated;

    // Status banner
    const bannerEl = document.getElementById('wqd-status-banner');
    const bannerMap = {
        'Pending':   { bg: 'bg-amber-50 border-amber-200',   dot: 'bg-amber-400', text: 'text-amber-800', label: 'Pending Review' },
        'Confirmed': { bg: 'bg-emerald-50 border-emerald-200', dot: 'bg-emerald-500', text: 'text-emerald-800', label: 'Confirmed' },
        'Rejected':  { bg: 'bg-red-50 border-red-200',       dot: 'bg-red-500',    text: 'text-red-800',    label: 'Rejected' },
    };
    const bm = bannerMap[status] || { bg: 'bg-slate-50', dot: 'bg-slate-400', text: 'text-slate-700', label: status };
    bannerEl.className = `px-6 py-3 flex items-center gap-3 border-b ${bm.bg} shrink-0`;
    bannerEl.innerHTML = `<span class="w-2 h-2 rounded-full ${bm.dot}"></span><span class="text-sm font-semibold ${bm.text}">Status: ${bm.label}</span>`;

    // Timeline tail
    const timelineIcon = document.getElementById('wqd-timeline-icon');
    const timelineLabel = document.getElementById('wqd-timeline-label');
    if (status === 'Pending') {
        timelineIcon.className = 'w-7 h-7 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0';
        timelineIcon.innerHTML = '<i class="fas fa-hourglass-half text-[11px]"></i>';
        timelineLabel.textContent = 'Awaiting Admin Review';
    } else if (status === 'Confirmed') {
        timelineIcon.className = 'w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0';
        timelineIcon.innerHTML = '<i class="fas fa-check text-[11px]"></i>';
        timelineLabel.textContent = 'Confirmed by Admin';
    } else {
        timelineIcon.className = 'w-7 h-7 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0';
        timelineIcon.innerHTML = '<i class="fas fa-times text-[11px]"></i>';
        timelineLabel.textContent = 'Rejected by Admin';
    }

    // Actions
    const actionsEl = document.getElementById('wqd-actions');
    if (status === 'Pending') {
        actionsEl.innerHTML = `
            <button onclick="handleWqAction(${id}, 'Confirmed'); document.getElementById('wqDetailModal').classList.add('hidden');"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition text-sm">
                <i class="fas fa-check"></i> Confirm
            </button>
            <button onclick="handleWqAction(${id}, 'Rejected'); document.getElementById('wqDetailModal').classList.add('hidden');"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition text-sm">
                <i class="fas fa-times"></i> Reject
            </button>`;
    } else {
        actionsEl.innerHTML = '';
    }

    document.getElementById('wqDetailModal').classList.remove('hidden');
}

document.getElementById('wqDetailModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
});
document.getElementById('wqConfirmDialog').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
});

// ── Handle Action (shows confirmation dialog) ──
let _pendingAction = null;

function handleWqAction(id, action) {
    _pendingAction = { id, action };

    const dialog   = document.getElementById('wqConfirmDialog');
    const iconEl   = document.getElementById('wqcd-icon');
    const titleEl  = document.getElementById('wqcd-title');
    const descEl   = document.getElementById('wqcd-desc');
    const reasonWrap = document.getElementById('wqcd-reason-wrap');
    const confirmBtn = document.getElementById('wqcd-confirm-btn');

    if (action === 'Confirmed') {
        iconEl.className   = 'w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 bg-emerald-100 text-emerald-600 text-xl';
        iconEl.innerHTML   = '<i class="fas fa-check-circle"></i>';
        titleEl.textContent = 'Confirm Wholesale Request';
        descEl.textContent  = 'Are you sure you want to confirm this wholesale request? The customer will be notified.';
        confirmBtn.textContent = 'Confirm Request';
        confirmBtn.className   = 'px-5 py-2.5 rounded-xl font-bold transition text-sm flex-1 text-white bg-emerald-600 hover:bg-emerald-700';
        reasonWrap.classList.add('hidden');
        document.getElementById('wqcd-reason').value = '';
    } else {
        iconEl.className   = 'w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 bg-red-100 text-red-600 text-xl';
        iconEl.innerHTML   = '<i class="fas fa-times-circle"></i>';
        titleEl.textContent = 'Reject Wholesale Request';
        descEl.textContent  = 'Are you sure you want to reject this wholesale request? This action cannot be undone.';
        confirmBtn.textContent = 'Reject Request';
        confirmBtn.className   = 'px-5 py-2.5 rounded-xl font-bold transition text-sm flex-1 text-white bg-red-600 hover:bg-red-700';
        reasonWrap.classList.remove('hidden');
    }

    confirmBtn.onclick = executeWqAction;
    dialog.classList.remove('hidden');
}

function executeWqAction() {
    if (!_pendingAction) return;
    const { id, action } = _pendingAction;
    _pendingAction = null;

    document.getElementById('wqConfirmDialog').classList.add('hidden');

    const formData = new FormData();
    formData.append('id', id);
    formData.append('action', action);

    // Optimistic UI update
    const badgeEl = document.getElementById('status-badge-' + id);
    const btnC    = document.getElementById('btn-confirm-' + id);
    const btnR    = document.getElementById('btn-reject-' + id);

    const colorMap = {
        'Confirmed': 'inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full border bg-emerald-100 text-emerald-700 border-emerald-200',
        'Rejected':  'inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full border bg-red-100 text-red-700 border-red-200',
    };
    const dotMap = { 'Confirmed': 'bg-emerald-500', 'Rejected': 'bg-red-500' };

    if (badgeEl) {
        badgeEl.className = colorMap[action] || '';
        badgeEl.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${dotMap[action]}"></span>${action}`;
    }
    if (btnC) btnC.remove();
    if (btnR) btnR.remove();

    // Replace action area with static label
    const actionDiv = document.getElementById('action-btns-' + id);
    if (actionDiv) {
        const viewBtn = actionDiv.querySelector('button'); // keep View
        if (viewBtn) {
            const viewClone = viewBtn.cloneNode(true);
            actionDiv.innerHTML = '';
            actionDiv.appendChild(viewClone);
            if (action === 'Confirmed') {
                actionDiv.insertAdjacentHTML('beforeend', '<span class="text-[11px] text-emerald-600 font-semibold"><i class="fas fa-check-circle mr-1"></i>Done</span>');
            } else {
                actionDiv.insertAdjacentHTML('beforeend', '<span class="text-[11px] text-red-500 font-semibold"><i class="fas fa-ban mr-1"></i>Closed</span>');
            }
        }
    }

    fetch('ajax_confirm_wholesale_request.php', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast(data.message || `Request ${action} successfully.`, 'success');
            } else {
                showToast('Error: ' + (data.message || 'Unknown error'), 'error');
                // Revert on error
                location.reload();
            }
        })
        .catch(() => {
            showToast('Network error. Please try again.', 'error');
            location.reload();
        });
}
</script>

</body>
</html>