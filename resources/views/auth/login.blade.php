@extends('layouts.app')

@section('title', 'Login User')

@section('content')
<div class="login-bg-animated">
    <div class="container d-flex justify-content-center align-items-center min-vh-100 position-relative" style="z-index:2;">
        <div class="card shadow-lg p-4 animate__animated animate__fadeInUp glass-card" style="border-radius: 1.5rem; min-width: 350px; max-width: 400px;">
            <h2 class="mb-4 text-center" style="font-weight: 700; letter-spacing: 1px; color: #fff;">Login User</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label" style="font-weight: 500; color: #dfe6e9;">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" required autofocus style="border-radius: 1rem; background: rgba(255,255,255,0.08); color: #fff; border: 1px solid #576574;">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label" style="font-weight: 500; color: #dfe6e9;">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" required style="border-radius: 1rem; background: rgba(255,255,255,0.08); color: #fff; border: 1px solid #576574;">
                </div>
                <button type="submit" class="btn btn-gold w-100 py-2 mt-2 animate__animated animate__fadeInUp" style="border-radius: 1rem; font-weight: 700; font-size: 1.1rem; letter-spacing: 1px;">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="text-decoration-none" style="color: #74b9ff; font-weight: 500;">
                    <i class="fas fa-user-plus me-1"></i>Belum punya akun? Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
body {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%) !important;
}
.login-bg-animated {
    min-height: 100vh;
    width: 100vw;
    background: linear-gradient(120deg, #232f3e, #34495e 30%,rgb(36, 59, 88) 60%, #232f3e 80%, #2980b9 100%);
    background-size: 300% 300%;
    animation: gradientMove 8s ease-in-out infinite;
}
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.bg-particles { display: none !important; }
.btn-gradient {
    background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
    color: #fff;
    border: none;
    transition: box-shadow 0.3s, background 0.3s;
    box-shadow: 0 4px 16px rgba(52,73,94,0.12);
}
.btn-gradient:hover {
    background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
    color: #fff;
    box-shadow: 0 8px 24px rgba(52,73,94,0.18);
}
.card.glass-card {
    background: rgba(255,255,255,0.18);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(44,62,80,0.18);
    backdrop-filter: blur(8px);
    animation: fadeInUp 1.2s cubic-bezier(.39,.575,.56,1) both;
}
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(40px);}
    100% { opacity: 1; transform: translateY(0);}
}
.form-control:focus, .btn:focus {
    box-shadow: 0 0 0 0.2rem #ffe08255;
    transition: box-shadow 0.3s;
}
::placeholder {
    color: #b2bec3 !important;
    opacity: 1;
}
.btn-gold {
    background: linear-gradient(90deg, #f5f6fa 0%, #d1d8e0 50%, #636e72 100%);
    color: #222;
    border: none;
    font-weight: 700;
    box-shadow: 0 4px 24px 0 rgba(99, 110, 114, 0.15);
    transition: box-shadow 0.3s, background 0.3s, color 0.3s;
    position: relative;
    overflow: hidden;
}
.btn-gold:hover, .btn-gold:focus {
    background: linear-gradient(90deg, #636e72 0%, #f5f6fa 100%);
    color: #111;
    box-shadow: 0 8px 32px 0 rgba(99, 110, 114, 0.25), 0 0 16px 4px #f5f6fa;
}
.btn-gold::after {
    content: '';
    position: absolute;
    top: 0; left: -75%;
    width: 50%; height: 100%;
    background: linear-gradient(120deg, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0.0) 100%);
    transform: skewX(-25deg);
    transition: left 0.5s;
}
.btn-gold:hover::after {
    left: 120%;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/> 