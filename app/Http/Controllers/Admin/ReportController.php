<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        try {
            // Mengambil data untuk laporan
            $data = [
                'totalOrders' => Order::count() ?? 0,
                'totalRevenue' => Order::where('status', 'completed')->sum('total') ?? 0,
                'totalProducts' => Product::count() ?? 0,
                'totalCustomers' => Customer::count() ?? 0,
                'recentOrders' => Order::with(['customer'])
                    ->latest()
                    ->take(5)
                    ->get(),
                'monthlyRevenue' => $this->getMonthlyRevenue(),
                'productSales' => $this->getProductSales()
            ];

            return view('admin.reports.index', $data);
        } catch (\Exception $e) {
            \Log::error('Error in reports: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat memuat laporan');
        }
    }

    private function getMonthlyRevenue()
    {
        try {
            $revenue = [];
            for ($i = 0; $i < 6; $i++) {
                $month = now()->subMonths($i);
                $revenue[$month->format('M Y')] = Order::where('status', 'completed')
                    ->whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->sum('total') ?? 0;
            }
            return array_reverse($revenue);
        } catch (\Exception $e) {
            \Log::error('Error in monthly revenue: ' . $e->getMessage());
            return [];
        }
    }

    private function getProductSales()
    {
        try {
            // Menggunakan aggregation pipeline untuk menghitung penjualan produk
            $productSales = Order::raw(function($collection) {
                return $collection->aggregate([
                    [
                        '$match' => [
                            'status' => 'completed'
                        ]
                    ],
                    [
                        '$unwind' => '$items'
                    ],
                    [
                        '$group' => [
                            '_id' => '$items.product_id',
                            'total_quantity' => ['$sum' => '$items.quantity'],
                            'total_revenue' => ['$sum' => ['$multiply' => ['$items.price', '$items.quantity']]]
                        ]
                    ],
                    [
                        '$sort' => ['total_quantity' => -1]
                    ],
                    [
                        '$limit' => 5
                    ]
                ]);
            });

            // Ambil detail produk
            $productIds = collect($productSales)->pluck('_id')->toArray();
            $products = Product::whereIn('_id', $productIds)->get();

            // Gabungkan data penjualan dengan detail produk
            return collect($productSales)->map(function($sale) use ($products) {
                $product = $products->firstWhere('_id', $sale['_id']);
                return [
                    'id' => $sale['_id'],
                    'name' => $product ? $product->name : 'Unknown Product',
                    'total_quantity' => $sale['total_quantity'],
                    'total_revenue' => $sale['total_revenue']
                ];
            });
        } catch (\Exception $e) {
            \Log::error('Error in product sales: ' . $e->getMessage());
            return collect([]);
        }
    }
} 