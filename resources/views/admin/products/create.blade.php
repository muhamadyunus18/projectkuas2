@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk Baru</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Variasi Produk</label>
                            <table class="table table-bordered table-sm" id="variasi-table" style="background:#fff;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th class="align-middle">Ukuran</th>
                                        <th class="align-middle">Stok</th>
                                        <th class="align-middle">Harga</th>
                                        <th class="align-middle" style="width:40px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="variations[0][size]" class="form-control" placeholder="Contoh: 1 mm" required></td>
                                        <td><input type="number" name="variations[0][stock]" class="form-control stok-input" min="0" value="" required></td>
                                        <td><input type="number" name="variations[0][price]" class="form-control harga-input" min="0" value="" required></td>
                                        <td><button type="button" class="btn btn-outline-secondary btn-remove-row" disabled><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="btn-add-row"><i class="fas fa-plus"></i> Tambah Variasi</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Utama</label>
                            <input type="text" id="main-price" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Stok</label>
                            <input type="number" id="total-stock" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label">Satuan</label>
                            <select class="form-select @error('unit') is-invalid @enderror" 
                                    id="unit" name="unit" required>
                                <option value="">Pilih Satuan</option>
                                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                <option value="meter" {{ old('unit') == 'meter' ? 'selected' : '' }}>Meter (m)</option>
                                <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                <option value="lembar" {{ old('unit') == 'lembar' ? 'selected' : '' }}>Lembar</option>
                            </select>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="kawat" {{ old('category') == 'kawat' ? 'selected' : '' }}>Kawat</option>
                                <option value="plat" {{ old('category') == 'plat' ? 'selected' : '' }}>Plat</option>
                                <option value="premium" {{ old('category') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="aksesoris" {{ old('category') == 'aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="aplas" {{ old('category') == 'aplas' ? 'selected' : '' }}>Aplas</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag (opsional)</label>
                            <input type="text" class="form-control @error('tag') is-invalid @enderror" 
                                id="tag" name="tag" value="{{ old('tag') }}" placeholder="Pisahkan dengan koma">
                            @error('tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Utama</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery" class="form-label">Galeri Gambar (opsional)</label>
                            <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                    id="gallery" name="gallery[]" accept="image/*" multiple>
                            @error('gallery')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Tampilkan di Halaman Utama</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_bestseller" name="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_bestseller">Produk Terlaris</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
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

@push('scripts')
<script>
let rowIdx = 1;
function updateMainPriceAndStock() {
    let prices = [];
    let totalStock = 0;
    document.querySelectorAll('#variasi-table tbody tr').forEach(function(row) {
        const harga = parseInt(row.querySelector('.harga-input').value) || 0;
        const stok = parseInt(row.querySelector('.stok-input').value) || 0;
        if (harga > 0) prices.push(harga);
        if (stok > 0) totalStock += stok;
    });
    prices.sort((a,b) => a-b);
    let mainPrice = '';
    if (prices.length > 0) {
        mainPrice = prices[0] === prices[prices.length-1] ? prices[0] : prices[0] + ' - ' + prices[prices.length-1];
    }
    document.getElementById('main-price').value = mainPrice;
    document.getElementById('total-stock').value = totalStock;
}
document.getElementById('btn-add-row').onclick = function() {
    const tbody = document.querySelector('#variasi-table tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="text" name="variations[${rowIdx}][size]" class="form-control" placeholder="Contoh: 2 mm" required></td>
        <td><input type="number" name="variations[${rowIdx}][stock]" class="form-control stok-input" min="0" value="" required></td>
        <td><input type="number" name="variations[${rowIdx}][price]" class="form-control harga-input" min="0" value="" required></td>
        <td><button type="button" class="btn btn-outline-secondary btn-remove-row"><i class="fas fa-trash"></i></button></td>
    `;
    tbody.appendChild(newRow);
    rowIdx++;
    updateMainPriceAndStock();
};
document.querySelector('#variasi-table').addEventListener('input', function(e) {
    if (e.target.classList.contains('stok-input') || e.target.classList.contains('harga-input')) {
        updateMainPriceAndStock();
    }
});
document.querySelector('#variasi-table').addEventListener('click', function(e) {
    if (e.target.closest('.btn-remove-row')) {
        const row = e.target.closest('tr');
        row.remove();
        updateMainPriceAndStock();
    }
});
updateMainPriceAndStock();
</script>
@endpush 