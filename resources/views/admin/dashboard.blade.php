@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4" style="background-color: #f8f9fa">
    <div class="mb-4">
        <h1 class="h3 mb-1" style="color: #0a1f3d">Hi, Welcome back!</h1>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Sales Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 rounded-4 bg-success bg-gradient" style="--bs-bg-opacity: 0.1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-success bg-gradient">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <span class="badge bg-success">{{ $userGrowth['percentage'] > 0 ? '+' : '' }}{{ $userGrowth['percentage'] }}%</span>
                    </div>
                    <h6 class="text-muted mb-1 text-uppercase small">Total Sales</h6>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 rounded-4 bg-primary bg-gradient" style="--bs-bg-opacity: 0.1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-primary bg-gradient">
                            <i class="fas fa-box text-white"></i>
                        </div>
                        <span class="badge bg-primary">{{ $totalProducts ?? 0 }}</span>
                    </div>
                    <h6 class="text-muted mb-1 text-uppercase small">Total Products</h6>
                    <h3 class="fw-bold mb-0">{{ $totalProducts ?? 0 }} Items</h3>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 rounded-4 bg-danger bg-gradient" style="--bs-bg-opacity: 0.1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-danger bg-gradient">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </div>
                        <span class="badge bg-danger">{{ $newOrders ?? 0 }}</span>
                    </div>
                    <h6 class="text-muted mb-1 text-uppercase small">Total Orders</h6>
                    <h3 class="fw-bold mb-0">{{ $newOrders ?? 0 }} Orders</h3>
                </div>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 rounded-4 bg-warning bg-gradient" style="--bs-bg-opacity: 0.1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-warning bg-gradient">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <span class="badge bg-warning">{{ $totalCustomers ?? 0 }}</span>
                    </div>
                    <h6 class="text-muted mb-1 text-uppercase small">Total Customers</h6>
                    <h3 class="fw-bold mb-0">{{ $totalCustomers ?? 0 }} Users</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Statistik -->
    <div class="row g-4 mb-4">
        <!-- Grafik Penjualan -->
        <div class="col-xl-8">
            <div class="card border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="mb-0">Revenue</h4>
                            <div class="d-flex align-items-center gap-2">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge bg-success rounded-circle p-1"></span>
                                    <small class="text-muted">Revenue</small>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge bg-info rounded-circle p-1"></span>
                                    <small class="text-muted">Orders</small>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge bg-danger rounded-circle p-1"></span>
                                    <small class="text-muted">Visits</small>
                                </div>
                            </div>
                        </div>
                        <select class="form-select form-select-sm w-auto" id="revenueRange">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="col-xl-4">
            <div class="card border-0 rounded-4">
                <div class="card-body">
                    <h4 class="mb-4">Statistics</h4>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Users</h6>
                            <span class="text-{{ $userGrowth['percentage'] >= 0 ? 'success' : 'danger' }}">
                                {{ $userGrowth['percentage'] > 0 ? '+' : '' }}{{ $userGrowth['percentage'] }}%
                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $userGrowth['progress'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Orders Status</h6>
                            <div class="d-flex align-items-center gap-2">
                                <div class="small">
                                    <span class="fw-bold">{{ $newOrders }}</span>
                                    <span class="text-muted">New</span>
                                </div>
                                <div class="chart-container" style="width: 50px; height: 50px;">
                                    <canvas id="ordersChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Recent Orders</h4>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = match($order->status) {
                                        'completed' => 'success',
                                        'pending' => 'warning',
                                        'cancelled' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusClass }} bg-gradient">{{ $order->status }}</span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-light btn-sm rounded-circle">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Tidak ada pesanan terbaru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        transition: all 0.3s ease;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .rounded-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
    }
    .table th {
        font-size: 0.875rem;
        font-weight: 500;
    }
    .table td {
        font-size: 0.875rem;
    }
    .progress {
        background-color: rgba(0,0,0,0.05);
    }
    .form-select {
        border-color: #dee2e6;
        padding: 0.25rem 2rem 0.25rem 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initial chart data
    const chartData = @json($chartData);

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: chartData.datasets[0].data,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Orders',
                    data: chartData.datasets[1].data,
                    borderColor: '#0dcaf0',
                    backgroundColor: 'rgba(13, 202, 240, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Visits',
                    data: chartData.datasets[2].data,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $newOrders }}, {{ max(1, $totalOrders - $newOrders) }}],
                backgroundColor: [
                    '#0d6efd',
                    'rgba(0,0,0,0.05)'
                ],
                borderWidth: 0,
                cutout: '80%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Handle revenue range change
    document.getElementById('revenueRange').addEventListener('change', function(e) {
        fetch(`/admin/dashboard/chart-data?period=${e.target.value}`)
            .then(response => response.json())
            .then(data => {
                // Update chart data
                revenueChart.data.labels = data.chartData.labels;
                revenueChart.data.datasets.forEach((dataset, index) => {
                    dataset.data = data.chartData.datasets[index].data;
                });
                revenueChart.update();
            })
            .catch(error => console.error('Error:', error));
    });

    // Update charts every 30 seconds
    setInterval(() => {
        const period = document.getElementById('revenueRange').value;
        fetch(`/admin/dashboard/chart-data?period=${period}`)
            .then(response => response.json())
            .then(data => {
                // Update revenue chart
                revenueChart.data.labels = data.chartData.labels;
                revenueChart.data.datasets.forEach((dataset, index) => {
                    dataset.data = data.chartData.datasets[index].data;
                });
                revenueChart.update();
            })
            .catch(error => console.error('Error:', error));
    }, 30000);
});
</script>
@endpush
@endsection 