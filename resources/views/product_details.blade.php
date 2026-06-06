@extends('maindesing')
<base href="/public">

@section('product_details')
    <!-- Cart Notification Message -->
    @if (session('cart_message'))
        <div class="container mt-4">
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert"
                style="background-color: #d1e7dd; color: #0f5132; border-radius: 8px;">
                <span class="me-2">✨</span> {{ session('cart_message') ?? 'Added to the cart!' }}
            </div>
        </div>
    @endif

    <style>
        /* تحسينات عامة على خطوط وتناسق الصفحة */
        .product-details-container {
            background-color: #fafbfc;
            color: #2d3748;
            padding: 80px 0;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        /* حاوية الصورة الاحترافية */
        .product-img-box {
            border: 1px solid #eef2f6;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img-box img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
            border-radius: 12px;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .product-img-box img:hover {
            transform: scale(1.03);
        }

        /* تفاصيل النصوص والشارات */
        .badge-stock {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            color: white;
            padding: 6px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }

        .product-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: #1a202c;
            margin-top: 15px;
            line-height: 1.3;
        }

        .product-price {
            font-size: 2.2rem;
            font-weight: 700;
            color: #00b4d8;
            margin: 15px 0 25px 0;
            display: flex;
            align-items: center;
        }

        .section-title-custom {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a202c;
            border-bottom: 3px solid #00b4d8;
            padding-bottom: 6px;
            display: inline-block;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* صندوق مواصفات الفئة والكمية */
        .meta-info-box {
            background-color: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
        }

        .meta-item strong {
            color: #4a5568;
            font-size: 0.85rem;
        }

        .meta-item span {
            color: #1a202c;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* أزرار التحكم ومحدد الكمية المطور */
        .quantity-input-group {
            max-width: 110px;
            border: 2px solid #edf2f7;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .quantity-input-group input {
            border: none;
            font-weight: 700;
            color: #1a202c;
            text-align: center;
            background: transparent;
        }

        .quantity-input-group input:focus {
            box-shadow: none;
            outline: none;
        }

        .btn-action-primary {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 14px 28px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(29, 78, 216, 0.25);
            text-decoration: none;
        }

        .btn-action-primary:hover {
            background: linear-gradient(135deg, #1e40af, #172554);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.35);
        }

        .btn-action-secondary {
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 14px 28px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.25);
            text-decoration: none;
        }

        .btn-action-secondary:hover {
            background: linear-gradient(135deg, #0077b6, #03045e);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.35);
        }

        /* زر الدفع عبر سترايب */
        .btn-stripe-pay {
            background: linear-gradient(135deg, #635bff, #4338ca);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 91, 255, 0.25);
            text-decoration: none;
            margin-top: 15px;
            width: 100%;
        }

        .btn-stripe-pay:hover {
            background: linear-gradient(135deg, #4338ca, #312e81);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 91, 255, 0.35);
        }

        /* قسم التعليقات والمراجعات المطور */
        .reviews-section {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 45px;
            margin-top: 60px;
            border: 1px solid #edf2f7;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        }

        .review-card {
            background: #fafbfc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .review-card:hover {
            transform: translateX(4px);
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border-color: #e2e8f0;
        }

        .avatar-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #4a5568;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .review-author {
            font-weight: 700;
            color: #2d3748;
            font-size: 0.95rem;
        }

        .review-date {
            font-size: 0.8rem;
            color: #a0aec0;
        }

        /* حقول الإدخال المخصصة للفورم */
        .custom-form-control {
            border: 2px solid #edf2f7;
            padding: 12px 18px;
            border-radius: 8px;
            width: 100%;
            background-color: #fafbfc;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .custom-form-control:focus {
            background-color: #ffffff;
            border-color: #00b4d8;
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.1);
            outline: none;
        }
    </style>

    <div class="product-details-container">
        <div class="container">
            <!-- Product Main Row -->
            <div class="row g-5 align-items-center">
                <!-- Product Image Column -->
                <div class="col-lg-6">
                    <div class="product-img-box">
                        @if ($product->product_image)
                            <img src="{{ asset('products/' . $product->product_image) }}"
                                alt="{{ $product->product_title }}">
                        @else
                            <img src="{{ asset('products/default.jpg') }}" alt="No Image Available">
                        @endif
                    </div>
                </div>

                <!-- Product Purchase Meta Column -->
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <span class="badge-stock">✓ In Stock</span>
                        <h1 class="product-title">{{ $product->product_title }}</h1>
                        <div class="product-price">${{ number_format($product->product_price, 2) }}</div>

                        <div class="mb-4">
                            <h4 class="section-title-custom">Description</h4>
                            <p class="text-muted" style="line-height: 1.8; font-size: 0.98rem; text-align: justify;">
                                {{ $product->product_description }}
                            </p>
                        </div>

                        <div class="meta-info-box mb-4">
                            <div class="row row-cols-2 g-3">
                                <div class="meta-item d-flex flex-column">
                                    <strong>Category</strong>
                                    <span>{{ $product->product_category }}</span>
                                </div>
                                <div class="meta-item d-flex flex-column">
                                    <strong>Available Quantity</strong>
                                    <span>{{ $product->product_quantity }} Units</span>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Form Controls -->
                        <form action="#" method="POST">
                            @csrf
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="quantity-input-group">
                                    <input type="number" name="quantity" class="form-control py-2 text-center"
                                        value="1" min="1" max="{{ $product->product_quantity }}">
                                </div>

                                <a href="{{ route('add_to_cart', $product->id) }}" class="btn-action-primary flex-grow-1">
                                    <span>🛒</span> Add to Cart
                                </a>

                                <a href="{{ route('add_to_cart', $product->id) }}"
                                    class="btn-action-secondary flex-grow-1">
                                    <span>⚡</span> Pay Now
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <h3 class="fw-bold text-dark mb-5" style="font-size: 1.6rem; letter-spacing: -0.5px;">Customer Experience
                </h3>

                <div class="row g-5">
                    <!-- Left Side: Add Review Form -->
                    <div class="col-lg-5">
                        <div class="bg-white p-4 rounded-4 border border-light shadow-sm">
                            <h5 class="fw-bold mb-4 text-dark d-flex align-items-center">
                                <span class="me-2 text-warning">★</span> Add Your Review
                            </h5>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Your Name</label>
                                    <input type="text" name="comment_author" class="custom-form-control"
                                        placeholder="E.g., John Doe" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-secondary">Your Message</label>
                                    <textarea name="comment_body" class="custom-form-control" rows="4"
                                        placeholder="Share your experience with this product..." style="resize: none;" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark w-100 py-3 fw-bold rounded-3"
                                    style="letter-spacing: 0.5px;">Submit Review</button>

                                <a href="{{ route('stript', ['price' => $product->product_price]) }}"
                                    class="btn-stripe-pay">
                                    <span>💳</span> Stripe Payment
                                </a>
                            </form>
                        </div>
                    </div>

                    <!-- Right Side: Existing Customer Reviews List -->
                    <div class="col-lg-7">
                        <div class="pe-lg-2" style="max-height: 460px; overflow-y: auto;">
                            <!-- Review Item 1 -->
                            <div class="review-card">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-placeholder">JD</div>
                                        <div>
                                            <h6 class="review-author mb-0">John D.</h6>
                                            <span class="review-date">January 15, 2026</span>
                                        </div>
                                    </div>
                                    <span class="text-warning">★★★★★</span>
                                </div>
                                <p class="mb-0 text-muted small" style="line-height: 1.7; padding-left: 55px;">
                                    These headphones are amazing! The noise cancellation works perfectly on my commute.
                                    Highly recommended!
                                </p>
                            </div>

                            <!-- Review Item 2 -->
                            <div class="review-card">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-placeholder">SM</div>
                                        <div>
                                            <h6 class="review-author mb-0">Sarah M.</h6>
                                            <span class="review-date">December 5, 2025</span>
                                        </div>
                                    </div>
                                    <span class="text-warning">★★★★☆</span>
                                </div>
                                <p class="mb-0 text-muted small" style="line-height: 1.7; padding-left: 55px;">
                                    Great sound quality and very comfortable for long listening sessions. The build quality
                                    feels very premium.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
