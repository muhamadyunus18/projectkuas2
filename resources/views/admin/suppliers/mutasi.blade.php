@extends('admin.layouts.app')

@section('title', 'Mutasi Barang Masuk - ' . $supplier->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Mutasi Barang Masuk dari: <span class="text-primary">{{ $supplier->name }}</span></h2>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Margin/Untung per Unit</th>
                            <th>Total Untung/Rugi</th>
                            <th>Total Harga</th>
                            <th>Invoice</th>
                            <th>Foto Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mutasiBarang as $mutasi)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($mutasi->tanggal)) }}</td>
                            <td>{{ $mutasi->product->name ?? '-' }}</td>
                            <td>{{ $mutasi->variation->size ?? '-' }}</td>
                            <td>{{ $mutasi->jumlah }}</td>
                            <td>Rp {{ number_format($mutasi->harga_beli,0,',','.') }}</td>
                            <td>Rp {{ number_format($mutasi->product->harga_jual ?? 0,0,',','.') }}</td>
                            @php
                                $hargaJual = $mutasi->product->harga_jual ?? 0;
                                $margin = $hargaJual - $mutasi->harga_beli;
                                $totalMargin = $margin * $mutasi->jumlah;
                            @endphp
                            <td><span class="{{ $margin >= 0 ? 'text-success' : 'text-danger' }}">Rp {{ number_format($margin,0,',','.') }}</span></td>
                            <td><span class="{{ $totalMargin >= 0 ? 'text-success' : 'text-danger' }}">Rp {{ number_format($totalMargin,0,',','.') }}</span></td>
                            <td>Rp {{ number_format($mutasi->total_harga,0,',','.') }}</td>
                            <td>{{ $mutasi->invoice ?? '-' }}</td>
                            <td>
                                @if(!empty($mutasi->nota))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#notaModal{{ $mutasi->_id }}">
                                        <img src="{{ asset('storage/'.$mutasi->nota) }}" alt="Nota" style="max-width:45px; max-height:45px; border-radius:8px; box-shadow:0 2px 8px #aaa; border:2px solid #4e73df;">
                                    </a>
                                    <!-- Modal Preview -->
                                    <div class="modal fade" id="notaModal{{ $mutasi->_id }}" tabindex="-1" aria-labelledby="notaModalLabel{{ $mutasi->_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="notaModalLabel{{ $mutasi->_id }}"><i class="fas fa-image"></i> Foto Nota</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/'.$mutasi->nota) }}" alt="Nota" class="img-fluid rounded shadow">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">Belum ada mutasi barang masuk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 