<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <title>Order Receipt - #{{ $data->id }}</title>

    <style>
        /* ضبط هوامش الصفحة بالكامل لضمان تمركز العناصر */
        @page {
            margin: 40px 20px;
        }

        body {
            background-color: #0c0e12;
            color: #e4e6eb;
            margin: 0;
            padding: 0;
            font-size: 13px;
            direction: rtl;
            text-align: right;
        }

        /* حاوية الكارت الرئيسية مع تحديد عرض ثابت لتجنب التمدد الأفقي */
        .receipt-card {
            width: 440px;
            margin: 0 auto;
            background-color: #191c24;
            border: 1px solid #2c2e3d;
            border-radius: 12px;
            overflow: hidden;
        }

        /* تنسيق الهيدر العلوي */
        .receipt-header {
            background-color: #2a3038;
            padding: 18px 24px;
            border-bottom: 1px solid #2c2e3d;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-title {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            margin: 0;
            text-align: right;
        }

        .receipt-subtitle {
            font-size: 11px;
            color: #6c7293;
            margin: 4px 0 0 0;
            text-align: right;
        }

        /* وسم الحالة (Status) متناسق في جهة اليسار */
        .status-badge {
            font-size: 11px;
            font-weight: bold;
            padding: 4px 12px;
            background-color: #00d2ff;
            color: #191c24;
            border-radius: 4px;
            text-align: center;
        }

        /* جسم الإيصال الداخلي */
        .receipt-body {
            padding: 24px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 12px 0;
            border-bottom: 1px solid rgba(44, 46, 61, 0.3);
        }

        .info-label {
            font-size: 11px;
            font-weight: bold;
            color: #6c7293;
            text-transform: uppercase;
            text-align: right;
            width: 35%;
            /* نسبة متوازنة للعنوان الجانبي */
        }

        .info-value {
            font-size: 13px;
            font-weight: bold;
            color: #ffffff;
            text-align: left;
            width: 65%;
            /* نسبة كافية لعرض القيم النصية */
        }

        .info-value-light {
            font-size: 13px;
            color: #e4e6eb;
            text-align: left;
            width: 65%;
        }

        /* صندوق بيانات المنتج */
        .product-box {
            background-color: #2a3038;
            border: 1px solid #2c2e3d;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table td {
            padding: 6px 0;
        }

        .product-label {
            font-size: 11px;
            font-weight: bold;
            color: #949aaf;
            text-align: right;
            width: 30%;
        }

        .product-title {
            font-size: 13px;
            font-weight: bold;
            color: #00d2ff;
            text-align: left;
            width: 70%;
        }

        .total-label {
            font-size: 13px;
            font-weight: bold;
            color: #ffffff;
            text-align: right;
        }

        .total-price {
            font-size: 15px;
            font-weight: bold;
            color: #00d25b;
            text-align: left;
        }

        /* الفوتر السفلي الكارت */
        .receipt-footer {
            background-color: #2a3038;
            padding: 14px 24px;
            border-top: 1px solid #2c2e3d;
            text-align: center;
        }

        .footer-text {
            font-size: 11px;
            color: #6c7293;
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="receipt-card">
        <div class="receipt-header">
            <table class="header-table">
                <tr>
                    <td style="text-align: right;">
                        <h3 class="receipt-title">Order Receipt</h3>
                        <p class="receipt-subtitle">تفاصيل طلب العميل</p>
                    </td>
                    <td style="text-align: left; vertical-align: middle;">
                        <span class="status-badge">
                            {{ $data->status ?? 'Active' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="receipt-body">
            <table class="info-table">
                <tr>
                    <td class="info-label">Customer Name</td>
                    <td class="info-value">
                        {{ $data->user->name ?? 'Guest User' }}
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Address</td>
                    <td class="info-value-light">
                        {{ $data->receiver_address }}
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Phone Number</td>
                    <td class="info-value-light" style="direction: ltr; text-align: left;">
                        {{ $data->receiver_phone }}
                    </td>
                </tr>
            </table>

            <div class="product-box">
                <table class="product-table">
                    <tr>
                        <td class="product-label">Product Title</td>
                        <td class="product-title">
                            {{ $data->product->product_title ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #191c24;">
                        <td class="total-label" style="padding-top: 12px;">Total Price</td>
                        <td class="total-price" style="padding-top: 12px; direction: ltr;">
                            ${{ isset($data->product) ? number_format($data->product->product_price, 2) : '0.00' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="receipt-footer">
            <p class="footer-text">Thank you for shopping with us • Giftos Store</p>
        </div>
    </div>

</body>

</html>
