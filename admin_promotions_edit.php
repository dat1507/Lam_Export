<?php
require_once 'config/database.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['id'])) {
    die("Promotion ID not found!");
}

$id = (int)$_GET['id'];
$stmt = $db->prepare("SELECT * FROM promotions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$promo = $stmt->get_result()->fetch_assoc();

if (!$promo) {
    die("This promotion program was not found!");
}
?>

<div class="max-w-4xl mx-auto px-4 py-8 h-full">
    <div class="flex items-center gap-4 mb-6">
        <a href="admin_promotions.php" class="text-gray-500 hover:text-blue-600 font-bold text-xl">⬅ Back</a>
        <h1 class="text-2xl font-bold text-[#1a2954]">✏️ Edit Campaign: <?= htmlspecialchars($promo['promo_name']) ?></h1>
    </div>

    <div id="alertMsg" class="hidden mb-4"></div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="p-6 md:p-8">
            <form id="editPromoForm">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Campaign Name</label>
                        <input type="text" name="promo_name" value="<?= htmlspecialchars($promo['promo_name']) ?>" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Voucher Code</label>
                        <input type="text" name="promo_code" value="<?= htmlspecialchars($promo['promo_code']) ?>" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm uppercase">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Discount Type</label>
                    <select id="promoTypeSelect" name="promo_type" required onchange="togglePromoFields()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm bg-white">
                        <option value="discount_amount" <?= $promo['promo_type'] === 'discount_amount' ? 'selected' : '' ?>>Discount Amount</option>
                        <option value="discount_percent" <?= $promo['promo_type'] === 'discount_percent' ? 'selected' : '' ?>>Discount Percentage (%)</option>
                        <option value="buy_x_get_y" <?= $promo['promo_type'] === 'buy_x_get_y' ? 'selected' : '' ?>>Buy X Get Y</option>
                    </select>
                </div>

                <div id="discountValueField" class="mb-6 <?= in_array($promo['promo_type'], ['discount_amount','discount_percent']) ? '' : 'hidden' ?>">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Discount Value</label>
                    <input type="number" name="discount_val" value="<?= $promo['discount_val'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div id="buyXgetYFields" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 <?= $promo['promo_type'] === 'buy_x_get_y' ? '' : 'hidden' ?>">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Buy Quantity</label>
                        <input type="number" name="buy_qty" value="<?= $promo['buy_qty'] ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Get Quantity</label>
                        <input type="number" name="get_qty" value="<?= $promo['get_qty'] ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Start Date</label>
                        <input type="datetime-local" name="start_date"
                            value="<?= !empty($promo['start_date']) ? date('Y-m-d\TH:i', strtotime($promo['start_date'])) : '' ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm text-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">End Date</label>
                        <input type="datetime-local" name="end_date"
                            value="<?= !empty($promo['end_date']) ? date('Y-m-d\TH:i', strtotime($promo['end_date'])) : '' ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm text-gray-600">
                    </div>
                </div>

                <div class="mb-8 flex items-center">
                    <label for="isActive" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="isActive" name="is_active" class="sr-only"
                                value="1" <?= $promo['is_active'] ? 'checked' : '' ?>>
                            <div class="block bg-gray-300 w-10 h-6 rounded-full transition toggle-bg"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                        </div>
                        <div class="ml-3 text-sm font-bold text-gray-700">Active</div>
                    </label>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="admin_promotions.php"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2.5 px-6 rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow transition flex items-center gap-2">
                        <span>💾</span> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input:checked ~ .dot { transform: translateX(100%); }
    input:checked ~ .toggle-bg { background-color: #16a34a; }
</style>

<script>
    function togglePromoFields() {
        const type = document.getElementById('promoTypeSelect').value;
        const discountField = document.getElementById('discountValueField');
        const buyGetFields = document.getElementById('buyXgetYFields');

        discountField.classList.add('hidden');
        buyGetFields.classList.add('hidden');

        if (type === 'discount_amount' || type === 'discount_percent') {
            discountField.classList.remove('hidden');
        } else if (type === 'buy_x_get_y') {
            buyGetFields.classList.remove('hidden');
        }
    }

    document.getElementById('editPromoForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'Saving...';
        submitBtn.disabled = true;

        let formData = new FormData(this);

        fetch('ajax_update_promotion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const alertEl = document.getElementById('alertMsg');
            if (data.status === 'success') {
                alertEl.className = 'mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded font-bold';
                alertEl.innerHTML = '✅ ' + data.message;
                alertEl.classList.remove('hidden');
                setTimeout(() => { window.location.href = 'admin_promotions.php'; }, 1200);
            } else {
                alertEl.className = 'mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded font-bold';
                alertEl.innerHTML = '❌ Error: ' + data.message;
                alertEl.classList.remove('hidden');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Network or server error!');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
</script>
