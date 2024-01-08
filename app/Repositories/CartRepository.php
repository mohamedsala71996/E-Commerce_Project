<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{
 
    public function get():Collection{

      return  Cart::with(['product'])->where('cookie_id',$this->getCookieId())->get();

    }
    public function add($product_id,$quantity=1){

      $item=Cart::where('cookie_id',$this->getCookieId())
      ->where('product_id',$product_id)->first();
      if (!$item) {
        return Cart::create([
              'cookie_id'=>$this->getCookieId(),
              'user_id'=>Auth::id(),
              'product_id'=>$product_id,
              'quantity'=>$quantity,
            ]);
      }

    //  return Cart::updateOrCreate(['cookie_id'=>$this->getCookieId(),'product_id'=>$product_id],[
    //     // 'cookie_id'=>$this->getCookieId(),
    //     'user_id'=>Auth::id(),
    //     // 'product_id'=>$product_id,
    //     'quantity'=>$quantity,
    //   ]);

    }

    public function update(Product $product,$quantity=1){
      Cart::where('cookie_id',$this->getCookieId())
      ->where('product_id',$product->id)
      ->update([
        'quantity'=>$quantity,
      ]);
    }

    public function delete(Product $product){
      Cart::where('cookie_id',$this->getCookieId())
      ->where('product_id',$product->id)
      ->delete();
    }

    public function empty(){
      Cart::where('cookie_id',$this->getCookieId())
      ->delete();
    }

    public function total(): float{
    return (float) Cart::where('cookie_id',$this->getCookieId())
      ->join('products','products.id','=','carts.product_id')
      ->selectRaw("sum('carts.quantity * products.price') as total")
      ->value('total');
    }

   protected function getCookieId() 
   {
        $cookie_id=Cookie::get('cart_id');
        if (!$cookie_id) {
          $cookie_id=Str::uuid();
          Cookie::queue('cart_id', $cookie_id, 30*24*60);
        }

        return  $cookie_id;
    }

}
