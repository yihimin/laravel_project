<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

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
    Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout'); // 구매
});

// 로그인 및 로그아웃
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', function () {
    return view('auth.login'); // 로그인 페이지를 반환
})->name('login');

Route::get('/admin', [AdminController::class, 'index'])->middleware('session_auth');

// 관리자 경로
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/stats', [AdminController::class, 'stats'])->name('stats');
});

Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [AdminController::class, 'users'])->name('index'); // 사용자 목록
    Route::get('/create', [AdminController::class, 'create'])->name('create'); // 사용자 추가 폼
    Route::post('/store', [AdminController::class, 'store'])->name('store'); // 사용자 저장
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit'); // 사용자 수정 폼
    Route::put('/{id}', [AdminController::class, 'update'])->name('update'); // 사용자 업데이트
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy'); // 사용자 삭제
});

Route::prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('/', [AdminController::class, 'products'])->name('index');
    Route::get('/{id}/edit', [AdminController::class, 'editProduct'])->name('edit');
    Route::put('/{id}', [AdminController::class, 'updateProduct'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'destroyProduct'])->name('destroy');
});

Route::prefix('admin/stats')->name('admin.stats.')->group(function () {
    Route::get('/', [AdminController::class, 'stats'])->name('index');
});


// 관리자 기본 경로 리다이렉트
Route::redirect('/admin', '/admin/products')->name('admin.home');

// 리소스 라우트
Route::resource('main', MainController::class)->except(['create', 'edit']);
