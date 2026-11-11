<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - BookStore</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Literary Bookstore Typography: Lora & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-canvas: #f6f4ee;
            --border-color: #e5dfd3;
            --color-ink: #1c1917;
            --color-ink-hover: #292524;
            --color-gold: #b45309;
            --color-gold-hover: #92400e;
            --color-gold-light: #fef3c7;
            --text-main: #1c1917;
            --text-muted: #78716c;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-book {
            font-family: 'Lora', Georgia, serif;
        }

        .auth-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(28, 25, 23, 0.05);
            width: 100%;
            max-width: 450px;
            padding: 2.25rem 2rem;
            position: relative;
        }

        .brand-badge {
            width: 48px;
            height: 48px;
            background-color: var(--color-ink);
            color: #f59e0b;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 10px rgba(28, 25, 23, 0.15);
            margin-bottom: 0.85rem;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.875rem;
            padding: 0.65rem 0.9rem;
            color: var(--text-main);
            background-color: #faf9f6;
            transition: all 0.15s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--color-gold);
            box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.12);
            color: var(--text-main);
            z-index: 2;
        }

        .input-group-text {
            background-color: #faf9f6;
            border-color: var(--border-color);
            color: var(--text-muted);
            border-radius: 8px;
        }

        .btn-toggle-password {
            background-color: #faf9f6;
            border: 1px solid var(--border-color);
            border-left: none;
            color: var(--text-muted);
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            padding: 0.65rem 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: color 0.15s ease, background-color 0.15s ease;
            z-index: 4;
        }

        .btn-toggle-password:hover {
            color: var(--color-gold);
            background-color: #f3efe6;
            border-color: var(--border-color);
        }

        .btn-toggle-password:focus,
        .btn-toggle-password:active {
            color: var(--color-ink);
            background-color: #ede7db;
            border-color: var(--border-color);
            outline: none;
            box-shadow: none;
        }

        .btn-toggle-password i {
            font-size: 1.05rem;
            pointer-events: none;
        }

        .btn-book-primary {
            background-color: var(--color-ink);
            color: #ffffff;
            border: 1px solid var(--color-ink);
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.7rem 1.25rem;
            transition: all 0.15s ease;
            box-shadow: 0 2px 4px rgba(28, 25, 23, 0.1);
        }

        .btn-book-primary:hover {
            background-color: var(--color-gold);
            border-color: var(--color-gold);
            color: #ffffff;
            box-shadow: 0 4px 8px rgba(180, 83, 9, 0.2);
        }

        .demo-box {
            background-color: #faf9f6;
            border: 1px dashed var(--border-color);
            border-radius: 10px;
            padding: 1rem;
        }

        .demo-btn {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.78rem;
            text-align: left;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-main);
            width: 100%;
        }

        .demo-btn:hover {
            border-color: var(--color-gold);
            background-color: var(--color-gold-light);
            color: var(--color-gold-hover);
        }

        .link-subtle {
            color: var(--color-ink);
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .link-subtle:hover {
            color: var(--color-gold);
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <!-- Brand & Title -->
    <div class="text-center mb-4">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <div class="brand-badge">
                <i class="bi bi-book"></i>
            </div>
            <h4 class="font-serif-book fw-bold mb-1 text-dark">BookStore</h4>
        </a>
        <p class="text-muted small mb-0">Masuk ke akun Anda untuk melanjutkan belanja & kelola katalog</p>
    </div>

    <!-- Flash Alerts -->
    @if(session('success'))
        <div class="alert alert-success border py-2 px-3 small rounded-3 mb-3 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill text-success"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border py-2 px-3 small rounded-3 mb-3 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <!-- Login Form -->
    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="emailInput">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" id="emailInput" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            </div>
            @error('email')
                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="passwordInput">Password</label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="passwordInput" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                <button type="button" class="btn-toggle-password" id="togglePasswordBtn" onclick="togglePassword('passwordInput', 'loginEyeIcon')" title="Tampilkan/Sembunyikan password">
                    <i class="bi bi-eye" id="loginEyeIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" style="accent-color: var(--color-ink);">
                <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-book-primary w-100">
            Masuk Sekarang
        </button>
    </form>

    <div class="text-center mt-3 pt-3 border-top">
        <p class="small text-muted mb-0">
            Belum punya akun? <a href="{{ route('register') }}" class="link-subtle fw-bold">Daftar Akun Baru</a>
        </p>
    </div>

    <!-- Quick Access Demo Buttons for Assessor / Testing -->
    <div class="mt-4 pt-3 border-top">
        <div class="demo-box">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Akun Demo (Klik untuk Isi):</span>
            </div>
            <div class="d-flex flex-column gap-1.5">
                <button type="button" class="demo-btn" onclick="setDemo('admin@bookstore.com', 'password123')">
                    <span class="d-flex align-items-center gap-1.5">
                        <span>Admin: <strong>admin@bookstore.com</strong></span>
                    </span>
                </button>
                <button type="button" class="demo-btn" onclick="setDemo('user@bookstore.com', 'password123')">
                    <span class="d-flex align-items-center gap-1.5">
                        <span>Customer: <strong>user@bookstore.com</strong></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    function setDemo(email, pass) {
        document.getElementById('emailInput').value = email;
        document.getElementById('passwordInput').value = pass;
    }

    function setupAutoDismissAlerts() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function (alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.4s ease, max-height 0.4s ease, margin 0.4s ease, padding 0.4s ease';
                alert.style.opacity = '0';
                alert.style.maxHeight = '0';
                alert.style.paddingTop = '0';
                alert.style.paddingBottom = '0';
                alert.style.marginBottom = '0';
                alert.style.overflow = 'hidden';
                setTimeout(function () {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 400);
            }, 3000);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupAutoDismissAlerts);
    } else {
        setupAutoDismissAlerts();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
