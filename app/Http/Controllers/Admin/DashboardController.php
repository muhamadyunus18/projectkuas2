<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk dashboard
        $data = [
            'totalProducts' => Product::count(),
            'newOrders' => Order::where('status', 'new')->count(),
            'totalOrders' => Order::count(),
            'totalCustomers' => Customer::count(),
            'totalRevenue' => Order::where('status', 'completed')->sum('total'),
            'recentOrders' => Order::with(['customer'])
                ->latest()
                ->take(5)
                ->get(),
            'userGrowth' => $this->calculateUserGrowth(),
            'chartData' => $this->getChartData('daily')
        ];

        return view('admin.dashboard', $data);
    }

    public function getChartData($period = 'daily')
    {
        $now = Carbon::now();
        $data = [];

        switch ($period) {
            case 'daily':
                $startDate = $now->copy()->subDays(6);
                $groupBy = 'date';
                break;
            case 'weekly':
                $startDate = $now->copy()->subWeeks(6);
                $groupBy = 'week';
                break;
            case 'monthly':
                $startDate = $now->copy()->subMonths(6);
                $groupBy = 'month';
                break;
            default:
                $startDate = $now->copy()->subDays(6);
                $groupBy = 'date';
        }

        // Revenue Data
        $revenue = Order::where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(function($date) use ($groupBy) {
                return Carbon::parse($date->created_at)->format($groupBy === 'date' ? 'D' : ($groupBy === 'week' ? 'W' : 'M'));
            })
            ->map(function($group) {
                return $group->sum('total');
            });

        // Orders Count
        $orders = Order::where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(function($date) use ($groupBy) {
                return Carbon::parse($date->created_at)->format($groupBy === 'date' ? 'D' : ($groupBy === 'week' ? 'W' : 'M'));
            })
            ->map(function($group) {
                return $group->count();
            });

        // Visits (jika ada sistem tracking pengunjung)
        // Untuk sementara menggunakan data dummy yang proporsional dengan orders
        $visits = $orders->map(function($count) {
            return $count * 2; // Asumsi setiap order menghasilkan 2 kunjungan
        });

        return [
            'labels' => $revenue->keys(),
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $revenue->values(),
                ],
                [
                    'label' => 'Orders',
                    'data' => $orders->values(),
                ],
                [
                    'label' => 'Visits',
                    'data' => $visits->values(),
                ]
            ]
        ];
    }

    private function calculateUserGrowth()
    {
        $now = Carbon::now();
        $currentMonth = Customer::whereMonth('created_at', $now->month)->count();
        $lastMonth = Customer::whereMonth('created_at', $now->subMonth()->month)->count();
        
        if ($lastMonth > 0) {
            $growth = (($currentMonth - $lastMonth) / $lastMonth) * 100;
        } else {
            $growth = $currentMonth > 0 ? 100 : 0;
        }

        return [
            'percentage' => round($growth, 2),
            'progress' => min(100, ($currentMonth / max(1, $lastMonth)) * 50)
        ];
    }

    public function updateChartData()
    {
        return response()->json([
            'chartData' => $this->getChartData(request('period', 'daily'))
        ]);
    }
} 