<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WaiterOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'waiter_id',
        'table_id',
        'items',
        'total_amount',
        'status',
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
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }
}



