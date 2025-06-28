# Tokomonel

Aplikasi Tokomonel adalah platform toko online untuk penjualan bahan baku aksesoris dan kerajinan (seperti kawat, plat, dan aksesoris premium) berbasis Laravel + MongoDB.

## Fitur Utama
- **Katalog Produk**: Lihat, cari, dan filter produk berdasarkan kategori.
- **Keranjang Belanja**: Tambah produk ke keranjang, atur jumlah & ukuran.
- **Quick Order**: Pesan produk langsung dari halaman produk.
- **Checkout**: Bisa lewat keranjang atau quick order.
- **Upload Bukti Pembayaran**: Setelah checkout, user wajib upload bukti transfer.
- **Manajemen Order Admin**: Admin bisa melihat, mengedit, dan mengelola order, termasuk melihat bukti pembayaran.
- **Stok Otomatis**: Stok produk otomatis berkurang saat order.


## Instalasi

### 1. Clone Repository
```bash
git clone <repo-url>
cd tokomonel
```

### 2. Install Dependency
```bash
composer install
npm install
```

### 3. Copy & Edit Environment
```bash
cp .env.example .env
```
- Atur koneksi database MongoDB di `.env`:
  ```
  DB_CONNECTION=mongodb
  DB_HOST=127.0.0.1
  DB_PORT=27017
  DB_DATABASE=tokomonel
  DB_USERNAME= # jika pakai auth
  DB_PASSWORD= # jika pakai auth
  ```
- Atur storage:
  ```
  FILESYSTEM_DRIVER=public
  ```

### 4. Generate Key & Storage Link
```bash
php artisan key:generate
php artisan storage:link
```

### 5. Jalankan Migrasi (jika ada)
```bash
php artisan migrate
```

### 6. Jalankan Server
```bash
php artisan serve
```

## Struktur Folder Utama
```
app/Http/Controllers/         # Controller utama (Order, Admin, Cart, dsb)
app/Models/                   # Model (Order, Product, Customer, dsb)
resources/views/              # Blade template (menu, admin, cart, dsb)
public/                       # Asset publik (css, js, images)
storage/app/public/           # File upload (bukti pembayaran, gambar produk)
```

## Cara Kerja Order & Bukti Pembayaran
- User bisa order lewat **keranjang** atau **quick order**.
- Setelah checkout, order_id disimpan di frontend (`window.currentOrderId`).
- User upload bukti pembayaran, file akan diupload ke `/konfirmasi-pembayaran/{orderId}`.
- Admin bisa melihat bukti pembayaran di halaman detail order.
- **Anti double order:** Tombol checkout otomatis disable saat submit, hanya satu order yang akan tercatat.

## Catatan Penting
- **Jangan lupa jalankan**: `php artisan storage:link` agar file bukti pembayaran bisa diakses dari web.
- **Jika ingin menambah fitur** (misal: proteksi order ganda di backend), tambahkan validasi di controller.
- **Pastikan event handler JS tidak terpasang dua kali** agar order tidak double.

## Kontribusi
Pull request dan issue sangat diterima!

## Lisensi
MIT

## Manual Book (Panduan Penggunaan)

### Untuk User (Pembeli)

#### 1. Registrasi & Login
- Klik tombol **Login/Register** di pojok kanan atas.
- Isi data diri dan buat akun baru, atau login jika sudah punya akun.

#### 2. Belanja Produk
- Jelajahi katalog produk di halaman utama.
- Gunakan fitur **cari** atau **filter kategori** untuk menemukan produk.
- Klik produk untuk melihat detail, pilih ukuran & jumlah.
- Klik **Tambah ke Keranjang** untuk memasukkan produk ke keranjang.
- Atau klik **Pesan Sekarang** (Quick Order) untuk langsung checkout satu produk.

#### 3. Keranjang Belanja
- Klik ikon keranjang di pojok kanan atas untuk melihat isi keranjang.
- Ubah jumlah/ukuran produk jika perlu, atau hapus produk dari keranjang.
- Klik **Checkout** untuk melanjutkan ke proses pemesanan.

#### 4. Checkout
- Isi data pengiriman (nama, alamat, email, telepon).
- Cek ulang daftar produk & total harga.
- Klik **Kirim Pesanan**.
- Tunggu hingga muncul modal pembayaran.

#### 5. Upload Bukti Pembayaran
- Setelah checkout, akan muncul **modal pembayaran**.
- Transfer sesuai instruksi ke rekening yang tertera.
- Upload foto bukti transfer pada form yang tersedia.
- Klik **Konfirmasi Pembayaran**.
- Selesai! Admin akan memproses pesanan Anda.

#### 6. Cek Status Order
- Masuk ke halaman **Profile** untuk melihat riwayat dan status pesanan.

---

### Untuk Admin

#### 1. Login Admin
- Akses halaman admin melalui `/admin`.
- Login menggunakan akun admin.

#### 2. Manajemen Produk
- Tambah, edit, atau hapus produk dari menu **Products**.
- Atur variasi ukuran, harga, dan stok.

#### 3. Manajemen Order
- Lihat daftar order di menu **Orders**.
- Klik detail order untuk melihat data pemesan, produk, dan **bukti pembayaran**.
- Ubah status order (pending, processing, completed, cancelled) sesuai proses.
- Download/cek bukti pembayaran jika diperlukan.

#### 4. Laporan & Customer
- Lihat laporan penjualan di menu **Reports**.
- Kelola data customer di menu **Customers**.

---

### Troubleshooting Umum
- **Order double:** Pastikan user tidak klik submit checkout berkali-kali. Sistem sudah otomatis disable tombol saat submit.
- **Bukti pembayaran tidak muncul:** Pastikan file berhasil diupload dan storage link sudah dibuat (`php artisan storage:link`).
- **Gambar produk tidak tampil:** Pastikan file gambar ada di folder `storage/app/public` dan sudah di-link ke `public/storage`.
- **Tidak bisa login:** Cek email/password, atau reset password jika lupa.

---

Untuk pertanyaan lebih lanjut, silakan hubungi admin atau cek dokumentasi tambahan di repo ini.

## Akun Admin Demo

Gunakan akun berikut untuk login ke halaman admin (testing/development):

- **Username/Email:** admin@tokomonel.com
- **Password:** admin123

> Ganti password ini di production untuk keamanan!

