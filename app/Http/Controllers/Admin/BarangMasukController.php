<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index($supplier)
    {
        $supplier = Supplier::findOrFail($supplier);
        $barangMasukSupplier = BarangMasuk::with('product')
            ->where('supplier_id', $supplier->_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.suppliers.barangmasuk_index', [
            'supplier' => $supplier,
            'barangMasukSupplier' => $barangMasukSupplier
        ]);
    }

    public function create($supplierId = null)
    {
        // Jika route nested, ambil supplier dari parameter
        $supplier = null;
        if ($supplierId) {
            $supplier = \App\Models\Supplier::findOrFail($supplierId);
        }
        $products = \App\Models\Product::all();
        return view('admin.suppliers.barangmasuk_create', [
            'supplier' => $supplier,
            'products' => $products
        ]);
    }

    public function store(Request $request, $supplierId)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,_id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_beli' => 'required|numeric|min:0',
        ]);

        $supplier = Supplier::findOrFail($supplierId);
        $tanggal = $request->tanggal;
        // Jika format input mengandung 'T', ubah ke format Y-m-d H:i:s
        if (strpos($tanggal, 'T') !== false) {
            $tanggal = str_replace('T', ' ', $tanggal) . ':00';
        }

        // Simpan file nota jika ada
        $notaPath = null;
        if ($request->hasFile('nota')) {
            $notaPath = $request->file('nota')->store('nota_barang_masuk', 'public');
        }

        foreach ($request->items as $item) {
            $total_harga = $item['jumlah'] * $item['harga_beli'];
            $barangMasuk = BarangMasuk::create([
                'tanggal' => $tanggal,
                'supplier_id' => $supplier->_id,
                'product_id' => $item['product_id'],
                'variation_id' => $item['variation_id'] ?? null,
                'jumlah' => $item['jumlah'],
                'harga_beli' => $item['harga_beli'],
                'total_harga' => $total_harga,
                'nota' => $notaPath,
            ]);
            // Update stok produk
            $product = Product::find($item['product_id']);
            if ($product) {
                $product->stock += $item['jumlah'];
                $product->save();
            }
        }

        return redirect()->route('admin.suppliers.barangmasuk.index', $supplier->_id)
            ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function destroy($supplierId, $barangMasukId)
    {
        $barangMasuk = BarangMasuk::findOrFail($barangMasukId);
        $barangMasuk->delete();
        return redirect()->route('admin.suppliers.barangmasuk.index', $supplierId)
            ->with('success', 'Data barang masuk dihapus.');
    }
} 