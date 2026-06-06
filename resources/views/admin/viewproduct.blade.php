@extends('admin.maindesign')

@section('view_category')
    <style>
        .custom-table-card {
            background: #191c24 !important;
            border: 1px solid #2c2e3d !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            background-color: #2a3038 !important;
            border: 1px solid #2c2e3d !important;
            border-radius: 6px;
            padding: 4px 8px;
            transition: all 0.2s ease;
            max-width: 320px;
            width: 100%;
        }

        .search-wrapper:focus-within {
            border-color: #00d2ff !important;
        }

        .custom-search-input {
            background: transparent !important;
            border: none !important;
            color: #ffffff !important;
            padding: 6px 10px;
            width: 100%;
            font-size: 0.85rem;
        }

        .custom-search-input:focus {
            outline: none !important;
        }

        .custom-search-input::placeholder {
            color: #6c7293 !important;
        }

        .custom-search-btn {
            background-color: #00d2ff !important;
            color: #0f1116 !important;
            font-weight: 600;
            border: none;
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 0.8rem;
            cursor: pointer;
        }


        .custom-pagination-wrapper .page-link {
            background-color: #2a3038 !important;
            border-color: #2c2e3d !important;
            color: #ffffff !important;
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .custom-pagination-wrapper .page-item.active .page-link {
            background-color: #00d2ff !important;
            border-color: #00d2ff !important;
            color: #0f1116 !important;
            font-weight: bold;
        }
    </style>
    <style>
        .custom-table-card {
            background: #191c24 !important;
            border: 1px solid #2c2e3d !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            transition: all 0.2s ease-in-out;
        }

        /* تأثير الإضاءة والتحجيم عند الوقوف على السطر */
        .custom-table tbody tr:hover {
            background-color: rgba(0, 218, 255, 0.02) !important;
            transform: scale(1.002);
            box-shadow: inset 4px 0 0 #00d2ff;
        }

        .action-btn {
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .product-img-container {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #2c2e3d;
        }
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0 text-white fw-bold d-flex align-items-center">
                <span class="bg-info rounded-circle me-2" style="width: 10px; height: 10px; display: inline-block;"></span>
                Products List (إدارة المنتجات)
            </h5>
            <a href="{{ url('/add_product') }}" class="btn btn-sm btn-info text-dark fw-bold px-3 py-2 action-btn">
                + Add New Product
            </a>
        </div>

        <div class="table-responsive p-4 rounded-3 custom-table-card">
            @if (session('deletecatgory_message'))
                <div class="alert alert-success alert-dismissible fade show mb-4 bg-success text-white border-0"
                    role="alert">
                    <strong>{{ session('deletecatgory_message') }}</strong>
                </div>
            @endif
            @if (session('deleteproduct_message'))
                <div class="alert alert-success alert-dismissible fade show mb-4 bg-success text-white border-0"
                    role="alert">
                    <strong>{{ session('deleteproduct_message') }}</strong>
                </div>
            @endif
            <div class="list-inline-item my-2">
                <form action="{{ route('admin.searchproduct') }}" method="POST" class="p-0 m-0">
                    @csrf
                    <div class="search-wrapper">
                        <input type="search" name="search" class="custom-search-input"
                            placeholder="What are you searching for...">
                        <button type="submit" class="custom-search-btn">Search</button>
                    </div>
                </form>
            </div>

            <table class="table table-dark align-middle m-0 custom-table">
                <thead>
                    <tr class="text-uppercase border-bottom border-secondary text-muted"
                        style="font-size: 0.82rem; letter-spacing: 0.5px;">
                        <th scope="col" class="py-3 px-3">Product Title</th>
                        <th scope="col" class="py-3 px-3" style="width: 25%;">Description</th>
                        <th scope="col" class="py-3 px-3 text-center">Qty</th>
                        <th scope="col" class="py-3 px-3">Price</th>
                        <th scope="col" class="py-3 px-3 text-center">Image</th>
                        <th scope="col" class="py-3 px-3">Category</th>
                        <th scope="col" class="py-3 px-3 text-end" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-bottom border-dark">
                            <td class="py-3 px-3">
                                <span class="text-white fw-bold" style="font-size: 0.95rem;">
                                    {{ $product->product_title }}
                                </span>
                            </td>

                            <td class="py-3 px-3">
                                <p class="text-muted mb-0 small text-truncate" style="max-width: 250px;"
                                    title="{{ $product->product_description }}">
                                    {{ Str::limit($product->product_description, 100, '...') }}
                                </p>
                            </td>

                            <td class="py-3 px-3 text-center">
                                <span class="badge bg-secondary px-2.5 py-1.5 font-monospace">
                                    {{ $product->product_quantity }}
                                </span>
                            </td>

                            <td class="py-3 px-3">
                                <span class="text-success fw-semibold font-monospace">
                                    ${{ number_format($product->product_price, 2) }}
                                </span>
                            </td>

                            <td class="py-3 px-3 text-center">
                                @if ($product->product_image)
                                    <img class="product-img-container"
                                        src="{{ asset('products/' . $product->product_image) }}" alt="Product Image">
                                @else
                                    <span class="text-muted small">No Image</span>
                                @endif
                            </td>

                            <td class="py-3 px-3">
                                <span class="badge rounded-2 border border-info text-info px-2.5 py-1.5"
                                    style="background: rgba(0, 210, 255, 0.05);">
                                    {{ $product->product_category }}
                                </span>
                            </td>

                            <td class="py-3 px-3 text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('admin.updateproduct', $product->id) }}"
                                        class="btn btn-sm btn-outline-warning action-btn px-2.5 py-1.5 fs-7"
                                        style="border-color: rgba(255, 193, 7, 0.2);">
                                        Update
                                    </a>

                                    <a href="{{ route('admin.deleteproduct', $product->id) }}"
                                        onclick="return confirm('Are You Sure?')"
                                        class="btn btn-sm btn-outline-danger action-btn px-2.5 py-1.5 fs-7 ms-2"
                                        style="border-color: rgba(220, 53, 69, 0.2);">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="text-secondary d-block mb-2" style="font-size: 2rem;">📦</i>
                                    <span class="fs-6 d-block">No products found in database.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    {{ $products->links() }}
                </tbody>
            </table>
        </div>
    </div>
@endsection
