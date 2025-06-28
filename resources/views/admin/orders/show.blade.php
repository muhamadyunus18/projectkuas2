@extends('admin.layouts.app')

@section('title', 'Detail Order')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="mb-2">Informasi Order</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID Order:</strong> {{ $order->id }}</li>
                        <li class="list-group-item"><strong>Nama Pemesan:</strong> {{ $order->buyer_name ?? '-' }}</li>
                        <li class="list-group-item"><strong>Alamat Pemesan:</strong> {{ $order->buyer_address ?? '-' }}</li>
                        <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">{{ ucfirst($order->status) }}</span></li>
                        <li class="list-group-item"><strong>Total:</strong> Rp {{ is_numeric($order->total) ? number_format($order->total, 0, ',', '.') : '0' }}</li>
                        <li class="list-group-item"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</li>
                        <li class="list-group-item"><strong>Bukti Pembayaran:</strong><br>
                            @if(!empty($order->payment_proof))
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" style="max-width:200px;max-height:200px;">
                                </a>
                            @else
                                <span class="text-muted">Belum ada bukti pembayaran</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Catatan Tambahan:</strong><br>
                            {{ $order->note ?? '-' }}
                        </li>
                    </ul>
                </div>
            </div>

            <h5 class="mb-3 mt-4">Daftar Produk</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NAMA PRODUK</th>
                            <th>UKURAN</th>
                            <th>QTY</th>
                            <th>HARGA SATUAN</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->name ?? '-' }}</td>
                                <td>{{ $item->size ?? '-' }} mm</td>
                                <td>{{ $item->quantity ?? 0 }} Kg</td>
                                <td>Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $item->price), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format(((int)preg_replace('/[^0-9]/', '', $item->price)) * ((int)$item->quantity), 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .list-group-item {
        background: transparent;
        border: none;
        padding-left: 0;
        padding-right: 0;
    }
    .badge {
        font-size: 1em;
        padding: 0.5em 1em;
        border-radius: 1em;
    }
</style>
@endsection 