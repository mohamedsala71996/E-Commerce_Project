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
    public function handle(object $event): void
    {
       $carts=Cart::get();
       foreach ($carts as $item) {
        $item->product()->update([
            'quantity'=>DB::raw("quantity - $item->quantity" )
        ]);

       }
    }

}
