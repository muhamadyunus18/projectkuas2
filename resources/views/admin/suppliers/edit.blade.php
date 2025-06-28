@extends('admin.layouts.app')

@section('title', 'Edit Pemasok')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Pemasok</h2>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.suppliers.update', $supplier->_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pemasok</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $supplier->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Kontak</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="{{ $supplier->contact }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $supplier->email }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" class="form-control">{{ $supplier->address }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan</label>
                    <textarea name="notes" id="notes" class="form-control">{{ $supplier->notes }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>
</div>
@endsection 