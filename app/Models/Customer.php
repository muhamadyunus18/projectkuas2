<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'customer_id');
    }
} 