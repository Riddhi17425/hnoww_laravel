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
}
