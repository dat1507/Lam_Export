<?php
$active_page = 'policy';
require_once 'header.php';
?>

<!-- SEO & Page Title -->
<script>
    document.title = "Policies — Lam Export";
    // Update meta description
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) {
        metaDesc.setAttribute("content", "Learn about Lam Export's shipping policies, return conditions, privacy protection, and terms of service for exporting premium agricultural products.");
    }
</script>

<main class="min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-900 via-[#1e3a8a] to-blue-850 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-400 via-transparent to-transparent"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Our Corporate Policies</h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">Transparency, security, and absolute reliability. Review our operational guidelines and regulatory terms.</p>
        </div>
    </section>

    <!-- Content Sections -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Shipping Policy Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg">
                            🚚
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">1. Shipping & Logistics Policy</h2>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600">
                        <p>We work with global shipping lines and air freight forwarders to ensure clean, safe, and on-time transit for all agricultural exports.</p>
                        <ul class="space-y-2 list-disc list-inside">
                            <li><strong>Processing Time:</strong> Customs clearance and phytosanitary inspections are typically processed within 5 to 7 business days from order confirmation.</li>
                            <li><strong>Delivery Time:</strong> Ocean freight takes 15 to 30 days depending on destination port. Air cargo averages 3 to 5 business days.</li>
                            <li><strong>Shipping Regions:</strong> We ship globally, specializing in shipments to Europe, North America, Middle East, and Asia-Pacific.</li>
                            <li><strong>Shipping Fees:</strong> Quoted on a per-order basis depending on selected Incoterms (FOB, CIF, CFR, Ex-Works).</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-150">
                    <span class="text-xs text-slate-400">Incoterms 2020 Compliant</span>
                </div>
            </div>

            <!-- Return & Refund Policy Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg">
                            🔄
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">2. Return & Refund Policy</h2>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600">
                        <p>We guarantee that all export goods meet agreed inspection specifications (SGS, Vinacontrol) prior to loading.</p>
                        <ul class="space-y-2 list-disc list-inside">
                            <li><strong>Return Conditions:</strong> Claims regarding quality discrepancies or weight shortages must be submitted within 14 days of cargo arrival at the destination port.</li>
                            <li><strong>Refund Process:</strong> Claims must be accompanied by an independent inspection report (SGS or equivalent). Once verified, refunds are processed via T/T or L/C.</li>
                            <li><strong>Refund Period:</strong> Agreed refund values will be wired or credited back within 10 business days of claim validation.</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-150">
                    <span class="text-xs text-slate-400">Backed by SGS Quality Verification</span>
                </div>
            </div>

            <!-- Privacy Policy Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg">
                            🔒
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">3. Privacy & Data Protection</h2>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600">
                        <p>We respect customer confidentiality and employ enterprise-grade security protocols to protect all corporate and transaction details.</p>
                        <ul class="space-y-2 list-disc list-inside">
                            <li><strong>Information Collection:</strong> We only collect corporate registration, contact info, and payment records necessary to execute trade agreements.</li>
                            <li><strong>Data Protection:</strong> All records are stored on secure cloud services and restricted to authorized logistics personnel. We never share details with third parties.</li>
                            <li><strong>Customer Rights:</strong> Partners have full rights to request transaction logs, request data deletion, or revise contact records at any time.</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-150">
                    <span class="text-xs text-slate-400">GDPR & Confidentiality Compliant</span>
                </div>
            </div>

            <!-- Terms & Conditions Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg">
                            📜
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">4. Terms & Conditions</h2>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600">
                        <p>By entering a commercial contract or using this platform, you agree to comply with our international trade terms.</p>
                        <ul class="space-y-2 list-disc list-inside">
                            <li><strong>Website Usage:</strong> The catalogue descriptions and wholesale specifications are for guidance. Final parameters are locked in the Contract.</li>
                            <li><strong>Order Policy:</strong> Commercial orders require signed sales contracts with clear payment specifications before dispatch planning begins.</li>
                            <li><strong>Payment Terms:</strong> Standard accepted methods are irrevocable LC at sight or TT bank transfer (30% deposit, 70% against Bill of Lading).</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-150">
                    <span class="text-xs text-slate-400">Standard International Trade Terms</span>
                </div>
            </div>

        </div>

        <!-- FAQ CTA Section -->
        <div class="bg-slate-100 rounded-2xl border border-slate-200 mt-12 p-8 text-center max-w-3xl mx-auto">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Have questions regarding shipping terms, trade documents, or custom packaging?</h3>
            <p class="text-sm text-gray-500 mb-5">Our sales team is available 24/7 to clarify standard international agricultural supply protocols.</p>
            <a href="contact.php" class="inline-flex items-center gap-2 bg-[#1e3a8a] hover:bg-blue-800 text-white font-semibold py-2.5 px-6 rounded-xl shadow-sm transition text-sm">
                Get in Touch
            </a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>
