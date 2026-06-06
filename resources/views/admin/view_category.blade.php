@extends('admin.maindesign')

@section('view_category')
    <!-- إضافة ستايل مخصص سريع للأنيميشن والألوان -->
    <style>
        .custom-table-card {
            background: #191c24 !important;
            /* لون متناسق مع ثيم DarkAdmin */
            border: 1px solid #2c2e3d !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            transition: all 0.2s ease-in-out;
        }

        /* تأثير شيك جداً لما تقف بالماوس على أي سطر */
        .custom-table tbody tr:hover {
            background-color: rgba(0, 218, 255, 0.04) !important;
            transform: scale(1.005);
            box-shadow: inset 4px 0 0 #00d2ff;
            /* خط مضيء على الشمال */
        }

        .action-btn {
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="container-fluid pt-4 px-4">
        <!-- عنوان الصفحة -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0 text-white fw-bold d-flex align-items-center">
                <span class="bg-info rounded-circle me-2" style="width: 10px; height: 10px; display: inline-block;"></span>
                Categories List (إدارة الأقسام)
            </h5>
            <a href="{{ url('/add_category') }}" class="btn btn-sm btn-info text-dark fw-bold px-3 py-2 action-btn">
                + Add New Category
            </a>
        </div>

        <!-- كارت الجدول المطور -->
        <div class="table-responsive p-4 rounded-3 custom-table-card">
            @if (session('deletecatgory_message'))
                <div class="alert alert-success mb-4" role="alert">
                    Delete successfully!
                </div>
            @endif
            <table class="table table-dark align-middle m-0 custom-table">
                <thead>
                    <tr class="text-uppercase border-bottom border-secondary text-muted"
                        style="font-size: 0.85rem; letter-spacing: 0.5px;">
                        <th scope="col" class="py-3 px-3" style="width: 15%;">ID</th>
                        <th scope="col" class="py-3 px-3">Category Name</th>
                        <th scope="col" class="py-3 px-3 text-end" style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categoryies as $category)
                        <tr class="border-bottom border-dark">
                            <!-- رقم القسم في Badge رمادي شيك جداً -->
                            <td class="py-3 px-3">
                                <span
                                    class="badge rounded-2 border border-secondary text-white-50 px-2.5 py-2 font-monospace"
                                    style="background: #212529;">
                                    #{{ $category->id }}
                                </span>
                            </td>

                            <!-- اسم القسم بخط واضح وأبيض مريح للعين -->
                            <td class="py-3 px-3">
                                <span class="text-white fw-semibold" style="font-size: 0.95rem;">
                                    {{ $category->category }}
                                </span>
                            </td>

                            <!-- أزرار التحكم الحديثة -->
                            <td class="py-3 px-3 text-end">
                                <a href="{{ route('admin.postcategoryupdate', $category->id) }}"
                                    class="btn btn-sm btn-outline-warning action-btn px-3 py-1.5 fs-7"
                                    style="border-color: rgba(255, 193, 7, 0.3);">
                                    Update
                                </a>
                                <a href="{{ route('admin.categorydelete', $category->id) }}"
                                    onclick="return confirm('Are You Sure')">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger action-btn px-3 py-1.5 fs-7 ms-2"
                                        style="border-color: rgba(220, 53, 69, 0.3);">
                                        Delete
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <!-- رسالة في حال كان الجدول فارغاً بستايل مميز -->
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="text-secondary d-block mb-2" style="font-size: 2rem;">📂</i>
                                    <span class="fs-6 d-block">No categories found in database.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
