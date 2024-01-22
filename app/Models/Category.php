<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'slug',
        'image'
    ];
    // public function parent()
    // {
    //     return $this->belongsTo(Category::class, "parent_id");
    // }
    public function scopeFilter(Builder $builder, $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('categories.name', 'LIKE', "%{$filters['name']}%");
        }
        if (isset($filters['status'])) {
            $builder->where('categories.status', $filters['status']);
        }
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
