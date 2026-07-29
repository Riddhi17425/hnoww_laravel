<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappGiftBlessing extends Model
{
    use HasFactory;
    protected $fillable = [
        'blessing_id',
        'sender_name',
        'receiver_name',
        'receiver_phone',
    ];

    public function blessing()
    {
        return $this->belongsTo(Blessing::class);
    }
}
