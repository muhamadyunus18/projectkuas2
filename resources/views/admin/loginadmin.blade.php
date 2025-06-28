<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Tokomonel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background: #232f3e; color: #fff; }
        .admin-login-box {
            max-width: 400px; margin: 80px auto; background: #34495e; border-radius: 1rem; padding: 32px;
            box-shadow: 0 4px 24px 0 rgba(44,62,80,0.18);
        }
        .admin-login-box h2 { font-weight: 700; margin-bottom: 24px; }
        .form-control { border-radius: 1rem; }
        .btn-admin-login { background: #f39c12; color: #fff; font-weight: 700; border-radius: 1rem; }
        .btn-admin-login:hover { background: #e67e22; }
    </style>
</head>
<body>
    <div class="admin-login-box">
        <h2>Admin Login</h2>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Admin" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn btn-admin-login w-100">Login</button>
        </form>
    </div>
</body>
</html> 