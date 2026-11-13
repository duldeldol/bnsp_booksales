<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - BookStore</title>
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
            padding: 2.5rem 1rem;
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
            padding: 0.75rem 1.25rem;
            transition: all 0.15s ease;
            box-shadow: 0 2px 4px rgba(28, 25, 23, 0.1);
        }

        .btn-book-primary:hover {
            background-color: var(--color-gold);
            border-color: var(--color-gold);
            color: #ffffff;
            box-shadow: 0 4px 8px rgba(180, 83, 9, 0.2);
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

        /* Authentic Bookstore Alerts & Floating Pop-up */
        .bookstore-toast-wrapper {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1090;
            min-width: 320px;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            pointer-events: none;
        }

        @media (max-width: 576px) {
            .bookstore-toast-wrapper {
                top: 1rem;
                left: 1rem;
                right: 1rem;
                min-width: auto;
            }
        }

        .bookstore-alert {
            pointer-events: auto;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 12px 24px -6px rgba(28, 25, 23, 0.15), 0 6px 12px -4px rgba(28, 25, 23, 0.08);
            padding: 0.85rem 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            transform: translateY(0);
            opacity: 1;
            transition: opacity 0.35s ease, transform 0.35s ease, max-height 0.4s ease, margin 0.4s ease, padding 0.4s ease;
            overflow: hidden;
        }

        .bookstore-alert.hiding {
            opacity: 0;
            transform: translateY(-8px);
            max-height: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
            border-width: 0 !important;
        }

        .bookstore-alert-success {
            border-left: 4px solid #059669;
        }

        .bookstore-alert-error {
            border-left: 4px solid #dc2626;
        }

        .toast-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .bookstore-alert-success .toast-icon-box {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #d1fae5;
        }

        .bookstore-alert-error .toast-icon-box {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }

        .toast-content {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-family: 'Lora', Georgia, serif;
            font-weight: 700;
            font-size: 0.88rem;
            margin-bottom: 0.15rem;
            line-height: 1.25;
        }

        .bookstore-alert-success .toast-title {
            color: #064e3b;
        }

        .bookstore-alert-error .toast-title {
            color: #7f1d1d;
        }

        .toast-message {
            color: #4b5563;
            font-size: 0.8rem;
            line-height: 1.35;
        }

        .toast-close-btn {
            background: transparent;
            border: none;
            color: #9ca3af;
            padding: 0;
            cursor: pointer;
            font-size: 1.15rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease;
            margin-left: 0.25rem;
            margin-top: 1px;
        }

        .toast-close-btn:hover {
            color: #1f2937;
        }
    </style>
</head>
<body>

<!-- Floating Bookstore Toast Container (Outside Card) -->
<div class="bookstore-toast-wrapper" id="toastContainer">
    @if(session('success'))
        <div class="bookstore-alert bookstore-alert-success" role="alert">
            <div class="toast-icon-box">
                <i class="bi bi-check2-circle"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Pendaftaran Berhasil</div>
                <div class="toast-message">{{ session('success') }}</div>
            </div>
            <button type="button" class="toast-close-btn" onclick="dismissToast(this.closest('.bookstore-alert'))" aria-label="Tutup">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bookstore-alert bookstore-alert-error" role="alert">
            <div class="toast-icon-box">
                <i class="bi bi-exclamation-octagon"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Pendaftaran Gagal</div>
                <div class="toast-message">{{ session('error') }}</div>
            </div>
            <button type="button" class="toast-close-btn" onclick="dismissToast(this.closest('.bookstore-alert'))" aria-label="Tutup">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif
</div>

<div class="auth-card">
    <!-- Brand & Title -->
    <div class="text-center mb-4">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <div class="brand-badge">
                <i class="bi bi-book"></i>
            </div>
            <h4 class="font-serif-book fw-bold mb-1 text-dark">BookStore</h4>
        </a>
        <p class="text-muted small mb-0">Daftar akun baru untuk mulai memesan buku pilihan Anda</p>
    </div>

    <!-- Registration Form -->
    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control border-start-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Ahmad Pratama" required autofocus>
            </div>
            @error('name')
                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            @error('email')
                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="regPassword" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" placeholder="Min. 6 karakter" required>
                <button type="button" class="btn-toggle-password" id="toggleRegPasswordBtn" onclick="togglePassword('regPassword', 'regEyeIcon')" title="Tampilkan/Sembunyikan password">
                    <i class="bi bi-eye" id="regEyeIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="bi bi-shield-lock"></i></span>
                <input type="password" name="password_confirmation" id="regPasswordConfirm" class="form-control border-start-0 border-end-0" placeholder="Ulangi password" required>
                <button type="button" class="btn-toggle-password" id="toggleRegConfirmBtn" onclick="togglePassword('regPasswordConfirm', 'regConfirmEyeIcon')" title="Tampilkan/Sembunyikan konfirmasi password">
                    <i class="bi bi-eye" id="regConfirmEyeIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-book-primary w-100">
            Daftar Sekarang
        </button>
    </form>

    <div class="text-center mt-3 pt-3 border-top">
        <p class="small text-muted mb-0">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="link-subtle fw-bold">Masuk di sini</a>
        </p>
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

    function dismissToast(toastEl) {
        if (!toastEl || toastEl.classList.contains('hiding')) return;
        toastEl.classList.add('hiding');
        setTimeout(function () {
            if (toastEl.parentNode) {
                toastEl.parentNode.removeChild(toastEl);
            }
        }, 400);
    }

    function setupAutoDismissAlerts() {
        // Bookstore alerts
        const bookstoreAlerts = document.querySelectorAll('.bookstore-alert');
        bookstoreAlerts.forEach(function (toast) {
            setTimeout(function () {
                dismissToast(toast);
            }, 3000);
        });

        // Fallback for regular alerts
        const alerts = document.querySelectorAll('.alert:not(.bookstore-alert)');
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
