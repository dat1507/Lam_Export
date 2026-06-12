<?php
$active_page = 'news';
require_once 'header.php';
?>

<!-- SEO & Page Title -->
<script>
    document.title = "Latest News & Insights — Lam Export";
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) {
        metaDesc.setAttribute("content", "Stay updated with global agriculture news, export market trends, food safety standards, and sustainable organic farming insights from Lam Export.");
    }
</script>

<main class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-900 via-[#1e3a8a] to-blue-850 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-400 via-transparent to-transparent"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Latest News & Industry Insights</h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">Explore organic agriculture developments, export trends, and modern ecological farming technologies.</p>
        </div>
    </section>

    <!-- News Grid & Sidebar Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
        
        <!-- Featured News -->
        <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition mb-12 grid grid-cols-1 lg:grid-cols-2">
            <div class="bg-slate-200 h-64 lg:h-auto flex items-center justify-center text-slate-400 relative">
                <span class="text-6xl">🌍</span>
                <div class="absolute top-4 left-4 bg-[#1e3a8a] text-white text-xs px-3 py-1.5 rounded-full font-bold uppercase">Featured Article</div>
            </div>
            <div class="p-8 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-wider">Export Trends</span>
                    <span class="text-xs text-gray-400 ml-3">June 12, 2026</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2 mb-4">Vietnam's Organic Agricultural Exports Continue to Rise in Global Markets</h2>
                    <p class="text-sm text-gray-600 leading-relaxed mb-4">Driven by increasing global health awareness and strict environmental compliance, premium agricultural products from Vietnam are experiencing historic export demands. Our shipments to EU and US ports highlight growing trust in our organic certifications.</p>
                </div>
                <div>
                    <button onclick="alert('This feature will display the complete article soon!')" class="inline-flex items-center gap-1.5 bg-[#1e3a8a] hover:bg-blue-800 text-white text-xs font-bold py-2.5 px-5 rounded-lg shadow-sm transition">
                        Read Full Article
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left: News Grid -->
            <div class="lg:w-2/3 flex flex-col gap-8">
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-2">More Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">🌶️</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Nutrition</span>
                                <span class="text-[10px] text-gray-400 ml-3">June 10, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Benefits of Organic Black Pepper</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">Explore how chemical-free black pepper farming preserves natural piperine contents, providing superior medical benefits and culinary flavor profiles.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">🌱</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Farming</span>
                                <span class="text-[10px] text-gray-400 ml-3">June 08, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Sustainable Farming Practices</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">Learn about water-conserving drip irrigation, biological crop controls, and natural composting methods applied in our certified farms.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">📈</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider">Markets</span>
                                <span class="text-[10px] text-gray-400 ml-3">June 05, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Export Market Trends</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">An analysis of import demands for clean herbs and spices in the European Union and North American retail networks in 2026.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">🛡️</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-rose-600 uppercase tracking-wider">Safety</span>
                                <span class="text-[10px] text-gray-400 ml-3">June 02, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Food Safety Standards</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">How modern automated factories execute metal separation, steam sterilizations, and HACCP steps for raw pepper sorting.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">🌾</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Development</span>
                                <span class="text-[10px] text-gray-400 ml-3">May 28, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Organic Agriculture Development</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">Investigating national investment policies designed to expand local high-yield organic farming operations across rural highlands.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="bg-slate-100 h-40 flex items-center justify-center text-slate-400 relative">
                            <span class="text-4xl">🚜</span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">Future</span>
                                <span class="text-[10px] text-gray-400 ml-3">May 25, 2026</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-1 mb-2">Future of Green Farming</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">How AI soil sensors, crop health drones, and ecological resource plans are steering high-tech farming methods.</p>
                            </div>
                            <button onclick="alert('Article coming soon!')" class="text-xs font-bold text-blue-600 hover:text-blue-800 text-left transition mt-auto">Read More &rarr;</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Sidebar -->
            <div class="lg:w-1/3 flex flex-col gap-8">
                
                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h4 class="font-bold text-gray-800 text-md border-b pb-2 mb-4">Categories</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="flex justify-between text-gray-600 hover:text-blue-650 transition"><span>Organic Crops</span> <span class="text-xs text-gray-400">(12)</span></a></li>
                        <li><a href="#" class="flex justify-between text-gray-600 hover:text-blue-650 transition"><span>Export Market Insights</span> <span class="text-xs text-gray-400">(8)</span></a></li>
                        <li><a href="#" class="flex justify-between text-gray-600 hover:text-blue-650 transition"><span>Safety Certifications</span> <span class="text-xs text-gray-400">(5)</span></a></li>
                        <li><a href="#" class="flex justify-between text-gray-600 hover:text-blue-650 transition"><span>Farming Technology</span> <span class="text-xs text-gray-400">(9)</span></a></li>
                    </ul>
                </div>

                <!-- Recent Posts Widget -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h4 class="font-bold text-gray-800 text-md border-b pb-2 mb-4">Recent Posts</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="#" class="group block">
                                <h5 class="text-sm font-bold text-gray-850 group-hover:text-blue-650 transition line-clamp-2">How to Secure Strict FDA Approvals for Food Imports</h5>
                                <span class="text-[10px] text-gray-400">June 11, 2026</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group block">
                                <h5 class="text-sm font-bold text-gray-850 group-hover:text-blue-650 transition line-clamp-2">Sustainable Packing Materials for Spice Container Shipping</h5>
                                <span class="text-[10px] text-gray-400">June 07, 2026</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group block">
                                <h5 class="text-sm font-bold text-gray-850 group-hover:text-blue-650 transition line-clamp-2">The Essential Role of Quality Testing in Agricultural Trade</h5>
                                <span class="text-[10px] text-gray-400">May 30, 2026</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Popular Topics -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h4 class="font-bold text-gray-800 text-md border-b pb-2 mb-4">Popular Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full cursor-pointer hover:bg-blue-50 hover:text-blue-750 transition">#OrganicPepper</span>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full cursor-pointer hover:bg-blue-50 hover:text-blue-750 transition">#HACCP</span>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full cursor-pointer hover:bg-blue-50 hover:text-blue-750 transition">#VietGAP</span>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full cursor-pointer hover:bg-blue-50 hover:text-blue-750 transition">#B2BTrade</span>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full cursor-pointer hover:bg-blue-50 hover:text-blue-750 transition">#EcologicalFarms</span>
                    </div>
                </div>

            </div>

        </div>

    </section>
</main>

<?php require_once 'footer.php'; ?>
