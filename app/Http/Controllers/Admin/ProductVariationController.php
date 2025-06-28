<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariation;

class ProductVariationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer'
        ]);

        $variation = ProductVariation::create([
            'product_id' => $validated['product_id'],
            'size' => $validated['size'],
            'price' => $validated['price'],
            'stock' => $validated['stock'] ?? 0
        ]);

        return response()->json([
            'success' => true,
            'variation' => $variation
        ]);
    }
} 