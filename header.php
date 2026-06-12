<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lam Export — Premium Agricultural Commodities</title>
    <meta name="description" content="Lam Export is a leading exporter of premium Vietnamese agricultural products and handicrafts to global markets.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .animate-floating { animation: floating 2.5s ease-in-out infinite; }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadedown { animation: fadeDown 0.25s ease forwards; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .nav-link {
            position: relative;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0; right: 0;
            height: 2px;
            background: #f59e0b;
            transform: scaleX(0);
            transition: transform 0.25s ease;
        }
        .nav-link:hover::after,
        .nav-link.active::after { transform: scaleX(1); }
        .nav-link.active { color: #f59e0b; }

        .header-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#1e3a8a', light: '#2563eb', dark: '#1e3a8a' },
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-gray-800 antialiased">

    <header class="header-sticky bg-white shadow-sm">

        <!-- Top Bar -->
        <div class="bg-[#1e3a8a] text-blue-200 text-xs py-2 px-4 sm:px-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center divide-x divide-white/20">
                    <span class="pr-3 flex items-center gap-1.5 hover:text-white transition cursor-pointer">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                        (+84) 123 456 789
                    </span>
                    <span class="hidden sm:flex px-3 items-center gap-1.5 hover:text-white transition cursor-pointer">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        export@lamexport.vn
                    </span>
                    <span class="hidden md:flex pl-3 items-center gap-1.5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        Mon – Sat: 07:30 – 18:00
                    </span>
                </div>
                <div class="flex items-center gap-3 font-medium">
                    <a href="#" class="text-white hover:text-amber-400 transition text-xs font-semibold">EN</a>
                    <span class="text-white/30 text-xs">|</span>
                    <a href="#" class="hover:text-amber-400 transition text-xs">VI</a>
                </div>
            </div>
        </div>

        <!-- Brand + Search Row -->
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-8 py-3">
            <a href="index.php" class="flex items-center gap-3 shrink-0">
                <img src="gallery/lamexportlogo.jpg" alt="Lam Export" class="h-16 md:h-20 w-auto object-contain">
            </a>

            <!-- Desktop Search -->
            <div class="hidden md:flex flex-1 max-w-lg mx-8">
                <div class="flex w-full rounded-lg overflow-hidden border border-gray-200 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition shadow-sm">
                    <input type="text" placeholder="Search products, categories..." 
                           class="flex-1 px-4 py-2.5 text-sm focus:outline-none bg-gray-50">
                    <button class="bg-[#1e3a8a] hover:bg-blue-700 text-white px-6 text-sm font-semibold transition whitespace-nowrap">
                        Search
                    </button>
                </div>
            </div>

            <!-- Mobile menu toggle -->
            <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-600 hover:text-blue-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menuIconOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path id="menuIconClose" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Bar -->
        <nav class="border-t border-gray-100 bg-white">
            <ul class="hidden md:flex justify-center gap-8 py-3 font-medium text-sm text-gray-600 max-w-7xl mx-auto px-4 sm:px-8">
                <li><a href="index.php" class="nav-link <?php echo ($active_page == 'home') ? 'active' : ''; ?> hover:text-amber-500 transition">Home</a></li>
                <li><a href="products.php" class="nav-link <?php echo ($active_page == 'products') ? 'active' : ''; ?> hover:text-amber-500 transition">Products</a></li>
                <li><a href="#" class="nav-link hover:text-amber-500 transition">Policy</a></li>
                <li><a href="#" class="nav-link hover:text-amber-500 transition">Certifications</a></li>
                <li><a href="#" class="nav-link hover:text-amber-500 transition">News</a></li>
                <li><a href="#" class="nav-link hover:text-amber-500 transition">Contact</a></li>
            </ul>

            <!-- Mobile nav -->
            <div id="mobileNav" class="hidden md:hidden px-4 pb-4 border-t border-gray-100 animate-fadedown">
                <div class="flex w-full rounded-lg overflow-hidden border border-gray-200 mb-3 mt-3">
                    <input type="text" placeholder="Search products..." class="flex-1 px-4 py-2 text-sm focus:outline-none">
                    <button class="bg-[#1e3a8a] text-white px-4 text-sm">Search</button>
                </div>
                <ul class="space-y-1 text-sm font-medium text-gray-700">
                    <li><a href="index.php" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition <?php echo ($active_page == 'home') ? 'text-amber-500 bg-amber-50' : ''; ?>">Home</a></li>
                    <li><a href="products.php" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition <?php echo ($active_page == 'products') ? 'text-amber-500 bg-amber-50' : ''; ?>">Products</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">Policy</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">Certifications</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">News</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <script>
        const btn = document.getElementById('mobileMenuBtn');
        const nav = document.getElementById('mobileNav');
        const iconOpen = document.getElementById('menuIconOpen');
        const iconClose = document.getElementById('menuIconClose');
        btn.addEventListener('click', () => {
            nav.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>