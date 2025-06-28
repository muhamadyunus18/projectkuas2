<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        Supplier::create($request->all());
        if ($request->hasFile('nota')) {
            $notaPath = $request->file('nota')->store('nota_barang_masuk', 'public');
            // simpan $notaPath ke field 'nota' pada setiap BarangMasuk yang dibuat
        }
        $barangMasuk = BarangMasuk::create([
            // ... field lain ...
            'nota' => $notaPath ?? null,
        ]);
        return redirect()->route('admin.suppliers.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Pemasok berhasil diupdate.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Pemasok berhasil dihapus.');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $barangMasukSupplier = BarangMasuk::with('product')
            ->where('supplier_id', $supplier->_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.suppliers.show', [
            'supplier' => $supplier,
            'barangMasukSupplier' => $barangMasukSupplier
        ]);
    }

    public function mutasi($id)
    {
        $supplier = Supplier::findOrFail($id);
        $mutasiBarang = $supplier->barangMasuk()->with('product')->orderBy('tanggal', 'desc')->get();

        return view('admin.suppliers.mutasi', compact('supplier', 'mutasiBarang'));
    }
} 