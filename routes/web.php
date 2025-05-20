<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BulkUpdateController;


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

// Hiển thị trang Dashboard (chỉ dành cho user đã đăng nhập)
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth') // Yêu cầu người dùng phải đăng nhập
    ->name('dashboard');

// Hiển thị trang chỉnh sửa hồ sơ cá nhân (chỉ dành cho user đã đăng nhập)
Route::get('/profile/edit', [AuthController::class, 'editProfile'])
    ->middleware('auth') // Yêu cầu đăng nhập trước khi truy cập
    ->name('profile.edit');

// Xử lý cập nhật thông tin hồ sơ cá nhân (chỉ dành cho user đã đăng nhập)
Route::put('/profile/update', [AuthController::class, 'updateProfile'])
    ->middleware('auth') // Yêu cầu đăng nhập để chỉnh sửa thông tin
    ->name('profile.update');


// lichj sử đăng nhập
Route::get('/logs', [LogController::class,'index'])->middleware('auth')->name('logs');
// lịch sử tạo users
Route::get('/userlogs', [LogController::class,'userIndex'])->middleware('auth')->name('userIndex');


// Route sử lý CRUD khách hàng
Route::middleware('auth')->group(function () {
    //Route::get('/new', [CustomerController::class, 'new']);
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    // web.php
    Route::post('/customers/update-multiple', [CustomerController::class, 'updateMultiple']);
});


