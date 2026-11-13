<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - BookStore Application
|--------------------------------------------------------------------------
*/

// Halaman Publik Toko Buku (Storefront)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

// Autentikasi Pengguna & Admin
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Keranjang Belanja & Checkout (Transaksi Pelanggan)
Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');

Route::middleware('auth')->group(function () {
    // 1. Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // 2. Checkout Pesanan (Bayar di Tempat - COD)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // 3. Nota Konfirmasi & Riwayat Pesanan Saya
    Route::get('/orders/success/{order_number}', [CheckoutController::class, 'success'])->name('orders.success');
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{order_number}', [CheckoutController::class, 'showOrder'])->name('orders.detail');
});

// Panel Administrasi (Khusus Role: Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 1. Dashboard Ringkasan
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Kelola Kategori Buku (CRUD)
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);

    // 3. Kelola Data Buku (CRUD & Upload Cover)
    Route::resource('books', BookController::class);

    // 4. List User Terdaftar
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // 5. List Pesanan Buku Pelanggan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    // 6. Kotak Masuk Pesan Pelanggan (Contact Us)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::patch('/contacts/{id}/toggle', [ContactController::class, 'toggleRead'])->name('contacts.toggle');
    Route::patch('/contacts/{id}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
