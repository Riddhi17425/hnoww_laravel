<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftBlessing extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'add_flowers' => 'boolean',
    ];

    public function blessing()
    {
        return $this->belongsTo(Blessing::class, 'blessing_id', 'id')->withTrashed();
    }
    
}
