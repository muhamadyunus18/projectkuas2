<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search sederhana
        if ($search = $request->search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $users = $query->where(function($q){
            $q->where('is_admin', false)->orWhere('role', 'user');
        })->latest()->paginate(10);
        $userIds = $users->pluck('_id')->toArray();
        $orders = \App\Models\Order::whereIn('user_id', $userIds)->get();
        $userStats = [];
        foreach ($userIds as $uid) {
            $userOrders = $orders->where('user_id', $uid);
            $userStats[$uid] = [
                'orders_count' => $userOrders->count(),
                'orders_sum_total' => $userOrders->sum('total'),
            ];
        }
        return view('admin.customers.index', [
            'customers' => $users,
            'customerStats' => $userStats
        ]);
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        if ($request->hasFile('nota')) {
            $notaPath = $request->file('nota')->store('nota_barang_masuk', 'public');
            // simpan $notaPath ke field 'nota'
        }

        Customer::create($validated);
        return redirect()->route('admin.suppliers.barangmasuk.index', $request->supplier_id)
            ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $orders = \App\Models\Order::where('user_id', $user->_id)->orderByDesc('created_at')->get();
        $totalOrders = $orders->count();
        $totalBelanja = $orders->sum('total');
        $rataRataBelanja = $totalOrders > 0 ? $totalBelanja / $totalOrders : 0;
        $orderTerakhir = $orders->first();
        return view('admin.customers.show', [
            'user' => $user,
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalBelanja' => $totalBelanja,
            'rataRataBelanja' => $rataRataBelanja,
            'orderTerakhir' => $orderTerakhir
        ]);
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $customer->update($validated);
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
} 