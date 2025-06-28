<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    // Proses checkout dari frontend (AJAX)
    public function processCheckout(Request $request)
    {
        // Validasi
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string|max:255',
            'buyer_email' => 'required|email|max:255',
            'buyer_phone' => 'required|string|max:20',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'cart' => 'required',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = json_decode($request->cart, true);
        $total = $request->total;

        // Validasi data keranjang
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kosong!'], 400);
        }

        // Kurangi stok produk
        foreach ($cart as $item) {
            $product = Product::where('name', $item['name'])->first();
            if ($product) {
                $product->stock = max(0, $product->stock - $item['quantity']);
                $product->save();
            }
        }

        // Upload bukti pembayaran jika ada
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('bukti_pembayaran', 'public');
        }

        // Simpan order ke MongoDB
        $order = new Order([
            'user_id' => auth()->id(),
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'email' => $request->buyer_email,
            'phone' => $request->buyer_phone,
            'note' => $request->notes,
            'payment_proof' => $paymentProofPath,
            'items' => $cart,
            'total' => $total,
            'status' => 'pending',
        ]);
        $order->save();

        return response()->json([
            'success' => true,
            'order_id' => $order->_id ?? $order->id,
            'message' => 'Pesanan berhasil dibuat!'
        ]);
    }

    public function checkout(Request $request)
    {
        // Cek data yang diterima
        // dd($request->all()); // Aktifkan ini untuk debug

        $order = new Order();
        $order->buyer_name = $request->buyer_name;
        $order->buyer_address = $request->buyer_address;
        // ... field lain ...
        $order->save();
        // ...
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            // ... validasi lain ...
        ]);
        $order->update($validated);
        // ...
    }

    public function konfirmasiPembayaran(Request $request, $orderId)
    {
        // Cari order berdasarkan _id MongoDB
        $order = \App\Models\Order::where('_id', $orderId)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan!'], 404);
        }
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $path = $file->store('bukti_pembayaran', 'public');
            $order->payment_proof = $path;
            $order->save();
            return response()->json([
                'success' => true,
                'message' => 'Bukti pembayaran berhasil diupload',
                'payment_proof' => $path
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'File bukti pembayaran tidak ditemukan'
        ], 400);
    }
} 