<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BarangMasuk;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Jika request dari AJAX (barang masuk), simpan produk minimal
        if ($request->ajax() || $request->wantsJson()) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
            ]);
            $product = Product::create($validated);
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $inputVariations = $request->input('variations', []);
        if (empty($inputVariations) || !is_array($inputVariations)) {
            return back()->withErrors(['variations' => 'Minimal 1 variasi produk diperlukan'])->withInput();
        }

        // Hitung harga utama, total stok, min_size, max_size dari variasi
        $prices = array_map(function($v){ return (int)($v['price'] ?? 0); }, $inputVariations);
        $stocks = array_map(function($v){ return (int)($v['stock'] ?? 0); }, $inputVariations);
        $sizes = array_map(function($v){ return floatval($v['size'] ?? 0); }, $inputVariations);
        $prices = array_filter($prices, fn($v) => $v > 0);
        $stocks = array_filter($stocks, fn($v) => $v > 0);
        $sizes = array_filter($sizes, fn($v) => $v > 0);
        $mainPrice = count($prices) ? min($prices) : 0;
        $maxPrice = count($prices) ? max($prices) : 0;
        $totalStock = array_sum($stocks);
        $minSize = count($sizes) ? min($sizes) : 0;
        $maxSize = count($sizes) ? max($sizes) : 0;

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $mainPrice; // harga utama = harga terkecil
        $product->unit = $request->unit;
        $product->category = $request->category;
        $product->stock = $totalStock;
        $product->min_size = $minSize;
        $product->max_size = $maxSize;
        $product->is_featured = $request->has('is_featured');
        $product->is_bestseller = $request->has('is_bestseller');
        $product->tag = $request->tag;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $filename, 'public');
            $product->image = $path;
        }
        // Galeri gambar
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $img) {
                $filename = uniqid('gallery_') . '.' . $img->getClientOriginalExtension();
                $gallery[] = $img->storeAs('products/gallery', $filename, 'public');
            }
            $product->gallery = $gallery;
        }
        $product->save();

        // Simpan variasi
        foreach ($inputVariations as $var) {
            \App\Models\ProductVariation::create([
                'product_id' => $product->_id,
                'size' => $var['size'],
                'price' => $var['price'],
                'stock' => $var['stock'],
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required',
            'category' => 'required',
            'stock' => 'required|numeric',
            'min_size' => 'required|numeric',
            'max_size' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->category = $request->category;
        $product->stock = $request->stock;
        $product->min_size = $request->min_size;
        $product->max_size = $request->max_size;
        $product->is_featured = $request->has('is_featured');
        $product->is_bestseller = $request->has('is_bestseller');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $filename, 'public');
            $product->image = $path;
        }

        $product->save();

        // Update variasi produk
        $inputVariations = $request->input('variations', []);
        $existingIds = [];
        $totalStock = 0;
        foreach ($inputVariations as $var) {
            $totalStock += isset($var['stock']) ? (int)$var['stock'] : 0;
            if (isset($var['id'])) {
                // Update existing variation
                $variation = \App\Models\ProductVariation::find($var['id']);
                if ($variation) {
                    $variation->size = $var['size'];
                    $variation->price = $var['price'];
                    $variation->stock = $var['stock'];
                    $variation->save();
                    $existingIds[] = $variation->_id;
                }
            } else {
                // Tambah variasi baru
                $newVar = new \App\Models\ProductVariation();
                $newVar->product_id = $product->_id;
                $newVar->size = $var['size'];
                $newVar->price = $var['price'];
                $newVar->stock = $var['stock'];
                $newVar->save();
                $existingIds[] = $newVar->_id;
            }
        }
        // Hapus variasi yang tidak ada di input
        \App\Models\ProductVariation::where('product_id', $product->_id)
            ->whereNotIn('_id', $existingIds)
            ->delete();
        // Update total stok produk
        $product->stock = $totalStock;
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function barangMasuk($id)
    {
        $product = Product::findOrFail($id);
        $barangMasukSupplier = BarangMasuk::with(['product', 'variation'])
            ->where('supplier_id', $product->supplier_id)
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.products.barangmasuk', compact('product', 'barangMasukSupplier'));
    }
} 