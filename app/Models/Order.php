<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    // Tambahkan fillable sesuai kebutuhan
    protected $fillable = [
        'user_id',
        'customer_id',
        'buyer_name',
        'buyer_address',
        'status',
        'total',
        'items',
        'payment_proof',
        'created_at',
        'updated_at',
        'note',
        'email',
        'phone'
        // tambahkan field lain sesuai struktur pesanan kamu
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
