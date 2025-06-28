<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'barang_masuk';
    public $timestamps = true;

    protected $fillable = [
        'tanggal',
        'supplier_id',
        'product_id',
        'variation_id',
        'jumlah',
        'harga_beli',
        'total_harga',
        'nota',
    ];

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id', '_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', '_id');
    }

    public function variation()
    {
        return $this->belongsTo(\App\Models\ProductVariation::class, 'variation_id', '_id');
    }
} 