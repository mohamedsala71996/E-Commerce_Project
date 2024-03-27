<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderNotification
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
       $order= $event->order;
        $user=User::where('id',$order->user_id)->first();
        $user->notify(new OrderCreatedNotification($order));
    }
}
