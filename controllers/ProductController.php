<?php
// File: controllers/ProductController.php
class ProductController {
    public function showPublicProducts() {
        global $conn;
        require_once 'connect.php';
        $active_page = 'products';
        include 'header.php';

        // Fetch all available products
        $query = "SELECT * FROM products WHERE status = 'available' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        $total = mysqli_num_rows($result);

        // Fetch categories for filter
        $cat_query = "SELECT DISTINCT category FROM products WHERE status = 'available' AND category IS NOT NULL AND category != '' ORDER BY category ASC";
        $cat_result = mysqli_query($conn, $cat_query);
        $categories = [];
        while ($c = mysqli_fetch_assoc($cat_result)) {
            $categories[] = $c['category'];
        }
        ?>

        <!-- Page Header -->
        <div class="bg-gradient-to-r from-[#1e3a8a] to-[#1d4ed8] text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <nav class="text-blue-300 text-sm mb-3 flex items-center gap-2">
                    <a href="index.php" class="hover:text-white transition">Home</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-white font-medium">Products</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-bold">Our Products</h1>
                <p class="text-blue-200 mt-2"><?= $total ?> products available for export</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10">

            <!-- Filters & Search -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8 items-start sm:items-center justify-between">
                <div class="flex gap-2 flex-wrap">
                    <button onclick="filterProducts('all')" id="filter-all"
                            class="filter-btn active-filter px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        All Products
                    </button>
                    <?php foreach ($categories as $cat): ?>
                    <button onclick="filterProducts('<?= htmlspecialchars($cat) ?>')"
                            id="filter-<?= htmlspecialchars($cat) ?>"
                            class="filter-btn px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        <?= htmlspecialchars($cat) ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                <div class="relative w-full sm:w-72">
                    <input type="text" id="searchInput" placeholder="Search products..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition bg-white shadow-sm">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Product Grid -->
            <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card group bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 shadow-sm"
                         data-category="<?= htmlspecialchars($row['category'] ?? '') ?>"
                         data-name="<?= htmlspecialchars(strtolower($row['product_name'])) ?>">

                        <div class="relative overflow-hidden bg-gray-50 h-52">
                            <img src="<?= htmlspecialchars($row['image_url']) ?>"
                                 alt="<?= htmlspecialchars($row['product_name']) ?>"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                            <?php if (!empty($row['certifications'])): ?>
                            <div class="absolute top-3 left-3">
                                <span class="bg-amber-400 text-blue-900 text-xs font-bold px-2.5 py-1 rounded-full"><?= htmlspecialchars($row['certifications']) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($row['is_trending']) && $row['is_trending'] == 1): ?>
                            <div class="absolute top-3 right-3">
                                <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">🔥 Hot</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1"><?= htmlspecialchars($row['category'] ?? 'General') ?></p>
                            <h3 class="font-semibold text-gray-800 leading-snug line-clamp-2 mb-3"><?= htmlspecialchars($row['product_name']) ?></h3>
                            <div class="mt-auto">
                                <p class="text-[#1e3a8a] font-bold text-base">
                                    <?= number_format($row['price'], 0, ',', '.') ?>đ
                                    <span class="text-gray-400 text-sm font-normal">/ <?= htmlspecialchars($row['unit']) ?></span>
                                </p>
                                <a href="detail.php?id=<?= $row['id'] ?>"
                                   class="mt-3 block text-center bg-[#1e3a8a] hover:bg-amber-400 hover:text-blue-900 text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <p class="font-medium text-lg">No products found</p>
                <p class="text-sm mt-1">Try adjusting your search or filters</p>
            </div>
        </div>

        <style>
            .filter-btn { background: #f1f5f9; color: #475569; }
            .filter-btn:hover { background: #dbeafe; color: #1e40af; }
            .active-filter { background: #1e3a8a !important; color: white !important; }
            .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        </style>

        <script>
            let activeCategory = 'all';

            function filterProducts(category) {
                activeCategory = category;
                // Update button styles
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter'));
                const activeBtn = document.getElementById('filter-' + category) || document.getElementById('filter-all');
                if (activeBtn) activeBtn.classList.add('active-filter');
                applyFilters();
            }

            function applyFilters() {
                const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
                const cards = document.querySelectorAll('.product-card');
                let visible = 0;

                cards.forEach(card => {
                    const cat = card.getAttribute('data-category') || '';
                    const name = card.getAttribute('data-name') || '';
                    const matchCat = (activeCategory === 'all') || (cat === activeCategory);
                    const matchSearch = !keyword || name.includes(keyword);

                    if (matchCat && matchSearch) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                document.getElementById('noResults').classList.toggle('hidden', visible > 0);
            }

            document.getElementById('searchInput').addEventListener('input', applyFilters);
        </script>

        <?php
        include 'footer.php';
    }
}
?>
