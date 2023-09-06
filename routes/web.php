<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProuductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/products_detail/{product}', [HomeController::class, 'show'])->name('product.show');
Route::post('/add_product/{product}', [HomeController::class, 'add_cart'])->name('add_product');
Route::get('/show_cart',[HomeController::class, 'show_cart'])->name('show.cart');
Route::delete('/cart_remove/{cart}',[HomeController::class, 'cart_remove'])->name('cart_remove');
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/card_order/{totalprice}', [HomeController::class, 'stripe'])->name('stripe');
Route::post('stripe',[HomeController::class, 'stripePost'] )->name('stripe.post');
Route::get('/show_order',[HomeController::class, 'show_order'])->name('show.order');
Route::get('/show_product',[HomeController::class, 'show_product'])->name('show.product');
Route::get('/cancel_order/{order}',[HomeController::class, 'cancel_order'])->name('cancel.order');
Route::post('/add_comment', [HomeController::class, 'add_comment'])->name('add.comment');
Route::post('/add_reply', [HomeController::class, 'add_reply'])->name('add.reply');
Route::get('/search_product', [HomeController::class, 'search_product'])->name('search.product');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::get('/orders', [OrderController::class,'index'])->name('orders');
    Route::get('/delivered/{order}', [OrderController::class,'delivered'])->name('delivered');
    Route::get('/print_pdf/{order}', [OrderController::class,'print_pdf'])->name('print_pdf');
    Route::get('/search_order', [OrderController::class,'search_order'])->name('search_order');
});

// Route::get('/pp', function(){
//     return view('backend.layouts.app');
// });


require __DIR__ . '/auth.php';
