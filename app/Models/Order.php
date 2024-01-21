<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'items',
        'delivery_address',
        'landmark',
        'total_amount',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
