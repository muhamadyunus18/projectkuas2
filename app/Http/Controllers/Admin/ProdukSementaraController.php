<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukSementara;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class ProdukSementaraController extends Controller
{
    public function index()
    {
        $items = ProdukSementara::with('pemasok')->latest()->get();
        return view('admin.produksementara.index', compact('items'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.produksementara.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemasok_id' => 'nullable|string',
            'kategori' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'tanggal_masuk' => 'nullable|date',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        ProdukSementara::create($request->all());
        return redirect()->route('admin.produksementara.index')->with('success', 'Barang berhasil ditambahkan ke gudang sementara.');
    }

    public function edit($id)
    {
        $item = ProdukSementara::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.produksementara.edit', compact('item', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $item = ProdukSementara::findOrFail($id);
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'pemasok_id' => 'nullable|string',
            'kategori' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'tanggal_masuk' => 'nullable|date',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        $item->update($request->all());
        return redirect()->route('admin.produksementara.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = ProdukSementara::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.produksementara.index')->with('success', 'Data berhasil dihapus.');
    }

    // Fitur pindahkan ke produk utama
    public function moveToProduct($id)
    {
        $item = ProdukSementara::findOrFail($id);
        // Cek apakah produk sudah ada
        $existing = Product::where('name', $item->nama_barang)->first();
        if ($existing) {
            // Tambah stok jika produk sudah ada
            $existing->stock += $item->jumlah;
            $existing->save();
        } else {
            // Buat produk baru
            Product::create([
                'name' => $item->nama_barang,
                'category' => $item->kategori,
                'min_size' => $item->ukuran,
                'max_size' => $item->ukuran,
                'stock' => $item->jumlah,
                'price' => $item->harga_beli, // harga jual bisa diubah nanti
                'unit' => 'kg',
                'description' => $item->catatan,
                'supplier_id' => $item->pemasok_id,
            ]);
        }
        $item->status = 'dipindahkan';
        $item->save();
        return redirect()->route('admin.produksementara.index')->with('success', 'Barang berhasil dipindahkan ke produk utama.');
    }
} 