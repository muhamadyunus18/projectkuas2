@extends('admin.layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Tambah Barang Masuk untuk {{ $supplier->name }}</h2>
        <a href="{{ route('admin.suppliers.barangmasuk.index', $supplier->_id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.suppliers.barangmasuk.store', $supplier->_id) }}" method="POST" id="form-barangmasuk" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="supplier_id" value="{{ $supplier->_id }}">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Masuk</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" required value="{{ date('Y-m-d\TH:i') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Daftar Barang Masuk</label>
                    <table class="table table-bordered align-middle" id="table-barangmasuk">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Ukuran</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-barangmasuk">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total Harga Semua</td>
                                <td><input type="text" id="grand_total" class="form-control" readonly></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="button" class="btn btn-success" id="btn-tambah-baris"><i class="fas fa-plus"></i> Tambah Baris</button>
                </div>
                <div class="mb-3">
                    <label for="nota" class="form-label">Upload Bukti Nota/Dokumen (Opsional)</label>
                    <input type="file" name="nota" id="nota" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
const products = @json($products);
let barisIndex = 0;

function getProductOptions(selected = "") {
    let html = '<option value="">-- Pilih Produk --</option>';
    products.forEach(p => {
        const val = p._id ? p._id : (p.id ? p.id : '');
        html += `<option value="${val}" ${selected == val ? 'selected' : ''}>${p.name}</option>`;
    });
    html += '<option value="add_new">+ Produk Baru</option>';
    return html;
}

function getVariationOptions(variations, selected = "") {
    let html = '<option value="">-- Pilih Ukuran --</option>';
    variations.forEach(v => {
        html += `<option value="${v.id}" data-price="${v.price}" ${selected == v.id ? 'selected' : ''}>${v.size} mm</option>`;
    });
    html += '<option value="add_new">+ Ukuran Baru</option>';
    return html;
}

function barisBarangMasuk(idx) {
    return `<tr data-idx="${idx}">
        <td>
            <select class="form-control product-select" name="items[${idx}][product_id]">
                ${getProductOptions()}
            </select>
            <div class="add-product-form mt-2" style="display:none"></div>
        </td>
        <td>
            <select class="form-control variation-select" name="items[${idx}][variation_id]" disabled>
                <option value="">-- Pilih Ukuran --</option>
            </select>
            <div class="add-variation-form mt-2" style="display:none"></div>
        </td>
        <td><input type="number" class="form-control jumlah-input" name="items[${idx}][jumlah]" min="1"></td>
        <td><input type="number" class="form-control harga-input" name="items[${idx}][harga_beli]" min="0"></td>
        <td><input type="text" class="form-control total-input" name="items[${idx}][total]" readonly></td>
        <td><button type="button" class="btn btn-danger btn-hapus-baris"><i class="fas fa-trash"></i></button></td>
    </tr>`;
}

function tambahBaris() {
    const tbody = document.getElementById('tbody-barangmasuk');
    tbody.insertAdjacentHTML('beforeend', barisBarangMasuk(barisIndex));
    barisIndex++;
    updateEventListeners();
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.total-input').forEach(input => {
        total += parseInt(input.value) || 0;
    });
    document.getElementById('grand_total').value = total;
}

function updateEventListeners() {
    document.querySelectorAll('.btn-hapus-baris').forEach(btn => {
        btn.onclick = function() {
            btn.closest('tr').remove();
            updateGrandTotal();
        };
    });
    document.querySelectorAll('.product-select').forEach(select => {
        select.onchange = function() {
            const tr = select.closest('tr');
            const idx = tr.getAttribute('data-idx');
            const val = select.value;
            const variationSelect = tr.querySelector('.variation-select');
            const addProductForm = tr.querySelector('.add-product-form');
            if (val === 'add_new') {
                addProductForm.innerHTML = `<div class='row g-2'>
                    <div class='col'><input type='text' class='form-control' placeholder='Nama Produk' id='add_name_${idx}'></div>
                    <div class='col'><input type='text' class='form-control' placeholder='Kategori' id='add_category_${idx}'></div>
                    <div class='col'><input type='text' class='form-control' placeholder='Satuan' id='add_unit_${idx}'></div>
                    <div class='col'><button type='button' class='btn btn-success btn-save-product'>Simpan</button> <button type='button' class='btn btn-secondary btn-cancel-product'>Batal</button></div>
                </div>`;
                addProductForm.style.display = 'block';
                variationSelect.innerHTML = '<option value="">-- Pilih Ukuran --</option>';
                variationSelect.disabled = true;
                // Simpan produk baru
                addProductForm.querySelector('.btn-save-product').onclick = function() {
                    const data = {
                        name: document.getElementById('add_name_' + idx).value,
                        category: document.getElementById('add_category_' + idx).value,
                        unit: document.getElementById('add_unit_' + idx).value
                    };
                    fetch('/admin/products', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success && res.product) {
                            products.push(res.product);
                            select.innerHTML = getProductOptions(res.product._id);
                            addProductForm.style.display = 'none';
                            select.dispatchEvent(new Event('change'));
                        } else {
                            alert('Gagal menambah produk baru!');
                        }
                    });
                };
                addProductForm.querySelector('.btn-cancel-product').onclick = function() {
                    addProductForm.style.display = 'none';
                    select.value = '';
                };
            } else if (val) {
                // Ambil variasi produk
                fetch(`/api/products/${val}/variations`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.data.variations.length > 0) {
                            variationSelect.innerHTML = getVariationOptions(data.data.variations);
                            variationSelect.disabled = false;
                        } else {
                            variationSelect.innerHTML = '<option value="">-- Pilih Ukuran --</option><option value="add_new">+ Ukuran Baru</option>';
                            variationSelect.disabled = false;
                        }
                    });
            } else {
                variationSelect.innerHTML = '<option value="">-- Pilih Ukuran --</option>';
                variationSelect.disabled = true;
            }
        };
    });
    document.querySelectorAll('.variation-select').forEach(select => {
        select.onchange = function() {
            const tr = select.closest('tr');
            const idx = tr.getAttribute('data-idx');
            const val = select.value;
            const hargaInput = tr.querySelector('.harga-input');
            const addVariationForm = tr.querySelector('.add-variation-form');
            if (val === 'add_new') {
                addVariationForm.innerHTML = `<div class='row g-2'>
                    <div class='col'><input type='number' class='form-control' placeholder='Ukuran (mm)' id='add_size_${idx}' step='0.01'></div>
                    <div class='col'><input type='number' class='form-control' placeholder='Harga' id='add_var_price_${idx}' min='0'></div>
                    <div class='col'><button type='button' class='btn btn-info btn-save-variation'>Simpan</button> <button type='button' class='btn btn-secondary btn-cancel-variation'>Batal</button></div>
                </div>`;
                addVariationForm.style.display = 'block';
                // Simpan variasi baru
                addVariationForm.querySelector('.btn-save-variation').onclick = function() {
                    const productId = tr.querySelector('.product-select').value;
                    const data = {
                        product_id: productId,
                        size: document.getElementById('add_size_' + idx).value,
                        price: document.getElementById('add_var_price_' + idx).value,
                        stock: 0
                    };
                    fetch('/admin/product-variations', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success && res.variation) {
                            select.innerHTML += `<option value='${res.variation.id}' data-price='${res.variation.price}' selected>${res.variation.size} mm</option>`;
                            select.value = res.variation.id;
                            addVariationForm.style.display = 'none';
                            select.dispatchEvent(new Event('change'));
                        } else {
                            alert('Gagal menambah ukuran baru!');
                        }
                    });
                };
                addVariationForm.querySelector('.btn-cancel-variation').onclick = function() {
                    addVariationForm.style.display = 'none';
                    select.value = '';
                };
            } else if (val) {
                // Set harga beli otomatis dari variasi
                const selected = select.options[select.selectedIndex];
                const price = selected.getAttribute('data-price');
                if (price) {
                    hargaInput.value = price;
                    hargaInput.dispatchEvent(new Event('input'));
                }
            }
        };
    });
    document.querySelectorAll('.jumlah-input, .harga-input').forEach(input => {
        input.oninput = function() {
            const tr = input.closest('tr');
            const jumlah = parseInt(tr.querySelector('.jumlah-input').value) || 0;
            const harga = parseInt(tr.querySelector('.harga-input').value) || 0;
            tr.querySelector('.total-input').value = jumlah * harga;
            updateGrandTotal();
        };
    });
}

document.getElementById('btn-tambah-baris').onclick = tambahBaris;
tambahBaris(); // Baris pertama otomatis
</script>
@endsection 