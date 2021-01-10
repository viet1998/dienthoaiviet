<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Type_product;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\User;
use App\Models\Bill_detail;
use Session;

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
    }
}
