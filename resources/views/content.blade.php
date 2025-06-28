@extends('layouts.app')

@section('title', 'Konten - Tokomonel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/content.css') }}">

<div class="container">
    <!-- Header Section -->
    <div class="content-header">
        <h1>Artikel & Tutorial</h1>
        <p>Temukan berbagai informasi menarik seputar perhiasan monel</p>
    </div>

    <!-- Filter Section -->
    <div class="content-filter">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="tutorial">Tutorial</button>
            <button class="filter-btn" data-filter="tips">Tips & Trik</button>
            <button class="filter-btn" data-filter="trend">Trend</button>
            <button class="filter-btn" data-filter="event">Event</button>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Cari artikel..." id="searchInput">
            <i class="fas fa-search"></i>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Tutorial Card 1 -->
        <div class="content-card" data-category="tutorial">
            <div class="card-image">
                <img src="{{ asset('images/content/tutorial-ring.jpg') }}" alt="Tutorial Cincin">
                <span class="badge tutorial">Tutorial</span>
                <div class="card-overlay">
                    <span class="read-more">Baca Selengkapnya</span>
                </div>
            </div>
            <div class="card-content">
                <h3>Tutorial Membuat Cincin Monel Premium</h3>
                <div class="meta">
                    <span><i class="fas fa-calendar"></i> 15 Mar 2024</span>
                    <span><i class="fas fa-eye"></i> 1.2k views</span>
                    <span><i class="fas fa-comments"></i> 8 komentar</span>
                </div>
                <p>Pelajari teknik profesional membuat cincin monel dengan finishing premium. Tutorial lengkap dari pemilihan bahan hingga finishing.</p>
                <div class="card-tags">
                    <span>#Tutorial</span>
                    <span>#Cincin</span>
                    <span>#Premium</span>
                </div>
            </div>
        </div>

        <!-- Tips Card -->
        <div class="content-card" data-category="tips">
            <div class="card-image">
                <img src="{{ asset('images/content/maintenance.jpg') }}" alt="Tips Perawatan">
                <span class="badge tips">Tips & Trik</span>
                <div class="card-overlay">
                    <span class="read-more">Baca Selengkapnya</span>
                </div>
            </div>
            <div class="card-content">
                <h3>7 Tips Merawat Perhiasan Monel Agar Awet</h3>
                <div class="meta">
                    <span><i class="fas fa-calendar"></i> 12 Mar 2024</span>
                    <span><i class="fas fa-eye"></i> 956 views</span>
                    <span><i class="fas fa-comments"></i> 12 komentar</span>
                </div>
                <p>Panduan lengkap cara merawat perhiasan monel agar tetap berkilau dan tahan lama. Termasuk tips membersihkan dan menyimpan.</p>
                <div class="card-tags">
                    <span>#Perawatan</span>
                    <span>#Tips</span>
                    <span>#Perhiasan</span>
                </div>
            </div>
        </div>

        <!-- Trend Card -->
        <div class="content-card" data-category="trend">
            <div class="card-image">
                <img src="{{ asset('images/content/trend.jpg') }}" alt="Trend 2024">
                <span class="badge trend">Trend</span>
                <div class="card-overlay">
                    <span class="read-more">Baca Selengkapnya</span>
                </div>
            </div>
            <div class="card-content">
                <h3>Trend Perhiasan Monel 2024</h3>
                <div class="meta">
                    <span><i class="fas fa-calendar"></i> 10 Mar 2024</span>
                    <span><i class="fas fa-eye"></i> 1.5k views</span>
                    <span><i class="fas fa-comments"></i> 15 komentar</span>
                </div>
                <p>Temukan trend terbaru desain perhiasan monel di tahun 2024. Dari gaya minimalis hingga vintage yang kembali populer.</p>
                <div class="card-tags">
                    <span>#Trend2024</span>
                    <span>#Fashion</span>
                    <span>#Design</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="load-more">
        <button class="load-more-btn">Muat Lebih Banyak</button>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Filter functionality
    $('.filter-btn').click(function() {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if(filter === 'all') {
            $('.content-card').fadeIn();
        } else {
            $('.content-card').hide();
            $('.content-card[data-category="' + filter + '"]').fadeIn();
        }
    });

    // Search functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.content-card').filter(function() {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(value) > -1);
        });
    });

    // Load more functionality
    let currentItems = 3;
    $('.content-card:gt(' + (currentItems - 1) + ')').hide();
    
    $('.load-more-btn').click(function() {
        currentItems += 3;
        $('.content-card:lt(' + currentItems + ')').fadeIn();
        
        if(currentItems >= $('.content-card').length) {
            $(this).hide();
        }
    });
});
</script>
@endpush
@endsection 