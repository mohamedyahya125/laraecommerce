@extends('admin.maindesign')

@section('view_orders')
    <style>
        /* تحسينات الكارت الخارجي والجدول */
        .custom-table-card {
            background: #191c24 !important;
            border: 1px solid #2c2e3d !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            transition: all 0.2s ease-in-out;
            border-bottom: 1px solid #2c2e3d !important;
        }

        .custom-table tbody tr:hover {
            background-color: rgba(0, 218, 255, 0.02) !important;
            box-shadow: inset 4px 0 0 #00d2ff;
        }

        /* تحسين تأثيرات الأزرار */
        .action-btn {
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 210, 255, 0.2);
        }

        /* زر تحميل الـ PDF المطور */
        .pdf-btn {
            background-color: rgba(252, 66, 74, 0.1) !important;
            color: #fc424a !important;
            border: 1px solid rgba(252, 66, 74, 0.2) !important;
            transition: all 0.2s ease;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pdf-btn:hover {
            background-color: #fc424a !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(252, 66, 74, 0.3);
            transform: translateY(-1px);
        }

        /* حاوية الصورة المخصصة للمنتج */
        .product-img-container {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #2c2e3d;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .product-img-container:hover {
            transform: scale(1.1);
        }

        /* تنسيق نصوص الأعمدة */
        .text-muted-custom {
            color: #6c7293 !important;
        }

        /* تنسيق مخصص لقائمة خيارات الحالة (Status Select) */
        .status-select {
            background-color: #2a3038 !important;
            color: #fff !important;
            border: 1px solid #2c2e3d !important;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }

        .status-select:focus {
            border-color: #00d2ff !important;
        }
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0 text-white fw-bold d-flex align-items-center">
                <span class="bg-info rounded-circle me-2" style="width: 10px; height: 10px; display: inline-block;"></span>
                Orders Management (إدارة الطلبات)
            </h5>
            <a href="{{ url('/add_product') }}" class="btn btn-sm btn-info text-dark fw-bold px-3 py-2 action-btn">
                + Add New Product
            </a>
        </div>

        <div class="table-responsive p-4 rounded-3 custom-table-card">
            <table class="table table-dark align-middle m-0 custom-table">
                <thead>
                    <tr class="text-uppercase text-muted-custom" style="font-size: 0.82rem; letter-spacing: 0.5px;">
                        <th scope="col" class="py-3 px-3">Customer Name</th>
                        <th scope="col" class="py-3 px-3" style="width: 20%;">Address</th>
                        <th scope="col" class="py-3 px-3 text-center">Phone</th>
                        <th scope="col" class="py-3 px-3">Product Title</th>
                        <th scope="col" class="py-3 px-3 text-center">Price</th>
                        <th scope="col" class="py-3 px-3 text-center">Product Image</th>
                        <th scope="col" class="py-3 px-3 text-center" style="width: 20%;">Status Actions</th>
                        <th scope="col" class="py-3 px-3 text-center" style="width: 12%;">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <!-- اسم العميل -->
                            <td class="py-3 px-3">
                                <span class="text-white fw-bold" style="font-size: 0.95rem;">
                                    {{ $order->user->name ?? 'Guest User' }}
                                </span>
                            </td>

                            <!-- العنوان -->
                            <td class="py-3 px-3">
                                <span class="text-white-50" style="font-size: 0.9rem;">
                                    {{ $order->receiver_address }}
                                </span>
                            </td>

                            <!-- رقم الهاتف -->
                            <td class="py-3 px-3 text-center font-monospace" style="color: #a5a8ad; font-size: 0.9rem;">
                                {{ $order->receiver_phone }}
                            </td>

                            <!-- اسم المنتج -->
                            <td class="py-3 px-3">
                                <span class="text-info fw-semibold" style="font-size: 0.95rem;">
                                    {{ $order->product->product_title ?? 'N/A' }}
                                </span>
                            </td>

                            <!-- السعر -->
                            <td class="py-3 px-3 text-center">
                                <span class="text-success fw-bold font-monospace"
                                    style="font-size: 1rem; color: #00d25b !important;">
                                    ${{ isset($order->product) ? number_format($order->product->product_price, 2) : '0.00' }}
                                </span>
                            </td>

                            <!-- صورة المنتج -->
                            <td class="py-3 px-3 text-center">
                                @if (isset($order->product) && $order->product->product_image)
                                    <img class="product-img-container"
                                        src="{{ asset('products/' . $order->product->product_image) }}" alt="Product Image">
                                @else
                                    <span class="text-muted small bg-secondary-subtle px-2 py-1 rounded"
                                        style="border: 1px solid #2c2e3d;">No Image</span>
                                @endif
                            </td>

                            <!-- إدارة وتحديث الحالة -->
                            <td class="py-3 px-3 text-center">
                                <form action="{{ route('admin.change_status', $order->id) }}" method="POST"
                                    class="d-flex align-items-center justify-content-center">
                                    @csrf
                                    <select name="status" class="status-select me-2">
                                        <option value="{{ $order->status }}" selected hidden>{{ $order->status }}</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-info action-btn px-2.5 py-1"
                                        style="border-color: rgba(0, 210, 255, 0.3); color: #00d2ff;"
                                        onclick="return confirm('Are You Sure you want to change order status?')">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <!-- زر الـ PDF المطور بنمط أحمر متناسق ومميز -->
                            <td class="py-3 px-3 text-center">
                                <a href="{{ route('admin.downloadpdf', $order->id) }}"
                                    class="btn btn-sm pdf-btn px-2.5 py-1 rounded">
                                    📄 PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <!-- تعديل الـ colspan ليكون 8 ليطابق عدد أعمدة الجدول ويمنع التشويه البصري -->
                            <td colspan="8" class="text-center py-5 text-muted-custom">
                                <div class="py-4">
                                    <span class="d-block mb-2" style="font-size: 2.5rem;">📦</span>
                                    <span class="fs-6 d-block text-white-50">No orders found in database.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
