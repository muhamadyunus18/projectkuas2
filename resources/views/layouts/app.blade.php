<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
    <style>
        #cartModal .cart-item {
            background: #fff !important;
            color: #232f3e !important;
        }
        #cartModal .cart-item * {
            color: #232f3e !important;
        }
    </style>
</head>
<body>
    @include('layouts.header')
    
    <main>
        @yield('content')
    </main>

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
                    <div class="cart-empty text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                        <h5>Keranjang Belanja Kosong</h5>
                        <p>Silakan tambahkan produk ke keranjang</p>
                    </div>
                    <div class="cart-summary mt-4">
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

    <!-- Modal Checkout -->
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

    <!-- Modal Pembayaran -->
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
                                <tr>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        // Konstanta untuk key localStorage
        const CART_STORAGE_KEY = 'tokomonel_cart';

        // Fungsi untuk memformat harga
        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(price);
        }

        // Fungsi untuk mendapatkan harga dari string
        function getPrice(priceText) {
            return parseInt(priceText.replace(/[^0-9]/g, ''));
        }

        // Fungsi untuk update tampilan keranjang
        function updateCartView() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const $cartItems = $('.cart-items');
            const $cartEmpty = $('.cart-empty');
            const $cartSummary = $('.cart-summary');
            const $cartCount = $('.cart-count');
            const $checkoutBtn = $('#checkoutCart');

            // Update jumlah item di badge
            $cartCount.text(cart.items.length);

            if (cart.items.length === 0) {
                $cartItems.hide();
                $cartSummary.hide();
                $cartEmpty.show();
                $checkoutBtn.prop('disabled', true);
                // Pastikan total juga direset
                $('.cart-total').text('Rp 0');
                // Hapus cart dari localStorage agar benar-benar kosong
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify({ items: [], total: 0 }));
                return;
            }

            // Render items
            $cartItems.empty();
            let total = 0;

            cart.items.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                $cartItems.append(`
                    <div class="cart-item mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="${item.image}" alt="${item.name}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">${item.name}</h6>
                                <p class="mb-1 text-muted">${formatPrice(item.price)}</p>
                                <p class="mb-0 text-muted">Ukuran: ${item.size}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm quantity-control">
                                    <button type="button" class="btn btn-outline-secondary decrease-qty" data-index="${index}">-</button>
                                    <input type="number" class="form-control text-center item-qty" value="${item.quantity}" min="1" data-index="${index}">
                                    <button type="button" class="btn btn-outline-secondary increase-qty" data-index="${index}">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="mb-0">${formatPrice(itemTotal)}</p>
                            </div>
                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-sm btn-danger remove-item" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            // Update total dan tampilan
            cart.total = total;
            $('.cart-total').text(formatPrice(total));
            $cartItems.show();
            $cartEmpty.hide();
            $cartSummary.show();
            $checkoutBtn.prop('disabled', false);

            // Simpan kembali ke localStorage
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        }

        // Event handler untuk storage changes
        window.addEventListener('storage', function(e) {
            if (e.key === CART_STORAGE_KEY) {
                updateCartView();
            }
        });

        // Event handler untuk tombol hapus item
        $(document).on('click', '.remove-item', function() {
            let cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const index = $(this).data('index');
            cart.items.splice(index, 1);
            // Jika sudah kosong, reset total juga
            if (cart.items.length === 0) {
                cart.total = 0;
            } else {
                cart.total = cart.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            }
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            updateCartView();
        });

        // Event handler untuk tombol kurang quantity
        $(document).on('click', '.decrease-qty', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const index = $(this).data('index');
            if (cart.items[index].quantity > 1) {
                cart.items[index].quantity--;
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                updateCartView();
            }
        });

        // Event handler untuk tombol tambah quantity
        $(document).on('click', '.increase-qty', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const index = $(this).data('index');
            cart.items[index].quantity++;
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            updateCartView();
        });

        // Event handler untuk input quantity manual
        $(document).on('change', '.item-qty', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const index = $(this).data('index');
            let value = parseInt($(this).val()) || 1;
            if (value < 1) value = 1;
            
            cart.items[index].quantity = value;
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            updateCartView();
        });

        // Event handler untuk tombol checkout di keranjang
        $(document).on('click', '#checkoutCart', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            
            if (cart.items.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Keranjang belanja masih kosong!'
                });
                return;
            }

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
        $(document).on('click', '#submitCheckoutOrder', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            // Validasi form
            if ($('#checkoutOrderForm')[0].checkValidity()) {
                // Ambil data pesanan
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
                // Cek login ke backend sebelum submit
                $.get('/test-auth', function(response) {
                    if (response !== 'Sudah login') {
                        window.location.href = '/login';
                        return;
                    }
                    // Kirim data ke backend
                    $.ajax({
                        url: '/checkout',
                        method: 'POST',
                        data: orderData,
                        success: function(res) {
                            // Update data di modal pembayaran
                            $('#paymentProductName').text('Multiple Products');
                            $('#paymentQuantity').text(cart.items.length + ' items');
                            $('#paymentTotal').text(formatPrice(cart.total));
                            // Tutup modal pemesanan
                            $('#checkoutOrderModal').modal('hide');
                            // Tampilkan modal pembayaran setelah modal pemesanan tertutup
                            setTimeout(() => {
                                $('#paymentModal').modal('show');
                            }, 500);
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                window.location.href = '/login';
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat checkout', 'error');
                            }
                        }
                    });
                });
            } else {
                // Tampilkan validasi form default
                $('#checkoutOrderForm')[0].reportValidity();
            }
        });

        // Event handler untuk konfirmasi pembayaran
        $(document).on('click', '#confirmPayment', function() {
            const cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || { items: [], total: 0 };
            const paymentProof = $('#paymentProof')[0].files[0];
            
            if (!paymentProof) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silakan upload bukti transfer terlebih dahulu!'
                });
                return;
            }

            // Tampilkan loading
            Swal.fire({
                title: 'Memproses Pembayaran',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulasi proses pembayaran
            setTimeout(() => {
                Swal.close();
                $('#paymentModal').modal('hide');
                
                // Tampilkan pesan sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil!',
                    text: 'Pesanan Anda akan segera diproses. Tim kami akan menghubungi Anda untuk konfirmasi.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset form dan keranjang
                        $('#checkoutOrderForm')[0].reset();
                        $('#paymentProof').val('');
                        cart.items = [];
                        cart.total = 0;
                        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
                        updateCartView();
                    }
                });
            }, 1500);
        });

        // Event handler untuk toggle metode pembayaran
        $(document).on('change', 'input[name="paymentMethod"]', function() {
            if ($(this).val() === 'bank') {
                $('#bankDetails').show();
                $('#ewalletDetails').hide();
            } else {
                $('#bankDetails').hide();
                $('#ewalletDetails').show();
            }
        });

        // Update tampilan keranjang saat halaman dimuat
        $(document).ready(function() {
            updateCartView();
        });
    </script>
    @stack('scripts')
</body>
</html> 