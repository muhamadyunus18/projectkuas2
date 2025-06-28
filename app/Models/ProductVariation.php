<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'product_variations';

    protected $fillable = [
        'product_id',
        'size',
        'price',
        'stock'
    ];

    protected $casts = [
        'size' => 'float',
        'price' => 'float',
        'stock' => 'integer'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', '_id');
    }
}
