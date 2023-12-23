<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'slug',
        'image'
    ];
    public function parent()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }
    public function scopeFilter(Builder $builder, $filters)
    {

        // $builder->when($filters['name'] ?? false, function ($builder,$value) {

        //     $builder->where('name', 'LIKE', "%{$value}%");
        // });

        // $builder->when($filters['status'] ?? false, function ($builder,$value) {

        //     $builder->where('status', $value);
        // });

        if ($filters->name) {
            $builder->where('name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters->status) {
            $builder->where('status', $filters['status']);
        }
    }
}
