<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'net_amount',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'price', 'total_price');
    }
    
}
