@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="profile-bg-animated">
    <div class="profile-container animate__animated animate__fadeIn">
        @if(Auth::check())
            <div class="profile-title">Profil Saya</div>
            <div class="row align-items-center mb-4">
                <div class="col-md-2 text-center">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" width="90" class="rounded-circle shadow mb-2">
                    @else
                        <div class="profile-avatar bg-secondary text-white rounded-circle mb-2 d-flex align-items-center justify-content-center" style="width:90px;height:90px;font-size:2.5rem;">{{ strtoupper(substr($user->name,0,1)) }}</div>
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="mb-1"><strong>Nama:</strong> {{ $user->name }}</div>
                    <div class="mb-1"><strong>Email:</strong> {{ $user->email }}</div>
                    <div class="mb-1"><strong>No. HP:</strong> {{ $user->phone ?? '-' }}</div>
                </div>
            </div>
            <div class="glass-card p-4 mb-4">
                <h4 class="mb-3">Edit Profil</h4>
                <form class="profile-form row g-3" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required placeholder="Nama">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="No. HP">
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control" placeholder="Password Baru (opsional)">
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-save-modern flex-fill">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
                <form action="{{ route('profile.logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-logout-modern w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
            <div class="glass-card p-4">
                <h4 class="mb-3">History Pesanan</h4>
                @if(isset($orders) && count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table table-history mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Ukuran</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            @if(isset($order->items) && count($order->items) > 0)
                                                {{ $order->items[0]['name'] ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($order->items) && count($order->items) > 0)
                                                {{ $order->items[0]['size'] ?? ($order->items[0]['ukuran'] ?? '-') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge-status {{ $order->status == 'selesai' ? 'selesai' : ($order->status == 'gagal' ? 'gagal' : '') }}">
                                                @if($order->status == 'selesai')
                                                    <i class="fas fa-check-circle me-1"></i>
                                                @elseif($order->status == 'gagal')
                                                    <i class="fas fa-times-circle me-1"></i>
                                                @else
                                                    <i class="fas fa-hourglass-half me-1"></i>
                                                @endif
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada pesanan.</p>
                @endif
            </div>
        @else
            <div class="row">
                <div class="col-md-6">
                    <h4>Login</h4>
                    <form method="POST" action="{{ route('profile.login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
                        <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
                        <button type="submit" class="btn btn-save w-100">Login</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4>Register</h4>
                    <form method="POST" action="{{ route('profile.register') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Nama" required class="form-control mb-2">
                        <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
                        <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="form-control mb-2">
                        <button type="submit" class="btn btn-save w-100">Daftar</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <div class="profile-bg-wave">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#e0eafc" fill-opacity="0.7">
                <animate attributeName="d" dur="8s" repeatCount="indefinite"
                    values="M0,80 Q360,120 720,80 T1440,80 V120 H0Z;
                            M0,100 Q360,60 720,100 T1440,100 V120 H0Z;
                            M0,80 Q360,120 720,80 T1440,80 V120 H0Z" />
            </path>
        </svg>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
    background: #f1f2f6 !important;
}
.profile-bg-animated {
    position: relative;
    min-height: 100vh;
    background: #f1f2f6;
    overflow: hidden;
}
.profile-bg-particles {
    position: absolute;
    top: 0; left: 0; width: 100vw; height: 100vh;
    z-index: 1;
    overflow: hidden;
    pointer-events: none;
}
.profile-bg-particles span {
    position: absolute;
    display: block;
    border-radius: 50%;
    opacity: 0.13;
    background: radial-gradient(circle, #d1d8e0 0%, #74b9ff 60%, #34495e 100%, transparent 100%);
    animation: floatProfile 8s linear infinite;
}
.profile-bg-particles span:nth-child(1) { width: 140px; height: 140px; left: 10%; top: 20%; animation-delay: 0s; }
.profile-bg-particles span:nth-child(2) { width: 90px; height: 90px; left: 70%; top: 10%; animation-delay: 2s; }
.profile-bg-particles span:nth-child(3) { width: 120px; height: 120px; left: 50%; top: 60%; animation-delay: 4s; }
.profile-bg-particles span:nth-child(4) { width: 70px; height: 70px; left: 80%; top: 70%; animation-delay: 6s; }
.profile-bg-particles span:nth-child(5) { width: 100px; height: 100px; left: 20%; top: 80%; animation-delay: 8s; }
.profile-bg-particles span:nth-child(6) { width: 80px; height: 80px; left: 40%; top: 30%; animation-delay: 3s; }
.profile-bg-particles span:nth-child(7) { width: 130px; height: 130px; left: 60%; top: 40%; animation-delay: 5s; }
.profile-bg-particles span:nth-child(8) { width: 60px; height: 60px; left: 30%; top: 70%; animation-delay: 7s; }
.profile-bg-particles span:nth-child(9) { width: 110px; height: 110px; left: 85%; top: 30%; animation-delay: 1s; }
.profile-bg-particles span:nth-child(10) { width: 70px; height: 70px; left: 15%; top: 50%; animation-delay: 9s; }
@keyframes floatProfile {
    0% { transform: translateY(0) scale(1); opacity: 0.13; }
    50% { transform: translateY(-60px) scale(1.12); opacity: 0.32; }
    100% { transform: translateY(0) scale(1); opacity: 0.13; }
}
.profile-container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 32px;
    background: none;
    border-radius: 1.5rem;
    box-shadow: none;
    position: relative;
    z-index: 2;
}
.profile-title {
    font-weight: 800;
    font-size: 2rem;
    color: #fff;
    letter-spacing: 1.2px;
    margin-bottom: 24px;
    border: 2px solid #d1d8e0;
    border-radius: 1rem;
    padding: 12px 24px;
    background: #232f3e;
    display: inline-block;
}
.row.align-items-center {
    border: 2px solid #d1d8e0;
    border-radius: 1rem;
    background: #34495e;
    padding: 18px 0 10px 0;
    margin-bottom: 24px;
}
.profile-avatar {
    width: 90px; height: 90px; font-size: 2.5rem;
    display: flex; align-items: center; justify-content: center;
    background: #d1d8e0;
    color: #232f3e;
    box-shadow: 0 2px 8px rgba(52,73,94,0.10);
}
.glass-card {
    background: #34495e;
    border-radius: 1.2rem;
    box-shadow: 0 4px 24px 0 rgba(44,62,80,0.10);
    margin-bottom: 32px;
    border: 1.5px solid #d1d8e0;
}
.profile-form input, .profile-form label {
    border-radius: 1rem !important;
    border: 1.2px solid #d1d8e0;
    background: #232f3e !important;
    color: #fff !important;
    box-shadow: 0 1px 4px rgba(52,73,94,0.04);
}
.profile-form input[type='file'] {
    background: #f1f2f6 !important;
    border: none;
    color: #232f3e !important;
}
.profile-form input[type='text'],
.profile-form input[type='password'] {
    background: #fff !important;
    color: #232f3e !important;
    border: 1.2px solid #d1d8e0;
}
.btn-save-modern {
    background: #232f3e;
    color: #fff;
    font-weight: 700;
    border-radius: 1.2rem;
    border: none;
    box-shadow: 0 4px 16px 0 rgba(44,62,80,0.13);
    transition: background 0.3s, box-shadow 0.3s, color 0.3s;
    position: relative;
    overflow: hidden;
    font-size: 1.08rem;
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}
.btn-save-modern:hover, .btn-save-modern:focus {
    background: #34495e;
    color: #fff;
    box-shadow: 0 8px 32px 0 rgba(44,62,80,0.18), 0 0 16px 4px #fff;
}
.btn-logout-modern {
    background: #d1d8e0;
    color: #232f3e;
    font-weight: 700;
    border-radius: 1.2rem;
    border: none;
    box-shadow: 0 2px 8px rgba(99,110,114,0.10);
    transition: background 0.3s, box-shadow 0.3s;
    font-size: 1.08rem;
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}
.btn-logout-modern:hover, .btn-logout-modern:focus {
    background: #232f3e;
    color: #fff;
    box-shadow: 0 4px 16px rgba(44,62,80,0.18);
}
.table-history {
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 24px 0 rgba(44,62,80,0.10);
    background: #232f3e;
}
.table-history th {
    background: #34495e !important;
    color: #fff !important;
    font-weight: 700;
    border: none;
    letter-spacing: 1px;
    text-shadow: 0 1px 4px rgba(52,73,94,0.06);
    opacity: 1 !important;
}
.table-history td {
    background: #34495e !important;
    color: #fff !important;
    opacity: 1 !important;
}
.table-history tr {
    transition: background 0.2s, box-shadow 0.2s;
}
.table-history tr:hover {
    background: #2c3e50;
    box-shadow: 0 2px 8px rgba(44,62,80,0.08);
}
.badge-status {
    padding: 5px 18px;
    border-radius: 1.2rem;
    font-size: 1em;
    font-weight: 700;
    color: #232f3e;
    background: #d1d8e0;
    box-shadow: 0 2px 8px rgba(209,216,224,0.10);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-status.selesai { background: #d1d8e0; color: #232f3e; }
.badge-status.gagal { background: #232f3e; color: #fff; }
.profile-bg-wave { display: none !important; }
.glass-card, .table-history, .row.align-items-center {
    color: #fff !important;
}
.profile-avatar {
    background: #232f3e;
    color: #fff;
}
.badge-status, .badge-status.selesai {
    background: #d1d8e0;
    color: #232f3e !important;
}
.badge-status.gagal {
    background: #232f3e;
    color: #fff !important;
}
.profile-form input[type='file'] {
    color: #232f3e !important;
    background: #f1f2f6 !important;
}
#cartModal .cart-item,
#cartModal .cart-item * {
    background: #fff !important;
    color: #232f3e !important;
}

#cartModal .cart-item .btn-danger,
#cartModal .cart-item .btn-danger * {
    color: #fff !important;
    background: #dc3545 !important;
    border: none !important;
}
</style> 