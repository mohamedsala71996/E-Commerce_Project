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

    protected $hidden=[
        'created_at',
        'updated_at',
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
    public function scopeFilter(Builder $builder,$filter)
    {
      $options= array_merge([
            'status' => null,
            'category_id' => null,
          'store_id' => null,
          'tag_id' => null,
        ],$filter);

        $builder->when($options['status'], function ($builder, $status) {
            $builder->where('status', $status);
        });
        $builder->when($options['category_id'], function ($builder, $category_id) {
            $builder->where('category_id', $category_id);
        });
        $builder->when($options['store_id'], function ($builder, $store_id) {
            $builder->where('store_id', $store_id);
        });
        $builder->when($options['tag_id'], function ($builder, $tag_id) {

            // $builder->whereExists(function ($builder)use ($tag_id){

            //     $builder->select(1)
            //     ->from('product_tag')
            //     ->whereRaw('products.id = product_id')
            //     ->where('tag_id','=',$tag_id);

            // });

            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]); //less performance
            // --------------------------------------------------------------
            // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)', [$value]); //more performance
            // --------------------------------------------------------------
            $builder->whereHas('tags', function ($query) use ($tag_id) {
                $query->whereIn('id', $tag_id);
            }); //less performance
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
