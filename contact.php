<?php
$active_page = 'contact';
require_once 'header.php';
?>

<!-- SEO & Page Title -->
<script>
    document.title = "Contact Us — Lam Export";
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) {
        metaDesc.setAttribute("content", "Get in touch with Lam Export's sales department. Send us inquiries regarding wholesale agricultural commodities, packaging customization, and global distribution logistics.");
    }
</script>

<main class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-900 via-[#1e3a8a] to-blue-850 text-white py-16 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-400 via-transparent to-transparent"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Contact Us</h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">Get in touch with our commercial sales team today. We respond to wholesale inquiries within 24 hours.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            
            <!-- Left: Contact Details -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 text-lg border-b pb-2 mb-4">Contact Information</h3>
                    <ul class="space-y-4 text-sm text-gray-650">
                        <li class="flex items-start gap-3">
                            <span class="text-lg">📍</span>
                            <div>
                                <strong class="text-gray-800 block">Headquarters:</strong>
                                <span>02 Tran Thi Ki, Quy Nhon Nam Ward, Gia Lai, Vietnam</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-lg">✉️</span>
                            <div>
                                <strong class="text-gray-800 block">General Inquiry Email:</strong>
                                <a href="mailto:export@lamexport.vn" class="text-blue-600 hover:underline">export@lamexport.vn</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-lg">📞</span>
                            <div>
                                <strong class="text-gray-800 block">Commercial Hotline:</strong>
                                <span>(+84) 123 456 789</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-lg">🕒</span>
                            <div>
                                <strong class="text-gray-800 block">Business Hours:</strong>
                                <span>Monday – Saturday: 07:30 – 18:00 (GMT+7)</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Instant Messaging Contact -->
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 shadow-sm">
                    <h4 class="font-bold text-blue-900 text-md mb-2">Need Immediate Support?</h4>
                    <p class="text-xs text-blue-700 leading-relaxed mb-4">Chat directly with our export logistics officer on Zalo or WhatsApp for active status updates.</p>
                    <div class="flex gap-3">
                        <a href="https://wa.me/84987654321" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg text-xs transition">WhatsApp Chat</a>
                        <a href="https://zalo.me/0123456789" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-xs transition">Zalo Chat</a>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="font-bold text-gray-800 text-lg border-b pb-2 mb-6">Send Us a Commercial Message</h3>
                    
                    <form id="contactForm" onsubmit="event.preventDefault(); alert('Message sent successfully! Our sales team will get back to you shortly.'); this.reset();">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Your Name</label>
                                <input type="text" placeholder="e.g. John Doe" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition text-sm bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Corporate Email</label>
                                <input type="email" placeholder="e.g. john@company.com" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition text-sm bg-gray-50">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Subject</label>
                            <input type="text" placeholder="e.g. Wholesale inquiry for black pepper..." required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition text-sm bg-gray-50">
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Message Specification</label>
                            <textarea rows="5" placeholder="Please detail your required quantities, packaging preferences, and destination port..." required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition text-sm bg-gray-50"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-[#1e3a8a] hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-xl shadow-md transition text-sm">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Google Maps Embed Placeholder -->
        <div class="mb-16">
            <h3 class="font-bold text-gray-800 text-lg border-b pb-2 mb-6">Our Location Map</h3>
            <div class="w-full h-80 rounded-2xl border border-gray-200 overflow-hidden relative shadow-sm">
                <!-- Fallback Map Graphic -->
                <div class="absolute inset-0 bg-slate-100 flex flex-col items-center justify-center text-slate-400 p-4">
                    <span class="text-4xl mb-2">🗺️</span>
                    <strong class="text-gray-800 text-sm">Lam Export Head Office</strong>
                    <p class="text-xs text-gray-500 mt-1 max-w-md text-center">02 Tran Thi Ki, Phường Quy Nhơn Nam, Gia Lai, Việt Nam</p>
                </div>
                <!-- Dynamic Iframe Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.5492471649964!2d107.98888!3d13.98333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDU5JzAwLjAiTiAxMDfCsDU5JzIwLjAiRQ!5e0!3m2!1sen!2svn!4v1620000000000!5m2!1sen!2svn" 
                        class="w-full h-full border-none relative z-10 opacity-90" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-4xl mx-auto">
            <h3 class="font-bold text-gray-800 text-xl border-b pb-3 mb-8 text-center">Frequently Asked Questions (FAQ)</h3>
            
            <div class="space-y-4">
                
                <!-- FAQ 1 -->
                <details class="bg-white rounded-2xl border border-gray-200 p-5 group cursor-pointer transition shadow-sm">
                    <summary class="flex justify-between items-center font-semibold text-sm text-gray-850 list-none">
                        <span>How long does shipping take?</span>
                        <span class="text-xs text-gray-400 group-open:rotate-180 transition-transform">&darr;</span>
                    </summary>
                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">Ocean freight shipments typically take 15 to 30 days depending on the destination continent. Air shipments take 3 to 5 business days. Order handling, phytosanitary certificates, and customs clearings take around 5-7 business days.</p>
                </details>

                <!-- FAQ 2 -->
                <details class="bg-white rounded-2xl border border-gray-200 p-5 group cursor-pointer transition shadow-sm">
                    <summary class="flex justify-between items-center font-semibold text-sm text-gray-850 list-none">
                        <span>Do you offer international delivery?</span>
                        <span class="text-xs text-gray-400 group-open:rotate-180 transition-transform">&darr;</span>
                    </summary>
                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">Yes, we export agricultural commodities globally. We support standard shipping protocols (FOB, CFR, CIF) to any major global port in Europe, North America, Middle East, and the Asia-Pacific region.</p>
                </details>

                <!-- FAQ 3 -->
                <details class="bg-white rounded-2xl border border-gray-200 p-5 group cursor-pointer transition shadow-sm">
                    <summary class="flex justify-between items-center font-semibold text-sm text-gray-850 list-none">
                        <span>Are your products certified organic?</span>
                        <span class="text-xs text-gray-400 group-open:rotate-180 transition-transform">&darr;</span>
                    </summary>
                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">Yes. Our organic line is certified organic under USDA and EU regulations. All other agricultural crops comply with strict VietGAP and GlobalG.A.P. ecological safety farming rules.</p>
                </details>

                <!-- FAQ 4 -->
                <details class="bg-white rounded-2xl border border-gray-200 p-5 group cursor-pointer transition shadow-sm">
                    <summary class="flex justify-between items-center font-semibold text-sm text-gray-850 list-none">
                        <span>What are your standard payment terms?</span>
                        <span class="text-xs text-gray-400 group-open:rotate-180 transition-transform">&darr;</span>
                    </summary>
                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">We support standard international B2B payments: Irrevocable Letter of Credit (L/C) at sight or Telegraphic Transfer (T/T) bank transfer (usually 30% advance deposit with the remaining 70% paid against copy of Bill of Lading).</p>
                </details>

                <!-- FAQ 5 -->
                <details class="bg-white rounded-2xl border border-gray-200 p-5 group cursor-pointer transition shadow-sm">
                    <summary class="flex justify-between items-center font-semibold text-sm text-gray-850 list-none">
                        <span>Can we request custom export packaging?</span>
                        <span class="text-xs text-gray-400 group-open:rotate-180 transition-transform">&darr;</span>
                    </summary>
                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">Absolutely. We provide standard PP bags, vacuum bags, paper cartons, and customized design layouts with your custom logo branding printed directly on shipping containers depending on the wholesale order scale.</p>
                </details>

            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>
