@extends('layouts.app')

@section('title', 'Beranda - Tokomonel')

@section('content')
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="hero-content">
                        <div class="hero-badge" data-aos="fade-down" data-aos-delay="200">
                            <span class="badge-text">Premium Quality</span>
                            <div class="badge-shine"></div>
                        </div>
                        <h1 class="hero-title" data-aos="fade-up">
                            <span class="text-gradient">Bahan Baku Monel</span>
                            <span class="highlight">Berkualitas Tinggi</span>
                        </h1>
                        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                            Solusi terpercaya untuk kebutuhan bahan baku monel industri Anda. 
                            <span class="text-accent">Kualitas premium dengan harga kompetitif.</span>
                        </p>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="200">
                            <a href="#" class="btn btn-luxury">
                                <span class="btn-content">
                                    <i class="fas fa-gem me-2"></i>
                                    Lihat Produk
                                </span>
                                <div class="btn-glow"></div>
                            </a>
                            <a href="#" class="btn btn-outline-luxury">
                                <span class="btn-content">
                                    <i class="fas fa-headset me-2"></i>
                                    Hubungi Kami
                                </span>
                            </a>
                        </div>
                        <div class="hero-features" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Kualitas Premium</h4>
                                    <p>Standar Internasional</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Garansi 100%</h4>
                                    <p>Jaminan Kualitas</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Tersertifikasi</h4>
                                    <p>Standar Nasional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="hero-image">
                        <div class="image-frame">
                            <img src="/images/monel-wire.jpg" alt="Premium Monel" class="main-image">
                            <div class="frame-decoration frame-top-left"></div>
                            <div class="frame-decoration frame-top-right"></div>
                            <div class="frame-decoration frame-bottom-left"></div>
                            <div class="frame-decoration frame-bottom-right"></div>
                        </div>
                        <div class="floating-elements">
                            <div class="floating-badge quality">
                                <i class="fas fa-award"></i>
                                <span>Best Quality</span>
                            </div>
                            <div class="floating-badge premium">
                                <i class="fas fa-star"></i>
                                <span>Premium</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="waves">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
    </section>

    

    <style>
    .hero-section {
        position: relative;
        min-height: 95vh;
        padding: 120px 0 0 0;
        overflow: hidden;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        z-index: 0;
    }

    .waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 20vh;
        margin-bottom: -7px;
        min-height: 120px;
        max-height: 180px;
        z-index: 1;
    }

    .waves svg {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
    }

    .parallax > use {
        animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
    }
    
    .parallax > use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }
    
    .parallax > use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }
    
    .parallax > use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }
    
    .parallax > use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }

    @keyframes move-forever {
        0% {
            transform: translate3d(-90px,0,0);
        }
        100% {
            transform: translate3d(85px,0,0);
        }
    }

    .container {
        position: relative;
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding-bottom: 100px;
    }

    .hero-image {
        position: relative;
        z-index: 2;
    }

    /* Luxury Background */
    .luxury-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    }

    .luxury-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(255,215,0,0.05) 0%, rgba(0,0,0,0) 70%);
        mix-blend-mode: overlay;
    }

    .geometric-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .diamond {
        position: absolute;
        background: linear-gradient(45deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05));
        transform: rotate(45deg);
    }

    .diamond-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
        animation: floatDiamond 20s infinite ease-in-out;
    }

    .diamond-2 {
        width: 200px;
        height: 200px;
        bottom: 10%;
        left: -100px;
        animation: floatDiamond 15s infinite ease-in-out reverse;
    }

    .diamond-3 {
        width: 150px;
        height: 150px;
        top: 40%;
        right: 10%;
        animation: floatDiamond 18s infinite ease-in-out;
    }

    .circle {
        position: absolute;
        border: 1px solid rgba(255,215,0,0.1);
        border-radius: 50%;
    }

    .circle-1 {
        width: 400px;
        height: 400px;
        top: 20%;
        left: -200px;
        animation: rotate 30s infinite linear;
    }

    .circle-2 {
        width: 300px;
        height: 300px;
        bottom: -150px;
        right: 10%;
        animation: rotate 20s infinite linear reverse;
    }

    .moving-lines {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .line {
        position: absolute;
        background: linear-gradient(90deg, transparent, rgba(255,215,0,0.1), transparent);
        height: 1px;
        width: 100%;
        transform-origin: left;
    }

    .line-1 {
        top: 20%;
        animation: moveLine 15s infinite linear;
    }

    .line-2 {
        top: 50%;
        animation: moveLine 20s infinite linear;
    }

    .line-3 {
        top: 80%;
        animation: moveLine 17s infinite linear;
    }

    @keyframes floatDiamond {
        0%, 100% { transform: rotate(45deg) translate(0, 0); }
        50% { transform: rotate(60deg) translate(-20px, -20px); }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes moveLine {
        0% { transform: translateX(-100%) rotate(-5deg); }
        100% { transform: translateX(100%) rotate(5deg); }
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255,215,0,0.1);
        padding: 8px 16px;
        border-radius: 20px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .badge-text {
        color: #FFD700;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .badge-shine {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255,215,0,0) 0%,
            rgba(255,215,0,0.2) 50%,
            rgba(255,215,0,0) 100%
        );
        transform: rotate(45deg);
        animation: badgeShine 3s infinite;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: #ffffff;
    }

    .text-gradient {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: block;
    }

    .highlight {
        color: #ffffff;
        display: block;
        font-size: 3.5rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .text-accent {
        color: #FFD700;
    }

    /* Buttons */
    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .btn-luxury {
        position: relative;
        background: linear-gradient(45deg, #FFD700, #FFA500);
        border: none;
        padding: 15px 40px;
        color: #1a1a1a;
        font-weight: 600;
        border-radius: 30px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,215,0,0.3);
    }

    .btn-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.3);
        transform: rotate(45deg);
        animation: buttonGlow 2s infinite;
    }

    .btn-outline-luxury {
        position: relative;
        background: transparent;
        border: 2px solid rgba(255,215,0,0.3);
        padding: 15px 40px;
        color: #FFD700;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-outline-luxury:hover {
        background: rgba(255,215,0,0.1);
        border-color: #FFD700;
        transform: translateY(-2px);
    }

    /* Features */
    .hero-features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: rgba(255,255,255,0.05);
        border-radius: 15px;
        border: 1px solid rgba(255,215,0,0.1);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,215,0,0.3);
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, rgba(255,215,0,0.1), rgba(255,215,0,0.2));
        border-radius: 50%;
        font-size: 1.5rem;
        color: #FFD700;
    }

    .feature-text h4 {
        color: #ffffff;
        font-size: 1.1rem;
        margin: 0;
    }

    .feature-text p {
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Hero Image */
    .image-frame {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .main-image {
        width: 100%;
        height: auto;
        transform: scale(1.1);
        transition: transform 0.5s ease;
    }

    .image-frame:hover .main-image {
        transform: scale(1);
    }

    .frame-decoration {
        position: absolute;
        width: 50px;
        height: 50px;
        border: 2px solid #FFD700;
    }

    .frame-top-left {
        top: 20px;
        left: 20px;
        border-right: none;
        border-bottom: none;
    }

    .frame-top-right {
        top: 20px;
        right: 20px;
        border-left: none;
        border-bottom: none;
    }

    .frame-bottom-left {
        bottom: 20px;
        left: 20px;
        border-right: none;
        border-top: none;
    }

    .frame-bottom-right {
        bottom: 20px;
        right: 20px;
        border-left: none;
        border-top: none;
    }

    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .floating-badge {
        position: absolute;
        background: rgba(255,255,255,0.95);
        padding: 10px 20px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        animation: float 6s infinite ease-in-out;
    }

    .floating-badge.quality {
        top: 10%;
        right: -30px;
    }

    .floating-badge.premium {
        bottom: 20%;
        left: -30px;
        animation-delay: -3s;
    }

    .floating-badge i {
        color: #FFD700;
        font-size: 1.2rem;
    }

    .floating-badge span {
        color: #1a1a1a;
        font-weight: 600;
        font-size: 0.9rem;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    @keyframes buttonGlow {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }

    @keyframes badgeShine {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .hero-title {
            font-size: 3rem;
        }

        .highlight {
            font-size: 2.5rem;
        }

        .hero-features {
            grid-template-columns: 1fr;
        }

        .hero-image {
            margin-top: 3rem;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 80px 0;
        }
        
        .waves {
            height: 50px;
            min-height: 50px;
        }
        
        .hero-content {
            padding-bottom: 60px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .highlight {
            font-size: 2rem;
        }

        .hero-buttons {
            flex-direction: column;
        }

        .floating-badge {
            display: none;
        }
    }

    .card.product-featured {
        transition: transform 0.35s cubic-bezier(.4,0,.2,1), box-shadow 0.35s;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        border-radius: 18px;
        border: 1px solid #f0f0f0;
        background: #fff;
    }
    .card.product-featured:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
        border: 1.5px solid #e0e0e0;
    }
    .card.product-featured img {
        transition: transform 0.4s cubic-bezier(.4,0,.2,1);
    }
    .card.product-featured:hover img {
        transform: scale(1.06);
    }
    </style>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true
            });
        });
    </script>

    <section class="features-section py-5">
        <div class="section-background">
            <div class="abstract-shape shape1"></div>
            <div class="abstract-shape shape2"></div>
            <div class="abstract-shape shape3"></div>
        </div>
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Keunggulan Kami</h2>
                <div class="title-line"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <i class="fas fa-award feature-icon"></i>
                            <div class="icon-glow"></div>
                        </div>
                        <h3>Kualitas Premium</h3>
                        <p>Bahan baku monel dengan standar internasional dan sertifikasi lengkap.</p>
                        <div class="card-shapes">
                            <div class="shape-dot"></div>
                            <div class="shape-line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <i class="fas fa-truck feature-icon"></i>
                            <div class="icon-glow"></div>
                        </div>
                        <h3>Pengiriman Cepat</h3>
                        <p>Layanan pengiriman cepat dan aman ke seluruh Indonesia.</p>
                        <div class="card-shapes">
                            <div class="shape-dot"></div>
                            <div class="shape-line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <i class="fas fa-handshake feature-icon"></i>
                            <div class="icon-glow"></div>
                        </div>
                        <h3>Layanan Profesional</h3>
                        <p>Tim profesional siap membantu kebutuhan bahan baku monel Anda.</p>
                        <div class="card-shapes">
                            <div class="shape-dot"></div>
                            <div class="shape-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section py-5">
        <div class="section-background">
            <div class="abstract-shape shape4"></div>
            <div class="abstract-shape shape5"></div>
            <div class="moving-dots"></div>
        </div>
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Tentang Tokomonel</h2>
                <div class="title-line"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5" data-aos="fade-up">
                    <p class="lead about-text">Kami adalah penyedia bahan baku monel terpercaya dengan pengalaman lebih dari 10 tahun dalam industri ini.</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-content">
                        <div class="about-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="about-icon-wrap">
                                <i class="fas fa-check-circle"></i>
                                <div class="icon-ring"></div>
                            </div>
                            <div>
                                <h4>Bahan Baku Berkualitas</h4>
                                <p>Menyediakan bahan baku monel dengan standar internasional dan kualitas terjamin.</p>
                            </div>
                        </div>
                        <div class="about-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="about-icon-wrap">
                                <i class="fas fa-check-circle"></i>
                                <div class="icon-ring"></div>
                            </div>
                            <div>
                                <h4>Harga Kompetitif</h4>
                                <p>Menawarkan harga yang bersaing dengan kualitas premium.</p>
                            </div>
                        </div>
                        <div class="about-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="about-icon-wrap">
                                <i class="fas fa-check-circle"></i>
                                <div class="icon-ring"></div>
                            </div>
                            <div>
                                <h4>Layanan 24/7</h4>
                                <p>Tim profesional siap membantu Anda kapan saja.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-image-grid">
                        <div class="grid-item grid-item-1" data-aos="zoom-in" data-aos-delay="100">
                            <div class="image-frame">
                                <img src="/images/monel-wire.jpg" alt="Kawat Monel Premium" class="img-fluid">
                                <div class="frame-border"></div>
                            </div>
                        </div>
                        <div class="grid-item grid-item-2" data-aos="zoom-in" data-aos-delay="200">
                            <div class="image-frame">
                                <img src="/images/monel-wire2.jpg" alt="Kawat Monel Premium" class="img-fluid">
                                <div class="frame-border"></div>
                            </div>
                        </div>
                        <div class="grid-item grid-item-3" data-aos="zoom-in" data-aos-delay="300">
                            <div class="image-frame">
                                <img src="/images/monel-wire3.jpg" alt="Kawat Monel Premium" class="img-fluid">
                                <div class="frame-border"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-section py-5" style="background:#fff;">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Produk Unggulan</h2>
                <div class="title-line"></div>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse($featured as $product)
                <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 shadow-sm border-0 product-featured">
                        <div class="overflow-hidden" style="height:220px;display:flex;align-items:center;justify-content:center;background:#fff;">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $product->name }}" style="max-height:200px;object-fit:contain;">
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title mb-1" style="font-weight:700;">{{ $product->name }}</h5>
                            <p class="card-text mb-2 text-primary" style="font-size:1.1rem;font-weight:600;">Rp {{ number_format($product->price, 0, ',', '.') }} <span style="font-size:0.9rem;font-weight:400;color:#888;">/ {{ $product->unit }}</span></p>
                            <a href="{{ url('/menu#product-' . $product->_id) }}" class="btn btn-warning mt-auto" style="border-radius:20px;font-weight:600;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Belum ada produk unggulan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="contact-section py-5">
        <div class="container">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <p class="lead">Kami siap membantu kebutuhan bahan baku monel Anda. Hubungi kami untuk informasi lebih lanjut.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Telepon</h3>
                        <p class="mb-0">+62 123 4567 890</p>
                        <p>Senin - Jumat, 08:00 - 17:00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email</h3>
                        <p class="mb-0">info@tokomonel.com</p>
                        <p>Respon dalam 24 jam</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Lokasi</h3>
                        <p class="mb-0">Jl. Industri No. 123</p>
                        <p>Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 