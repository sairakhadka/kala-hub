<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ArtworkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\FrontendController;
// use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('testdashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/frontend/about_us', [FrontendController::class, 'about_us'])->name(
    'frontend.about_us'
);
Route::get('/frontend/blog-details-slidebar', [
    FrontendController::class,
    'blog_details_slidebar',
])->name('frontend.blog-details-slidebar');
Route::get('/frontend/blog', [FrontendController::class, 'blog'])->name(
    'frontend.blog'
);
Route::get('/frontend/cart', [FrontendController::class, 'cart'])->name(
    'frontend.cart'
);
Route::get('/frontend/checkout', [FrontendController::class, 'checkout'])->name(
    'frontend.checkout'
);
Route::get('/frontend/conceptual', [
    FrontendController::class,
    'conceptual',
])->name('frontend.conceptual');
Route::get('/frontend/contact', [FrontendController::class, 'contact'])->name(
    'frontend.contact'
);
Route::get('/frontend/digitalart', [
    FrontendController::class,
    'digitalart',
])->name('frontend.digitalart');
Route::get('/frontend/drawings', [FrontendController::class, 'drawings'])->name(
    'frontend.drawings'
);
Route::get('/frontend/index-book', [
    FrontendController::class,
    'index-book',
])->name('frontend.index-book');
Route::get('/frontend/login', [FrontendController::class, 'login'])->name(
    'frontend.login'
);
Route::get('/frontend/paintings', [
    FrontendController::class,
    'paintings',
])->name('frontend.paintings');
Route::get('/frontend/photography', [
    FrontendController::class,
    'photography',
])->name('frontend.photography');
Route::get('/frontend/product-details', [
    FrontendController::class,
    'product_details',
])->name('frontend.product-details');
Route::get('/frontend/register', [FrontendController::class, 'register'])->name(
    'frontend.register'
);
Route::get('/frontend/sculpture', [
    FrontendController::class,
    'sculpture',
])->name('frontend.sculpture');
Route::get('/frontend/shop-grid-box', [
    FrontendController::class,
    'shop_grid_box',
])->name('frontend.shop-grid-box');
Route::get('/frontend/shop', [FrontendController::class, 'shop'])->name(
    'frontend.shop'
);
Route::get('/frontend/wishlist', [FrontendController::class, 'wishlist'])->name(
    'frontend.wishlist'
);

Route::get('/hello', [ProfileController::class, 'greet']);
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name(
    'admin.dashboard'
);
Route::get('/admin/customer', [CustomerController::class, 'index'])->name(
    'admin.customer'
);
Route::get('/admin/category', [CategoryController::class, 'index'])->name(
    'admin.category'
);
Route::get('/admin/delivery', [DeliveryController::class, 'index'])->name(
    'admin.delivery'
);
Route::get('/admin/order', [OrderController::class, 'index'])->name(
    'admin.order'
);
Route::get('/admin/transaction', [TransactionController::class, 'index'])->name(
    'admin.transaction'
);
Route::get('/admin/artist', [ArtistController::class, 'index'])->name(
    'admin.artist'
);
Route::get('/admin/artwork', [ArtworkController::class, 'index'])->name(
    'admin.artwork.index'
);

Route::get('customers/index', [CustomerController::class, 'index'])->name(
    'customer.index'
);
Route::post('customer/add', [CustomerController::class, 'store'])->name(
    'customer.add'
);
Route::get('customer/create', [CustomerController::class, 'create'])->name(
    'customer.create'
);
Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name(
    'customer.edit'
);
Route::post('customer/edit', [CustomerController::class, 'update'])->name(
    'customer.insertEdit'
);
Route::get('customer/status/{id}', [CustomerController::class, 'status'])->name(
    'customer.status'
);

Route::post('artwork/add', [ArtworkController::class, 'store'])->name(
    'artwork.add'
);
Route::get('artwork/create', [ArtworkController::class, 'create'])->name(
    'artwork.create'
);
Route::get('artwork/edit/{id}', [ArtworkController::class, 'edit'])->name(
    'artwork.edit'
);
Route::post('artwork/edit', [ArtworkController::class, 'update'])->name(
    'artwork.insertEdit'
);
Route::get('artwork/{id}/delete', [ArtworkController::class, 'destroy'])->name(
    'artwork.delete'
);

Route::get('artist/index', [ArtistController::class, 'index'])->name(
    'artist.index'
);
Route::post('artist/add', [ArtistController::class, 'store'])->name(
    'artist.add'
);
Route::get('artist/create', [ArtistController::class, 'create'])->name(
    'artist.create'
);
Route::get('artist/edit/{id}', [ArtistController::class, 'edit'])->name(
    'artist.edit'
);
Route::post('artist/edit', [ArtistController::class, 'update'])->name(
    'artist.insertEdit'
);
Route::get('artist/{id}/delete', [ArtistController::class, 'destroy'])->name(
    'artist.delete'
);

Route::get('category/index', [CategoryController::class, 'index'])->name(
    'category.index'
);
Route::get('category/create', [CategoryController::class, 'create'])->name(
    'category.create'
);
Route::post('category/add', [CategoryController::class, 'store'])->name(
    'category.add'
);
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name(
    'category.edit'
);

Route::get('category/delete/{id}', [
    CategoryController::class,
    'destroy',
])->name('category.delete');

Route::post('category/edit', [CategoryController::class, 'update'])->name(
    'category.insertEdit'
);
Route::get('category/status/{id}', [CategoryController::class, 'status'])->name(
    'category.status'
);

Route::get('delivery/index', [DeliveryController::class, 'index'])->name(
    'delivery.index'
);
Route::post('delivery/add', [DeliveryController::class, 'add'])->name(
    'delivery.add'
);
Route::get('delivery/create', [DeliveryController::class, 'create'])->name(
    'delivery.create'
);
Route::get('delivery/edit/{id}', [DeliveryController::class, 'edit'])->name(
    'delivery.edit'
);
Route::post('delivery/edit', [DeliveryController::class, 'update'])->name(
    'delivery.insertEdit'
);
Route::get('delivery/status/{id}', [DeliveryController::class, 'status'])->name(
    'delivery.status'
);

Route::get('order/index', [OrderController::class, 'index'])->name(
    'order.index'
);
Route::post('order/add', [OrderController::class, 'add'])->name('order.add');
Route::get('order/create', [OrderController::class, 'create'])->name(
    'order.create'
);
Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name(
    'order.edit'
);
Route::post('order/edit', [OrderController::class, 'update'])->name(
    'order.insertEdit'
);
Route::get('order/status/{id}', [OrderController::class, 'status'])->name(
    'order.status'
);

require __DIR__ . '/auth.php';
