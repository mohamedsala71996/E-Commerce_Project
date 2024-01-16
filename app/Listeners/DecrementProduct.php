<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DecrementProduct
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
       $carts=Cart::get();
       foreach ($carts as $item) {
        $item->product()->update([
            'quantity'=>DB::raw("quantity - $item->quantity" )
        ]);
        // Product::where('id',$item->product_id)->update([
        //     'quantity'=>DB::raw("quantity - $item->quantity" )
        // ]);
       }
    }

    // public function handle($event): void
    // {
    //   $order=$event->order;
    //   foreach ($order->products as $product) {
    //     $product->decrement('quantity',$product->order_items->quantity);
    //   }
   
    // }
}
