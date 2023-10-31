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

    public function activeProducts()
    {
        return $this->where('status', 'available');
    }
}
