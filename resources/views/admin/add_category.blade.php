@extends('admin.maindesign')

@section('add_category')
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">

                @if (session('category_message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                        style="background-color: #198754; color: #fff; border: none;">
                        <strong>Success!</strong> Category added successfully!
                    </div>
                @endif

                <div class="card card-body bg-dark text-white border-0 shadow-sm p-4"
                    style="background-color: #22252a !important;">
                    <h4 class="mb-4 text-uppercase tracking-wider" style="color: #db6574; font-weight: 600;">Add New Category
                    </h4>

                    <form action="{{ route('admin.postaddcategory') }}" method="Post">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="category" class="form-label text-muted mb-2">Category Name</label>
                            <input type="text" id="category" name="category" class="form-control text-white"
                                placeholder="Enter Category Name!"
                                style="background-color: #2d3035; border: 1px solid #343a40;" required>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn px-4"
                                style="background-color: #db6574; color: #fff; font-weight: 500;">
                                Add Category
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary px-3">Cancel</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
