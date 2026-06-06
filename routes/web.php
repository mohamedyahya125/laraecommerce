<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [UserController::class, 'home'])->name('index');
Route::get('/product_details{id}', [UserController::class, 'productDetails'])->name('product_details');
Route::get('/allproducts', [UserController::class, 'allProducts'])->name('viewallproducts');
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myorsers', [UserController::class, 'myorsers'])->middleware(['auth', 'verified'])->name('myorsers');
Route::get('/addtocart/{id}', [UserController::class, 'addTOCart'])->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/cartproducts', [UserController::class, 'cartBroducts'])->middleware(['auth', 'verified'])->name('cartproducts');
Route::get('/removecartproducts/{id}', [UserController::class, 'removeCartProducts'])->middleware(['auth', 'verified'])->name('removecartproducts');
Route::post('/confirm_order', [UserController::class, 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');
Route::controller(UserController::class)->middleware(['auth', 'verified'])->group(function () {

    Route::get('stripe/{price}', 'stripe')->name('stript');

    Route::post('stripe', 'stripePost')->name('stripe.post');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('admin')->group(function () {
    Route::get('/add_category', [AdminController::class, 'AddCategory'])->name('admin.add_category');
    Route::post('/postaddcategory', [AdminController::class, 'PostAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'ViewCategory'])->name('admin.view_category');
    Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');
    Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.categoryupdate');
    Route::post('/update_category/{id}', [AdminController::class, 'postcategoryupdate'])->name('admin.postcategoryupdate');
    Route::get('/add_product', [AdminController::class, 'addproduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'PostAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'ViewProduct'])->name('admin.viewproduct');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteproduct'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}', [AdminController::class, 'updateproduct'])->name('admin.updateproduct');
    Route::post('/update_product/{id}', [AdminController::class, 'postupdateproduct'])->name('admin.postupdateproduct');
    Route::any('/search', [AdminController::class, 'searchproduct'])->name('admin.searchproduct');
    Route::get('/vieworders', [AdminController::class, 'viewOrders'])->name('admin.vieworders');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');
    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadPdf'])->name('admin.downloadpdf');
});

require __DIR__ . '/auth.php';
