@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label">Satuan</label>
                            <select class="form-select @error('unit') is-invalid @enderror" 
                                    id="unit" name="unit" required>
                                <option value="">Pilih Satuan</option>
                                <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                <option value="meter" {{ old('unit', $product->unit) == 'meter' ? 'selected' : '' }}>Meter (m)</option>
                                <option value="pcs" {{ old('unit', $product->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                <option value="lembar" {{ old('unit', $product->unit) == 'lembar' ? 'selected' : '' }}>Lembar</option>
                            </select>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Total Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                id="stock" name="stock" value="{{ old('stock', $product->stock) }}" readonly required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="min_size" class="form-label">Ukuran Minimum</label>
                            <input type="number" step="0.01" class="form-control @error('min_size') is-invalid @enderror" 
                                id="min_size" name="min_size" value="{{ old('min_size', $product->min_size) }}" required>
                            @error('min_size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="max_size" class="form-label">Ukuran Maksimum</label>
                            <input type="number" step="0.01" class="form-control @error('max_size') is-invalid @enderror" 
                                id="max_size" name="max_size" value="{{ old('max_size', $product->max_size) }}" required>
                            @error('max_size')
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
                                <option value="kawat" {{ old('category', $product->category) == 'kawat' ? 'selected' : '' }}>Kawat</option>
                                <option value="plat" {{ old('category', $product->category) == 'plat' ? 'selected' : '' }}>Plat</option>
                                <option value="premium" {{ old('category', $product->category) == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="aksesoris" {{ old('category', $product->category) == 'aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="aplas" {{ old('category', $product->category) == 'aplas' ? 'selected' : '' }}>Aplas</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag (opsional)</label>
                            <input type="text" class="form-control @error('tag') is-invalid @enderror" 
                                id="tag" name="tag" value="{{ old('tag', $product->tag) }}" placeholder="Pisahkan dengan koma">
                            @error('tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Utama</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 100px">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery" class="form-label">Galeri Gambar (opsional)</label>
                            @if($product->gallery)
                                <div class="row mb-2">
                                    @foreach($product->gallery as $image)
                                        <div class="col-md-3 mb-2">
                                            <img src="{{ Storage::url($image) }}" alt="Gallery" class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                    id="gallery" name="gallery[]" accept="image/*" multiple>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah galeri</small>
                            @error('gallery')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" 
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Tampilkan di Halaman Utama</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_bestseller" name="is_bestseller" value="1" 
                                    {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_bestseller">Produk Terlaris</label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h5>Variasi Ukuran, Harga & Stok</h5>
                <div id="variation-list">
                    @if($product->variations && count($product->variations) > 0)
                        @foreach($product->variations as $i => $variation)
                        <div class="row align-items-end variation-item mb-2">
                            <div class="col-md-3">
                                <label>Ukuran</label>
                                <input type="number" step="0.01" name="variations[{{ $i }}][size]" class="form-control" value="{{ $variation->size }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Harga</label>
                                <input type="number" name="variations[{{ $i }}][price]" class="form-control" value="{{ $variation->price }}" required>
                            </div>
                            <div class="col-md-3">
                                <label>Stok</label>
                                <input type="number" name="variations[{{ $i }}][stock]" class="form-control" value="{{ $variation->stock }}" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-remove-variation">Hapus</button>
                                <input type="hidden" name="variations[{{ $i }}][id]" value="{{ $variation->_id }}">
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-success mb-3" id="add-variation">Tambah Variasi</button>

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

@section('scripts')
<script>
    let variationIndex = {{ $product->variations ? count($product->variations) : 0 }};
    function updateTotalStock() {
        let total = 0;
        document.querySelectorAll('#variation-list input[name$="[stock]"]').forEach(function(input) {
            total += parseInt(input.value) || 0;
        });
        document.getElementById('stock').value = total;
    }
    document.getElementById('add-variation').addEventListener('click', function() {
        const list = document.getElementById('variation-list');
        const row = document.createElement('div');
        row.className = 'row align-items-end variation-item mb-2';
        row.innerHTML = `
            <div class="col-md-3">
                <label>Ukuran</label>
                <input type="number" step="0.01" name="variations[${variationIndex}][size]" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Harga</label>
                <input type="number" name="variations[${variationIndex}][price]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Stok</label>
                <input type="number" name="variations[${variationIndex}][stock]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-remove-variation">Hapus</button>
            </div>
        `;
        list.appendChild(row);
        variationIndex++;
        updateTotalStock();
    });
    document.getElementById('variation-list').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-variation')) {
            e.target.closest('.variation-item').remove();
            updateTotalStock();
        }
    });
    document.getElementById('variation-list').addEventListener('input', function(e) {
        if (e.target.name && e.target.name.endsWith('[stock]')) {
            updateTotalStock();
        }
    });
    // Inisialisasi total stok saat halaman dimuat
    updateTotalStock();
</script>
@endsection 