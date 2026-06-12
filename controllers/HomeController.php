<?php
// File: controllers/HomeController.php
class HomeController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function index() {
        $active_page = 'home';
        include 'header.php';

        // Fetch categories
        $cat_query = "SELECT * FROM categories ORDER BY category_name ASC";
        $categories = mysqli_query($this->conn, $cat_query);

        // Fetch trending products
        $prod_query = "SELECT * FROM products WHERE status = 'available' AND is_trending = 1 LIMIT 8";
        $trending_products = mysqli_query($this->conn, $prod_query);

        // Fetch all available products count
        $count_query = "SELECT COUNT(*) as total FROM products WHERE status = 'available'";
        $count_result = mysqli_query($this->conn, $count_query);
        $total_products = mysqli_fetch_assoc($count_result)['total'] ?? 0;
        ?>

        <!-- HERO SECTION -->
        <section class="relative bg-gradient-to-br from-[#1e3a8a] via-[#1d4ed8] to-[#1e40af] text-white overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-amber-400 rounded-full translate-x-1/3 translate-y-1/3"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-8 py-20 md:py-28 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 text-sm font-medium mb-6 backdrop-blur-sm">
                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                        Trusted Global Export Partner
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-5 tracking-tight">
                        Premium Vietnamese<br>
                        <span class="text-amber-400">Agricultural Exports</span>
                    </h1>
                    <p class="text-blue-200 text-lg leading-relaxed mb-8">
                        Supplying high-quality agricultural products and artisan goods — certified to the most rigorous international standards.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="products.php" 
                           class="inline-flex items-center justify-center gap-2 bg-amber-400 hover:bg-amber-300 text-blue-900 font-bold px-8 py-3.5 rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            View All Products
                        </a>
                        <a href="#" 
                           class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-200 backdrop-blur-sm">
                            Request a Quote
                        </a>
                    </div>
                </div>
                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4 shrink-0">
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur-sm text-center">
                        <p class="text-3xl font-bold text-amber-400"><?= $total_products ?>+</p>
                        <p class="text-sm text-blue-200 mt-1">Products Listed</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur-sm text-center">
                        <p class="text-3xl font-bold text-amber-400">15+</p>
                        <p class="text-sm text-blue-200 mt-1">Countries Served</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur-sm text-center">
                        <p class="text-3xl font-bold text-amber-400">100%</p>
                        <p class="text-sm text-blue-200 mt-1">Quality Certified</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur-sm text-center">
                        <p class="text-3xl font-bold text-amber-400">10yr</p>
                        <p class="text-sm text-blue-200 mt-1">Experience</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURED PRODUCTS -->
        <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-amber-500 font-semibold text-sm uppercase tracking-wider mb-1">Handpicked for You</p>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a8a]">Featured Products</h2>
                </div>
                <a href="products.php" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 hover:text-amber-500 transition group">
                    View All
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <?php if (mysqli_num_rows($trending_products) > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php while ($row = mysqli_fetch_assoc($trending_products)): ?>
                    <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 shadow-sm">
                        <div class="relative overflow-hidden h-48 bg-gray-50">
                            <img src="<?= htmlspecialchars($row['image_url']) ?>" 
                                 alt="<?= htmlspecialchars($row['product_name']) ?>" 
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='gallery/no-image.png'; this.onerror=null;">
                            <div class="absolute top-3 left-3">
                                <span class="bg-amber-400 text-blue-900 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">Featured</span>
                            </div>
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1"><?= htmlspecialchars($row['category'] ?? 'General') ?></p>
                            <h3 class="font-semibold text-gray-800 mb-2 leading-snug line-clamp-2"><?= htmlspecialchars($row['product_name']) ?></h3>
                            <p class="text-blue-800 font-bold text-lg mt-auto">
                                <?= number_format($row['price'], 0, ',', '.') ?>đ
                                <span class="text-gray-400 text-sm font-normal">/ <?= htmlspecialchars($row['unit']) ?></span>
                            </p>
                            <a href="detail.php?id=<?= $row['id'] ?>" 
                               class="mt-4 block text-center bg-[#1e3a8a] hover:bg-amber-400 hover:text-blue-900 text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <p class="font-medium">No featured products at the moment.</p>
                <a href="products.php" class="mt-4 inline-block text-blue-600 hover:underline text-sm">Browse all products</a>
            </div>
            <?php endif; ?>

            <div class="mt-8 text-center sm:hidden">
                <a href="products.php" class="inline-flex items-center gap-2 bg-[#1e3a8a] text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition">
                    View All Products
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </section>

        <!-- WHY CHOOSE US -->
        <section class="bg-white border-t border-gray-100 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="text-center mb-10">
                    <p class="text-amber-500 font-semibold text-sm uppercase tracking-wider mb-1">Our Commitment</p>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a8a]">Why Choose Lam Export?</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php
                    $features = [
                        ['icon' => '🏅', 'title' => 'Certified Quality', 'desc' => 'Products meet international food safety and quality standards (GlobalG.A.P., HACCP, ISO).'],
                        ['icon' => '🌍', 'title' => 'Global Reach', 'desc' => 'We export to 15+ countries across Asia, Europe, and North America.'],
                        ['icon' => '🤝', 'title' => 'B2B Partnership', 'desc' => 'Flexible wholesale pricing and dedicated support for business buyers.'],
                        ['icon' => '📦', 'title' => 'Reliable Delivery', 'desc' => 'On-time shipment with full documentation support for FOB and CIF terms.'],
                    ];
                    foreach ($features as $f): ?>
                    <div class="bg-slate-50 rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-300 text-center">
                        <div class="text-3xl mb-4"><?= $f['icon'] ?></div>
                        <h3 class="font-bold text-[#1e3a8a] mb-2"><?= $f['title'] ?></h3>
                        <p class="text-sm text-gray-500 leading-relaxed"><?= $f['desc'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php
        include 'footer.php';
    }
}
?>
