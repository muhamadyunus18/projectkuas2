<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProdukSementara extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'produk_sementara';
    public $timestamps = true;

    protected $fillable = [
        'nama_barang',
        'pemasok_id',
        'kategori',
        'ukuran',
        'jumlah',
        'harga_beli',
        'tanggal_masuk',
        'status',
        'catatan',
    ];

    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'pemasok_id', '_id');
    }
} 