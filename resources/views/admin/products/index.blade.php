@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="productsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th width="100">Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->_id }}</td>
                            <td class="text-center">
                                @if($product->image && Storage::disk('public')->exists($product->image))
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" 
                                         alt="No Image" 
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <span class="badge badge-{{ 
                                    $product->category == 'premium' ? 'warning' : 
                                    ($product->category == 'kawat' ? 'primary' : 
                                    ($product->category == 'plat' ? 'success' : 
                                    ($product->category == 'aksesoris' ? 'info' : 'secondary')))
                                }}">
                                    {{ ucfirst($product->category) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }} {{ $product->unit }}</td>
                            <td>
                                @php
                                    $stockStatus = '';
                                    $badgeClass = '';
                                    if ($product->stock > 100) {
                                        $stockStatus = 'Tersedia';
                                        $badgeClass = 'success';
                                    } elseif ($product->stock > 50) {
                                        $stockStatus = 'Menengah';
                                        $badgeClass = 'warning';
                                    } elseif ($product->stock > 0) {
                                        $stockStatus = 'Menipis';
                                        $badgeClass = 'danger';
                                    } else {
                                        $stockStatus = 'Habis';
                                        $badgeClass = 'secondary';
                                    }
                                @endphp
                                <span class="badge badge-{{ $badgeClass }}">{{ $stockStatus }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.products.edit', $product->_id) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->_id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table td {
        vertical-align: middle;
    }
    .custom-pagination {
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        background: rgba(255,255,255,0.7);
        border-radius: 2.5rem;
        padding: 0.5rem 1.5rem;
        margin-top: 2rem;
    }

    .custom-pagination .page-link {
        border: none;
        background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
        font-size: 1.3rem;
        color: #222;
        transition: 
            background 0.3s, 
            color 0.3s, 
            box-shadow 0.3s, 
            transform 0.2s;
        margin: 0 6px;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,123,255,0.08);
        position: relative;
        z-index: 1;
    }

    .custom-pagination .page-link:hover, 
    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
        color: #fff;
        box-shadow: 0 6px 24px rgba(0,123,255,0.18);
        transform: translateY(-2px) scale(1.08);
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #ccc;
        pointer-events: none;
        background: #f8f9fa;
        box-shadow: none;
    }

    .custom-pagination .page-link svg {
        filter: drop-shadow(0 2px 6px rgba(0,123,255,0.10));
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f7fafd;
        border-radius: 2rem;
        box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.10);
        padding: 0.5rem 1.5rem;
        margin: 2rem auto 0 auto;
        width: fit-content;
        transition: box-shadow 0.4s cubic-bezier(.4,2,.6,1), background 0.4s;
    }

    .page-item {
        margin: 0 2px;
    }

    .page-link {
        border: none !important;
        background: transparent !important;
        color: #1976d2 !important;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 1.5rem !important;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 
            background 0.35s cubic-bezier(.4,2,.6,1), 
            color 0.25s, 
            box-shadow 0.35s cubic-bezier(.4,2,.6,1), 
            transform 0.22s cubic-bezier(.4,2,.6,1);
        will-change: background, color, box-shadow, transform;
        position: relative;
        overflow: hidden;
    }

    .page-link:focus {
        outline: none;
        box-shadow: 0 0 0 2px #90caf9;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #1976d2 0%, #00c6ff 100%) !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(25, 118, 210, 0.15);
        transform: scale(1.08);
        animation: popActive 0.35s cubic-bezier(.4,2,.6,1);
    }

    @keyframes popActive {
        0% { transform: scale(0.85); }
        60% { transform: scale(1.15); }
        100% { transform: scale(1.08); }
    }

    .page-link:hover:not(.active):not(.disabled) {
        background: #e3f2fd !important;
        color: #1976d2 !important;
        transform: translateY(-2px) scale(1.08);
        box-shadow: 0 6px 24px rgba(25, 118, 210, 0.10);
    }

    .page-item.disabled .page-link {
        color: #bdbdbd !important;
        background: #f7fafd !important;
        pointer-events: none;
    }

    .page-link svg {
        width: 22px;
        height: 22px;
        vertical-align: middle;
    }

    .page-link:after {
        content: '';
        position: absolute;
        left: 50%; top: 50%;
        width: 0; height: 0;
        background: rgba(25, 118, 210, 0.08);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.35s cubic-bezier(.4,2,.6,1), height 0.35s cubic-bezier(.4,2,.6,1);
        z-index: 0;
    }

    .page-link:hover:after {
        width: 120%;
        height: 120%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
@endsection 