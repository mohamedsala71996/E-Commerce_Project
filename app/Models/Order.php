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
    protected $table = 'orderrs'; 


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
        return $this->belongsToMany(Product::class,'orderr_items')->using(OrderItem::class)->withPivot('product_name','price','quantity','options');
        // return $this->belongsToMany(Product::class,'order_items','order_id','product_id','id','id');
    }

    //relations between orders and order_addresses

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function billing()
    {
        // return $this->addresses()->where('type','billing'); // return collection
        return $this->hasOne(OrderAddress::class.'order_id')->where('type','billing'); // return one 
    }
    public function shipping()
    {
        return $this->hasOne(OrderAddress::class.'order_id')->where('type','shipping');
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
      return  $number+1;
     }
    return $number=now()->format('Y').'0001';

    }



}
