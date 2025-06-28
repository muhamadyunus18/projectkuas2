<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer')->latest();
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $orders = $query->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,_id',
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'total' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $order = Order::create($validated);
        $order->buyer_name = $request->buyer_name;
        $order->buyer_address = $request->buyer_address;
        if ($request->hasFile('payment_proof')) {
            $order->payment_proof = $request->file('payment_proof')->store('bukti_pembayaran', 'public');
        }
        if ($request->filled('notes')) {
            $order->notes = $request->notes;
        }
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function show(Order $order)
    {
        $order->load('customer');
        // Filter hanya item yang punya product_id
        $filteredItems = collect($order->items)->filter(function($item) {
            return isset($item['product_id']) || isset($item->product_id);
        });

        $productIds = $filteredItems->map(function($item) {
            return is_array($item) ? $item['product_id'] ?? null : $item->product_id ?? null;
        })->filter()->all();

        $products = \App\Models\Product::whereIn('_id', $productIds)->get()->keyBy('_id');

        // Gabungkan data produk ke setiap item
        $items = collect($order->items)->map(function($item) use ($products) {
            $item = (object) $item;
            $pid = $item->product_id ?? null;
            $item->product = $pid ? ($products[$pid] ?? null) : null;
            return $item;
        });

        $order->items = $items;

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        // Filter hanya item yang punya product_id
        $filteredItems = collect($order->items)->filter(function($item) {
            return isset($item['product_id']) || isset($item->product_id);
        });

        $productIds = $filteredItems->map(function($item) {
            return is_array($item) ? $item['product_id'] ?? null : $item->product_id ?? null;
        })->filter()->all();

        $products = \App\Models\Product::whereIn('_id', $productIds)->get()->keyBy('_id');

        // Gabungkan data produk ke setiap item
        $items = collect($order->items)->map(function($item) use ($products) {
            $item = (object) $item;
            $pid = $item->product_id ?? null;
            $item->product = $pid ? ($products[$pid] ?? null) : null;
            return $item;
        });

        $order->items = $items;

        return view('admin.orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dihapus!');
    }

    public function konfirmasiPembayaran(Request $request, $orderId)
    {
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