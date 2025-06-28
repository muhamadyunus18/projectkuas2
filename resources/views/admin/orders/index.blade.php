@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders</h1>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Order
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" id="error-alert">{{ session('error') }}</div>
    @endif

    <script>
        setTimeout(function() {
            let alert = document.getElementById('success-alert');
            if(alert) alert.style.display = 'none';
            let alertErr = document.getElementById('error-alert');
            if(alertErr) alertErr.style.display = 'none';
        }, 3500);
    </script>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="order-header mb-3 d-flex justify-content-between align-items-center flex-wrap">
                <ul class="nav nav-pills mb-2">
                    <li class="nav-item"><a class="nav-link {{ request('status') == null ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">All orders</a></li>
                    <li class="nav-item"><a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Processing</a></li>
                    <li class="nav-item"><a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a></li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'completed']) }}">Completed</a>
                    </li>
                </ul>
                <!-- Filter tanggal bisa ditambah di sini -->
            </div>
            <div class="table-responsive">
                <table class="table table-hover order-table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->buyer_name ?? '-' }}</td>
                                <td>{{ $order->buyer_address ?? '-' }}</td>
                                <td>{{ optional($order->created_at)->format('d M Y') ?? '-' }}</td>
                                <td>Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge
                                        {{
                                            $order->status == 'completed' ? 'bg-success' :
                                            ($order->status == 'pending' ? 'bg-warning' :
                                            ($order->status == 'processing' ? 'bg-info text-dark' :
                                            ($order->status == 'cancelled' ? 'bg-danger' : 'bg-secondary')))
                                        }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-light" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete" onclick="return confirm('Yakin hapus pesanan ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                @if ($orders->hasPages())
                    <nav>
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">Previous</a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">Next</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.order-table tbody tr {
    transition: background 0.2s, box-shadow 0.2s;
}
.order-table tbody tr:hover {
    background: #f5f7fa;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.order-table td, .order-table th {
    vertical-align: middle;
}
.order-table .btn-light {
    border: none;
    background: transparent;
    color: #333;
    margin-right: 4px;
    box-shadow: none;
}
.order-table .btn-light:hover {
    color: #007bff;
    background: #e9ecef;
}
.order-header .nav-pills .nav-link.active {
    background: #fff;
    color: #007bff;
    border-bottom: 2px solid #007bff;
}
.order-header .nav-pills .nav-link {
    color: #007bff;
    border-radius: 0;
    margin-right: 8px;
}
/* Fix ukuran ikon panah pagination agar normal */
.pagination i,
.pagination svg,
.fa-chevron-left, .fa-chevron-right, .fa-angle-left, .fa-angle-right {
    font-size: 1.2rem !important;
    width: 1.2em !important;
    height: 1.2em !important;
    vertical-align: middle !important;
    line-height: 1 !important;
}
</style>
@endsection 