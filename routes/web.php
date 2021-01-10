<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhoneproductController;
use App\Http\Controllers\TabletproductController;
use App\Http\Controllers\AccessoriesproductController;
use App\Http\Controllers\WatchproductController;
use App\Http\Controllers\SimproductController;
// blog controller
use App\Http\Controllers\HirepurchaseBlogController;
use App\Http\Controllers\ServiceBlogController;
// Quan ly admin
use App\Http\Controllers\AdminDashboardController;


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
Route::resource('product', ProductController::class);
// Route::resource('navbar', ProductController::class);

// ------------ giao diện người dùng
//Xử lý giỏ hàng
Route::get('addtocart/{id}/{qty}',[PageController::class,'getAddtoCart'])->name('addtocart');
Route::get('del-cart/{id}',[PageController::class,'getDelItemCart'])->name('del_cart');
// show trang chu
Route::get('trang-chu', [HomepageController::class, 'showHomePage'])->name('trangchu');	
//show danh sách sản phẩm điện thoại

Route::get('smartphone', [PageController::class,'getSmartphone'])->name('smartphone');
// show danh sach tablet
Route::get('smartphone/apple', [PageController::class,'getAppleSmartphone'])->name('apple_smartphone');
Route::get('smartphone/samsung', [PageController::class,'getSamsungSmartphone'])->name('samsung_smartphone');
Route::get('smartphone/oppo', [PageController::class,'getOppoSmartphone'])->name('oppo_smartphone');
Route::get('smartphone/xiaomi', [PageController::class,'getXiaomiSmartphone'])->name('xiaomi_smartphone');
Route::get('smartphone/vivo', [PageController::class,'getVivoSmartphone'])->name('vivo_smartphone');
Route::get('smartphone/realme', [PageController::class,'getRealmeSmartphone'])->name('realme_smartphone');
Route::get('smartphone/oneplus', [PageController::class,'getOneplusSmartphone'])->name('oneplus_smartphone');


// show trang phụ kiện
Route::get('Phu-kien',[AccessoriesproductController::class, 'showAccessories'])->name('accessories');
// show trang đồng hồ
Route::get('dong-ho-deo-tay',[WatchproductController::class, 'showWatch'])->name('watch');
// show trang bán sim
Route::get('sim-so-dep', [SimproductController::class, 'showSim'])->name('sim');
// show trang thông tin trả góp
Route::get('thanh-toan-tra-gop', [HirepurchaseBlogController::class, 'showBlogHps'])->name('hirepurchase');
// show trang sửa chữa
// show trang khuyễn mãi
Route::get('dich-vu', [ServiceBlogController::class, 'showBlogService'])->name('service');
// goi trang đăng nhập người dùng
Route::get('dang-nhap', [UserController::class,'showLogin'])->name('login');
// goi trang đăng ký người dùng
Route::get('dang-ky', [UserController::class,'showSigup'])->name('sigup');

//-------------------Quản Lý Admin-------------------
// show trang đăng nhập Admin
Route::get('admin/login',[AdminController::class, 'showLoginAdmin'])->name('admin-login');
//show trang dashboard
Route::get('admin/thong-ke',[AdminDashboardController::class, 'showindex'])->name('admin-doasboard');