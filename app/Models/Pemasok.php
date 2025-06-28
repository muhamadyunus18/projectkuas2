<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pemasok extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pemasok';
    public $timestamps = false;

    protected $fillable = [
        'nama_pemasok',
        'alamat',
        'telepon',
        'email',
    ];
}