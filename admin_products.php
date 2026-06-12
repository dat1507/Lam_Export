<?php
require_once 'config/database.php';
require_once 'models/Product.php';
require_once 'connect.php';
require_once 'admin_header.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->getAllProducts();
$total = $stmt->num_rows;
?>

<div class="p-6 max-w-full">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Products</h1>
            <p class="text-sm text-slate-500 mt-0.5"><?= $total ?> product<?= $total != 1 ? 's' : '' ?> in catalog</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <input type="text" id="searchProduct" placeholder="Search by name, ID, price..."
                    class="pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white shadow-sm w-64">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
            </div>
            <!-- Add Button -->
            <a href="admin_product_add.php"
               class="inline-flex items-center gap-2 bg-[#1e3a8a] hover:bg-blue-800 text-white font-semibold py-2.5 px-4 rounded-xl shadow-sm transition whitespace-nowrap text-sm">
                <i class="fas fa-plus text-xs"></i>
                Add Product
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">ID</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">Image</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">Product Name</th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">Price</th>
                        <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wide">Stock</th>
                        <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wide">Visibility</th>
                        <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>

                <tbody id="productTableBody" class="divide-y divide-slate-50">
                    <?php while ($row = $stmt->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50/60 transition group">

                        <!-- ID -->
                        <td class="px-5 py-3.5">
                            <span class="font-mono text-xs text-slate-400">#<?= $row['id'] ?></span>
                        </td>

                        <!-- Image -->
                        <td class="px-5 py-3.5">
                            <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-100 bg-slate-50">
                                <img src="<?= htmlspecialchars($row['image_url']) ?>"
                                     alt="<?= htmlspecialchars($row['product_name']) ?>"
                                     class="w-full h-full object-cover"
                                     onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                            </div>
                        </td>

                        <!-- Name -->
                        <td class="px-5 py-3.5 max-w-[220px]">
                            <p class="font-semibold text-slate-800 truncate"><?= htmlspecialchars($row['product_name']) ?></p>
                            <?php if (!empty($row['category'])): ?>
                            <p class="text-xs text-slate-400 mt-0.5"><?= htmlspecialchars($row['category']) ?></p>
                            <?php endif; ?>
                        </td>

                        <!-- Price -->
                        <td class="px-5 py-3.5 text-right">
                            <span class="font-bold text-slate-800"><?= number_format($row['price'], 0, ',', '.') ?>đ</span>
                        </td>

                        <!-- Stock -->
                        <td class="px-5 py-3.5 text-center">
                            <?php
                            $qty = $row['quantity'] ?? 0;
                            if ($qty === 'Liên hệ' || $qty === '') {
                                echo '<span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">Contact</span>';
                            } elseif (is_numeric($qty) && (int)$qty <= 0) {
                                echo '<span class="text-xs font-semibold text-red-600 bg-red-50 border border-red-200 px-2.5 py-1 rounded-full">Out of Stock</span>';
                            } elseif (is_numeric($qty) && (int)$qty < 10) {
                                echo '<span class="text-xs font-semibold text-orange-600 bg-orange-50 border border-orange-200 px-2.5 py-1 rounded-full">' . (int)$qty . ' — Low</span>';
                            } else {
                                echo '<span class="font-bold text-slate-700 text-sm">' . quantity_check($qty) . '</span>';
                            }
                            ?>
                        </td>

                        <!-- Visibility -->
                        <td class="px-5 py-3.5 text-center">
                            <?php if ($row['status'] === 'available'): ?>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Published
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 bg-slate-100 border border-slate-200 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                    Hidden
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
                        <td class="px-5 py-3.5 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="print_barcode.php?id=<?= $row['id'] ?>" target="_blank"
                                   title="Print barcode label"
                                   class="inline-flex items-center gap-1 text-xs font-semibold text-violet-700 bg-violet-50 hover:bg-violet-100 border border-violet-200 px-3 py-1.5 rounded-lg transition">
                                    <i class="fas fa-print text-xs"></i> Label
                                </a>
                                <a href="admin_product_edit.php?id=<?= $row['id'] ?>"
                                   class="inline-flex items-center gap-1 text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-lg transition">
                                    <i class="fas fa-edit text-xs"></i> Edit
                                </a>
                                <form action="admin_product_delete.php" method="POST"
                                      onsubmit="return confirm('Delete this product from the website?');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition">
                                        <i class="fas fa-trash text-xs"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- No results -->
        <div id="noResultsMsg" class="hidden px-5 py-12 text-center text-slate-400">
            <i class="fas fa-search text-2xl mb-3 opacity-40"></i>
            <p class="font-medium">No products match your search.</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchProduct').addEventListener('input', function() {
        const keyword = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#productTableBody tr');
        let visible = 0;

        rows.forEach(row => {
            const match = row.innerText.toLowerCase().includes(keyword);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        document.getElementById('noResultsMsg').classList.toggle('hidden', visible > 0);
    });
</script>

</main>
</body>
</html>