@extends('admin.layouts.app')

@section('title', 'Gudang Sementara')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gudang Sementara</h2>
        <a href="{{ route('admin.produksementara.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Pemasok</th>
                            <th>Kategori</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Harga Beli</th>
                            <th>Tanggal Masuk</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->pemasok->name ?? '-' }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->ukuran }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->harga_beli,0,',','.') }}</td>
                            <td>{{ $item->tanggal_masuk }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>{{ $item->catatan }}</td>
                            <td>
                                <a href="{{ route('admin.produksementara.edit', $item->_id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.produksementara.destroy', $item->_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                @if($item->status !== 'dipindahkan')
                                <form action="{{ route('admin.produksementara.moveToProduct', $item->_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Pindahkan ke produk utama?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-arrow-right"></i> Pindahkan</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 