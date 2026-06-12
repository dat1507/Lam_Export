<?php
$active_page = 'certifications';
require_once 'header.php';
?>

<!-- SEO & Page Title -->
<script>
    document.title = "Certifications — Lam Export";
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) {
        metaDesc.setAttribute("content", "View the international and regional agricultural quality standards achieved by Lam Export, including Organic USDA, HACCP, ISO 22000, VietGAP, and GlobalG.A.P.");
    }
</script>

<main class="min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-900 via-[#1e3a8a] to-blue-850 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-400 via-transparent to-transparent"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Certified Quality & Sustainable Farming</h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">We strictly enforce global safety guidelines and eco-friendly harvesting practices to supply certified, clean agricultural items.</p>
        </div>
    </section>

    <!-- Certifications Cards Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            
            <!-- Organic Certification -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full border border-emerald-200">Global Standard</span>
                        <span class="text-2xl">🌿</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Organic Certification</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">USDA & EU Organic certified farms. Evaluates clean soil cultivation, chemical-free fertilization, and non-GMO agricultural standards to verify premium clean food production.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-slate-400 font-semibold">100% Chemical-Free Farming</span>
                </div>
            </div>

            <!-- HACCP -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider bg-blue-100 text-blue-800 px-3 py-1 rounded-full border border-blue-200">Food Safety</span>
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">HACCP Certification</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Hazard Analysis Critical Control Point standard. Monitors and eliminates physical, chemical, and biological threats across food sorting, packaging, and logistics pipelines.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-slate-400 font-semibold">Critical Threat Prevention System</span>
                </div>
            </div>

            <!-- ISO 22000 -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider bg-blue-100 text-blue-800 px-3 py-1 rounded-full border border-blue-200">System Quality</span>
                        <span class="text-2xl">🏭</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">ISO 22000:2018</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">International food safety management standard. Verifies that processing plants, storage systems, and distribution lines comply with hygiene and traceability regulations.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-slate-400 font-semibold">International Management Quality</span>
                </div>
            </div>

            <!-- VietGAP -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider bg-orange-100 text-orange-850 px-3 py-1 rounded-full border border-orange-200">National GAP</span>
                        <span class="text-2xl">🇻🇳</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">VietGAP Certificate</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Vietnamese Good Agricultural Practices. Certifies local farming operations for environment safety, worker welfare, and clean non-toxic vegetable and spice harvesting.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-slate-400 font-semibold">Vietnamese Standard Compliant</span>
                </div>
            </div>

            <!-- GlobalG.A.P. -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full border border-emerald-200">Global GAP</span>
                        <span class="text-2xl">🌎</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">GlobalG.A.P.</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">International farming safety and welfare certificate. Validates full farm traceability, worker safety compliance, and low chemical pesticide usages for international markets.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-slate-400 font-semibold">Global Export Standards Standard</span>
                </div>
            </div>

        </div>

        <!-- Gallery Section -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Inspection & Farm Operations Gallery</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Certificate Card -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="bg-slate-100 h-48 flex items-center justify-center text-slate-400 relative">
                        <span class="text-4xl">📄</span>
                        <div class="absolute bottom-3 left-3 bg-black/60 text-white text-xs px-2 py-1 rounded font-medium">Quality Certificates</div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 text-sm">Official Standards Accreditations</h4>
                        <p class="text-xs text-gray-500 mt-1">Verified USDA Organic & HACCP documents approved by international audit agencies.</p>
                    </div>
                </div>

                <!-- Inspection Card -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="bg-slate-100 h-48 flex items-center justify-center text-slate-400 relative">
                        <span class="text-4xl">🔬</span>
                        <div class="absolute bottom-3 left-3 bg-black/60 text-white text-xs px-2 py-1 rounded font-medium">Lab Inspections</div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 text-sm">Strict Quality Assurance Testing</h4>
                        <p class="text-xs text-gray-500 mt-1">Continuous laboratory screening for contaminants to secure clean food exports.</p>
                    </div>
                </div>

                <!-- Farm Card -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="bg-slate-100 h-48 flex items-center justify-center text-slate-400 relative">
                        <span class="text-4xl">🚜</span>
                        <div class="absolute bottom-3 left-3 bg-black/60 text-white text-xs px-2 py-1 rounded font-medium">Sustainable Farms</div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 text-sm">Eco-Friendly Farming Operations</h4>
                        <p class="text-xs text-gray-500 mt-1">Sustainable crop development that protects soil nutrition and local water sources.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-900 rounded-3xl text-white p-8 md:p-12 text-center max-w-4xl mx-auto shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-amber-400 via-transparent to-transparent"></div>
            <h2 class="text-2xl md:text-3xl font-bold mb-4 relative z-10">Learn More About Our Quality Standards</h2>
            <p class="text-blue-100 max-w-xl mx-auto mb-6 text-sm md:text-base relative z-10">Request certified documents, audit certificates, or detailed specifications for wholesale commodities.</p>
            <a href="contact.php" class="relative z-10 inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-blue-950 font-bold py-3 px-8 rounded-xl shadow-lg transition text-sm">
                Request Certificates Copy
            </a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>
