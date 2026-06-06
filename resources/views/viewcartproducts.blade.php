@extends('maindesing')

@section('viewcart_product')
    <style>
        /* تحسين الحاوية العامة وجعلها متناسقة ومريحة للعين */
        .custom-cart-container {
            padding: 40px 30px;
            background-color: #ffffff;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        /* تحسين حاوية صورة المنتج بداخل الجدول */
        .cart-product-img {
            max-height: 70px;
            width: 70px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 5px;
            background-color: #fff;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cart-product-img:hover {
            transform: scale(1.08);
        }

        /* تحسينات الجدول العصري المبسط */
        .custom-table {
            border-collapse: separate;
            border-spacing: 0 12px;
            background-color: transparent !important;
        }

        .custom-table thead th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.8px;
            background-color: #fafbfc !important;
            color: #718096 !important;
            border: none;
            padding: 16px 20px;
        }

        .custom-table tbody tr {
            background-color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        }

        .custom-table td {
            color: #2d3748 !important;
            vertical-align: middle !important;
            padding: 20px !important;
            border-top: 1px solid #edf2f7 !important;
            border-bottom: 1px solid #edf2f7 !important;
        }

        .custom-table td:first-child {
            border-left: 1px solid #edf2f7 !important;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .custom-table td:last-child {
            border-right: 1px solid #edf2f7 !important;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* تنسيق زر الحذف */
        .cart-delete-btn {
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 16px;
            border-color: #fed7d7 !important;
            color: #e53e3e !important;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .cart-delete-btn:hover {
            background-color: #e53e3e !important;
            color: #fff !important;
            border-color: #e53e3e !important;
        }

        /* كارت الفواتير والشحن الجانبي */
        .checkout-card {
            background-color: #fafbfc !important;
            border: 1px solid #edf2f7 !important;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
            padding: 25px;
        }

        .checkout-card .form-control {
            background-color: #ffffff !important;
            border: 2px solid #edf2f7 !important;
            color: #2d3748 !important;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .checkout-card .form-control:focus {
            border-color: #00b4d8 !important;
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.1);
            outline: none;
        }

        /* أزرار إنهاء الطلب والدفع */
        .submit-order-btn {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            border-radius: 8px;
            padding: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        .submit-order-btn:hover {
            background: linear-gradient(135deg, #1e7e34, #115e21);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
            color: #fff;
        }

        .stripe-payment-btn {
            background: linear-gradient(135deg, #635bff, #4338ca);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 91, 255, 0.25);
        }

        .stripe-payment-btn:hover {
            background: linear-gradient(135deg, #4338ca, #312e81);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 91, 255, 0.35);
            color: #fff;
        }

        /* تفاصيل الفاتورة المصغرة */
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
    </style>

    <div class="container my-5">
        <div class="custom-cart-container">

            <!-- رسالة نجاح تأكيد الطلب -->
            @if (session('confirm_order'))
                <div class="alert alert-success border-0 text-white p-3 mb-4 d-flex align-items-center"
                    style="background-color: #28a745; border-radius: 10px; box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);"
                    role="alert">
                    <span class="me-2" style="font-size: 1.3rem;">🎉</span>
                    <strong>Order Confirmed Successfully!</strong>
                </div>
            @endif

            <h3 class="mb-4 text-dark fw-bold d-flex align-items-center gap-2" style="letter-spacing: -0.5px;">
                <span>🛒</span> Shopping Cart
            </h3>

            <div class="row g-4">
                <!-- جدول المنتجات الجانبي -->
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table align-middle m-0 custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $price = 0;
                                @endphp

                                @forelse ($cart as $cart_product)
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 1rem;">
                                                {{ $cart_product->product->product_title }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-bold font-monospace" style="color: #00b4d8; font-size: 1.1rem;">
                                                ${{ number_format($cart_product->product->product_price, 2) }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if ($cart_product->product->product_image)
                                                <img class="cart-product-img"
                                                    src="{{ asset('products/' . $cart_product->product->product_image) }}"
                                                    alt="{{ $cart_product->product->product_title }}">
                                            @else
                                                <span class="text-muted small bg-light px-3 py-2 rounded-3 border">No
                                                    Image</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('removecartproducts', $cart_product->id) }}"
                                                onclick="return confirm('Are you sure you want to remove this item?')">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger cart-delete-btn">
                                                    Remove
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                    @php
                                        $price = $price + $cart_product->product->product_price;
                                    @endphp

                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="text-center py-5 text-muted bg-white border rounded-4 shadow-sm">
                                            <div class="py-4">
                                                <span class="d-block mb-3" style="font-size: 3rem;">🛒</span>
                                                <h5 class="fw-bold text-dark mb-1">Your cart is empty</h5>
                                                <p class="text-muted small mb-0">Looks like you haven't added anything to
                                                    your cart yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- كارت الشحن والدفع الجانبي -->
                <div class="col-lg-4">
                    @if ($price > 0)
                        <div class="card checkout-card">
                            <!-- ملخص مالي مصغر للفاتورة -->
                            <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">Order Summary</h5>
                            <div class="summary-row text-secondary">
                                <span>Subtotal</span>
                                <span class="font-monospace fw-bold text-dark">${{ number_format($price, 2) }}</span>
                            </div>
                            <div class="summary-row text-secondary mb-4">
                                <span>Shipping</span>
                                <span class="text-success fw-bold">Free</span>
                            </div>
                            <div class="summary-row border-top pt-3 mb-4">
                                <span class="fw-bold text-dark fs-5">Total Price</span>
                                <span class="font-monospace fw-bold fs-5"
                                    style="color: #28a745;">${{ number_format($price, 2) }}</span>
                            </div>

                            <!-- فورم تفاصيل الشحن -->
                            <h5 class="fw-bold text-dark mb-3 pt-2">Shipping Details</h5>
                            <form action="{{ route('confirm_order') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="receiver_address"
                                        class="form-label text-secondary small fw-bold mb-1">Receiver Address</label>
                                    <input type="text" name="receiver_address" id="receiver_address" class="form-control"
                                        placeholder="E.g., 123 Street, Cairo" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="receiver_phone"
                                        class="form-label text-secondary small fw-bold mb-1">Receiver Phone Number</label>
                                    <input type="text" name="receiver_phone" id="receiver_phone" class="form-control"
                                        placeholder="E.g., +201xxxxxxxxx" required>
                                </div>

                                <!-- أزرار الإجراءات منسقة مصلحة برمجياً -->
                                <div class="d-flex flex-column gap-2">
                                    <button type="submit" class="btn submit-order-btn w-100">
                                        ✓ Cash on Delivery
                                    </button>

                                    <a href="{{ route('stript', $price) }}" class="stripe-payment-btn">
                                        💳 Pay Now with Stripe
                                    </a>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
