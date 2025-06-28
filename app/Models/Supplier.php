<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Supplier extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'suppliers';
    protected $fillable = [
        'name', 'contact', 'email', 'address', 'notes', 'created_at', 'updated_at'
    ];

    public function barangMasuk()
    {
        return $this->hasMany(\App\Models\BarangMasuk::class, 'supplier_id', '_id');
    }
} 