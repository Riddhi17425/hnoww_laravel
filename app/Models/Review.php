<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    // is_active: 1 = Active, 0 = In-active
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // is_product_review: 0 = Common review (home page), 1 = Product review
    public function scopeCommon($query)
    {
        return $query->where('is_product_review', 0);
    }

    public function scopeForProduct($query, $productId)
    {
        return $query->where('is_product_review', 1)->where('product_id', $productId);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
