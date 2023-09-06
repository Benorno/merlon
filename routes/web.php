<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});
Route::get('/contact-us', function () {
    return view('contacts');
})->name('contacts');
Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/thank-you', function () {
    return view('thanks');
})->name('thank-you');
Route::get('/404', function () {
    return view('errors.404');
});
Route::get('/504', function () {
    return view('errors.500');
});


Route::view('/no-product', 'no-product')->name('no-product');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/view', [ProductController::class, 'updateViews'])->name('product.view');
Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity/{productId}', [CartController::class,'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/place-order', [OrdersController::class, 'placeOrder'])->name('cart.placeOrder');

Route::get('/orders/{id}', [OrdersController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrdersController::class, 'create'])->name('orders.create');
Route::post('/orders/store', [OrdersController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');

Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
Route::post('/product/request-quote/{productId}', [OrdersController::class, 'requestQuote'])->name('product.requestQuote');

Route::get('/register', [AdminController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AdminController::class, 'register'])->name('register');


Route::middleware('auth.user')->group(function () {


    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/help', [AdminController::class, 'help'])->name('admin.help');
    //product routes
    Route::get('admin/products-list', [AdminDashboardController::class, 'productsTable'])->name('admin.products.index');
    Route::get('admin/products-list/search', [AdminDashboardController::class, 'index'])->name('admin.products.search');
    Route::put('admin/products-list/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('/admin/products-list/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::get('/admin/create-product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    //category routes
    Route::get('/admin/categories-list', [CategoryController::class, 'table'])->name('admin.categories.index');
    Route::get('/admin/categories-list/search', [CategoryController::class, 'table'])->name('admin.categories.search');
    Route::get('/admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/category/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('categories.store');
    //subcategory routes
    Route::get('/admin/subcategories-list', [SubcategoryController::class, 'table'])->name('admin.subcategories.index');
    Route::get('/admin/subcategories-list/search', [SubcategoryController::class, 'table'])->name('admin.subcategories.search');
    Route::get('/admin/subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/admin/subcategory/{id}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/admin/subcategory/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::get('/admin/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/admin/subcategory', [SubcategoryController::class, 'store'])->name('subcategories.store');
    //order routes
    Route::get('/admin/orders', [AdminDashboardController::class,'viewOrders'])->name('admin.orders');
    Route::get('/admin/orders/search', [AdminDashboardController::class,'viewOrders'])->name('admin.search');
    Route::get('/admin/order-details/{orderGroupId}', [AdminDashboardController::class,'showOrderDetails'])->name('admin.orderDetails');
    Route::put('/admin/orders/{orderId}/update-status', [OrdersController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
    //admin profile routes
    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
