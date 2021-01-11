<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Type_product;
use App\Models\Company;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\User;
use App\Models\Bill_detail;
use Session;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('navbar',function($view){
            
            $type_product=Type_product::all();
            $view->with('type_product',$type_product);
        });

        view()->composer('navbar',function($view){
            
            if(Session('cart')){
                $oldcart= Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        view()->composer('admin.dashboard',function($view){
            $bills=Bill::all();
            $products=Product::all();
            $now = Carbon::now();
            $newbills=Bill::where('date_order',$now)->get();
            $users=User::all();
            $view->with(['bills_count'=>$bills->count(),'products_count'=>$products->count(),'newbills_count'=>$newbills->count(),'users_count'=>$users->count()]);
        });

        view()->composer('header',function($view){
            $loai_sp=Type_product::all();
            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('header',function($view){
            
            if(Session('cart')){
                $oldcart= Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        view()->composer('page.giohang',function($view){
            
            if(Session('cart')){
                $oldcart= Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        view()->composer('page.dathang',function($view){
            
            if(Session('cart')){
                $oldcart= Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        view()->composer('page.loai-sanpham',function($view){
            $loai_sp=Type_product::all();
            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('admin.product_admin',function($view){
            $products=Product::paginate(10);
            $view->with('products',$products);
        });
        view()->composer('page.quanly.quanlydonhang',function($view){
            $bills=Bill::orderBy('date_order','DESC')->get();
            $view->with('bills',$bills);
        });
        view()->composer('page.quanly.quanlykhachhang',function($view){
            $customers=Customer::paginate(10);
            $view->with('customers',$customers);
        });
        view()->composer('page.quanly.quanlytaikhoan',function($view){
            $users=User::paginate(10);
            $view->with('users',$users);
        });
        view()->composer('page.quanly.themsanpham',function($view){
            $product_types=Type_product::all();
            $view->with('product_types',$product_types);
        });
        view()->composer('page.quanly.suasanpham',function($view){
            $product_types=Type_product::all();
            $view->with('product_types',$product_types);
        });
        view()->composer('page.quanly.bangthongke',function($view){
            $products=Product::join('bill_detail', 'products.id', '=', 'bill_detail.id_product')
            ->select('products.id','name','id_type','description','products.unit_price','promotion_price','image','unit','new',Bill_detail::raw('sum(bill_detail.quantity) as product_count'))->groupBy('bill_detail.id_product')->orderByDesc('product_count')->take(5)->get();
            $view->with('products',$products);
        });
        view()->composer('page.quanly.bangthongke',function($view){
            $customers=Customer::join('bills','customer.id','=','bills.id_customer')
            ->select('customer.id','name','email','gender','address','phone_number','customer.note',Bill::raw('count(bills.id_customer) as bills_count'),Bill::raw('sum(bills.total) as totalpaid'))->groupBy('bills.id_customer')->orderBy('bills_count','DESC')->take(5)->get();
            $view->with('customers',$customers);
        });

        view()->composer('page.quanly.bangthongke',function($view){
            $bills=Bill::orderBy('date_order','DESC')->take(5)->get();
            $view->with('bills',$bills);
        });
        view()->composer('page.quanly.bangthongke',function($view){
            $bills=Bill::all();
            $products=Product::all();
            $customers=Customer::all();
            $users=User::all();
            $view->with(['bills_count'=>$bills->count(),'products_count'=>$products->count(),'customers_count'=>$customers->count(),'users_count'=>$users->count()]);
        });
    }
}
