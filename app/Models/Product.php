<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit',
        'category',
        'image',
        'gallery',
        'tag',
        'min_size',
        'max_size',
        'stock',
        'stock_status',
        'is_featured',
        'is_bestseller',
        'color',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float',
        'min_size' => 'float',
        'max_size' => 'float',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
        'gallery' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'items.product_id', '_id');
    }

    public function getStockLevelAttribute()
    {
        $unit = $this->unit ?? 'kg';
        if ($this->stock > 500) {
            return [
                'status' => 'success',
                'width' => '75%',
                'text' => "Tersedia (> {$this->stock} {$unit})"
            ];
        } elseif ($this->stock > 200) {
            return [
                'status' => 'warning',
                'width' => '50%',
                'text' => "Terbatas (< {$this->stock} {$unit})"
            ];
        } else {
            return [
                'status' => 'danger',
                'width' => '25%',
                'text' => "Sangat Terbatas (< {$this->stock} {$unit})"
            ];
        }
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', '_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(\App\Models\BarangMasuk::class, 'product_id', '_id');
    }
} 