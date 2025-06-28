<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\ProdukSementaraController;
use App\Http\Controllers\Admin\ProductVariationController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Halaman user (bisa diakses tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/content', [ContentController::class, 'index'])->name('content');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/test-auth', function() {
    return auth()->check() ? 'Sudah login' : 'Belum login';
});

// Keranjang
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout (hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/profile', [ProfileController::class, 'allInOne'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard/chart-data', [DashboardController::class, 'updateChartData'])->name('admin.dashboard.chart-data');
        Route::resource('products', ProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
        ]);
        Route::resource('orders', AdminOrderController::class)->names([
            'index' => 'admin.orders.index',
            'create' => 'admin.orders.create',
            'store' => 'admin.orders.store',
            'show' => 'admin.orders.show',
            'edit' => 'admin.orders.edit',
            'update' => 'admin.orders.update',
            'destroy' => 'admin.orders.destroy'
        ]);
        Route::resource('customers', CustomerController::class)->names([
            'index' => 'admin.customers.index',
            'create' => 'admin.customers.create',
            'store' => 'admin.customers.store',
            'show' => 'admin.customers.show',
            'edit' => 'admin.customers.edit',
            'update' => 'admin.customers.update',
            'destroy' => 'admin.customers.destroy'
        ]);
        Route::get('reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');

        Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
        Route::resource('suppliers', SupplierController::class)->names([
            'index' => 'admin.suppliers.index',
            'create' => 'admin.suppliers.create',
            'store' => 'admin.suppliers.store',
            'edit' => 'admin.suppliers.edit',
            'update' => 'admin.suppliers.update',
            'destroy' => 'admin.suppliers.destroy',
            'show' => 'admin.suppliers.show',
        ]);
        Route::prefix('suppliers/{supplier}')->group(function () {
            Route::get('barangmasuk', [BarangMasukController::class, 'index'])
                ->name('admin.suppliers.barangmasuk.index');
            Route::get('barangmasuk/create', [App\Http\Controllers\Admin\BarangMasukController::class, 'create'])
                ->name('admin.suppliers.barangmasuk.create');
            Route::post('barangmasuk', [App\Http\Controllers\Admin\BarangMasukController::class, 'store'])
                ->name('admin.suppliers.barangmasuk.store');
            Route::delete('barangmasuk/{barangmasuk}', [BarangMasukController::class, 'destroy'])
                ->name('admin.suppliers.barangmasuk.destroy');
        });
        Route::get('/admin/suppliers/{supplier}', [SupplierController::class, 'show'])->name('admin.suppliers.show');
        Route::get('suppliers/{supplier}/mutasi', [SupplierController::class, 'mutasi'])->name('admin.suppliers.mutasi');
        Route::resource('produksementara', ProdukSementaraController::class)->names([
            'index' => 'admin.produksementara.index',
            'create' => 'admin.produksementara.create',
            'store' => 'admin.produksementara.store',
            'edit' => 'admin.produksementara.edit',
            'update' => 'admin.produksementara.update',
            'destroy' => 'admin.produksementara.destroy',
        ]);
        Route::post('produksementara/{id}/move-to-product', [ProdukSementaraController::class, 'moveToProduct'])->name('admin.produksementara.moveToProduct');
        Route::post('/product-variations', [ProductVariationController::class, 'store'])->name('admin.product-variations.store');
    });

    // Admin Login Routes (outside middleware)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::post('/konfirmasi-pembayaran/{order}', [OrderController::class, 'konfirmasiPembayaran'])->name('orders.konfirmasiPembayaran');


