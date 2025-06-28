@extends('layouts.app')

@section('title', 'Kontak Kami - Tokomonel')

@section('content')
    <!-- Notifikasi Toast -->
    <div class="notification-toast" id="notification">
        <div class="toast-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="toast-content">
            <h4>Sukses!</h4>
            <p>Pesan Anda telah terkirim</p>
        </div>
        <button class="toast-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Loading Spinner -->
    <div id="loading">
        <div class="loading-content">
            <div class="spinner"></div>
            <p>Mengirim pesan...</p>
        </div>
    </div>

    <section class="contact-hero">
        <div class="hero-background">
            <div class="gradient-overlay"></div>
            <div class="animated-rings">
                <div class="ring ring-1"></div>
                <div class="ring ring-2"></div>
            </div>
            <div class="floating-elements">
                <div class="floating-circle"></div>
                <div class="floating-square"></div>
                <div class="floating-diamond"></div>
                <div class="glowing-orb"></div>
            </div>
            <div class="animated-lines">
                <div class="line line-1"></div>
                <div class="line line-2"></div>
                <div class="line line-3"></div>
            </div>
            <div class="geometric-shapes">
                <div class="geo-shape hex"></div>
                <div class="geo-shape triangle"></div>
                <div class="geo-shape circle"></div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="hero-badge" data-aos="fade-down">
                        <span>Premium Quality</span>
                    </div>
                    <h1 class="contact-title" data-aos="fade-up">
                        <span class="highlight">Hubungi</span> Kami
                    </h1>
                    <p class="contact-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Kami siap memberikan pelayanan terbaik untuk Anda
                    </p>
                </div>
            </div>

            <div class="row g-4 mt-5">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-ring"></div>
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Lokasi Kami</h3>
                        <p>Rejosari RT 3 RW 3<br>Pecangaan, Jepara</p>
                        <a href="#map" class="btn-contact">
                            <span>Petunjuk Arah</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-card featured">
                        <div class="card-icon">
                            <div class="icon-ring"></div>
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Hubungi Kami</h3>
                        <p>+62 1233 5181 53<br>Buka Setiap Hari</p>
                        <a href="tel:+621233518153" class="btn-contact">
                            <span>Hubungi Sekarang</span>
                            <i class="fas fa-phone"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="contact-card">
                        <div class="card-icon">
                            <div class="icon-ring"></div>
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Kami</h3>
                        <p>info@tokomonel.com<br>Respon dalam 24 jam</p>
                        <a href="mailto:info@tokomonel.com" class="btn-contact">
                            <span>Kirim Email</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="contact-form-wrapper">
                        <div class="form-header" data-aos="fade-up">
                            <div class="form-badge">
                                <span>Hubungi Kami</span>
                            </div>
                            <h2>Kirim Pesan</h2>
                            <p>Kami akan merespons pesan Anda secepatnya</p>
                        </div>
                        <form class="contact-form" id="contactForm" onsubmit="return handleSubmit(event)">
                            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name">Nama Lengkap</label>
                                        <div class="input-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <label for="email">Email</label>
                                        <div class="input-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                        <label for="phone">Nomor Telepon</label>
                                        <div class="input-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" data-aos="fade-up" data-aos-delay="400">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="input-wrapper">
                                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                        <label for="message">Pesan</label>
                                        <div class="input-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-action" data-aos="fade-up" data-aos-delay="500">
                                <button type="submit" class="btn-submit">
                                    <span>Kirim Pesan</span>
                                    <div class="btn-hover-effect"></div>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="map-container">
                        <div class="map-loading" id="map-loading">
                            <div class="spinner"></div>
                            <p>Memuat peta...</p>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambahkan particle background -->
    <div class="particles-container" id="particles-js"></div>

    <!-- Tambahkan Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
    .contact-hero {
        position: relative;
        min-height: 70vh;
        padding: 100px 0;
        background: linear-gradient(to bottom, #2B3B4C 0%, #2B3B4C 60%, #ffffff 100%);
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .gradient-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at top right, rgba(255,215,0,0.02) 0%, transparent 60%),
            radial-gradient(circle at bottom left, rgba(255,182,0,0.02) 0%, transparent 50%);
        opacity: 0.8;
    }

    .animated-rings {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .ring {
        position: absolute;
        border-radius: 50%;
        border: 2px solid rgba(255,215,0,0.15);
        animation: ringRotate 30s linear infinite;
        opacity: 0.5;
    }

    .ring-1 {
        top: 15%;
        right: 15%;
        width: 350px;
        height: 350px;
        border-width: 3px;
        border-color: rgba(255,215,0,0.2);
        animation-duration: 30s;
    }

    .ring-2 {
        bottom: 25%;
        left: 10%;
        width: 280px;
        height: 280px;
        border-width: 2px;
        border-color: rgba(255,215,0,0.25);
        animation-duration: 25s;
        animation-direction: reverse;
    }

    @keyframes ringRotate {
        0% {
            transform: rotate(0deg) scale(1);
            opacity: 0.3;
        }
        50% {
            transform: rotate(180deg) scale(1.2);
            opacity: 0.6;
        }
        100% {
            transform: rotate(360deg) scale(1);
            opacity: 0.3;
        }
    }

    .hero-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(43, 59, 76, 0.5);
        border: 1px solid rgba(255,215,0,0.3);
        border-radius: 30px;
        margin-bottom: 2rem;
    }

    .hero-badge span {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .contact-title {
        font-size: 4rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .contact-title .highlight {
        color: #FFD700;
        background: linear-gradient(45deg, #FFD700, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 3rem;
    }

    .contact-card {
        background: rgba(43, 59, 76, 0.4);
        border: 1px solid rgba(255,215,0,0.1);
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        backdrop-filter: blur(10px);
    }

    .contact-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255,215,0,0.3);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        background: rgba(43, 59, 76, 0.6);
    }

    .contact-card.featured {
        background: rgba(43, 59, 76, 0.5);
        border-color: rgba(255,215,0,0.2);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid rgba(255,215,0,0.2);
        border-radius: 50%;
        animation: pulseAndRotate 3s infinite ease-in-out;
    }

    @keyframes pulseAndRotate {
        0% {
            transform: rotate(0deg) scale(1);
            border-color: rgba(255,215,0,0.2);
        }
        50% {
            transform: rotate(180deg) scale(1.15);
            border-color: rgba(255,215,0,0.4);
        }
        100% {
            transform: rotate(360deg) scale(1);
            border-color: rgba(255,215,0,0.2);
        }
    }

    .contact-card:hover .icon-ring {
        animation: pulseAndRotateHover 1.5s infinite ease-in-out;
    }

    @keyframes pulseAndRotateHover {
        0% {
            transform: rotate(0deg) scale(1);
            border-color: rgba(255,215,0,0.3);
        }
        50% {
            transform: rotate(180deg) scale(1.25);
            border-color: rgba(255,215,0,0.6);
        }
        100% {
            transform: rotate(360deg) scale(1);
            border-color: rgba(255,215,0,0.3);
        }
    }

    .card-icon i {
        font-size: 2rem;
        color: #FFD700;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .contact-card:hover .card-icon i {
        transform: scale(1.1);
        color: #FFA500;
    }

    .contact-card h3 {
        color: #ffffff;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .contact-card p {
        color: rgba(255,255,255,0.7);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .btn-contact {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem 1.5rem;
        background: rgba(43, 59, 76, 0.5);
        color: #FFD700;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,215,0,0.2);
    }

    .btn-contact:hover {
        background: rgba(255,215,0,0.2);
        color: #ffffff;
        transform: translateX(5px);
    }

    .contact-form-section {
        padding: 100px 0;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .contact-form-wrapper {
        background: rgba(255,255,255,1);
        border: 1px solid rgba(43, 59, 76, 0.1);
        border-radius: 20px;
        padding: 3rem;
        position: relative;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .contact-form-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,215,0,0.03), transparent);
        border-radius: 20px;
        z-index: -1;
    }

    .form-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(255,215,0,0.1);
        border: 1px solid rgba(255,215,0,0.2);
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .form-badge span {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .form-header h2 {
        font-size: 2.5rem;
        color: #2B3B4C;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .form-header p {
        color: rgba(43, 59, 76, 0.7);
        font-size: 1.1rem;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }

    .input-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(43, 59, 76, 0.1);
        border-radius: 50%;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }

    .input-icon i {
        color: #2B3B4C;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-wrapper {
        flex: 1;
        position: relative;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 0;
        background: transparent;
        border: none;
        color: #2B3B4C;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
    }

    .input-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: rgba(43, 59, 76, 0.2);
        transition: all 0.3s ease;
    }

    .input-line::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #2B3B4C;
        transition: all 0.3s ease;
    }

    .form-control:focus ~ .input-line::after {
        width: 100%;
    }

    .input-wrapper label {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(43, 59, 76, 0.6);
        font-size: 1rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .form-control:focus ~ label,
    .form-control:valid ~ label {
        top: -5px;
        font-size: 0.875rem;
        color: #2B3B4C;
    }

    textarea.form-control ~ label {
        top: 20px;
    }

    textarea.form-control:focus ~ label,
    textarea.form-control:valid ~ label {
        top: -5px;
    }

    .input-group:hover .input-icon {
        background: rgba(43, 59, 76, 0.2);
        transform: scale(1.1);
    }

    .btn-submit {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 2.5rem;
        background: #2B3B4C;
        border: none;
        border-radius: 30px;
        color: #ffffff;
        font-weight: 600;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-hover-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #2B3B4C, #1a2530);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,215,0,0.2);
        color: #ffffff;
    }

    .btn-submit:hover .btn-hover-effect {
        opacity: 1;
    }

    .btn-submit span,
    .btn-submit i {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .btn-submit:hover i {
        transform: translateX(5px);
    }

    .map-container {
        position: relative;
        width: 100%;
        height: 500px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,215,0,0.1);
    }

    #map {
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    #map.loaded {
        opacity: 1;
    }

    .map-loading {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: rgba(43, 59, 76, 0.95);
        z-index: 2;
        transition: opacity 0.3s ease;
    }

    .map-loading.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .map-loading .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(255,215,0,0.1);
        border-top-color: #FFD700;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 15px;
    }

    .map-loading p {
        color: white;
        font-size: 16px;
        margin: 0;
    }

    @media (max-width: 991px) {
        .contact-title {
            font-size: 3rem;
        }
        
        .contact-form-wrapper {
            margin-bottom: 3rem;
        }
    }

    @media (max-width: 768px) {
        .contact-title {
            font-size: 2.5rem;
        }

        .contact-card {
            margin-bottom: 1rem;
        }
    }

    /* Floating Elements Animation */
    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-circle {
        position: absolute;
        width: 150px;
        height: 150px;
        border: 1px solid rgba(255,215,0,0.08);
        border-radius: 50%;
        top: 15%;
        right: 10%;
        animation: floatAnimation 15s infinite ease-in-out;
    }

    .floating-square {
        position: absolute;
        width: 100px;
        height: 100px;
        border: 1px solid rgba(255,215,0,0.08);
        transform: rotate(45deg);
        top: 60%;
        left: 5%;
        animation: floatAnimation 20s infinite ease-in-out reverse;
    }

    .floating-diamond {
        position: absolute;
        width: 120px;
        height: 120px;
        border: 1px solid rgba(255,215,0,0.08);
        transform: rotate(45deg);
        bottom: 15%;
        right: 15%;
        animation: floatAndRotate 25s infinite linear;
    }

    .glowing-orb {
        position: absolute;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,215,0,0.02) 0%, transparent 70%);
        border-radius: 50%;
        top: 30%;
        left: 20%;
        animation: pulseGlow 8s infinite ease-in-out;
    }

    /* Animated Lines */
    .animated-lines {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        opacity: 0.3;
    }

    .line {
        position: absolute;
        width: 1px;
        height: 100%;
        background: linear-gradient(to bottom, 
            transparent,
            rgba(255,215,0,0.03),
            rgba(255,215,0,0.05),
            rgba(255,215,0,0.03),
            transparent
        );
        animation: lineMove 15s infinite linear;
    }

    .line-1 { left: 20%; animation-delay: 0s; }
    .line-2 { left: 50%; animation-delay: -5s; }
    .line-3 { left: 80%; animation-delay: -10s; }

    /* Geometric Shapes */
    .geometric-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 1;
        pointer-events: none;
        z-index: 1;
    }

    .geo-shape {
        position: absolute;
        border: 2px solid rgba(255,215,0,0.2);
        backdrop-filter: blur(5px);
        animation: floatAndGlow 8s infinite ease-in-out;
    }

    .hex {
        width: 120px;
        height: 138px;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        top: 15%;
        left: 10%;
        border-color: rgba(255,215,0,0.3);
        animation: rotateAndFloat 20s infinite linear;
        background: linear-gradient(45deg, rgba(255,215,0,0.1), transparent);
    }

    .triangle {
        width: 100px;
        height: 100px;
        clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
        bottom: 25%;
        right: 15%;
        border-color: rgba(255,215,0,0.25);
        animation: bounceAndRotate 15s infinite ease-in-out;
        background: linear-gradient(-45deg, rgba(255,215,0,0.08), transparent);
    }

    .circle {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        top: 35%;
        right: 20%;
        border-color: rgba(255,215,0,0.2);
        animation: pulseAndSpin 12s infinite linear;
        background: radial-gradient(circle, rgba(255,215,0,0.05) 0%, transparent 70%);
    }

    @keyframes rotateAndFloat {
        0% {
            transform: rotate(0deg) translate(0, 0);
            opacity: 0.4;
        }
        25% {
            transform: rotate(90deg) translate(20px, 20px);
            opacity: 0.6;
        }
        50% {
            transform: rotate(180deg) translate(0, 40px);
            opacity: 0.8;
        }
        75% {
            transform: rotate(270deg) translate(-20px, 20px);
            opacity: 0.6;
        }
        100% {
            transform: rotate(360deg) translate(0, 0);
            opacity: 0.4;
        }
    }

    @keyframes bounceAndRotate {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.4;
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
            opacity: 0.7;
        }
    }

    @keyframes pulseAndSpin {
        0% {
            transform: scale(1) rotate(0deg);
            opacity: 0.3;
            border-width: 2px;
        }
        50% {
            transform: scale(1.2) rotate(180deg);
            opacity: 0.6;
            border-width: 3px;
        }
        100% {
            transform: scale(1) rotate(360deg);
            opacity: 0.3;
            border-width: 2px;
        }
    }

    @keyframes floatAndGlow {
        0%, 100% {
            box-shadow: 0 0 15px rgba(255,215,0,0.1);
            filter: brightness(1);
        }
        50% {
            box-shadow: 0 0 25px rgba(255,215,0,0.2);
            filter: brightness(1.2);
        }
    }

    /* Particle Background */
    .particles-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }

    /* Enhanced Floating Elements Animation */
    .floating-elements {
        animation: backgroundShift 20s infinite alternate;
    }

    @keyframes backgroundShift {
        0% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.1) rotate(5deg); }
        100% { transform: scale(1) rotate(0deg); }
    }

    .floating-circle {
        animation: floatCircle 15s infinite ease-in-out;
        box-shadow: 0 0 20px rgba(255,215,0,0.1);
    }

    @keyframes floatCircle {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(-20px, 20px) rotate(90deg); }
        50% { transform: translate(20px, -20px) rotate(180deg); }
        75% { transform: translate(20px, 20px) rotate(270deg); }
    }

    /* Elegant Toast Notification */
    .notification-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        min-width: 350px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1),
                    0 1px 8px rgba(0, 0, 0, 0.05),
                    0 0 1px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        transform: translateX(150%);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        z-index: 9999;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .notification-toast::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 16px;
        padding: 2px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    .notification-toast.show {
        transform: translateX(0);
    }

    .notification-toast.success {
        border-left: 4px solid #4CAF50;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.05), rgba(76, 175, 80, 0.02));
    }

    .notification-toast.error {
        border-left: 4px solid #f44336;
        background: linear-gradient(135deg, rgba(244, 67, 54, 0.05), rgba(244, 67, 54, 0.02));
    }

    .toast-icon {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .notification-toast.success .toast-icon {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
    }

    .notification-toast.error .toast-icon {
        background: linear-gradient(135deg, rgba(244, 67, 54, 0.2), rgba(244, 67, 54, 0.1));
    }

    .toast-icon i {
        font-size: 20px;
        background: linear-gradient(135deg, #2B3B4C, #1a2530);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .notification-toast.success .toast-icon i {
        background: linear-gradient(135deg, #43A047, #2E7D32);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .notification-toast.error .toast-icon i {
        background: linear-gradient(135deg, #E53935, #C62828);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .toast-content {
        flex: 1;
        min-width: 0;
    }

    .toast-content h4 {
        margin: 0;
        color: #2B3B4C;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .toast-content p {
        margin: 5px 0 0;
        color: rgba(43, 59, 76, 0.7);
        font-size: 14px;
        line-height: 1.5;
    }

    .toast-close {
        position: relative;
        width: 30px;
        height: 30px;
        padding: 0;
        background: rgba(43, 59, 76, 0.05);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .toast-close:hover {
        background: rgba(43, 59, 76, 0.1);
        transform: rotate(90deg);
    }

    .toast-close i {
        font-size: 14px;
        color: rgba(43, 59, 76, 0.6);
        transition: color 0.3s ease;
    }

    .toast-close:hover i {
        color: rgba(43, 59, 76, 0.8);
    }

    /* Elegant Loading Spinner */
    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(43, 59, 76, 0.3);
        backdrop-filter: blur(8px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-content {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(43, 59, 76, 0.1);
        border-top: 3px solid #2B3B4C;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    .loading-content p {
        color: #2B3B4C;
        font-size: 16px;
        margin: 0;
        font-weight: 500;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Toast Animation */
    @keyframes slideIn {
        from {
            transform: translateX(150%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .notification-toast.show {
        animation: slideIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    }

    #loading.show {
        animation: fadeIn 0.3s ease forwards;
    }

    /* Custom Popup Styles */
    .custom-popup {
        padding: 0;
        margin: 0;
    }

    .popup-content {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        min-width: 300px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .popup-header {
        background: linear-gradient(135deg, #2B3B4C 0%, #1a2530 100%);
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.3);
    }

    .popup-logo {
        width: 40px;
        height: 40px;
        object-fit: contain;
        border-radius: 8px;
        background: white;
        padding: 5px;
    }

    .popup-header h3 {
        color: white;
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .popup-body {
        padding: 15px;
    }

    .popup-section {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .popup-section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .popup-section i {
        color: #2B3B4C;
        font-size: 16px;
        padding-top: 3px;
    }

    .popup-section p {
        margin: 0;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
    }

    .popup-footer {
        padding: 15px;
        background: rgba(43, 59, 76, 0.05);
        border-top: 1px solid rgba(0,0,0,0.1);
    }

    .direction-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        background: #2B3B4C;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .direction-btn:hover {
        background: #1a2530;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        color: #FFD700;
        text-decoration: none;
    }

    .direction-btn i {
        font-size: 16px;
    }

    /* Override Leaflet Default Styles */
    .leaflet-popup-content-wrapper {
        padding: 0;
        border-radius: 12px;
        overflow: hidden;
    }

    .leaflet-popup-content {
        margin: 0;
        width: auto !important;
    }

    .leaflet-popup-close-button {
        color: white !important;
        margin: 8px !important;
    }

    .leaflet-popup-tip {
        background: #2B3B4C !important;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Koordinat lokasi yang tepat di Rejosari, Pecangaan
        const lat = -6.719755;
        const lng = 110.711367;

        // Inisialisasi peta
        const map = L.map('map', {
            center: [lat, lng],
            zoom: 18, // Zoom level ditingkatkan untuk detail yang lebih jelas
            zoomControl: true,
            scrollWheelZoom: true // Mengaktifkan zoom dengan scroll mouse
        });

        // Tambahkan tile layer dengan style yang lebih detail
        L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Custom icon yang lebih menonjol
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: `
                <div style="
                    background: #2B3B4C; 
                    width: 24px; 
                    height: 24px; 
                    border-radius: 50%; 
                    border: 3px solid #FFD700; 
                    box-shadow: 0 0 15px rgba(255,215,0,0.5);
                    position: relative;
                ">
                    <div style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 8px;
                        height: 8px;
                        background: #FFD700;
                        border-radius: 50%;
                    "></div>
                </div>
            `,
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });

        // Tambahkan marker dengan animasi
        const marker = L.marker([lat, lng], {
            icon: customIcon,
            title: 'Tokomonel - Rejosari, Pecangaan'
        }).addTo(map);

        // Tambahkan animasi bounce saat marker muncul
        marker.on('add', function() {
            const el = this._icon;
            el.style.transform += ' scale(0)';
            el.style.transition = 'transform 0.5s ease-out';
            setTimeout(() => {
                el.style.transform = el.style.transform.replace(' scale(0)', '') + ' scale(1)';
            }, 10);
        });

        // Custom popup content dengan informasi yang lebih lengkap
        const popupContent = `
            <div class="popup-content">
                <div class="popup-header">
                    <img src="/images/logo.png" alt="Tokomonel Logo" class="popup-logo">
                    <h3>Tokomonel</h3>
                </div>
                <div class="popup-body">
                    <div class="popup-section">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Rejosari RT 3 RW 3<br>Pecangaan, Jepara<br>Jawa Tengah, Indonesia<br>Kode Pos: 59462</p>
                    </div>
                    <div class="popup-section">
                        <i class="fas fa-clock"></i>
                        <p>Buka Setiap Hari<br>Senin - Ahad: 07:00 - 20:00 WIB</p>
                    </div>
                    <div class="popup-section">
                        <i class="fas fa-phone-alt"></i>
                        <p>+62 1233 5181 53</p>
                    </div>
                </div>
                <div class="popup-footer">
                    <a href="https://www.openstreetmap.org/directions?from=&to=${lat},${lng}" 
                       target="_blank" 
                       class="direction-btn">
                        <i class="fas fa-directions"></i>
                        Petunjuk Arah ke Tokomonel
                    </a>
                </div>
            </div>
        `;

        // Tambahkan popup dengan animasi
        marker.bindPopup(popupContent, {
            className: 'custom-popup',
            maxWidth: 'auto',
            closeButton: true,
            closeOnClick: false
        }).openPopup();

        // Tambahkan circle area untuk menandai area sekitar
        L.circle([lat, lng], {
            color: '#2B3B4C',
            fillColor: '#FFD700',
            fillOpacity: 0.1,
            radius: 50,
            weight: 1
        }).addTo(map);

        // Sembunyikan loading setelah peta dimuat
        map.whenReady(() => {
            document.getElementById('map').classList.add('loaded');
            document.getElementById('map-loading').classList.add('hidden');
        });

        // Handle error
        map.on('error', function() {
            const mapLoading = document.getElementById('map-loading');
            if (mapLoading) {
                mapLoading.innerHTML = `
                    <div class="map-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Gagal memuat peta. Silakan coba lagi nanti.</p>
                    </div>
                `;
            }
        });

        // Fungsi untuk menampilkan notifikasi
        function showToast(type, title, message) {
            const toast = document.getElementById('notification');
            const toastIcon = toast.querySelector('.toast-icon i');
            const toastTitle = toast.querySelector('h4');
            const toastMessage = toast.querySelector('p');
            
            // Reset kelas
            toast.classList.remove('success', 'error');
            
            // Atur jenis notifikasi
            toast.classList.add(type);
            
            // Update ikon
            toastIcon.className = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle';
            
            // Update konten
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            
            // Tampilkan toast
            toast.classList.add('show');
            
            // Sembunyikan toast setelah 5 detik
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        // Fungsi untuk menangani submit form
        function handleSubmit(event) {
            event.preventDefault();
            
            // Ambil semua input yang diperlukan
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();
            
            // Validasi form
            if (!name || !email || !phone || !message) {
                showToast('error', 'Error!', 'Mohon lengkapi semua field yang diperlukan');
                return false;
            }
            
            // Tampilkan loading
            const loading = document.getElementById('loading');
            loading.style.display = 'flex';
            
            // Simulasi pengiriman pesan
            setTimeout(() => {
                loading.style.display = 'none';
                showToast('success', 'Sukses!', 'Pesan Anda telah terkirim');
                
                // Reset form
                document.getElementById('contactForm').reset();
            }, 1500);
            
            return false;
        }

        // Tambahkan event listener untuk tombol close pada toast
        const toastClose = document.querySelector('.toast-close');
        if (toastClose) {
            toastClose.addEventListener('click', function() {
                document.getElementById('notification').classList.remove('show');
            });
        }

        // Tambahkan event listener untuk form
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', handleSubmit);
        }
    });
    </script>

    <!-- Tambahkan Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Tambahkan Particle.js library -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
@endsection
