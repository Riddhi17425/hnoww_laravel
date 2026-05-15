<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeIsActive($query)
    {
        return $query->where('products.is_active', 0);
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('products.deleted_at');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    public function tabs()
    {
        return $this->hasMany(ProductTab::class, 'product_id')->where('is_active', 0)->whereNull('deleted_at');
    }

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class, 'product_id', 'id');
    // }
}
