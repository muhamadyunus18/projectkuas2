<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Tokomonel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --navy: #2c3e50;
            --navy-light: #34495e;
            --navy-dark: #1a252f;
            --gray: #95a5a6;
            --gray-light: #ecf0f1;
            --gray-dark: #7f8c8d;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-light);
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--navy) 0%, var(--navy-dark) 100%);
            color: var(--gray-light);
            transition: var(--transition);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h3 {
            font-size: 1.5rem;
            font-weight: 600;
            padding: 1.5rem 1rem;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .nav-item {
            margin: 0.25rem 0;
            transition: var(--transition);
        }

        .sidebar .nav-link {
            color: var(--gray);
            padding: 0.8rem 1.2rem;
            border-radius: 6px;
            margin: 0 0.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .content {
            padding: 2rem;
            background: white;
            min-height: 100vh;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.05);
        }

        .btn-logout {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--gray);
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-logout:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
            color: white;
        }

        .btn-logout i {
            margin-right: 8px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        /* Table Styles */
        .table {
            border-radius: 8px;
            overflow: hidden;
            background: white;
        }

        .table thead th {
            background: var(--navy);
            color: white;
            font-weight: 500;
            border: none;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .table tbody tr:hover {
            background-color: var(--gray-light);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-dark);
        }

        /* Notifikasi Styles */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, #f39c12 0%, #d35400 100%);
            color: white;
        }

        .alert-info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .alert i {
            margin-right: 12px;
            font-size: 1.25rem;
        }

        .alert .close {
            color: white;
            opacity: 0.8;
            text-shadow: none;
            margin-left: auto;
            padding: 0;
            background: transparent;
            border: 0;
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
            transition: var(--transition);
        }

        .alert .close:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <h3 class="text-center">Tokomonel</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customers.index') }}" class="nav-link {{ Request::is('admin/customers*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.suppliers.index') }}" class="nav-link {{ Request::is('admin/suppliers*') ? 'active' : '' }}">
                            <i class="fas fa-truck"></i> Pemasok
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.produksementara.index') }}" class="nav-link {{ Request::is('admin/produksementara*') ? 'active' : '' }}">
                            <i class="fas fa-box-open"></i> Gudang Sementara
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reports.index') }}" class="nav-link {{ Request::is('admin/reports*') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ Request::is('admin/reviews*') ? 'active' : '' }}">
                            <i class="fas fa-star"></i> Reviews
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item mt-4 px-3">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-logout w-100">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: message
            })
        }

        // Cek jika ada session message
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif

        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }

        // Tambahkan event listener untuk semua tombol hapus
        document.querySelectorAll('button[onclick*="confirm"]').forEach(button => {
            button.onclick = confirmDelete;
        });
    </script>
    @stack('scripts')
</body>
</html> 