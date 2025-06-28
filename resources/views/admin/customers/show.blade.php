@extends('admin.layouts.app')

@section('title', 'Detail Customer')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Customer</h2>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Profil</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Telepon:</strong> {{ $user->phone ?? '-' }}</li>
                        <li class="list-group-item"><strong>Alamat:</strong> {{ $user->address ?? '-' }}</li>
                        <li class="list-group-item"><strong>Tanggal Daftar:</strong> {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') : '-' }}</li>
                        <li class="list-group-item"><strong>Status Verifikasi Email:</strong> {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}</li>
                        @if($user->profile_photo)
                        <li class="list-group-item"><img src="{{ asset('storage/'.$user->profile_photo) }}" width="80" class="rounded"></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Total Pesanan:</strong> {{ $totalOrders }}</li>
                        <li class="list-group-item"><strong>Total Belanja:</strong> Rp {{ number_format($totalBelanja, 0, ',', '.') }}</li>
                        <li class="list-group-item"><strong>Rata-rata Belanja:</strong> Rp {{ number_format($rataRataBelanja, 0, ',', '.') }}</li>
                        <li class="list-group-item"><strong>Tanggal Order Terakhir:</strong> {{ $orderTerakhir ? \Carbon\Carbon::parse($orderTerakhir->created_at)->format('d-m-Y H:i') : '-' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Riwayat Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Detail Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id ?? '-' }}</td>
                                    <td>{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') : '-' }}</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                    <td>Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if(isset($order->items) && is_array($order->items))
                                            <ul class="mb-0">
                                            @foreach($order->items as $item)
                                                <li>{{ $item['name'] ?? '-' }} ({{ $item['size'] ?? '-' }}) x{{ $item['quantity'] ?? 1 }}</li>
                                            @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pesanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 