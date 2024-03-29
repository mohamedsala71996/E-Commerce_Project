<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street_address',
        'city',
        'postal_code',
        'state',
        'country',
    ];
    protected $table = 'orderr_addresses'; 
    public $timestamps=false;

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getNameAttribute() 
    {
        return $this->first_name .' '.$this->last_name;
    }

}
