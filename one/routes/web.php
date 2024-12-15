<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductsController;

// 메인 페이지
Route::get('/', [ProductiController::class, 'index'])->name('home');

// Product 상세보기
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/{id}', [ProductiController::class, 'show'])->name('show');
});

// 장바구니 및 구매
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index'); // 장바구니 페이지
    Route::post('/', [CartController::class, 'store'])->name('store'); // 장바구니에 추가
    Route::delete('/{id}', [CartController::class, 'remove'])->name('remove'); // 장바구니 항목 삭제
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout'); // 구매
});

// 로그인 및 로그아웃
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.get');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->middleware('session_auth');

// 관리자 경로
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/stats', [AdminController::class, 'stats'])->name('stats');
});

// 사용자 라우트
Route::prefix('admin/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.users.index');     // 사용자 목록
    Route::get('/create', [UserController::class, 'create'])->name('admin.users.create'); // 사용자 추가 폼
    Route::post('/', [UserController::class, 'store'])->name('admin.users.store');       // 사용자 저장
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // 사용자 수정 폼
    Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');  // 사용자 수정 저장
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // 사용자 삭제
});

// 제품 관리
Route::prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('/create', [ProductsController::class, 'create'])->name('create');
    Route::post('/', [ProductsController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProductsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/stats')->name('admin.stats.')->group(function () {
    Route::get('/', [AdminController::class, 'stats'])->name('index');
});


// 관리자 기본 경로 리다이렉트
Route::redirect('/admin', '/admin/products')->name('admin.home');

// 리소스 라우트
Route::resource('main', MainController::class)->except(['create', 'edit']);
