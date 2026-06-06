<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function AddCategory()
    {
        return view('admin.add_category');
    }
    public function postaddcategory(Request $request)
    {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category_message', 'Category added successfully! ');
    }
    public function ViewCategory()
    {
        $categoryies = Category::all();
        return view('admin.view_category', compact('categoryies'));
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('deletecatgory_message', 'Delete successfully!');
    }
    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.postcategoryupdate', compact('category'));
    }
    public function postcategoryupdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('catgory_Update_message', 'Update successfully!');
    }
    public function addproduct()
    {
        $categoryies = Category::all();
        return view('admin.addproduct', compact('categoryies'));
    }
    public function PostAddProduct(Request $request)
    {
        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;
        $image = $request->product_image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $product->product_image = $imagename;
        }
        $product->product_category = $request->product_category;
        $product->save();
        if ($image && $product->save()) {
            $request->product_image->move('products', $imagename);
        }
        return redirect()->back()->with('product_message', 'product added successfully!');
    }
    public function ViewProduct()
    {
        $products = Product::paginate(2);
        return view('admin.viewproduct', compact('products'));
    }
    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);
        $image_path = public_path('products/' . $product->product_image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $product->delete();
        return redirect()->back()->with('deleteproduct_message', 'Product Delete successfully!');
    }
    public function updateproduct($id)
    {
        $product = Product::findOrFail($id);
        $categoryies = Category::all();
        return view('admin.updateproduct', compact('product', 'categoryies'));
    }
    public function postupdateproduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;
        $image = $request->product_image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $product->product_image = $imagename;
        }
        $product->product_category = $request->product_category;
        $product->save();
        if ($image && $product->save()) {
            $request->product_image->move('products', $imagename);
        }
        return redirect()->back()->with('product_message', 'product added successfully!');
    }
    public function searchproduct(Request $request)
    {
        $products = Product::where('product_title', 'LIKE', '%' . $request->search . '%')
            ->orwhere('product_description', 'LIKE', '%' . $request->search . '%')
            ->orwhere('product_category', 'LIKE', '%' . $request->search . '%')
            ->paginate(2);
        return view('admin.viewproduct', compact('products'));
    }
    public function viewOrders()
    {
        $orders = Order::all();
        return view('admin.vieworders', compact('orders'));
    }
    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
    }
    public function downloadPdf($id)
    {
        $data = Order::findOrFail($id);

        // بنجهز الـ HTML من ملف الـ Blade بتاعك
        $html = view('admin.invoice', compact('data'))->render();

        // تشغيل مكتبة mPDF مع تفعيل الـ لغات من اليمين للشمال تلقائياً
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'autoScriptToLang' => true, // سحر: بيتعرف على العربي تلقائياً
            'autoLangToFont' => true,   // سحر: بيختار خط عربي مدمج ومنسق تلقائياً
        ]);

        // كتابة الـ HTML داخل الـ PDF
        $mpdf->WriteHTML($html);

        // تحميل الملف فوراً
        return $mpdf->Output('Invoice_Order_' . $id . '.pdf', 'D');
    }
}
