<?php
require_once 'config/database.php';
require_once 'admin_header.php';
?>
<div class="max-w-4xl mx-auto px-4 py-8 h-full">
    <div class="flex items-center gap-4 mb-6">
        <a href="admin_promotions.php" class="text-gray-500 hover:text-blue-600 font-bold text-xl">⬅ Back</a>
        <h1 class="text-2xl font-bold text-[#1a2954]">Add New Promotion</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="p-6 md:p-8">
            <form id="promoForm">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Campaign Name</label>
                        <input type="text" name="promo_name" placeholder="e.g. Quy Nhon Tourism Year" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Voucher Code (UPPERCASE ONLY, NO SPACES)</label>
                        <input type="text" name="promo_code" placeholder="e.g. SACHITANG10" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm uppercase">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Discount Type</label>
                    <select id="promoTypeSelect" name="promo_type" required onchange="togglePromoFields()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm bg-white">
                        <option value="" disabled selected>-- Select Discount Type --</option>
                        <option value="discount_amount">Discount Amount (Deducted directly from bill)</option>
                        <option value="discount_percent">Discount Percentage (%)</option>
                        <option value="buy_x_get_y">Buy X Get Y</option>
                    </select>
                </div>

                <div id="discountValueField" class="mb-6 hidden">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Discount Value</label>
                    <input type="number" name="discount_val" placeholder="Enter amount or %"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div id="buyXgetYFields" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 hidden">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Buy Quantity</label>
                        <input type="number" name="buy_qty" placeholder="e.g. Buy 2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Get Quantity</label>
                        <input type="number" name="get_qty" placeholder="e.g. Get 1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Start Date & Time</label>
                        <input type="datetime-local" name="start_date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm text-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">End Date & Time</label>
                        <input type="datetime-local" name="end_date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm text-gray-600">
                    </div>
                </div>

                <div class="mb-8 flex items-center">
                    <label for="isActive" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="isActive" name="is_active" class="sr-only" checked value="1">
                            <div class="block bg-gray-300 w-10 h-6 rounded-full transition toggle-bg"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                        </div>
                        <div class="ml-3 text-sm font-bold text-gray-700">
                            Active
                        </div>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-6 rounded-lg shadow transition flex items-center gap-2">
                        <span>💾</span> Save Promotion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input:checked ~ .dot { transform: translateX(100%); }
    input:checked ~ .toggle-bg { background-color: #16a34a; /* Tailwind green-600 */ }
    
    .fade-in { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function togglePromoFields() {
        const type = document.getElementById('promoTypeSelect').value;
        const discountField = document.getElementById('discountValueField');
        const buyGetFields = document.getElementById('buyXgetYFields');

        // Reset class
        discountField.classList.add('hidden');
        discountField.classList.remove('block', 'fade-in');
        buyGetFields.classList.add('hidden');
        buyGetFields.classList.remove('grid', 'fade-in');

        if (type === 'discount_amount' || type === 'discount_percent') {
            discountField.classList.remove('hidden');
            discountField.classList.add('block', 'fade-in');
        } else if (type === 'buy_x_get_y') {
            buyGetFields.classList.remove('hidden');
            buyGetFields.classList.add('grid', 'fade-in');
        }
    }
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'Saving...';
        submitBtn.disabled = true;

        let formData = new FormData(this);

        fetch('ajax_save_promotion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if(data.status === 'success') {
                alert(data.message); 
                window.location.href = 'admin_promotions.php'; 
            } else {
                alert('Error: ' + data.message);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Connection Error:', error);
            alert('A network or server error occurred! Please try again.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
</script>