<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome'); 
});
// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

// Xử lý đăng ký tài khoản
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Xử lý đăng xuất
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth') ->group(function (){
    // Hiển thị trang Dashboard (chỉ dành cho user đã đăng nhập)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Hiển thị trang chỉnh sửa hồ sơ cá nhân (chỉ dành cho user đã đăng nhập)
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    // Xử lý cập nhật thông tin hồ sơ cá nhân (chỉ dành cho user đã đăng nhập)
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    // lichj sử đăng nhập
    Route::get('/logs', [LogController::class,'index'])->name('logs');
    // lịch sử tạo users
    Route::get('/userlogs', [LogController::class,'userIndex'])->name('userIndex');
});
// Route sử lý CRUD khách hàng
Route::middleware('auth')->group(function () {
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/update-multiple', [CustomerController::class, 'updateMultiple']);
});
//　quản lý sản phẩm
Route::middleware('auth') -> group(function () {
    Route::get('/index',[ProductController::class,'index'])->name('product.index');
    Route::post('/product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/proLogs', [ProductController::class, 'showLogs'])->name('product.logs');
    Route::get('/doanhthu', [ProductController::class, 'doanhthu'])->name('doanhthu');
});






