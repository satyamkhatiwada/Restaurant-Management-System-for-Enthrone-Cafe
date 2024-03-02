<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'items',
        'delivery_address',
        'landmark',
        'total_amount',
        'payment_method',
    ];

    protected $keyType = 'string';  // Set the key type to string

    public $incrementing = false;  // Disable auto-incrementing for the 'id' column

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate a custom order ID starting with 'O' and containing only six characters
            $model->id = 'O' . strtoupper(Str::random(5));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
