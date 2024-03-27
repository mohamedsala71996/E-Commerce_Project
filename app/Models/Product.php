<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

    protected $appends=[
        'image_url'
    ];

    protected $hidden=[
        'image',
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
            if ($user && $user->store_id) {
                $builder->where('store_id',$user->store_id);
            }
        });
    }

    public function scopeActive(Builder $builder)
    {
            $builder->where('status','active');
    }

    public function getImageUrlAttribute() 
    {
        if ($this->image) {
            return 'http://127.0.0.1:8000/storage/'.$this->image;
        }
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
            $builder->join('product_tag', 'products.id', '=', 'product_tag.product_id')
            ->where('product_tag.tag_id', '=', $tag_id);
        });
    }

}
