<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'store_id',
        'status',
        'slug',
        'image',
        'price',
        'compare_price',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(['name'=>'-']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function booted()
    {

        static::addGlobalScope('store', function (Builder $builder) {
            $user=auth()->user();
            if ($user && $user->user_id) {
                $builder->where('store_id',$user->user_id);
            }
        });
    }

    public function scopeActive(Builder $builder)
    {
            $builder->where('status','active');
    }

    public function getImageUrlAttribute() 
    {
        return 'https://www.mobismea.com/upload/iblock/2a0/2f5hleoupzrnz9o3b8elnbv82hxfh4ld/No%20Product%20Image%20Available.png';
    }

    public function getDiscountPercentAttribute() 
    {
       
        if ($this->compare_price) {
           return (($this->compare_price-$this->price)/$this->compare_price)*100;
        }else{
            return '';
        }
    
        
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
