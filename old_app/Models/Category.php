<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeIsActive($query)
    {
        return $query->where('categories.is_active', 0);
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('categories.deleted_at');
    }

}
