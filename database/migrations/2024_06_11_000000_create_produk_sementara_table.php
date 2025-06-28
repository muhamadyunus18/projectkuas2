<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk_sementara', function (Blueprint $table) {
            $table->id('_id');
            $table->string('nama_barang');
            $table->foreignId('pemasok_id')->nullable();
            $table->string('kategori')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jumlah')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->date('tanggal_masuk')->nullable();
            $table->string('status')->default('draft');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk_sementara');
    }
}; 