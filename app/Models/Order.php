<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'user_id',
        'number',
        'payment_method',
        'status',
        'payment_status',
        'shipping',
        'tax',
        'discount',
        'total',
    ];

    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items','product_id','order_id','id','id');
    }



    protected static function booted()
    {

        static::creating(function(Order $order){
            $order->number= Order::getNextOrderNumber();
        });
    }
    public static function getNextOrderNumber()
    {

     $number = Order::whereYear('created_at',now()->format('Y'))->max('number');
     if ($number) {
      return  $number++;
     }
    return $number=now()->format('Y').'0001';

    }



}
