@extends('admin.layouts.app')

@section('title', 'Riwayat Barang Masuk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Riwayat Barang Masuk dari {{ $supplier->name }}</h2>
        <div>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.suppliers.barangmasuk.create', $supplier->_id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Barang Masuk
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row g-4">
        @forelse($barangMasukSupplier as $bm)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-gradient" style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($bm->tanggal)->translatedFormat('l, d F Y H:i') }}</span>
                        <form action="{{ route('admin.suppliers.barangmasuk.destroy', [$supplier->_id, $bm->_id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" style="border-radius: 50%;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <span class="badge bg-secondary">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($bm->tanggal)->translatedFormat('l, d F Y H:i') }}
                        </span>
                    </div>
                    <h5 class="card-title text-primary mb-2"><i class="fas fa-box"></i> {{ $bm->product->name ?? '-' }}</h5>
                    <div class="mb-2">
                        <span class="badge bg-info text-dark fs-6 shadow-sm">
                            <i class="fas fa-ruler"></i> Ukuran: {{ optional($bm->variation)->size ? optional($bm->variation)->size.' mm' : '-' }}
                        </span>
                    </div>
                    <ul class="list-group list-group-flush mb-2">
                        <li class="list-group-item"><b>Jumlah:</b> <span class="badge bg-warning text-dark">{{ $bm->jumlah }}</span></li>
                        <li class="list-group-item"><b>Harga Beli:</b> <span class="text-success">Rp {{ number_format($bm->harga_beli,0,',','.') }}</span></li>
                        <li class="list-group-item"><b>Total Harga:</b> <span class="fw-bold text-success">Rp {{ number_format($bm->total_harga,0,',','.') }}</span></li>
                        <li class="list-group-item"><b>Invoice:</b></li>
                    </ul>
                    <div class="text-center mt-2">
                        @if(!empty($bm->nota))
                            <a href="{{ asset('storage/'.$bm->nota) }}" target="_blank">
                                <img src="{{ asset('storage/'.$bm->nota) }}" alt="Nota" style="max-width:90px; max-height:90px; border-radius:10px; box-shadow:0 2px 8px #aaa; border:2px solid #4e73df;">
                            </a>
                        @else
                            <span class="text-muted">Tidak ada foto nota</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-box-open fa-2x mb-2"></i><br>
                <span class="fs-5">Belum ada data barang masuk</span>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection 