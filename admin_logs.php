<?php
require_once 'config/database.php';
require_once 'admin_header.php'; 

$database = new Database();
$db = $database->getConnection();

// 1. Nhận các giá trị từ thanh công cụ (nếu có)
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$action_filter = isset($_GET['action']) ? $_GET['action'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// 2. Lấy danh sách Hành động để đưa vào ô Select
$sql_get_actions = "SELECT DISTINCT action FROM activity_logs WHERE action IS NOT NULL AND action != '' ORDER BY action ASC";
$stmt_actions = $db->query($sql_get_actions);
$actions_list = $stmt_actions->fetch_all(MYSQLI_ASSOC);

$sql_logs = "SELECT * FROM activity_logs WHERE 1=1 ";

if ($search !== '') {
    $safe_search = $db->real_escape_string($search);
    $sql_logs .= " AND details LIKE '%$safe_search%' ";
}

// Lọc theo Hành động
if ($action_filter !== '') {
    $safe_action = $db->real_escape_string($action_filter);
    $sql_logs .= " AND action = '$safe_action' ";
}

// Lọc theo Từ ngày
if ($start_date !== '') {
    $safe_start = $db->real_escape_string($start_date);
    $sql_logs .= " AND DATE(created_at) >= '$safe_start' ";
}

// Lọc theo Đến ngày
if ($end_date !== '') {
    $safe_end = $db->real_escape_string($end_date);
    $sql_logs .= " AND DATE(created_at) <= '$safe_end' ";
}

$sql_logs .= " ORDER BY created_at DESC LIMIT 500";

$stmt_logs = $db->query($sql_logs);
$logs = $stmt_logs->fetch_all(MYSQLI_ASSOC);
?>

<div class="max-w-7xl mx-auto px-4 py-8 flex-1 h-screen overflow-y-auto">
    <div class="flex items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold text-[#1a2954]">🕵️ Activity Log</h1>
    </div>

    <form method="GET" action="" class="bg-white border border-gray-200 p-4 rounded-lg mb-6 flex flex-wrap gap-4 items-end shadow-sm">
    
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-bold text-gray-700 mb-1">🔍 Search Product ID, Supplier name...</label>
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Enter keyword and press Enter..." class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div class="w-[220px]">
            <label class="block text-sm font-bold text-gray-700 mb-1">⚡ Action</label>
            <select name="action" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none bg-white cursor-pointer">
                <option value="">-- All Actions --</option>
                <?php 
                if (!empty($actions_list)) {
                    foreach ($actions_list as $act) {
                        $selected = ($action_filter === $act['action']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($act['action']) . "' $selected>" . htmlspecialchars($act['action']) . "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">📅 From Date</label>
            <input type="date" name="start_date" value="<?= htmlspecialchars($start_date) ?>" onchange="this.form.submit()" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">📅 To Date</label>
            <input type="date" name="end_date" value="<?= htmlspecialchars($end_date) ?>" onchange="this.form.submit()" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                Filter
            </button>
            
            <button type="button" onclick="window.location.href='admin_logs.php'" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-bold hover:bg-gray-300 transition flex items-center justify-center">
                Reset
            </button>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-md border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-bold border-b">
                    <th class="p-4 w-48">Timestamp</th>
                    <th class="p-4 w-32">Account</th>
                    <th class="p-4 w-48">Action</th>
                    <th class="p-4">Details</th>
                    <th class="p-4 w-32">IP</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                <?php if (count($logs) > 0): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-500">
                                <?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?>
                            </td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-800 font-bold px-2 py-1 rounded">
                                    <?= htmlspecialchars($log['username']) ?>
                                </span>
                            </td>
                            <td class="p-4 font-semibold text-gray-800">
                                <?= htmlspecialchars($log['action']) ?>
                            </td>
                            <td class="p-4 text-gray-600">
                                <?= htmlspecialchars($log['details']) ?>
                            </td>
                            <td class="p-4 text-gray-400 text-xs">
                                <?= htmlspecialchars($log['ip_address']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">No activities match the filter criteria.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>