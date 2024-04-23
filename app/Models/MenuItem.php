<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description', 'image', 'category_id', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}


