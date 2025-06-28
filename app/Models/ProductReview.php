<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProductReview extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'product_reviews';
    protected $fillable = [
        'product_id', 'user_name', 'review_text', 'rating', 'photo', 'created_at'
    ];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', '_id');
    }
} 