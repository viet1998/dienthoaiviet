<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\NewsController;
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
use App\Http\Middleware;

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

// Route::resource('navbar', ProductController::class);

// ------------ Xử lý user-----------
//
Route::post('dangky',[PageController::class,'postSignup'])->name('dangky');
Route::post('dangnhap',[PageController::class,'postLogin'])->name('dangnhap');
Route::get('dangxuat',[PageController::class,'postLogout'])->name('dangxuat');
// goi trang đăng nhập người dùng
Route::get('dang-nhap', [UserController::class,'showLogin'])->name('login');
// goi trang đăng ký người dùng
Route::get('dang-ky', [UserController::class,'showSigup'])->name('sigup');
// trang cá nhân
Route::get('profile',[PageController::class,'getProfile'])->name('profile');

//Xử lý đơn hàng và đặt hàng
Route::get('addtocart',[PageController::class,'getAddtoCart'])->name('addtocart');
Route::get('reduceitemcart/{id}',[PageController::class,'getReduceItemCart'])->name('reduceitemcart');
Route::get('increaseitemcart/{id}',[PageController::class,'getIncreaseItemCart'])->name('increaseitemcart');
Route::get('del-cart/{id}',[PageController::class,'getDelItemCart'])->name('del_cart');

Route::get('checkout',[PageController::class,'getCheckout'])->name('checkout');
Route::post('checkout',[PageController::class,'postCheckout'])->name('savecheckout');
Route::get('confirmcheckorder',[PageController::class,'getConfirmCheckOrder'])->name('confirmcheckorder');
Route::get('checkorder',[PageController::class,'getCheckOrder'])->name('checkorder');

// ---------------------------

// ------------ Hiển thị sản phẩm-----------
Route::get('dtdd', [PageController::class,'getSmartphone'])->name('smartphone');
// show danh sach hãng
Route::get('dtdd-apple', [PageController::class,'getAppleSmartphone'])->name('apple_smartphone');
Route::get('dtdd-samsung', [PageController::class,'getSamsungSmartphone'])->name('samsung_smartphone');
Route::get('dtdd-oppo', [PageController::class,'getOppoSmartphone'])->name('oppo_smartphone');
Route::get('dtdd-xiaomi', [PageController::class,'getXiaomiSmartphone'])->name('xiaomi_smartphone');
Route::get('dtdd-vivo', [PageController::class,'getVivoSmartphone'])->name('vivo_smartphone');
Route::get('dtdd-realme', [PageController::class,'getRealmeSmartphone'])->name('realme_smartphone');
Route::get('dtdd-oneplus', [PageController::class,'getOneplusSmartphone'])->name('oneplus_smartphone');
// show trang chu
Route::get('trang-chu', [PageController::class, 'showHomePage'])->name('trangchu');	
// show trong dien thoai
Route::get('dtdd/{id}',[PageController::class,'getProduct'])->name('show');
Route::get('dtdd/getbonusprice/{id}',[PageController::class,'getBonusPrice'])->name('getbonusprice');
Route::get('dtdd/checkoutofstock/{id}',[PageController::class,'getCheckOutOfStock'])->name('getbonusprice');
Route::get('search',[PageController::class,'getSearch'])->name('search');
Route::get('dtdd/filter/{id}/{from}/{to}',[PageController::class,'getFilterProduct'])->name('filter');


Route::get('news/{id}',[PageController::class,'getNewsDetail'])->name('shownews');
Route::get('newsindex',[PageController::class,'getNewsIndex'])->name('newsindex');
// ---------------------------

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
// goi trang profile  người dùng
Route::get('trang-ca-nhan', [UserController::class,'showProfileUser'])->name('profile_user');

//-------------------Quản Lý Admin-------------------
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::resource('product', ProductController::class);
	Route::resource('customer', CustomerController::class);
	Route::resource('bill', BillController::class);
	Route::group(['middleware'=>'adminUser'],function(){
		Route::resource('user', UserController::class);
		Route::get('history',[AdminController::class,'getHistoryChange'])->name('history');
	});
	Route::resource('slide', SlideController::class);
	Route::resource('news', NewsController::class);

	Route::get('typeandbrand',[ProductController::class,'getTypeAndBrand'])->name('typeandbrand');
	Route::post('typestore',[ProductController::class,'storeType'])->name('type.store');
	Route::delete('typedestroy/{id}',[ProductController::class,'destroyType'])->name('type.destroy');
	Route::post('brandstore',[ProductController::class,'storeBrand'])->name('brand.store');
	Route::delete('branddestroy/{id}',[ProductController::class,'destroyBrand'])->name('brand.destroy');
	// quản lý product variant
	Route::get('productvariants',[ProductController::class,'getProductVariant'])->name('productvariants');
	Route::get('createvariant/{id}',[ProductController::class,'createVariant'])->name('product.createvariant');
	Route::get('productvariants/{id}/edit',[ProductController::class,'editVariant'])->name('product.editvariant');
	Route::get('removeimage/{id}',[ProductController::class,'removeImage'])->name('remove_image');
	Route::post('storevariant',[ProductController::class,'storeVariant'])->name('product.storevariant');
	Route::post('updatevariant/{id}',[ProductController::class,'updateVariant'])->name('product.updatevariant');
	//sắp xếp sảnphaamr
	Route::get('sortproductvariant/{id}',[ProductController::class,'getSortVariant'])->name('sortproductvariant');
	Route::get('searchproductvariant/{searchname}',[ProductController::class,'getSearchVariant'])->name('searchproductvariant');

	Route::get('sortproduct/{id}',[ProductController::class,'getSortProduct'])->name('sortproduct');
	Route::get('searchproduct/{searchname}',[ProductController::class,'getSearchProduct'])->name('searchproduct');

	Route::get('sortbill/{id}',[BillController::class,'getSortBill'])->name('sortbill');
	Route::get('searchbill/{searchname}',[BillController::class,'getSearchBill'])->name('searchbill');

	Route::get('sortcustomer/{id}',[CustomerController::class,'getSortCustomer'])->name('sortcustomer');
	Route::get('searchcustomer/{searchname}',[CustomerController::class,'getSearchCustomer'])->name('searchcustomer');

	Route::get('sortuser/{id}',[UserController::class,'getSortUser'])->name('sortuser');
	Route::get('searchuser/{searchname}',[UserController::class,'getSearchUser'])->name('searchuser');

	Route::get('searchnews/{searchname}',[NewsController::class,'getSearchNews'])->name('searchnews');
	//show trang dashboard


	Route::get('dashboard',[AdminController::class,'getAdminDashboard'])->name('admin_dashboard');
	Route::get('tinhtongtien',[AdminController::class,'getSumTotalForDay']);
	Route::get('thongkedoanhthu',[AdminController::class,'getDataStatistical']);
});