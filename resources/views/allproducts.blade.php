@extends('maindesing')

@section('all_products')
    <style>
        /* التنسيقات العامة لصفحة كل المنتجات */
        .all-products-section {
            padding: 80px 0;
            background: radial-gradient(circle at top right, #fdfbfb 0%, #ebedee 100%);
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        .section-title-container h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 50px;
            position: relative;
            letter-spacing: -0.5px;
        }

        .section-title-container h2::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 5px;
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            border-radius: 10px;
        }

        /* كرت المنتج المطور بتأثيرات بصرية ثلاثية الأبعاد */
        .product-card-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* تأثير الحركة والظلال عند الـ Hover */
        .product-card-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        /* تأثير اللمعان الزجاجي العائم عند التمرير */
        .product-card-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
            transform: skewX(-25deg);
            transition: 0.75s;
            z-index: 3;
        }

        .product-card-box:hover::before {
            left: 125%;
        }

        /* حاوية الصورة الموحدة */
        .product-card-box .img-box {
            background-color: #f8fafc;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
            position: relative;
        }

        .product-card-box .img-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .product-card-box:hover .img-box img {
            transform: scale(1.08);
        }

        /* صندوق تفاصيل المنتج */
        .product-card-box .detail-box {
            padding: 24px 20px 12px 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card-box .detail-box h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3rem;
            transition: color 0.2s ease;
        }

        .product-card-box:hover .detail-box h5 {
            color: #0077b6;
        }

        .product-card-box .price-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px dashed #e2e8f0;
        }

        .product-card-box .price-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .product-card-box .price-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #00b4d8;
        }

        /* شارة "جديد" الزجاجية العصرية */
        .product-card-box .badge-new {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(239, 68, 68, 0.9);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            color: #ffffff;
            padding: 4px 14px;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
            z-index: 4;
        }

        /* أزرار الإجراءات داخل الكرت */
        .product-actions {
            display: flex;
            gap: 10px;
            padding: 0 20px 24px 20px;
        }

        .btn-view-details {
            flex: 1;
            background-color: #f1f5f9;
            color: #475569 !important;
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
            padding: 12px 4px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-view-details:hover {
            background-color: #e2e8f0;
            color: #0f172a !important;
        }

        .btn-stripe-pay {
            flex: 1;
            background: linear-gradient(135deg, #635bff, #4f46e5);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
            padding: 12px 4px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(99, 91, 255, 0.15);
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-stripe-pay:hover {
            background: linear-gradient(135deg, #4f46e5, #3730a3);
            box-shadow: 0 6px 18px rgba(99, 91, 255, 0.3);
        }

        /* زر العودة للرئيسية في الأسفل */
        .back-home-container {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }

        .btn-back-home {
            background: #475569;
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1rem;
            padding: 14px 45px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(71, 85, 105, 0.15);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back-home:hover {
            background: #334155;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(71, 85, 105, 0.25);
        }

        .btn-back-home span {
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .btn-back-home:hover span {
            transform: translateX(-5px);
        }
    </style>

    <div class="all-products-section">
        <div class="container">

            <div class="section-title-container text-center">
                <h2>All Products</h2>
            </div>

            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="product-card-box">

                            <div class="badge-new">
                                <span>New</span>
                            </div>

                            <div class="img-box">
                                @if ($product->product_image)
                                    <img src="{{ asset('products/' . $product->product_image) }}"
                                        alt="{{ $product->product_title }}">
                                @else
                                    <img src="{{ asset('products/default.jpg') }}" alt="No Image Available">
                                @endif
                            </div>

                            <div class="detail-box">
                                <h5>{{ $product->product_title }}</h5>

                                <div class="price-box">
                                    <span class="price-label">Price</span>
                                    <span class="price-value">${{ number_format($product->product_price, 2) }}</span>
                                </div>
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('product_details', $product->id) }}" class="btn-view-details">
                                    <span>🔎</span> Details
                                </a>
                                <a href="{{ route('stript', ['price' => $product->product_price]) }}"
                                    class="btn-stripe-pay">
                                    <span>💳</span> Stripe
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="back-home-container">
                <a href="{{ route('index') }}" class="btn-back-home">
                    <span>⬅</span> View Latest Products
                </a>
            </div>

        </div>
    </div>
@endsection
