<!DOCTYPE html>
<html lang="vi">
<head>
    <style>
        @keyframes wiggle {
            0%, 100% { transform: rotate(-1deg); }
            50% { transform: rotate(1deg); }
        }
        .animate-wiggle {
            animation: wiggle 0.5s ease-in-out infinite;
            transform-origin: center;
        }
    </style>
    <style>
        @keyframes floating {
            0%, 100% { transform: translateY(0); } 
            50% { transform: translateY(-5px); } 
        }
        .animate-floating {
            animation: floating 2s ease-in-out infinite; 
            transform-origin: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lam Export</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#1a2954',
                            dark: '#15803d',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-gray-50">

    <header class="bg-white shadow-sm">
        <div class="bg-[#1a2954] text-gray-200 text-sm py-2 px-4 flex justify-between items-center sm:px-8">
    
            <div class="flex items-center divide-x divide-white/30">
                <span class="pr-4 flex items-center gap-1.5 hover:text-white transition cursor-pointer">
                    📞 Hotline: (+84) 123 456 789
                </span>
                
                <span class="hidden sm:flex px-4 items-center gap-1.5 hover:text-white transition cursor-pointer">
                    📭 Email: export@yourcompany.vn
                </span>
                
                <span class="hidden md:flex pl-4 items-center gap-1.5">
                    ⏰ Giờ làm việc: 07:30 - 18:00
                </span>
            </div>

            <div class="flex gap-3 font-medium">
                <a href="#" class="text-white hover:text-[#f5b041] transition">VN</a>
                <span class="text-white/30">|</span>
                <a href="#" class="hover:text-[#f5b041] transition">EN</a>
            </div>
    
        </div>
 
        <div class="flex justify-between items-center px-4 py-4 sm:px-8">
            <a href="index.php" class="flex items-center"> 
                <img src="gallery/lamexportlogo.jpg" alt="Lam Export Logo" class="h-28 md:h-36 w-auto object-contain">
            </a>
            

            <div class="hidden md:flex flex-1 max-w-xl mx-8 relative">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." 
                       class="w-full border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:border-brand">
                <button class="bg-[#1a2954] text-white px-8 font-bold text-sm rounded-r-md hover:bg-[#f5b041] transition whitespace-nowrap">
                    Tìm kiếm
                </button>
            </div>

        </div>

        <nav class="bg-gray-100 border-t border-gray-200">
            <ul class="flex justify-center gap-6 py-3 font-medium text-sm sm:text-base text-gray-700">
                <li><a href="index.php" class="<?php echo ($active_page == 'home') ? 'text-[#f5b041] underline underline-offset-4 decoration-2' : 'hover:text-[#f5b041]'; ?> transition">Trang chủ</a></li>
                
                <li><a href="products.php" class="<?php echo ($active_page == 'products') ? 'text-[#f5b041] underline underline-offset-4 decoration-2' : 'hover:text-[#f5b041]'; ?> transition">Sản phẩm</a></li>
                
                <li><a href="#" class="hover:text-[#f5b041] transition">Chính sách</a></li>
                <li><a href="#" class="hover:text-[#f5b041] transition">Chứng nhận</a></li>
                <li><a href="#" class="hover:text-[#f5b041] transition">Tin tức</a></li>
                <li><a href="#" class="hover:text-[#f5b041] transition">Liên hệ</a></li>
            </ul>
</nav>
    </header>