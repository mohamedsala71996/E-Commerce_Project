<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    public function store()
    {
        return $this->belongsTo(Store::class, "store_id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    protected static function booted()
    {

        static::addGlobalScope('store', function (Builder $builder) {
            if ($user = auth()->user()->store_id) {
                $builder->where('store_id', $user);
            }
        });
    }
    // protected static function boot()
    // {
    //     parent::boot();

    //     // Check if the user is authenticated and has a store_id
    //     if (Auth::check() && ($user = Auth::user()->store_id)) {
    //         // Apply global scope to filter products based on store_id
    //         static::addGlobalScope('store', function ($builder) use ($user) {
    //             $builder->where('store_id', $user);
    //         });
    //     }
    // }
}