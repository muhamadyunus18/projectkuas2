<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('size', 8, 2); // Ukuran dalam mm
            $table->decimal('price', 15, 2); // Harga
            $table->integer('stock')->default(0); // Stok untuk ukuran spesifik
            $table->timestamps();
            
            // Unique constraint untuk memastikan tidak ada duplikasi ukuran untuk produk yang sama
            $table->unique(['product_id', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
}; 