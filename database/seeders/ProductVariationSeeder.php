<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariation;
use MongoDB\Laravel\Collection;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua variasi produk yang ada
        ProductVariation::truncate();

        // Ambil semua produk
        $products = Product::all();

        // Definisikan ukuran dan multiplier harga
        $variations = [
            ['size' => 0.3, 'price_multiplier' => 1.0, 'stock_percentage' => 0.4],  // 40% dari total stock
            ['size' => 0.5, 'price_multiplier' => 1.2, 'stock_percentage' => 0.2],  // 20% dari total stock
            ['size' => 0.8, 'price_multiplier' => 1.5, 'stock_percentage' => 0.2],  // 20% dari total stock
            ['size' => 1.0, 'price_multiplier' => 1.8, 'stock_percentage' => 0.2],  // 20% dari total stock
        ];

        foreach ($products as $product) {
            foreach ($variations as $variation) {
                // Hanya buat variasi jika ukuran dalam rentang min_size dan max_size produk
                if ($variation['size'] >= $product->min_size && $variation['size'] <= $product->max_size) {
                    // Hitung stok berdasarkan persentase
                    $stock = floor($product->stock * $variation['stock_percentage']);
                    
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'size' => $variation['size'],
                        'price' => $product->price * $variation['price_multiplier'],
                        'stock' => $stock
                    ]);
                }
            }
        }
    }
}
