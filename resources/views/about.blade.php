@extends('layouts.app')

@section('title', 'Tentang Kami - Tokomonel')

@section('content')
<!-- Animated Background Elements -->
<div class="animated-bg">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="circle circle-3"></div>
    <div class="line line-1"></div>
    <div class="line line-2"></div>
</div>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4 text-gradient">Tokomonel</h1>
                <p class="lead mb-4 text-fade-in">Spesialis Perhiasan Monel Premium dengan Pengalaman Lebih dari 10 Tahun</p>
                <p class="text-muted text-fade-in-delay">Kami adalah toko perhiasan monel terpercaya yang menghadirkan produk berkualitas tinggi dengan desain eksklusif dan pelayanan profesional.</p>
                <div class="mt-4 hero-buttons" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('menu') }}" class="btn btn-primary btn-lg me-3">Lihat Koleksi</a>
                    <a href="#contact" class="btn btn-outline-dark btn-lg">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('images/about/store-front.jpg') }}" alt="Toko Kami" class="img-fluid rounded-3 shadow-lg">
                    <div class="floating-card card-1">
                        <i class="fas fa-gem"></i>
                        <span>Premium Quality</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-award"></i>
                        <span>Best Seller</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi Section -->
<section class="vision-mission py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="card h-100 border-0 shadow-lg vision-card">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="card-decoration"></div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-eye fa-2x text-primary me-3"></i>
                            <h3 class="mb-0">Visi</h3>
                        </div>
                        <p class="card-text">Menjadi toko perhiasan monel terkemuka yang menghadirkan produk berkualitas premium dengan harga terjangkau untuk semua kalangan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-lg mission-card">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="card-decoration"></div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-bullseye fa-2x text-primary me-3"></i>
                            <h3 class="mb-0">Misi</h3>
                        </div>
                        <ul class="list-unstyled mission-list">
                            <li class="mb-3" data-aos="fade-left" data-aos-delay="200">
                                <i class="fas fa-check text-success me-2"></i> 
                                Menghadirkan perhiasan monel berkualitas tinggi
                            </li>
                            <li class="mb-3" data-aos="fade-left" data-aos-delay="300">
                                <i class="fas fa-check text-success me-2"></i> 
                                Memberikan pelayanan terbaik kepada pelanggan
                            </li>
                            <li class="mb-3" data-aos="fade-left" data-aos-delay="400">
                                <i class="fas fa-check text-success me-2"></i> 
                                Mengembangkan desain yang inovatif
                            </li>
                            <li data-aos="fade-left" data-aos-delay="500">
                                <i class="fas fa-check text-success me-2"></i> 
                                Mendukung pengrajin lokal
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan Section -->
<section class="features py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title" data-aos="fade-up">Keunggulan Kami</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center">
                    <div class="icon-wrapper">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Kualitas Premium</h4>
                    <p>Menggunakan bahan monel berkualitas tinggi dengan finishing yang sempurna.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center">
                    <div class="icon-wrapper">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h4>Garansi Produk</h4>
                    <p>Memberikan garansi untuk setiap produk yang kami jual.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Pengrajin Ahli</h4>
                    <p>Didukung oleh pengrajin berpengalaman dan profesional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tim Section with Parallax -->
<section class="team-section py-5" data-parallax="scroll" data-image-src="{{ asset('images/about/pattern-bg.jpg') }}">
    <div class="container">
        <h2 class="text-center mb-5 section-title" data-aos="fade-up">Tim Kami</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="flip-left">
                <div class="team-card">
                    <div class="card-front">
                        <img src="{{ asset('images/about/team-1.jpg') }}" alt="CEO">
                        <div class="overlay">
                            <h5>Ahmad Suherman</h5>
                            <p>CEO & Founder</p>
                        </div>
                    </div>
                    <div class="card-back">
                        <h5>Ahmad Suherman</h5>
                        <p class="position">CEO & Founder</p>
                        <p class="bio">Berpengalaman lebih dari 15 tahun dalam industri perhiasan monel.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-left" data-aos-delay="100">
                <div class="team-card">
                    <div class="card-front">
                        <img src="{{ asset('images/about/team-2.jpg') }}" alt="Designer">
                        <div class="overlay">
                            <h5>Siti Aminah</h5>
                            <p>Head Designer</p>
                        </div>
                    </div>
                    <div class="card-back">
                        <h5>Siti Aminah</h5>
                        <p class="position">Head Designer</p>
                        <p class="bio">Desainer kreatif dengan ratusan desain perhiasan original.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-behance"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-left" data-aos-delay="200">
                <div class="team-card">
                    <div class="card-front">
                        <img src="{{ asset('images/about/team-3.jpg') }}" alt="Craftsman">
                        <div class="overlay">
                            <h5>Budi Santoso</h5>
                            <p>Master Craftsman</p>
                        </div>
                    </div>
                    <div class="card-back">
                        <h5>Budi Santoso</h5>
                        <p class="position">Master Craftsman</p>
                        <p class="bio">Ahli kerajinan monel dengan keahlian tingkat tinggi.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sertifikasi Section with 3D Effect -->
<section class="certification-section py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title" data-aos="fade-up">Sertifikasi & Prestasi</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="cert-card">
                    <div class="cert-content">
                        <div class="cert-icon">
                            <img src="{{ asset('images/about/cert-1.png') }}" alt="Sertifikat 1">
                        </div>
                        <h5>Sertifikat Kualitas Produk</h5>
                        <p>Tersertifikasi standar kualitas nasional</p>
                    </div>
                    <div class="cert-shine"></div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="cert-card">
                    <div class="cert-content">
                        <div class="cert-icon">
                            <img src="{{ asset('images/about/cert-2.png') }}" alt="Sertifikat 2">
                        </div>
                        <h5>Penghargaan UMKM</h5>
                        <p>UMKM terbaik kategori kerajinan 2023</p>
                    </div>
                    <div class="cert-shine"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS Styles -->
<style>
/* Animated Background */
.animated-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
}

.circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(44, 62, 80, 0.3), rgba(52, 73, 94, 0.2));
    animation: float 15s infinite ease-in-out;
}

.circle-1 {
    width: 300px;
    height: 300px;
    top: -150px;
    right: -150px;
}

.circle-2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    left: -100px;
    animation-delay: -5s;
}

.circle-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 15%;
    animation-delay: -7s;
}

.line {
    position: absolute;
    background: linear-gradient(90deg, transparent, rgba(44, 62, 80, 0.2), transparent);
    transform: rotate(-45deg);
}

.line-1 {
    width: 100%;
    height: 2px;
    top: 25%;
    animation: slideLine 20s infinite linear;
}

.line-2 {
    width: 100%;
    height: 2px;
    bottom: 35%;
    animation: slideLine 15s infinite linear;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

@keyframes slideLine {
    0% { transform: translateX(-100%) rotate(-45deg); }
    100% { transform: translateX(100%) rotate(-45deg); }
}

/* Hero Section */
.about-hero {
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}

.text-gradient {
    background: linear-gradient(45deg, #1a1a1a, #2c3e50);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientText 8s infinite;
}

@keyframes gradientText {
    0%, 100% { filter: hue-rotate(0deg); }
    50% { filter: hue-rotate(30deg); }
}

.hero-image-wrapper {
    position: relative;
    perspective: 1000px;
}

.hero-image-wrapper img {
    transform: rotateY(-5deg);
    transition: transform 0.5s ease;
}

.hero-image-wrapper:hover img {
    transform: rotateY(0deg);
}

.floating-card {
    position: absolute;
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 10px;
    animation: float 6s infinite ease-in-out;
}

.card-1 {
    top: 20px;
    right: -20px;
}

.card-2 {
    bottom: 20px;
    left: -20px;
    animation-delay: -3s;
}

/* Vision Mission Cards */
.vision-card, .mission-card {
    position: relative;
    overflow: hidden;
    background: white;
    z-index: 1;
}

.vision-card .fas, .mission-card .fas {
    color: #2c3e50;
}

.vision-card:hover, .mission-card:hover {
    background: linear-gradient(45deg, rgba(44, 62, 80, 0.05), rgba(52, 73, 94, 0.1));
}

.card-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, transparent 50%, rgba(44, 62, 80, 0.2) 50%);
    z-index: -1;
    transition: transform 0.3s ease;
}

.vision-card:hover .card-decoration,
.mission-card:hover .card-decoration {
    transform: scale(1.2) rotate(45deg);
}

/* Feature Cards */
.feature-card {
    padding: 30px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(45deg, #2c3e50, #34495e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    position: relative;
}

.icon-wrapper::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: inherit;
    border-radius: inherit;
    filter: blur(10px);
    opacity: 0.5;
    z-index: -1;
}

/* Team Cards */
.team-card {
    position: relative;
    height: 400px;
    perspective: 1000px;
}

.card-front,
.card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    transition: transform 0.6s;
    border-radius: 15px;
    overflow: hidden;
}

.card-front {
    background: white;
}

.card-back {
    background: linear-gradient(45deg, #1a1a1a, #2c3e50);
    color: white;
    transform: rotateY(180deg);
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.team-card:hover .card-front {
    transform: rotateY(180deg);
}

.team-card:hover .card-back {
    transform: rotateY(0deg);
}

.card-front img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: 20px;
    color: white;
}

.social-links {
    margin-top: 20px;
}

.social-links a {
    color: white;
    margin: 0 10px;
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

.social-links a:hover {
    transform: scale(1.2);
}

/* Certification Cards */
.cert-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.cert-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        to right,
        transparent,
        rgba(255,255,255,0.8),
        transparent
    );
    transform: skewX(-25deg);
    animation: shine 3s infinite;
}

@keyframes shine {
    0% { left: -100%; }
    20% { left: 200%; }
    100% { left: 200%; }
}

.cert-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
    position: relative;
}

.cert-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-hero {
        padding: 80px 0 40px;
    }
    
    .floating-card {
        display: none;
    }
    
    .team-card {
        height: 350px;
    }
}

.btn-primary {
    background: linear-gradient(45deg, #2c3e50, #34495e);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #34495e, #2c3e50);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
}

.d-flex .fa-eye,
.d-flex .fa-bullseye {
    color: #2c3e50 !important;
}

.mission-list .fa-check {
    color: #2c3e50 !important;
}

.card-body .d-flex i {
    color: #2c3e50 !important;
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

<!-- Parallax Library -->
<script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
@endsection 