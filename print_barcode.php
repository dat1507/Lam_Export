<?php
// Nhớ đổi lại đường dẫn file kết nối database của bạn cho đúng nhé
require_once 'connect.php'; 

$product_id = isset($_GET['id']) ? trim($_GET['id']) : '';

if (empty($product_id)) {
    die("Please provide the product ID to print label.");
}


$safe_id = mysqli_real_escape_string($conn, $product_id);
$sql = "SELECT id, product_name, price FROM products WHERE id = '$safe_id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Product not found with code: " . htmlspecialchars($product_id));
}

$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Barcode Label</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <style>
        @page {
            size: 74mm 22mm landscape;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            width: 74mm;
            height: 22mm;
            display: flex;
            justify-content: center; 
            align-items: center;
            gap: 2mm;
            background-color: white;
            color: black;
            font-family: Arial, sans-serif;
            -webkit-print-color-adjust: exact;
        }
        
        /* KHUNG CHỨA MỖI TEM */
        .label-box {
            width: 35mm; 
            height: 22mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            align-items: center;
            text-align: center;
            padding: 1mm 2mm; 
            box-sizing: border-box;
            overflow: hidden;
        }
        
        .shop-name {
            font-size: 4.5pt;
            font-weight: bold;
            line-height: 1;
            margin: 0;
            width: 100%;
        }
        
        .divider {
            width: 90%;
            border-top: 0.5pt solid black; 
            margin: 1px 0;
        }
        
        .product-name {
            font-size: 6.5pt;
            font-weight: bold;
            line-height: 1.2; 
            margin: 1px 0; 
            width: 100%;
            display: -webkit-box;
            -webkit-line-clamp: 2; 
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 18px; 
        }
        
        .barcode-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 0;
        }
        
        .barcode-container svg {
            max-width: 95%; 
            height: 22px !important; 
            shape-rendering: crispEdges;
        }
        
        /* Gom ID và Giá tiền lại 1 cục */
        .price-id-block {
            font-size: 6.5pt;
            line-height: 1;
            margin: 0;
            width: 100%;
        }
        .product-id {
            font-size: 7pt; 
            font-weight: 700; 
            letter-spacing: 0.5px; 
            font-family: Arial, sans-serif;
            color: black;
        }
        .price {
            font-size: 7.5pt; 
            font-weight: 700; 
            color: black;
        }
        
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body onload="window.print();">

    <div class="label-box">
        <p class="shop-name">HTX TM & DV QUY<br>NHƠN XANH - LAM EXPORT</p>
        <div class="divider"></div>
        <p class="product-name"><?= htmlspecialchars($product['product_name']) ?></p>
        <div class="barcode-container"><svg id="barcode1"></svg></div>
        <div class="price-id-block">
            <span class="product-id"><?= htmlspecialchars($product['id']) ?></span><br>
            <span class="price"><?= number_format($product['price'], 0, ',', '.') ?> VND/</span>
        </div>
    </div>

    <div class="label-box">
        <p class="shop-name">HTX TM & DV QUY<br>NHƠN XANH - LAM EXPORT</p>
        <div class="divider"></div>
        <p class="product-name"><?= htmlspecialchars($product['product_name']) ?></p>
        <div class="barcode-container"><svg id="barcode2"></svg></div>
        <div class="price-id-block">
            <span class="product-id"><?= htmlspecialchars($product['id']) ?></span><br>
            <span class="price"><?= number_format($product['price'], 0, ',', '.') ?> VND/</span>
        </div>
    </div>

    <script>
        var barcodeValue = "<?= addslashes($product['id']); ?>";
        
        // Cấu hình mã vạch
        var barcodeConfig = {
            format: "CODE128", 
            width: 1.4, 
            height: 22, 
            displayValue: false, 
            margin: 0
        };

        JsBarcode("#barcode1", barcodeValue, barcodeConfig);
        JsBarcode("#barcode2", barcodeValue, barcodeConfig);
    </script>
</body>
</html>