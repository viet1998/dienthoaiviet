<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TypeproductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// show trong dien thoai
Route::resource('dienthoaiviet', ProductController::class);
// Route::resource('navbar', ProductController::class);

// show trang chu
Route::get('trang-chu', [HomepageController::class, 'showHomePage'])->name('trangchu');	

// show trang quan ly
// Route::get('admin', [AdminController::class, 'showAdmin']);	

//show danh sách sản phẩm loại
Route::get('danh-sach-san-pham', [TypeproductController::class,'showTypeProduct'])->name('type-product');

// goi trang đăng nhập người dùng
Route::get('dang-nhap', [UserController::class,'showLogin'])->name('login');
// goi trang đăng ký người dùng
Route::get('dang-ky', [UserController::class,'showSigup'])->name('sigup');

// show trang đăng nhập Admin
Route::get('admin/login',[AdminController::class, 'showLoginAdmin'])->name('admin-login');