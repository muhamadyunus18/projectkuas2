@extends('admin.layouts.app')

@section('title', 'Tambah Barang Gudang Sementara')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Tambah Barang ke Gudang Sementara</h2>
        <a href="{{ route('admin.produksementara.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.produksementara.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pemasok_id" class="form-label">Pemasok</label>
                    <select name="pemasok_id" id="pemasok_id" class="form-control">
                        <option value="">-- Pilih Pemasok --</option>
                        @foreach($suppliers as $s)
                        <option value="{{ $s->_id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection 