@extends('admin.layouts.app')

@section('title', 'Daftar Pemasok')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Pemasok</h2>
        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pemasok
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
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->contact }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ $supplier->notes }}</td>
                            <td>
                                <a href="{{ route('admin.suppliers.edit', $supplier->_id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.suppliers.show', $supplier->_id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <form action="{{ route('admin.suppliers.destroy', $supplier->_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pemasok ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pemasok</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 