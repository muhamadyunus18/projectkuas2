<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function getVariations($id)
    {
        try {
            \Log::info('Mencoba mengambil produk dengan ID: ' . $id);
            
            $product = Product::with('variations')->where('_id', $id)->first();
            
            if (!$product) {
                \Log::error('Produk tidak ditemukan dengan ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            \Log::info('Data produk ditemukan:', [
                'product' => $product->toArray(),
                'variations' => $product->variations->toArray()
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'product' => [
                        'id' => $product->_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'image' => $product->image,
                        'unit' => $product->unit
                    ],
                    'variations' => $product->variations->map(function($variation) {
                        return [
                            'id' => $variation->_id,
                            'size' => $variation->size,
                            'stock' => $variation->stock,
                            'price' => $variation->price
                        ];
                    })->toArray(),
                    'images' => array_values(array_filter(array_merge(
                        $product->image ? [asset('storage/' . $product->image)] : [],
                        is_array($product->gallery) ? array_map(function($img) { return asset('storage/' . $img); }, $product->gallery) : []
                    )))
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saat mengambil variasi produk: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }

    public function addReview(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:100',
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reviews', 'public');
        }

        $review = ProductReview::create([
            'product_id' => $id,
            'user_name' => $request->user_name,
            'review_text' => $request->review_text,
            'rating' => $request->rating,
            'photo' => $photoPath,
            'created_at' => now()
        ]);

        return response()->json(['success' => true, 'review' => $review]);
    }

    public function getReviews($id)
    {
        $reviews = ProductReview::where('product_id', $id)->orderBy('created_at', 'desc')->get();
        $average = $reviews->avg('rating') ?? 0;
        $count = $reviews->count();
        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'average' => round($average, 1),
            'count' => $count
        ]);
    }
}
