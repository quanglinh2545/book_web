<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\Route;
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
        //
        view()->composer('header',function($view){

            $loai_sp = ProductType::all();
            if(Session('cart')){
                $oldCart = Route::get('cart');
                $cart = new Cart($oldCart);
            }
            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('header',function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=> Session::get('cart'),
                'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,
                'totalQty'=>$cart->toltalQty]);
            }
        });
       
    }
    
}
