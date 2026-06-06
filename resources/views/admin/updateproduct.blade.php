@extends('admin.maindesign')
<base href="/public">

@section('add_product')
    <style>
        .form-container-card {
            background: #191c24 !important;
            border: 1px solid #2c2e3d !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        }

        .dark-form-control {
            background-color: #2a3038 !important;
            color: #ffffff !important;
            border: 1px solid #2c2e3d !important;
            border-radius: 5px;
            padding: 10px 15px;
            width: 100%;
            transition: all 0.2s ease;
        }

        .dark-form-control:focus {
            border-color: #00d2ff !important;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 210, 255, 0.15);
        }

        .image-dashed-box {
            background: rgba(255, 255, 255, 0.02);
            border: 1px dashed #2c2e3d;
            border-radius: 6px;
        }

        .btn-submit-custom {
            background-color: #ffab00 !important;
            color: #000000 !important;
            font-weight: bold;
            border: none;
            padding: 12px;
            border-radius: 5px;
            width: 100%;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-submit-custom:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>

    <div class="container-fluid pt-4 px-4 d-flex justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="d-flex align-items-center mb-4">
                <span class="bg-warning rounded-circle me-2" style="width: 10px; height: 10px; display: inline-block;"></span>
                <h5 class="mb-0 text-white fw-bold">Update Product</h5>
            </div>

            @if (session('product_message'))
                <div class="alert alert-success border-0 text-white mb-4" style="background-color: #00d25b;" role="alert">
                    Product update successfully!
                </div>
            @endif

            <div class="form-container-card p-4 rounded-3">
                <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="Post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold mb-2">PRODUCT TITLE</label>
                        <input type="text" name="product_title" class="dark-form-control"
                            value="{{ $product->product_title }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold mb-2">PRODUCT DESCRIPTION</label>
                        <textarea name="product_description" class="dark-form-control" style="height: 150px; resize: none;">{{ $product->product_description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold mb-2">PRODUCT QUANTITY</label>
                        <input type="number" name="product_quantity" class="dark-form-control"
                            value="{{ $product->product_quantity }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold mb-2">PRODUCT PRICE</label>
                        <input type="number" name="product_price" class="dark-form-control"
                            value="{{ $product->product_price }}">
                    </div>

                    <div class="mb-4 p-3 image-dashed-box">
                        <div class="row align-items-center">
                            <div class="col-auto text-center">
                                <span class="d-block text-muted small fw-bold mb-2">OLD IMAGE</span>
                                <img class="rounded border border-secondary"
                                    style="width: 80px; height: 80px; object-fit: cover;"
                                    src="{{ asset('products/' . $product->product_image) }}">
                            </div>
                            <div class="col">
                                <label class="form-label text-muted small fw-bold mb-2">ADD NEW IMAGE HERE!</label>
                                <input type="file" name="product_image" class="dark-form-control"
                                    style="padding: 7px 12px;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold mb-2">PRODUCT CATEGORY</label>
                        <select name="product_category" class="dark-form-control" style="cursor: pointer;">
                            <option value="{{ $product->product_category }}">
                                {{ $product->product_category }}
                            </option>

                            @foreach ($categoryies as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <input type="submit" name="submit" class="btn-submit-custom" value="Add Product">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
