<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FestivalInquiry extends Model
{
    protected $guarded = [];
    protected $casts = [
        'product_of_interest' => 'array',
    ];
}