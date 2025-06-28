<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Session extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sessions';

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

    protected $casts = [
        'last_activity' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::random(40);
            }
        });
    }
} 