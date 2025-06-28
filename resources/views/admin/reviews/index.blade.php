@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Review Produk</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>User</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Foto</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->product->name ?? '-' }}</td>
                <td>{{ $review->user_name }}</td>
                <td>
                    @for($i=1; $i<=5; $i++)
                        <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star text-warning"></i>
                    @endfor
                    ({{ $review->rating }})
                </td>
                <td>{{ $review->review_text }}</td>
                <td>
                    @if($review->photo)
                        <img src="{{ asset('storage/'.$review->photo) }}" width="60">
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d-m-Y H:i') }}</td>
                <td>
                    <!-- Tombol hapus/edit jika perlu -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 