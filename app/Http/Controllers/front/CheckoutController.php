<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\CartRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    
  public  function create(CartRepositoryInterface $cart){

    $countries = Countries::getNames();

    return view('front.orders.show',compact('cart','countries'));
  }

  public  function store(Request $request,CartRepositoryInterface $cart){

    DB::beginTransaction();

    try {
        $cartItems = $cart->get()->groupBy('product.store_id')->all();

        foreach ($cartItems as $store_id => $items) {
            $order = Order::create([
                'store_id' => $store_id,
                'user_id' => Auth::id(),
                'payment_method' => 'cod',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }

            foreach ($request->addr as $type => $data) {
                $data['type'] = $type;
                $order->addresses()->create($data);
            }
        }
        $cart->empty();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
    return redirect()->route('home')->with('success', 'Data saved successfully');


  }



}
