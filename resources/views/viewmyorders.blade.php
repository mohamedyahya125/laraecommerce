<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <!-- الخلفية العامة رمادي فاتح مريح يتناسق مع الهيدر -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- كارت خارجي أبيض ناصع مع حدود خفيفة جداً وظل ناعم -->
            <div class="bg-white border border-gray-200 overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6">

                    <style>
                        /* تخصيص الجدول ليتناسب مع الثيم الفاتح المودرن */
                        .custom-table-card {
                            background: #ffffff !important;
                            border: 1px solid #e5e7eb !important;
                        }

                        .custom-table {
                            color: #1f2937 !important;
                            /* نصوص داكنة واضحة للقراءة */
                        }

                        .custom-table th {
                            background-color: #f8fafc !important;
                            /* خلفية رمادية خفيفة جداً لرؤوس الجدول */
                            color: #4b5563 !important;
                            /* لون رمادي داكن احترافي للعناوين */
                            font-weight: 700;
                            text-transform: uppercase;
                            font-size: 0.8rem;
                            letter-spacing: 0.5px;
                            border-bottom: 2px solid #e5e7eb !important;
                        }

                        .custom-table tbody tr {
                            border-bottom: 1px solid #f1f5f9 !important;
                            transition: all 0.2s ease-in-out;
                        }

                        .custom-table tbody tr:hover {
                            background-color: #f8fafc !important;
                            /* تأثير تمرير ناعم جداً */
                        }

                        /* شارات الحالة بنمط الهالة الفاتحة (Soft Badges) */
                        .status-badge {
                            font-size: 0.8rem;
                            font-weight: 600;
                            padding: 6px 12px;
                            border-radius: 9999px;
                            /* شارات دائرية بالكامل لمظهر عصري */
                            display: inline-flex;
                            align-items: center;
                            gap: 4px;
                        }

                        .badge-delivered {
                            background-color: #def7ec !important;
                            color: #03543f !important;
                            border: 1px solid #bcf0da;
                        }

                        .badge-pending {
                            background-color: #fef3c7 !important;
                            color: #92400e !important;
                            border: 1px solid #fde68a;
                        }

                        .badge-canceled {
                            background-color: #fde8e8 !important;
                            color: #9b1c1c !important;
                            border: 1px solid #fbd5d5;
                        }

                        /* حاوية صورة المنتج */
                        .product-img-container {
                            width: 50px;
                            height: 50px;
                            object-fit: cover;
                            border-radius: 8px;
                            border: 1px solid #e5e7eb;
                            display: inline-block;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                        }
                    </style>

                    <div class="container-fluid pt-2 px-2">
                        <!-- هيدر الجدول الداخلي بلون داكن واضح وصريح -->
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="mb-0 text-gray-800 fw-bold d-flex align-items-center" style="font-size: 1.15rem;">
                                <span class="bg-primary rounded-circle me-2"
                                    style="width: 10px; height: 10px; display: inline-block;"></span>
                                Shopping Orders History (سجل طلباتي)
                            </h5>
                        </div>

                        <!-- جدول البيانات الاستجابي -->
                        <div class="table-responsive rounded-3 custom-table-card">
                            <table class="table align-middle m-0 custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3 px-3">Customer Name</th>
                                        <th scope="col" class="py-3 px-3" style="width: 20%;">Address</th>
                                        <th scope="col" class="py-3 px-3 text-center">Phone</th>
                                        <th scope="col" class="py-3 px-3">Product Title</th>
                                        <th scope="col" class="py-3 px-3 text-center">Price</th>
                                        <th scope="col" class="py-3 px-3 text-center">Product Image</th>
                                        <th scope="col" class="py-3 px-3 text-center" style="width: 15%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <!-- اسم العميل -->
                                            <td class="py-3 px-3">
                                                <span class="text-gray-900 fw-bold" style="font-size: 0.9rem;">
                                                    {{ $order->user->name ?? 'Guest User' }}
                                                </span>
                                            </td>

                                            <!-- العنوان -->
                                            <td class="py-3 px-3">
                                                <span class="text-gray-600" style="font-size: 0.85rem;">
                                                    {{ $order->receiver_address }}
                                                </span>
                                            </td>

                                            <!-- رقم الهاتف -->
                                            <td class="py-3 px-3 text-center font-monospace text-gray-600"
                                                style="font-size: 0.85rem;">
                                                {{ $order->receiver_phone }}
                                            </td>

                                            <!-- اسم المنتج -->
                                            <td class="py-3 px-3">
                                                <span class="text-gray-800 fw-semibold" style="font-size: 0.9rem;">
                                                    {{ $order->product->product_title ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <!-- السعر بلون أخضر مريح غير فاقع -->
                                            <td class="py-3 px-3 text-center">
                                                <span class="fw-bold font-monospace"
                                                    style="font-size: 0.95rem; color: #10b981 !important;">
                                                    ${{ isset($order->product) ? number_format($order->product->product_price, 2) : '0.00' }}
                                                </span>
                                            </td>

                                            <!-- صورة المنتج -->
                                            <td class="py-3 px-3 text-center">
                                                @if (isset($order->product) && $order->product->product_image)
                                                    <img class="product-img-container"
                                                        src="{{ asset('products/' . $order->product->product_image) }}"
                                                        alt="Product Image">
                                                @else
                                                    <span
                                                        class="text-gray-400 small bg-gray-100 px-2 py-1 rounded border"
                                                        style="border-color: #e5e7eb !important;">
                                                        No Image
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- الحالات بنمط الـ Soft Badges الحديث -->
                                            <td class="py-3 px-3 text-center">
                                                @if ($order->status == 'Delivered')
                                                    <span class="status-badge badge-delivered">
                                                        ✔ Delivered
                                                    </span>
                                                @elseif($order->status == 'Canceled')
                                                    <span class="status-badge badge-canceled">
                                                        ✕ Canceled
                                                    </span>
                                                @else
                                                    <span class="status-badge badge-pending">
                                                        ⏳ Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <!-- حالة عدم وجود طلبات -->
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-gray-400">
                                                <div class="py-4">
                                                    <span class="d-block mb-2" style="font-size: 2rem;">📦</span>
                                                    <span class="fs-6 d-block text-gray-500">You haven't placed any
                                                        orders yet.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
