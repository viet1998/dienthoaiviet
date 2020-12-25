<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhoneproductController;
use App\Http\Controllers\TabletproductController;
use App\Http\Controllers\AccessoriesproductController;
use App\Http\Controllers\WatchproductController;

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

// ------------ giao diện người dùng
// show trang chu
Route::get('trang-chu', [HomepageController::class, 'showHomePage'])->name('trangchu');	
//show danh sách sản phẩm điện thoại
Route::get('dtv', [PhoneproductController::class,'showDTV'])->name('phone');
// show danh sach tablet
Route::get('may-tinh-bang', [TabletproductController::class,'showTablet'])->name('tablet');
// show trang phụ kiện
Route::get('Phu-kien',[AccessoriesproductController::class, 'showAccessories'])->name('accessories');
// show trang đồng hồ
Route::get('dong-ho-deo-tay',[WatchproductController::class, 'showWatch'])->name('watch');
// show trang bán sim
// show trang thông tin trả góp
// show trang sửa chữa
// show trang khuyễn mãi

// goi trang đăng nhập người dùng
Route::get('dang-nhap', [UserController::class,'showLogin'])->name('login');
// goi trang đăng ký người dùng
Route::get('dang-ky', [UserController::class,'showSigup'])->name('sigup');

//--------------------------------------
// show trang đăng nhập Admin
Route::get('admin/login',[AdminController::class, 'showLoginAdmin'])->name('admin-login');