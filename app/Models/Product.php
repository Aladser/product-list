<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; // без времени создания

    protected $casts = [
        'size' => 'array',
        'color' => 'array',
    ];

    public static function activeProducts()
    {
        return Product::where('status', 'available')->select('id', 'articul', 'name', 'data')->get();
    }
}