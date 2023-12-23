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
    public function parent()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters->name) {
            $builder->where('name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters->status) {
            $builder->where('status', $filters['status']);
        }
    }
}
