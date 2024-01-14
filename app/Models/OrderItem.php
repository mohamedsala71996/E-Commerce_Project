<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot //عشان جدول وسيط 
{
    use HasFactory;
    // protected $fillable = [
    //     'order_id',
    //     'product_id',
    //     'product_name',
    //     'price',
    //     'quantity',
    //     'options',
    // ];

    public $incrementing = true;

    protected $table = 'orderr_items'; 

    public $timestamps=false;



    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
