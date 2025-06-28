@extends('admin.layouts.app')

@section('title', 'Detail Pemasok')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Pemasok</h2>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        <a href="{{ route('admin.suppliers.mutasi', $supplier->_id) }}" class="btn btn-info">
            <i class="fas fa-history"></i> Lihat Mutasi Barang Masuk
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $supplier->name }}</dd>
                <dt class="col-sm-3">Kontak</dt>
                <dd class="col-sm-9">{{ $supplier->contact }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $supplier->email }}</dd>
                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $supplier->address }}</dd>
                <dt class="col-sm-3">Catatan</dt>
                <dd class="col-sm-9">{{ $supplier->notes }}</dd>
            </dl>
        </div>
    </div>
    @include('admin.suppliers.barangmasuk_index', ['supplier' => $supplier, 'barangMasukSupplier' => $barangMasukSupplier])
</div>
@endsection 