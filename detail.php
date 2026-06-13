<?php 
$active_page = 'products'; 
include 'header.php'; 
require_once 'config/database.php';
require_once 'connect.php';
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
$row = [];

if ($id !== '') {
    $safe_id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM products WHERE id = '$safe_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
}

if (empty($row)) {
    echo "<div class='min-h-[60vh] flex flex-col items-center justify-center bg-slate-50 px-4'>
            <div class='text-center'>
                <div class='text-6xl mb-6'>📭</div>
                <h2 class='text-2xl font-bold text-gray-700 mb-3'>Product Not Found</h2>
                <p class='text-gray-500 mb-8'>The product you are looking for does not exist or has been removed.</p>
                <a href='products.php' class='inline-flex items-center gap-2 bg-[#1e3a8a] hover:bg-blue-700 transition text-white font-bold px-8 py-3 rounded-xl shadow-md'>
                    <svg class=\"w-4 h-4\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\"/></svg>
                    Back to Products
                </a>
            </div>
          </div>";
    include 'footer.php';
    exit;
}

// Helper: quantity label
function quantity_label($qty) {
    if ($qty === 'Liên hệ' || $qty === '' || $qty === null) return 'Contact for availability';
    if (is_numeric($qty)) {
        if ((int)$qty <= 0) return 'Out of Stock';
        if ((int)$qty < 10) return $qty . ' units (Low Stock)';
        return $qty . ' units';
    }
    return htmlspecialchars($qty);
}
?>

<script>
    function changeMainImage(element, newSrc) {
        document.getElementById('main-product-image').src = newSrc;
        document.querySelectorAll('.thumb-item').forEach(thumb => {
            thumb.classList.remove('ring-2', 'ring-amber-400');
        });
        element.classList.add('ring-2', 'ring-amber-400');
    }
</script>

<div class="bg-slate-50 min-h-screen">

    <!-- Page Banner -->
    <div class="bg-gradient-to-r from-[#1e3a8a] to-[#1d4ed8] text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <nav class="text-blue-300 text-sm mb-3 flex items-center gap-2">
                <a href="index.php" class="hover:text-white transition">Home</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="products.php" class="hover:text-white transition">Products</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium truncate max-w-xs"><?php echo htmlspecialchars($row['product_name']); ?></span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 pb-24">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex flex-col lg:flex-row">

                <!-- LEFT: Images -->
                <div class="w-full lg:w-5/12 p-6 md:p-10 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col items-center relative bg-white">

                    <!-- Badges -->
                    <div class="absolute top-6 left-6 flex flex-wrap gap-2 z-10">
                        <?php if (!empty($row['certifications'])): ?>
                            <span class="bg-amber-400 text-blue-900 text-xs font-bold px-3 py-1 rounded-full uppercase shadow-sm">
                                <?php echo htmlspecialchars($row['certifications']); ?>
                            </span>
                        <?php endif; ?>
                        <?php if (isset($row['is_trending']) && $row['is_trending'] == 1): ?>
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow-sm animate-floating">
                                🔥 Trending
                            </span>
                        <?php endif; ?>
                        <?php if (isset($row['is_sale']) && $row['is_sale'] == 1): ?>
                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow-sm">
                                SALE
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Main image -->
                    <div class="w-full aspect-square rounded-xl overflow-hidden mb-4 border border-gray-100 shadow-sm group">
                        <img id="main-product-image"
                             src="<?php echo htmlspecialchars($row['image_url']); ?>"
                             alt="<?php echo htmlspecialchars($row['product_name']); ?>"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-3 w-full">
                        <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent cursor-pointer thumb-item ring-2 ring-amber-400 transition-all hover:opacity-80"
                             onclick="changeMainImage(this, '<?php echo htmlspecialchars($row['image_url']); ?>')">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="w-full h-full object-cover"
                                 onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                        </div>
                        <?php foreach (['image_url_2','image_url_3','image_url_4'] as $imgField): ?>
                            <?php if (!empty($row[$imgField])): ?>
                            <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent cursor-pointer thumb-item hover:ring-2 hover:ring-amber-400 transition-all"
                                 onclick="changeMainImage(this, '<?php echo htmlspecialchars($row[$imgField]); ?>')">
                                <img src="<?php echo htmlspecialchars($row[$imgField]); ?>" class="w-full h-full object-cover hover:opacity-80 transition"
                                     onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- RIGHT: Product Info -->
                <div class="w-full lg:w-7/12 p-6 md:p-10 flex flex-col">

                    <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-2">
                        <?php echo htmlspecialchars($row['category'] ?? 'Uncategorized'); ?>
                    </p>

                    <h1 class="text-2xl md:text-3xl font-bold text-[#1e3a8a] mb-4 leading-tight">
                        <?php echo htmlspecialchars($row['product_name']); ?>
                    </h1>

                    <!-- Stock Status -->
                    <div class="flex items-center gap-2 mb-5">
                        <?php
                        $qty = $row['quantity'] ?? 0;
                        $isContact = ($qty === 'Liên hệ' || $qty === '');
                        $isLow = is_numeric($qty) && (int)$qty > 0 && (int)$qty < 10;
                        $isOut = is_numeric($qty) && (int)$qty <= 0;
                        $dotColor = $isOut ? 'bg-red-500' : ($isLow ? 'bg-orange-400' : 'bg-emerald-500');
                        ?>
                        <span class="inline-block w-2 h-2 rounded-full <?= $dotColor ?>"></span>
                        <span class="text-sm text-gray-500">Availability: <strong class="text-gray-700"><?= quantity_label($qty) ?></strong></span>
                    </div>

                    <!-- Price Box -->
                    <div class="bg-slate-50 border border-gray-100 rounded-xl p-5 mb-6">
                        <?php if (isset($row['is_sale']) && $row['is_sale'] == 1 && isset($row['sale_price']) && $row['sale_price'] > 0): ?>
                            <div class="flex items-end gap-3 flex-wrap">
                                <span class="text-3xl md:text-4xl font-bold text-red-600">
                                    <?php echo number_format($row['sale_price'], 0, ',', '.'); ?>đ
                                </span>
                                <span class="text-lg text-gray-400 line-through pb-1">
                                    <?php echo number_format($row['price'], 0, ',', '.'); ?>đ
                                </span>
                                <span class="text-gray-500 pb-1">/ <?php echo htmlspecialchars($row['unit']); ?></span>
                                <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-md pb-1">
                                    Save <?= round((1 - $row['sale_price']/$row['price'])*100) ?>%
                                </span>
                            </div>
                        <?php else: ?>
                            <div class="flex items-end gap-2 flex-wrap">
                                <span class="text-3xl md:text-4xl font-bold text-[#1e3a8a]">
                                    <?php echo number_format($row['price'], 0, ',', '.'); ?>đ
                                </span>
                                <span class="text-gray-500 pb-1">/ <?php echo htmlspecialchars($row['unit']); ?></span>
                            </div>
                        <?php endif; ?>
                        <p class="text-xs text-gray-400 mt-2">* Wholesale pricing available upon request</p>
                    </div>

                    <!-- Description -->
                    <?php if (!empty($row['des1']) || !empty($row['des2'])): ?>
                    <div class="space-y-3 mb-8 text-gray-600 text-sm leading-relaxed">
                        <!-- Render rich text HTML from TinyMCE editor -->
                    <?php
                    // Safety: strip dangerous tags while allowing safe HTML (images, formatting)
                    function safe_html($content) {
                        if (empty($content)) return '';
                        // Remove <script>, <style>, event handlers
                        $content = preg_replace('/<script\b[^>]*>[\s\S]*?<\/script>/i', '', $content);
                        $content = preg_replace('/<style\b[^>]*>[\s\S]*?<\/style>/i', '', $content);
                        $content = preg_replace('/\bon\w+\s*=\s*(["\']).*?\1/i', '', $content);
                        $content = preg_replace('/\bon\w+\s*=[^>]*/i', '', $content);
                        return $content;
                    }
                    ?>
                    <?php if (!empty($row['des1'])): ?>
                        <div class="prose-content flex gap-2">
                            <span class="text-amber-400 mt-0.5 shrink-0">✦</span>
                            <div class="text-sm text-gray-600 leading-relaxed"><?= safe_html($row['des1']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($row['des2'])): ?>
                        <div class="prose-content flex gap-2">
                            <span class="text-amber-400 mt-0.5 shrink-0">✦</span>
                            <div class="text-sm text-gray-600 leading-relaxed"><?= safe_html($row['des2']) ?></div>
                        </div>
                    <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-auto">
                        <button onclick="openWholesaleModal()" class="flex-1 inline-flex items-center justify-center gap-2 bg-[#1e3a8a] hover:bg-blue-800 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Request Wholesale Quote
                        </button>
                        <a href="products.php" class="inline-flex items-center justify-center gap-2 border border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-700 font-semibold py-3.5 px-6 rounded-xl transition-all bg-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes floating {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-floating { animation: floating 2.5s ease-in-out infinite; }
</style>

<!-- ══ WHOLESALE QUOTE REQUEST MODAL ══ -->
<div id="wholesaleModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.55);">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col" style="animation:fadeUpModal 0.25s ease;">

        <!-- Modal Header -->
        <div class="bg-[#1e3a8a] px-6 py-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Request Wholesale Quote</p>
                    <p class="text-blue-300 text-xs">Our team will contact you within 24 hours</p>
                </div>
            </div>
            <button onclick="closeWholesaleModal()" class="text-blue-300 hover:text-white transition text-2xl leading-none">&times;</button>
        </div>

        <!-- Success State (hidden by default) -->
        <div id="wqSuccess" class="hidden flex-col items-center justify-center px-8 py-12 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Request Submitted!</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Your wholesale request has been submitted successfully.<br>Our sales team will contact you shortly.</p>
            <button onclick="closeWholesaleModal()" class="mt-6 px-6 py-2.5 bg-[#1e3a8a] text-white font-semibold rounded-xl hover:bg-blue-800 transition">Close</button>
        </div>

        <!-- Form State -->
        <form id="wqForm" class="flex flex-col" onsubmit="submitWholesaleRequest(event)">
            <div class="px-6 py-5 space-y-4 overflow-y-auto flex-1">

                <!-- Product Info (readonly) -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#1e3a8a] rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Product</p>
                        <p id="wqProductDisplay" class="text-sm font-bold text-gray-800 truncate"><?= htmlspecialchars($row['product_name']) ?></p>
                    </div>
                    <input type="hidden" id="wqProductId"   name="product_id"   value="<?= $row['id'] ?>">
                    <input type="hidden" id="wqProductName" name="product_name" value="<?= htmlspecialchars($row['product_name']) ?>">
                </div>

                <!-- Customer Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Customer Name <span class="text-red-500">*</span></label>
                    <input type="text" id="wqCustomerName" name="customer_name"
                           placeholder="e.g. John Smith"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white">
                    <p id="errCustomerName" class="text-red-500 text-xs mt-1 hidden">Customer name is required.</p>
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" id="wqPhone" name="phone_number"
                           placeholder="e.g. +49 123 456789"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white">
                    <p id="errPhone" class="text-red-500 text-xs mt-1 hidden">Phone number is required.</p>
                </div>

                <!-- Requested Quantity -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Requested Quantity <span class="text-red-500">*</span></label>
                    <input type="number" id="wqQty" name="requested_quantity"
                           placeholder="e.g. 500" min="1"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white">
                    <p id="errQty" class="text-red-500 text-xs mt-1 hidden">Quantity must be at least 1.</p>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Additional Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea id="wqNotes" name="notes" rows="3"
                              placeholder="e.g. We are interested in importing this product to Germany."
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white resize-none"></textarea>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex gap-3 justify-end shrink-0">
                <button type="button" onclick="closeWholesaleModal()"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-100 transition bg-white">
                    Cancel
                </button>
                <button type="submit" id="wqSubmitBtn"
                        class="px-6 py-2.5 text-sm font-bold bg-[#1e3a8a] hover:bg-blue-800 text-white rounded-xl transition flex items-center gap-2 shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Request Wholesale Quote
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fadeUpModal {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function openWholesaleModal() {
    document.getElementById('wholesaleModal').classList.remove('hidden');
    document.getElementById('wqSuccess').classList.add('hidden');
    document.getElementById('wqForm').classList.remove('hidden');
    document.getElementById('wqForm').style.display = '';
    document.getElementById('wqCustomerName').focus();
    // clear errors & fields
    ['wqCustomerName','wqPhone','wqQty','wqNotes'].forEach(id => document.getElementById(id).value = '');
    ['errCustomerName','errPhone','errQty'].forEach(id => document.getElementById(id).classList.add('hidden'));
}

function closeWholesaleModal() {
    document.getElementById('wholesaleModal').classList.add('hidden');
}

// Close on backdrop click
document.getElementById('wholesaleModal').addEventListener('click', function(e) {
    if (e.target === this) closeWholesaleModal();
});

function submitWholesaleRequest(e) {
    e.preventDefault();
    let valid = true;

    const name  = document.getElementById('wqCustomerName').value.trim();
    const phone = document.getElementById('wqPhone').value.trim();
    const qty   = parseInt(document.getElementById('wqQty').value);

    document.getElementById('errCustomerName').classList.toggle('hidden', name !== '');
    document.getElementById('errPhone').classList.toggle('hidden', phone !== '');
    document.getElementById('errQty').classList.toggle('hidden', qty > 0);

    if (!name)       valid = false;
    if (!phone)      valid = false;
    if (!(qty > 0))  valid = false;
    if (!valid) return;

    const btn = document.getElementById('wqSubmitBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Submitting...';

    const formData = new FormData(document.getElementById('wqForm'));

    fetch('ajax_save_wholesale_request.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg> Request Wholesale Quote';
        if (data.success) {
            document.getElementById('wqForm').style.display = 'none';
            const s = document.getElementById('wqSuccess');
            s.classList.remove('hidden');
            s.style.display = 'flex';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(() => {
        btn.disabled = false;
        alert('Network error. Please try again.');
    });
}
</script>

<?php include 'footer.php'; ?>