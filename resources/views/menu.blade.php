@extends('layouts.app')

@section('title', 'Katalog Produk - Tokomonel')

@section('content')
    <section class="menu-header py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="title-wrapper">
                        <h1 class="menu-title animate-title">Katalog Produk Tokomonel</h1>
                        <div class="title-decoration"></div>
                    </div>
                    <p class="menu-subtitle animate-subtitle">Temukan berbagai bahan baku berkualitas untuk kebutuhan aksesoris dan kerajinan Anda</p>
                    
                    <!-- Search Bar -->
                    <div class="search-bar flex-grow-1 animate-search">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari produk...">
                            <button class="btn btn-custom" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .menu-header {
            position: relative;
            overflow: hidden;
        }

        .menu-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            transform: translateX(-100%);
            animation: shimmer 2s infinite;
        }

        .title-wrapper {
            position: relative;
            margin-bottom: 2rem;
            perspective: 1000px;
        }

        .animate-title {
            animation: titleReveal 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            display: inline-block;
            transform-origin: center;
        }

        .title-decoration {
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: currentColor;
            animation: lineExpand 0.8s cubic-bezier(0.17, 0.67, 0.83, 0.67) 0.8s forwards;
            opacity: 0.7;
        }

        .title-decoration::before,
        .title-decoration::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            top: 50%;
            transform: translateY(-50%) scale(0);
            animation: dotScale 0.5s ease forwards 1.4s;
        }

        .title-decoration::before {
            left: 0;
        }

        .title-decoration::after {
            right: 0;
        }

        .animate-subtitle {
            animation: subtitleReveal 0.8s cubic-bezier(0.215, 0.61, 0.355, 1) 0.4s;
            opacity: 0;
            animation-fill-mode: forwards;
            position: relative;
            transform-origin: center;
        }

        .animate-search {
            animation: searchReveal 1s cubic-bezier(0.215, 0.61, 0.355, 1) 0.8s;
            opacity: 0;
            animation-fill-mode: forwards;
            transform-origin: top;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .search-bar:hover {
            transform: translateY(-2px) scale(1.01);
        }

        .search-bar .input-group {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 30px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .search-bar:hover .input-group {
            box-shadow: 0 6px 25px rgba(0,0,0,0.15);
        }

        .search-bar input {
            padding: 15px 25px;
            transition: all 0.3s ease;
        }

        .search-bar .btn-custom {
            padding: 12px 25px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-bar .btn-custom:hover {
            transform: scale(1.05);
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        @keyframes titleReveal {
            0% {
                opacity: 0;
                transform: rotateX(30deg) translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: rotateX(0) translateY(0);
            }
        }

        @keyframes lineExpand {
            0% {
                width: 0;
                opacity: 0;
            }
            100% {
                width: 120px;
                opacity: 0.7;
            }
        }

        @keyframes dotScale {
            0% {
                transform: translateY(-50%) scale(0);
                opacity: 0;
            }
            100% {
                transform: translateY(-50%) scale(1);
                opacity: 0.7;
            }
        }

        @keyframes subtitleReveal {
            0% {
                opacity: 0;
                transform: scale(0.95) translateY(20px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes searchReveal {
            0% {
                opacity: 0;
                transform: scaleY(0.8);
            }
            100% {
                opacity: 1;
                transform: scaleY(1);
            }
        }

        /* Floating animation for search bar */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-bar {
                width: 90%;
            }
            
            .title-decoration {
                animation: lineExpand 0.8s cubic-bezier(0.17, 0.67, 0.83, 0.67) 0.8s forwards;
            }
            
            @keyframes lineExpand {
                100% {
                    width: 80px;
                }
            }
        }

        /* ... kode CSS lain ... */
        .modal-title {
            color: #fff !important;
            font-weight: bold;
        }
        </style>
    </section>

    <!-- Produk Terlaris -->
    <section class="bestseller-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Produk Terlaris</h2>
            <div class="row g-4">
                @foreach($bestsellers as $product)
                <div class="col-md-4">
                    <div class="product-card bestseller">
                        <div class="product-image">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid">
                            <div class="product-tag">Bestseller</div>
                        </div>
                        <div class="product-content">
                            <div class="bestseller-badge">
                                <i class="fas fa-crown"></i> Best Seller
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <div class="product-specs">
                                <span><i class="fas fa-ruler-combined"></i> {{ $product->min_size }}mm - {{ $product->max_size }}mm</span>
                                <span><i class="fas fa-star"></i> 4.9 (2.1rb)</span>
                            </div>
                            <div class="product-price">
                                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="unit">/ {{ $product->unit }}</span>
                            </div>
                            <div class="stock-info">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                </div>
                                <small class="text-success"><i class="fas fa-box"></i> Stok: Tersedia ({{ $product->stock }} {{ $product->unit }})</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Keunggulan Produk -->
            <div class="product-features mt-5">
                <div class="row text-center g-4">
                    <div class="col-md-3">
                        <div class="feature-item">
                            <i class="fas fa-medal fa-2x text-primary mb-3"></i>
                            <h5>Kualitas Premium</h5>
                            <p>Material berkualitas tinggi, tahan karat & tidak luntur</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-item">
                            <i class="fas fa-certificate fa-2x text-primary mb-3"></i>
                            <h5>Tersertifikasi</h5>
                            <p>Produk telah lulus uji standar nasional</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-item">
                            <i class="fas fa-shipping-fast fa-2x text-primary mb-3"></i>
                            <h5>Pengiriman Cepat</h5>
                            <p>Tersedia pengiriman express 1-2 hari</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-item">
                            <i class="fas fa-headset fa-2x text-primary mb-3"></i>
                            <h5>Layanan 24/7</h5>
                            <p>Konsultasi gratis & dukungan teknis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .bestseller-section {
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
        }
        
        .product-card.bestseller {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .product-card.bestseller:hover {
            transform: translateY(-5px);
        }

        .product-image {
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .bestseller-badge {
            display: inline-block;
            background: #ffd700;
            color: #000;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }

        .product-content {
            padding: 20px;
        }

        .product-specs {
            margin: 10px 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .product-specs span {
            margin-right: 15px;
        }

        .product-price {
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.25rem;
            transition: color 0.3s ease;
        }

        .product-card:hover .product-price {
            color: #34495e;
        }

        .price-tag {
            color: #2c3e50;
        }

        .bestseller .product-price,
        .featured .product-price {
            color: #2c3e50;
            font-size: 1.4rem;
        }

        .discount-price {
            color: #2c3e50;
        }

        .original-price {
            text-decoration: line-through;
            color: #95a5a6;
        }

        .product-price .unit {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .feature-item {
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            height: 100%;
        }

        .feature-item p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }
        </style>
    </section>

    <section class="menu-categories py-4">
        <div class="container">
            <div class="category-filters text-center mb-5">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="category-buttons">
                        <button class="btn btn-category active" data-category="semua">Semua</button>
                        <button class="btn btn-category" data-category="kawat">Kawat</button>
                        <button class="btn btn-category" data-category="plat">Plat</button>
                        <button class="btn btn-category" data-category="premium">Premium</button>
                        <button class="btn btn-category" data-category="aksesoris">Aksesoris</button>
                    </div>
                    <div class="sorting-options mt-3 mt-md-0">
                        <select class="form-select" id="sortProducts">
                            <option value="default">Urutkan Produk</option>
                            <option value="price-asc">Harga: Rendah ke Tinggi</option>
                            <option value="price-desc">Harga: Tinggi ke Rendah</option>
                            <option value="name-asc">Nama: A ke Z</option>
                            <option value="name-desc">Nama: Z ke A</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Loading Animation -->
            <div class="loading-overlay">
                <div class="loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Mencari produk...</p>
                </div>
            </div>

            <div class="row g-4" id="product-container">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4 product-item" data-category="{{ $product->category }}">
                    <div class="product-card" data-product-id="{{ $product->_id }}">
                        <div class="product-image">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid">
                            @if($product->is_bestseller)
                            <div class="product-tag">Bestseller</div>
                            @elseif($product->is_featured)
                            <div class="product-tag">Featured</div>
                            @endif
                        </div>
                        <div class="product-content">
                            <h3>{{ $product->name }}</h3>
                            <div class="product-specs">
                                <span><i class="fas fa-ruler-combined"></i> {{ $product->min_size }}mm - {{ $product->max_size }}mm</span>
                                <span><i class="fas fa-palette"></i> {{ ucfirst($product->category) }}</span>
                            </div>
                            <div class="product-price mb-2">
                                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="unit">/ {{ $product->unit }}</span>
                            </div>
                            <div class="stock-info mb-3">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, ($product->stock/200)*100) }}%"></div>
                                </div>
                                <small class="text-success"><i class="fas fa-box"></i> Stok: {{ $product->stock }} {{ $product->unit }}</small>
                            </div>
                            <p class="product-description">{{ $product->description }}</p>
                            <div class="product-footer">
                                <button class="btn btn-custom btn-add-to-cart" data-product-id="{{ $product->_id }}">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                                <button class="btn btn-outline-secondary btn-detail">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Galeri Gambar -->
                            <div class="product-gallery mb-3">
                                <div class="main-image">
                                    <img src="" alt="" class="img-fluid rounded" id="modalProductImage">
                                </div>
                                <div class="thumbnail-images mt-2 d-flex gap-2" id="modalProductGallery">
                                    <!-- Thumbnail images akan di-render di sini -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 id="modalProductTitle"></h3>
                            
                            <!-- Rating dan Review -->
                            <div class="product-rating mb-3">
                                <div class="stars" id="modalProductStars"></div>
                            </div>

                            <div class="product-price mb-3">
                                <span class="price" id="modalProductPrice"></span>
                                <span class="unit" id="modalProductUnit"></span>
                            </div>

                            <!-- Stok Real-time -->
                            <div class="stock-info mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-box me-2"></i>
                                    <div>
                                        <p class="mb-0" id="modalProductStock"></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Estimasi Pengiriman -->
                            <div class="shipping-info mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-truck me-2"></i>
                                    <div>
                                        <p class="mb-0">Estimasi Pengiriman:</p>
                                        <small class="text-muted">2-3 hari kerja (Jakarta)</small>
                                        <small class="text-muted d-block">3-5 hari kerja (Luar Jakarta)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="product-specs mb-3" id="modalProductSpecs"></div>
                            <p class="product-description" id="modalProductDesc"></p>

                            <!-- Pilihan Ukuran -->
                            <div class="product-variants mb-3">
                                <h6>Pilihan Ukuran:</h6>
                                <select class="form-select" id="modalProductSize">
                                    <!-- Opsi ukuran akan diisi lewat JS -->
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3">
                                <label class="form-label">Jumlah:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" id="quickViewDecrease">-</button>
                                    <input type="number" class="form-control text-center" value="1" min="1" id="quickViewQty">
                                    <button class="btn btn-outline-secondary" type="button" id="quickViewIncrease">+</button>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="total-price mb-3">
                                <label class="form-label">Total Harga:</label>
                                <h4 class="text-warning" id="modalTotalPrice">Rp 0</h4>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-grid gap-2">
                                <button class="btn btn-custom" id="quickViewOrderBtn">
                                    <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                                </button>
                                <button class="btn btn-outline-secondary" id="quickViewAddToCart">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @if(isset($user) && $user)
                        <button class="btn btn-primary mt-3 mb-2" id="toggleReviewForm">Tambah Review</button>
                        <div id="reviewList" class="mb-3"></div>
                        <div id="reviewFormWrapper" style="display:none;">
                            <div class="card shadow-sm mb-3 mt-2">
                                <div class="card-body">
                                    <h5 class="mb-3">Tulis Review Produk</h5>
                                    <form id="formReviewProduk" enctype="multipart/form-data">
                                        <input type="hidden" id="reviewUserName" name="user_name" value="{{ $user->name }}">
                                        <div class="mb-2"><strong>Nama: {{ $user->name }}</strong></div>
                                        <div class="mb-2">
                                            <label for="reviewText" class="form-label">Komentar</label>
                                            <textarea class="form-control" id="reviewText" name="review_text" rows="2" required></textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Rating</label>
                                            <select class="form-select" name="rating" required>
                                                <option value="">Pilih Bintang</option>
                                                <option value="5">5 - Sangat Bagus</option>
                                                <option value="4">4 - Bagus</option>
                                                <option value="3">3 - Cukup</option>
                                                <option value="2">2 - Kurang</option>
                                                <option value="1">1 - Buruk</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reviewPhoto" class="form-label">Foto (opsional)</label>
                                            <input type="file" class="form-control" id="reviewPhoto" name="photo" accept="image/*">
                                        </div>
                                        <input type="hidden" id="reviewProductId" name="product_id">
                                        <button type="submit" class="btn btn-primary">Kirim Review</button>
                                    </form>
                                    <div id="reviewSuccessMsg" class="alert alert-success mt-3 d-none">Review berhasil dikirim!</div>
                                    <div id="reviewErrorMsg" class="alert alert-danger mt-3 d-none"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Order Modal untuk Quick View -->
    <div class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Produk</label>
                                    <input type="text" class="form-control" id="productName" readonly>
                                    <input type="hidden" id="productPrice">
                                </div>
                                <div class="mb-3">
                                    <label for="buyer_name" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" id="buyer_name" name="buyer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="buyer_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="buyer_email" name="buyer_email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="buyer_phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="buyer_phone" name="buyer_phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="orderQty" class="form-label">Jumlah</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary" id="orderDecrease">-</button>
                                        <input type="number" class="form-control text-center" id="orderQty" value="1" min="1" required>
                                        <button type="button" class="btn btn-outline-secondary" id="orderIncrease">+</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productSize" class="form-label">Ukuran</label>
                                    <select class="form-select" id="productSize" required>
                                        <option value="">Pilih Ukuran</option>
                                        <!-- Opsi ukuran akan diisi lewat JS jika perlu -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total Harga:</label>
                                    <h4 class="text-warning" id="orderTotalPrice">Rp 0</h4>
                                </div>
                                <div class="mb-3">
                                    <label for="buyer_address" class="form-label">Alamat Pemesan</label>
                                    <textarea class="form-control" id="buyer_address" name="buyer_address" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="orderNotes" class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" id="orderNotes" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom" id="submitOrder">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Modal untuk Checkout -->
    <div class="modal fade" id="checkoutOrderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="checkoutOrderForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="checkoutCustomerName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="checkoutCustomerName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="checkoutCustomerEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="checkoutCustomerEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="checkoutCustomerPhone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="checkoutCustomerPhone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="checkoutShippingAddress" class="form-label">Alamat Pengiriman</label>
                                    <textarea class="form-control" id="checkoutShippingAddress" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="checkoutOrderNotes" class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" id="checkoutOrderNotes" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Tampilan Barang yang di-Checkout -->
                        <div class="checkout-items mt-4">
                            <h5>Barang yang Dipesan</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Ukuran</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="checkoutItemsList">
                                        <!-- Items will be rendered here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                            <td><strong id="checkoutTotalPrice">Rp 0</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom" id="submitCheckoutOrder">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="payment-details mb-4">
                        <h6>Detail Pesanan</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tr></tr>
                                    <td>Produk</td>
                                    <td id="paymentProductName"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td id="paymentQuantity"></td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td id="paymentTotal"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="payment-methods">
                        <h6>Metode Pembayaran</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="payment-method-card">
                                    <input type="radio" name="paymentMethod" id="bankTransfer" value="bank" checked>
                                    <label for="bankTransfer">
                                        <i class="fas fa-university me-2"></i>Transfer Bank
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="payment-method-card">
                                    <input type="radio" name="paymentMethod" id="eWallet" value="ewallet">
                                    <label for="eWallet">
                                        <i class="fas fa-wallet me-2"></i>E-Wallet
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bank-details mt-4" id="bankDetails">
                        <h6>Rekening Bank</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Bank</td>
                                    <td>BCA</td>
                                </tr>
                                <tr>
                                    <td>Nomor Rekening</td>
                                    <td>1234567890</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama</td>
                                    <td>Tokomonel</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="ewallet-details mt-4" id="ewalletDetails" style="display: none;">
                        <h6>E-Wallet</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Provider</td>
                                    <td>DANA</td>
                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>081234567890</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama</td>
                                    <td>Tokomonel</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="payment-instructions mt-4">
                        <h6>Instruksi Pembayaran</h6>
                        <ol>
                            <li>Transfer sesuai total pembayaran</li>
                            <li>Simpan bukti transfer</li>
                            <li>Upload bukti transfer di form berikut</li>
                        </ol>
                        <div class="mb-3">
                            <label for="paymentProof" class="form-label">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" id="paymentProof" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom" id="confirmPayment">
                        <i class="fas fa-check me-2"></i>Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keranjang -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="cart-items">
                        <!-- Item keranjang akan di-render di sini -->
                    </div>
                    <div class="cart-empty text-center py-5" style="display: none;">
                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                        <h5>Keranjang Belanja Kosong</h5>
                        <p>Silakan tambahkan produk ke keranjang</p>
                    </div>
                    <div class="cart-summary mt-4" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total:</h5>
                            <h5 class="cart-total">Rp 0</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-custom" id="checkoutCart" disabled>
                        <i class="fas fa-shopping-bag me-2"></i>Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah ke Keranjang -->
    <div class="modal fade" id="addToCartModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah ke Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="" alt="" id="cartProductImage" class="img-fluid rounded mb-3" style="max-height: 200px;">
                        <h5 id="cartProductName"></h5>
                        <div class="product-price">
                            <span id="cartProductPrice"></span>
                            <span id="cartProductUnit"></span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Ukuran:</label>
                        <select class="form-select" id="cartProductSize">
                            <!-- Opsi ukuran akan diisi lewat JS -->
                        </select>
                        <div id="cartProductStock" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah:</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="cartDecrease">-</button>
                            <input type="number" class="form-control text-center" id="cartQuantity" value="1" min="1">
                            <button type="button" class="btn btn-outline-secondary" id="cartIncrease">+</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total:</label>
                        <h4 class="text-warning" id="cartTotalPrice">Rp 0</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom" id="confirmAddToCart">
                        <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentProduct = null;
            let currentVariations = [];
            let cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };

            // Event listener untuk tombol Detail
            $(document).on('click', '.btn-detail', function() {
                const $card = $(this).closest('.product-card');
                const productId = $card.data('product-id');
                const productName = $card.find('h3').text();
                const productImage = $card.find('.product-image img').attr('src');
                const productDesc = $card.find('.product-description').text();
                const productUnit = $card.find('.unit').text();
                
                // Set data produk ke modal
                $('#modalProductTitle').text(productName);
                $('#modalProductImage').attr('src', productImage);
                $('#modalProductDesc').text(productDesc);
                $('#modalProductUnit').text(productUnit);
                
                // Reset form dan dropdown ukuran
                $('#modalProductSize').empty().append('<option value="">Pilih Ukuran</option>');
                $('#quickViewQty').val(1);
                $('#modalProductStock').text('Pilih ukuran untuk melihat stok');
                $('#modalProductPrice').text('Pilih ukuran untuk melihat harga').data('price', 0);
                $('#modalTotalPrice').text('Rp 0');
                
                // Ambil data variasi dari API
                $.get(`/api/products/${productId}/variations`, function(response) {
                    if (response.success && response.data && response.data.variations) {
                        currentVariations = response.data.variations;
                        currentProduct = {
                            id: productId,
                            name: productName,
                            image: productImage,
                            unit: productUnit
                        };
                        // Isi dropdown ukuran
                        response.data.variations.forEach(variation => {
                            $('#modalProductSize').append(`
                                <option value="${variation.size}" 
                                        data-stock="${variation.stock}"
                                        data-price="${variation.price}">
                                ${variation.size} mm
                                </option>
                            `);
                        });
                    } else {
                        $('#modalProductStock').html(`
                            <div>
                                <p class="mb-1 text-danger">Error: Data stok tidak tersedia</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Silakan coba lagi nanti</small>
                            </div>
                        `);
                    }
                    // Tambahkan di sini:
                    $('#modalProductGallery').empty();
                    if (response.data.images && response.data.images.length > 0) {
                        response.data.images.forEach((src, idx) => {
                            $('#modalProductGallery').append(
                                `<img src="${src}" class="gallery-thumbnail img-thumbnail${idx === 0 ? ' active' : ''}" style="width:60px;height:60px;object-fit:cover;cursor:pointer;">`
                            );
                        });
                        $('#modalProductImage').attr('src', response.data.images[0]);
                    }
                    $('#quickViewModal').modal('show');
                });
                
                $('#quickViewModal').modal('show');
            });

            // Event listener untuk perubahan ukuran
            $('#modalProductSize').change(function() {
                const selectedOption = $(this).find(':selected');
                console.log('Ukuran dipilih:', selectedOption.val()); // Tambahkan log
                console.log('Data stok:', selectedOption.data('stock')); // Tambahkan log
                console.log('Data harga:', selectedOption.data('price')); // Tambahkan log
                
                if (!selectedOption.val()) {
                    $('#modalProductStock').text('Pilih ukuran untuk melihat stok');
                    $('#modalProductPrice').text('Pilih ukuran untuk melihat harga').data('price', 0);
                    $('#quickViewQty').val(1);
                    updateTotalPrice();
                    return;
                }

                const stock = selectedOption.data('stock');
                const price = Number(selectedOption.data('price')) || 0;

                if (!stock || !price) {
                    console.error('Stock or price data is missing');
                    $('#modalProductStock').html(`
                        <div>
                            <p class="mb-1 text-danger">Error: Data stok tidak tersedia</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted">Silakan coba lagi nanti</small>
                        </div>
                    `);
                    return;
                }

                // Update informasi stok dengan progress bar
                const stockText = `Stok tersedia: ${stock} kg`;
                $('#modalProductStock').html(`
                    <div>
                        <p class="mb-1">${stockText}</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar ${stock > 500 ? 'bg-success' : stock > 200 ? 'bg-warning' : 'bg-danger'}" 
                                 role="progressbar" 
                                 style="width: ${Math.min((stock / 1000) * 100, 100)}%">
                            </div>
                        </div>
                        <small class="text-muted">Total stok: 1000 kg</small>
                    </div>
                `);
                
                // Update harga dengan format Rupiah
                $('#modalProductPrice')
                    .text(new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(price))
                    .data('price', price);
                
                // Update total harga
                updateTotalPrice();
            });

            // Event listener untuk quantity
            $('#quickViewQty').on('change input', function() {
                const max = parseInt($(this).attr('max'));
                let value = parseInt($(this).val()) || 1;
                
                if (value > max) {
                    value = max;
                    $(this).val(max);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: `Stok tersedia hanya ${max} kg untuk ukuran ini`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if (value < 1) {
                    value = 1;
                    $(this).val(1);
                }
                
                updateTotalPrice();
            });

            // Event handler untuk tombol Detail
            $(document).on('click', '.btn-detail', function() {
                const $card = $(this).closest('.product-card');
                const productName = $card.find('h3').text();
                const basePrice = getPrice($card.find('.price').text());
                const unit = $card.find('.unit').text();
                const image = $card.find('.product-image img').attr('src');
                
                // Set data ke modal
                $('#modalProductTitle').text(productName);
                $('#modalProductImage').attr('src', image);
                $('#modalProductUnit').text(unit);
                
                
                // Buka modal
                $('#quickViewModal').modal('show');
            });

            // Fungsi untuk update total harga
            function updateTotalPrice() {
                const price = parseFloat($('#modalProductPrice').data('price')) || 0;
                const quantity = parseInt($('#quickViewQty').val()) || 1;
                const total = price * quantity;
                const formattedTotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(total);
                $('#modalTotalPrice').text(formattedTotal);
            }


            // Event handler untuk thumbnail images
            $(document).on('click', '.gallery-thumbnail', function() {
                const newSrc = $(this).attr('src');
                $('#modalProductImage').fadeOut(200, function() {
                    $(this).attr('src', newSrc).fadeIn(200);
                });
                
                // Update active state
                $('.gallery-thumbnail').removeClass('active');
                $(this).addClass('active');
            });

            // Event handler untuk tombol tambah ke keranjang di quick view
            $(document).on('click', '#quickViewAddToCart', function() {
                const size = $('#modalProductSize').val();
                const price = $('#modalProductPrice').data('price');
                if (!size) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Ukuran!',
                        text: 'Silakan pilih ukuran terlebih dahulu sebelum menambah ke keranjang.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                if (!price || price === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Harga Tidak Valid!',
                        text: 'Harga produk tidak ditemukan. Silakan pilih ukuran yang benar.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                // Selalu ambil cart terbaru dari localStorage
                const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
                const item = {
                    name: $('#modalProductTitle').text(),
                    price: price,
                    image: $('#modalProductImage').attr('src'),
                    size: size + 'mm',
                    quantity: parseInt($('#quickViewQty').val()) || 1
                };
                const existingItemIndex = cart.items.findIndex(cartItem => 
                    cartItem.name === item.name && cartItem.size === item.size
                );
                if (existingItemIndex > -1) {
                    cart.items[existingItemIndex].quantity += item.quantity;
                } else {
                    cart.items.push(item);
                }
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                updateCartView();
                $('#quickViewModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk telah ditambahkan ke keranjang',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            // Fungsi untuk menghitung total harga di quick view
            function updateTotalPrice() {
                const price = parseFloat($('#modalProductPrice').data('price')) || 0;
                const quantity = parseInt($('#quickViewQty').val()) || 1;
                const total = price * quantity;
                const formattedTotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(total);
                $('#modalTotalPrice').text(formattedTotal);
            }

            // Update total saat quantity berubah di quick view
            $(document).on('click', '#quickViewDecrease, #quickViewIncrease', function(e) {
                e.stopPropagation();
                e.preventDefault();
                const $qty = $('#quickViewQty');
                let currentVal = parseInt($qty.val()) || 1;
                
                if ($(this).attr('id') === 'quickViewDecrease') {
                    if (currentVal > 1) {
                        $qty.val(currentVal - 1);
                    }
                } else {
                    $qty.val(currentVal + 1);
                }
                
                updateTotalPrice();
            });

            // Update total saat input manual di quick view
            $(document).on('input', '#quickViewQty', function() {
                let value = parseInt($(this).val()) || 1;
                if (value < 1) {
                    $(this).val(1);
                }
                updateTotalPrice();
            });

            // Reset dan update total saat modal quick view dibuka
            $('#quickViewModal').on('show.bs.modal', function() {
                $('#quickViewQty').val(1);
                updateTotalPrice();
            });

            // Event handler untuk tombol Pesan Sekarang di quick view
            $(document).on('click', '#quickViewOrderBtn', function() {
                // Cek apakah ukuran sudah dipilih
                const selectedSize = $('#modalProductSize').val();
                if (!selectedSize) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Ukuran!',
                        text: 'Silakan pilih ukuran terlebih dahulu sebelum memesan.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                // Tutup modal quick view
                $('#quickViewModal').modal('hide');
                
                // Ambil data dari quick view
                const productName = $('#modalProductTitle').text();
                const price = $('#modalProductPrice').data('price'); // Ambil harga mentah
                const quantity = parseInt($('#quickViewQty').val()) || 1;
                const selectedSizeText = $('#modalProductSize option:selected').text();
                
                // Set data ke form pemesanan
                setTimeout(() => {
                    $('#productName').val(productName);
                    $('#productPrice').val(price); // Set harga mentah
                    $('#orderQty').val(quantity);
                    // Pastikan dropdown ukuran sudah ada opsinya
                    if ($('#productSize option[value="' + selectedSize + '"]').length === 0 && selectedSize) {
                        const dataPrice = $('#modalProductSize option:selected').data('price');
                        $('#productSize').append('<option value="' + selectedSize + '" data-price="' + dataPrice + '">' + selectedSizeText + '</option>');
                    }
                    $('#productSize').val(selectedSize);
                    updateOrderTotal();
                    $('#orderModal').modal('show');
                }, 500);
            });

            // Tambahkan event handler untuk perubahan ukuran di form order
            $('#productSize').change(function() {
                const selectedOption = $(this).find(':selected');
                const price = Number(selectedOption.data('price')) || 0;
                $('#productPrice').val(price); // Set harga mentah ke input hidden
                updateOrderTotal();
            });

            // Fungsi untuk menghitung total harga di form pemesanan
            function updateOrderTotal() {
                const price = Number($('#productPrice').val()) || 0;
                const quantity = parseInt($('#orderQty').val()) || 1;
                const total = price * quantity;
                const formattedTotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(total);
                $('#orderTotalPrice').text(formattedTotal);
            }

            // Event handler untuk tombol quantity di form pemesanan
            $(document).on('click', '#orderDecrease, #orderIncrease', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const $qty = $('#orderQty');
                let currentVal = parseInt($qty.val()) || 1;
                
                if ($(this).attr('id') === 'orderDecrease') {
                    if (currentVal > 1) {
                        currentVal -= 1;
                    }
                } else {
                    currentVal += 1;
                }
                
                $qty.val(currentVal);
                updateOrderTotal();
            });

            // Update total saat input manual di form pemesanan
            $(document).on('input', '#orderQty', function() {
                let value = parseInt($(this).val()) || 1;
                if (value < 1) {
                    value = 1;
                    $(this).val(value);
                }
                updateOrderTotal();
            });

            // Event handler untuk tombol submit form pemesanan
            $('#submitOrder').click(function() {
                var $btn = $(this);
                $btn.prop('disabled', true); // Disable tombol saat submit
                if ($('#orderForm')[0].checkValidity()) {
                    const orderData = {
                        cart: JSON.stringify([{
                            name: $('#productName').val(),
                            price: $('#productPrice').val(),
                            quantity: $('#orderQty').val(),
                            size: $('#productSize').val(),
                        }]),
                        total: $('#orderTotalPrice').text().replace(/[^0-9]/g, ''),
                        buyer_name: $('#buyer_name').val(),
                        buyer_email: $('#buyer_email').val(),
                        buyer_phone: $('#buyer_phone').val(),
                        buyer_address: $('#buyer_address').val(),
                        notes: $('#orderNotes').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                    $.ajax({
                        url: '/checkout',
                        method: 'POST',
                        data: orderData,
                        success: function(res) {
                            $('#orderModal').modal('hide');
                            $('#orderForm')[0].reset();
                            if (res.order_id) {
                                window.currentOrderId = res.order_id;
                            } else {
                                window.currentOrderId = null;
                            }
                            setTimeout(() => {
                                $('#paymentModal').modal('show');
                            }, 500);
                            $btn.prop('disabled', false); // Enable lagi setelah sukses
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat checkout', 'error');
                            $btn.prop('disabled', false); // Enable lagi jika error
                        }
                    });
                } else {
                    $('#orderForm')[0].reportValidity();
                    $btn.prop('disabled', false);
                }
            });

            // Event handler untuk konfirmasi pembayaran
            $(document).on('click', '#confirmPayment', function() {
                const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
                const paymentProof = $('#paymentProof')[0].files[0];
                const notes = $('#orderNotes').val() || $('#checkoutOrderNotes').val() || '';
                const orderId = window.currentOrderId || null;
                if (!paymentProof) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan upload bukti transfer terlebih dahulu!'
                    });
                    return;
                }
                if (!orderId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Order tidak ditemukan!',
                        text: 'Silakan ulangi proses checkout.'
                    });
                    return;
                }
                Swal.fire({
                    title: 'Memproses Pembayaran',
                    html: 'Mohon tunggu sebentar...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                const formData = new FormData();
                formData.append('payment_proof', paymentProof);
                formData.append('notes', notes);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                $.ajax({
                    url: '/konfirmasi-pembayaran/' + orderId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.close();
                        $('#paymentModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            text: 'Pesanan Anda akan segera diproses.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#checkoutOrderForm')[0].reset();
                                $('#paymentProof').val('');
                                cart.items = [];
                                cart.total = 0;
                                updateCartView();
                                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                                window.currentOrderId = null; // Reset ID order setelah pembayaran
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire('Gagal', 'Terjadi kesalahan saat upload bukti pembayaran', 'error');
                    }
                });
            });

            // Fungsi untuk filter produk berdasarkan kategori
            function filterProducts(category) {
                if (category === 'semua') {
                    $('.product-item').fadeIn(600);
                } else {
                    $('.product-item').each(function() {
                        if ($(this).data('category') === category) {
                            $(this).fadeIn(600);
                        } else {
                            $(this).fadeOut(400);
                        }
                    });
                }
            }

            // Event handler untuk tombol kategori
            $('.btn-category').click(function() {
                const $buttons = $('.btn-category');
                const $selectedButton = $(this);
                const selectedCategory = $selectedButton.data('category');
                
                // Animasi untuk tombol
                $buttons.removeClass('active');
                $selectedButton.addClass('active');
                
                // Terapkan filter dengan delay
                setTimeout(function() {
                    filterProducts(selectedCategory);
                }, 100);
            });

            // Fungsi pencarian produk
            $('#searchInput').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                
                $('.product-item').each(function() {
                    const productName = $(this).find('h3').text().toLowerCase();
                    const productDesc = $(this).find('.product-description').text().toLowerCase();
                    
                    if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                        $(this).fadeIn(400);
                    } else {
                        $(this).fadeOut(400);
                    }
                });
            });

            // Fungsi untuk sorting produk
            function sortProducts(sortBy) {
                const $container = $('#product-container');
                const $products = $('.product-item').toArray();

                $products.sort(function(a, b) {
                    const $a = $(a);
                    const $b = $(b);

                    switch(sortBy) {
                        case 'price-asc':
                            return getPrice($a.find('.price').text()) - getPrice($b.find('.price').text());
                        case 'price-desc':
                            return getPrice($b.find('.price').text()) - getPrice($a.find('.price').text());
                        case 'name-asc':
                            return $a.find('h3').text().localeCompare($b.find('h3').text());
                        case 'name-desc':
                            return $b.find('h3').text().localeCompare($a.find('h3').text());
                        default:
                            return 0;
                    }
                });

                $container.fadeOut(300, function() {
                    $container.empty();
                    $products.forEach(function(product) {
                        $container.append(product);
                    });
                    $container.fadeIn(300);
                });
            }

            // Event handler untuk dropdown sorting
            $('#sortProducts').change(function() {
                sortProducts($(this).val());
            });

            // Event handler untuk tombol tambah ke keranjang di produk (menu utama)
            $(document).on('click', '.btn-add-to-cart', function(e) {
                e.preventDefault();
                const $card = $(this).closest('.product-card');
                const productId = $card.data('product-id');
                const title = $card.find('h3').text();
                const image = $card.find('.product-image img').attr('src');
                const unit = $card.find('.unit').text();
                $('#cartProductImage').attr('src', image);
                $('#cartProductName').text(title);
                $('#cartProductUnit').text(unit);
                $('#cartQuantity').val(1);
                $('#cartTotalPrice').text('Rp 0');
                // Reset dropdown dan stok
                $('#cartProductSize').empty().append('<option value="">Pilih Ukuran</option>');
                $('#cartProductStock').text('Pilih ukuran untuk melihat stok');
                $('#cartProductPrice').text('Pilih ukuran untuk melihat harga');
                // Ambil variasi dari API
                $.get(`/api/products/${productId}/variations`, function(response) {
                    if (response.success && response.data && response.data.variations) {
                        response.data.variations.forEach(variation => {
                            $('#cartProductSize').append(`
                                <option value="${variation.size}" data-stock="${variation.stock}" data-price="${variation.price}">
                                    ${variation.size} mm
                                </option>
                            `);
                        });
                        setTimeout(function() {
                            const selectedOption = $('#cartProductSize').find(':selected');
                            if (selectedOption.val()) {
                                const stock = selectedOption.data('stock');
                                const price = selectedOption.data('price');
                                if (typeof stock !== 'undefined' && typeof price !== 'undefined') {
                                    $('#cartProductStock').html('<span class="text-success">Stok tersedia: ' + stock + '</span>');
                                    $('#cartProductPrice')
                                        .text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(price))
                                        .data('price', price);
                                    updateCartTotalPrice();
                                }
                            }
                        }, 100);
                    }
                });
                $('#addToCartModal').modal('show');
            });

            // Event handler perubahan ukuran di modal tambah ke keranjang
            $('#cartProductSize').change(function() {
                const selectedOption = $(this).find(':selected');
                if (!selectedOption.val()) {
                    $('#cartProductStock').text('Pilih ukuran untuk melihat stok');
                    $('#cartProductPrice').text('Pilih ukuran untuk melihat harga');
                    updateCartTotalPrice();
                    return;
                }
                const stock = selectedOption.data('stock');
                const price = selectedOption.data('price');
                if (typeof stock === 'undefined' || typeof price === 'undefined') {
                    $('#cartProductStock').html('<span class="text-danger">Stok/harga tidak ditemukan</span>');
                    $('#cartProductPrice').text('Rp 0');
                    updateCartTotalPrice();
                    return;
                }
                // Tampilkan stok tersedia dari database
                $('#cartProductStock').html('<span class="text-success">Stok tersedia: ' + stock + '</span>');
                $('#cartProductPrice')
                    .text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(price))
                    .data('price', price);
                updateCartTotalPrice();
            });

            // Update total harga di modal tambah ke keranjang
            function updateCartTotalPrice() {
                const price = $('#cartProductPrice').data('price') || 0;
                const quantity = parseInt($('#cartQuantity').val()) || 1;
                const total = price * quantity;
                $('#cartTotalPrice').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(total));
            }

            // Event handler untuk tombol quantity di modal tambah ke keranjang
            $(document).on('click', '#cartDecrease, #cartIncrease', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const $qty = $('#cartQuantity');
                let currentVal = parseInt($qty.val()) || 1;
                
                if ($(this).attr('id') === 'cartDecrease') {
                    if (currentVal > 1) {
                        currentVal -= 1;
                    }
                } else {
                    currentVal += 1;
                }
                
                $qty.val(currentVal);
                updateCartTotalPrice();
            });

            // Update total saat input manual di modal tambah ke keranjang
            $(document).on('input', '#cartQuantity', function() {
                let value = parseInt($(this).val()) || 1;
                if (value < 1) {
                    value = 1;
                    $(this).val(value);
                }
                updateCartTotalPrice();
            });

            // Event handler untuk konfirmasi tambah ke keranjang
            $('#confirmAddToCart').click(function() {
                // Selalu ambil cart terbaru dari localStorage
                const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
                const item = {
                    name: $('#cartProductName').text(),
                    price: getPrice($('#cartProductPrice').text()),
                    image: $('#cartProductImage').attr('src'),
                    size: $('#cartProductSize').val() + 'mm',
                    quantity: parseInt($('#cartQuantity').val()) || 1
                };
                const existingItemIndex = cart.items.findIndex(cartItem => 
                    cartItem.name === item.name && cartItem.size === item.size
                );
                if (existingItemIndex > -1) {
                    cart.items[existingItemIndex].quantity += item.quantity;
                } else {
                    cart.items.push(item);
                }
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                updateCartView();
                $('#addToCartModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk telah ditambahkan ke keranjang',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            // Event handler untuk tombol checkout di keranjang
            $('#checkoutCart').click(function() {
                // Ambil cart terbaru dari localStorage setiap kali tombol diklik
                const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
                if (!cart.items || cart.items.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Keranjang belanja masih kosong!'
                    });
                    return;
                }

                // Hitung ulang total cart
                cart.total = cart.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));

                // Tutup modal keranjang
                $('#cartModal').modal('hide');
                
                // Render items di form pemesanan
                const $checkoutItemsList = $('#checkoutItemsList');
                $checkoutItemsList.empty();
                
                cart.items.forEach(item => {
                    const subtotal = item.price * item.quantity;
                    $checkoutItemsList.append(`
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.size}</td>
                            <td>${item.quantity}</td>
                            <td>${formatPrice(item.price)}</td>
                            <td>${formatPrice(subtotal)}</td>
                        </tr>
                    `);
                });
                
                // Update total harga
                $('#checkoutTotalPrice').text(formatPrice(cart.total));
                
                // Buka modal pemesanan checkout
                setTimeout(() => {
                    $('#checkoutOrderModal').modal('show');
                }, 500);
            });

            // Event handler untuk tombol submit form pemesanan checkout
            $('#submitCheckoutOrder').click(function() {
                var $btn = $(this);
                $btn.prop('disabled', true); // Disable tombol saat submit
                const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
                if ($('#checkoutOrderForm')[0].checkValidity()) {
                    const orderData = {
                        cart: JSON.stringify(cart.items),
                        total: cart.total,
                        buyer_name: $('#checkoutCustomerName').val(),
                        buyer_email: $('#checkoutCustomerEmail').val(),
                        buyer_phone: $('#checkoutCustomerPhone').val(),
                        buyer_address: $('#checkoutShippingAddress').val(),
                        notes: $('#checkoutOrderNotes').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                    $.ajax({
                        url: '/checkout',
                        method: 'POST',
                        data: orderData,
                        success: function(res) {
                            $('#checkoutOrderModal').modal('hide');
                            $('#checkoutOrderForm')[0].reset();
                            if (res.order_id) {
                                window.currentOrderId = res.order_id;
                            } else {
                                window.currentOrderId = null;
                            }
                            setTimeout(() => {
                                $('#paymentModal').modal('show');
                            }, 500);
                            $btn.prop('disabled', false); // Enable lagi setelah sukses
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat checkout', 'error');
                            $btn.prop('disabled', false); // Enable lagi jika error
                        }
                    });
                } else {
                    $('#checkoutOrderForm')[0].reportValidity();
                    $btn.prop('disabled', false);
                }
            });
        });

        // Otomatis set product_id saat quick view dibuka
    $(document).on('click', '.btn-detail', function() {
        const $card = $(this).closest('.product-card');
        const productId = $card.data('product-id');
        $('#reviewProductId').val(productId);
    });

    // Submit form review via AJAX
    $('#formReviewProduk').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const productId = $('#reviewProductId').val();
        $.ajax({
            url: `/api/products/${productId}/review`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#reviewSuccessMsg').removeClass('d-none');
                $('#reviewErrorMsg').addClass('d-none');
                $('#formReviewProduk')[0].reset();
                $('#reviewFormWrapper').slideUp();
                loadProductReviews(productId);
            },
            error: function(xhr) {
                $('#reviewErrorMsg').removeClass('d-none').text(xhr.responseJSON?.message || 'Gagal mengirim review');
                $('#reviewSuccessMsg').addClass('d-none');
            }
        });
    });

    // Toggle form review
    $('#toggleReviewForm').on('click', function() {
        $('#reviewFormWrapper').slideToggle();
    });

    function loadProductReviews(productId) {
        $.get(`/api/products/${productId}/reviews`, function(res) {
            // Tampilkan daftar review
            if (res.success && res.reviews.length > 0) {
                let html = '';
                res.reviews.forEach(function(r) {
                    html += `<div class="border-bottom pb-2 mb-2">
                        <strong>${r.user_name}</strong> <span class="text-warning">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</span><br>
                        <small class="text-muted">${r.created_at ? new Date(r.created_at).toLocaleString('id-ID') : ''}</small><br>
                        ${r.photo ? `<img src='/storage/${r.photo}' width='60' class='rounded mb-1'>` : ''}
                        <div>${r.review_text}</div>
                    </div>`;
                });
                $('#reviewList').html(html);
            } else {
                $('#reviewList').html('<em>Belum ada review.</em>');
            }

            // Tampilkan bintang dan jumlah review
            let stars = '';
            let avg = res.average || 0;
            for (let i = 1; i <= 5; i++) {
                if (avg >= i) {
                    stars += '<i class="fas fa-star text-warning"></i>';
                } else if (avg >= i - 0.5) {
                    stars += '<i class="fas fa-star-half-alt text-warning"></i>';
                } else {
                    stars += '<i class="far fa-star text-warning"></i>';
                }
            }
            $('#modalProductStars').html(
                stars + ` <span class="ms-2">${avg} (${res.count || 0} reviews)</span>`
            );
        });
    }
    $('#quickViewModal').on('show.bs.modal', function() {
        const productId = $('#reviewProductId').val();
        if(productId) loadProductReviews(productId);
    });
    </script>
    @endpush
@endsection 
