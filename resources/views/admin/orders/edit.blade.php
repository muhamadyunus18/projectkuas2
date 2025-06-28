@extends('admin.layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" onsubmit="console.log('submit!')">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" value="{{ $order->buyer_name ?? ($order->customer->name ?? '-') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="buyer_address" class="form-label">Alamat Pemesan</label>
                            <input type="text" class="form-control" value="{{ $order->buyer_address ?? ($order->customer->address ?? '-') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" value="Rp {{ is_numeric($order->total) ? number_format($order->total, 0, ',', '.') : '0' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Daftar Produk</h5>
                        <div id="order-items">
                            @if(isset($order->items) && count($order->items) > 0)
                                @foreach($order->items as $i => $item)
                                    <div class="row align-items-end mb-2 order-item-row">
                                        <div class="col-4">
                                            <label class="form-label">Produk</label>
                                            <input type="text" class="form-control" value="{{ $item->name ?? ($item->product->name ?? '-') }}" readonly>
                                            <input type="hidden" name="items[{{ $i }}][product_id]" value="{{ $item->product_id ?? '' }}">
                                        </div>
                                        <div class="col-2">
                                            <label class="form-label">Ukuran</label>
                                            <input type="text" class="form-control" value="{{ $item->size ?? '-' }} mm" readonly>
                                        </div>
                                        <div class="col-2">
                                            <label class="form-label">Qty</label>
                                            <input type="text" class="form-control" value="{{ $item->quantity ?? 0 }} Kg" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Harga Satuan</label>
                                            <input type="text" class="form-control" value="Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $item->price), 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    Tidak ada item dalam pesanan ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">
                <input type="hidden" name="buyer_name" value="{{ $order->buyer_name }}">
                <input type="hidden" name="buyer_address" value="{{ $order->buyer_address }}">
                <input type="hidden" name="total" value="{{ $order->total }}">
                @foreach($order->items as $i => $item)
                    <input type="hidden" name="items[{{ $i }}][product_id]" value="{{ $item->product_id ?? '' }}">
                    <input type="hidden" name="items[{{ $i }}][quantity]" value="{{ $item->quantity ?? 0 }}">
                    <input type="hidden" name="items[{{ $i }}][price]" value="{{ $item->price ?? 0 }}">
                @endforeach
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .form-label {
        font-weight: 500;
        color: var(--navy);
    }
    .btn-primary {
        background-color: var(--navy);
        border-color: var(--navy);
    }
    .btn-primary:hover {
        background-color: var(--navy-light);
        border-color: var(--navy-light);
    }
    .btn-secondary {
        background-color: var(--gray);
        border-color: var(--gray);
    }
    .btn-secondary:hover {
        background-color: var(--gray-dark);
        border-color: var(--gray-dark);
    }
</style>
@endsection 