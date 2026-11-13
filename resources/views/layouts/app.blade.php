<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Buku Online') - BookStore</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Literary Bookstore Typography: Lora Serif & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-canvas: #faf7f2;
            --bg-card: #ffffff;
            --bg-muted: #f4ede2;
            --border-subtle: #ede6db;
            --border-medium: #e0d7c7;
            --color-ink: #1c1917;
            --color-amber: #b45309;
            --color-amber-hover: #92400e;
            --color-amber-soft: #fef7ee;
            --text-main: #1c1917;
            --text-muted: #78716c;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-book {
            font-family: 'Lora', Georgia, serif;
        }

        .store-navbar {
            background-color: var(--bg-canvas);
            border-bottom: 1px solid var(--border-subtle);
            position: sticky;
            top: 0;
            z-index: 1040;
            padding: 1.1rem 0;
            transition: background-color 0.2s ease;
        }

        @keyframes badgeBounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.35); }
            100% { transform: scale(1); }
        }
        .scale-bounce {
            animation: badgeBounce 0.3s ease-in-out;
        }

        .brand-logo-text {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--color-ink);
            letter-spacing: -0.4px;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .brand-logo-text .brand-dot {
            color: var(--color-amber);
            transition: color 0.2s ease;
        }
        .brand-logo-text:hover {
            color: var(--color-amber);
        }
        .brand-logo-text:hover .brand-dot {
            color: var(--color-ink) !important;
        }

        .nav-link-pure {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.92rem;
            padding: 0.45rem 1rem;
            text-decoration: none;
            transition: color 0.15s ease;
            letter-spacing: 0.01em;
            position: relative;
        }
        .nav-link-pure:hover {
            color: var(--color-amber);
        }
        .nav-link-pure.active {
            color: var(--color-ink);
            font-weight: 700;
        }
        .nav-link-pure.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background-color: var(--color-amber);
            border-radius: 2px;
        }

        .btn-book-primary {
            background-color: var(--color-amber);
            color: #ffffff !important;
            border: 1px solid var(--color-amber);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 1.35rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-book-primary:hover {
            background-color: var(--color-amber-hover);
            border-color: var(--color-amber-hover);
            transform: translateY(-1px);
        }

        .btn-book-outline {
            background-color: transparent;
            color: var(--color-ink);
            border: 1px solid var(--border-medium);
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.5rem 1.25rem;
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-book-outline:hover {
            background-color: #ffffff;
            border-color: var(--color-ink);
            color: var(--color-ink);
        }

        .btn-search-nav {
            color: var(--text-muted);
            font-size: 0.88rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.45rem 0.9rem;
            border: 1px solid transparent;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .btn-search-nav:hover {
            color: var(--color-ink);
            background-color: #ffffff;
            border-color: var(--border-subtle);
        }

        .boutique-card {
            background-color: #ffffff;
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            padding: 1.15rem;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.22s ease, border-color 0.22s ease;
        }
        .boutique-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px -6px rgba(28, 25, 23, 0.08);
            border-color: var(--border-medium);
        }

        .boutique-cover-wrap {
            position: relative;
            width: 100%;
            padding-top: 140%;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ede6db;
            margin-bottom: 1rem;
            box-shadow: 0 8px 18px -4px rgba(28, 25, 23, 0.14);
            cursor: pointer;
        }
        .boutique-cover-wrap img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease;
        }
        .boutique-card:hover .boutique-cover-wrap img {
            transform: scale(1.03);
        }

        .boutique-tag {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--color-amber);
            margin-bottom: 0.25rem;
        }

        .boutique-title {
            font-family: 'Lora', Georgia, serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-ink);
            line-height: 1.35;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.7em;
            cursor: pointer;
        }
        .boutique-title:hover {
            color: var(--color-amber);
        }

        .boutique-author {
            font-size: 0.8rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 1rem;
        }

        .boutique-bottom-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 0.85rem;
            border-top: 1px solid #f6f1e8;
        }

        .boutique-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--color-ink);
        }

        .btn-boutique-action {
            background-color: transparent;
            color: var(--color-ink);
            border: 1px solid var(--border-medium);
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.38rem 0.95rem;
            transition: all 0.15s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-boutique-action:hover {
            background-color: var(--color-ink);
            border-color: var(--color-ink);
            color: #ffffff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--color-amber) !important;
            box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.12) !important;
            outline: none !important;
        }

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
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            box-shadow: 0 12px 24px -6px rgba(28, 25, 23, 0.12), 0 6px 12px -4px rgba(28, 25, 23, 0.06);
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

        .bookstore-alert-success { border-left: 4px solid #059669; }
        .bookstore-alert-error { border-left: 4px solid #dc2626; }

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
        .bookstore-alert-success .toast-icon-box { background-color: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
        .bookstore-alert-error .toast-icon-box { background-color: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }

        .toast-content { flex: 1; min-width: 0; }
        .toast-title { font-family: 'Lora', Georgia, serif; font-weight: 700; font-size: 0.88rem; margin-bottom: 0.15rem; }
        .bookstore-alert-success .toast-title { color: #064e3b; }
        .bookstore-alert-error .toast-title { color: #7f1d1d; }
        .toast-message { color: #4b5563; font-size: 0.8rem; line-height: 1.35; }

        .toast-close-btn {
            background: transparent;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 1.15rem;
            padding: 0;
            margin-left: 0.25rem;
        }
        .toast-close-btn:hover { color: #1f2937; }

        .modal-content {
            background: #ffffff;
            border: 1px solid var(--border-subtle) !important;
            border-radius: 16px !important;
            box-shadow: 0 25px 40px -10px rgba(28, 25, 23, 0.15);
            overflow: hidden;
        }
        .modal-header {
            border-bottom: 1px solid var(--border-subtle) !important;
            padding: 1.25rem 1.5rem !important;
            background-color: #faf7f2;
        }
        .modal-title { font-family: 'Lora', Georgia, serif; font-weight: 700; color: var(--color-ink); }
        .modal-body { padding: 1.75rem !important; }
        .modal-footer {
            border-top: 1px solid var(--border-subtle) !important;
            padding: 1rem 1.5rem !important;
            background-color: #faf7f2;
        }

        .page-link {
            color: var(--color-ink);
            background-color: #ffffff;
            border-color: var(--border-subtle);
            padding: 0.5rem 0.95rem;
            font-size: 0.88rem;
        }
        .page-link:hover {
            color: var(--color-amber);
            background-color: #f7f3eb;
            border-color: var(--border-medium);
        }
        .page-item.active .page-link {
            background-color: var(--color-ink);
            border-color: var(--color-ink);
            color: #ffffff;
        }
        .page-item.disabled .page-link {
            color: #a8a29e;
            background-color: transparent;
            border-color: var(--border-subtle);
        }

        .store-footer {
            background-color: #f5efe6;
            border-top: 1px solid var(--border-subtle);
            margin-top: auto;
            padding: 3.5rem 0 2rem 0;
        }
        .footer-heading {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--color-ink);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1rem;
        }
        .footer-link {
            color: var(--text-muted);
            font-size: 0.88rem;
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .footer-link:hover {
            color: var(--color-amber);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Floating Toast Container -->
    <div class="bookstore-toast-wrapper" id="toastContainer">
        @if(session('success'))
            <div class="bookstore-alert bookstore-alert-success" role="alert">
                <div class="toast-icon-box">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">Berhasil</div>
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
                    <div class="toast-title">Pemberitahuan</div>
                    <div class="toast-message">{{ session('error') }}</div>
                </div>
                <button type="button" class="toast-close-btn" onclick="dismissToast(this.closest('.bookstore-alert'))" aria-label="Tutup">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Storefront Header / Navbar -->
    <nav class="navbar navbar-expand-lg store-navbar">
        <div class="container">
            <!-- Brand Text Logo -->
            <a class="brand-logo-text" href="{{ route('home') }}">
                BookStore<span class="brand-dot">.</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links & User Area -->
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link-pure {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-pure {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">
                            Katalog Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-pure {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-pure {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            Kontak
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <!-- Cart Button -->
                    <a href="{{ route('cart.index') }}" id="navbarCartLink" class="btn btn-sm btn-book-outline position-relative d-inline-flex align-items-center gap-1 px-3 py-1.5 {{ request()->routeIs('cart.*') ? 'active' : '' }}" title="Keranjang Belanja">
                        <i class="bi bi-cart3 fs-6"></i>
                        <span class="d-none d-md-inline fw-semibold ms-1">Keranjang</span>
                        <span id="navbarCartBadge" class="badge rounded-pill bg-dark text-white ms-1" style="font-size: 0.65rem; padding: 0.2em 0.45em; line-height: 1; letter-spacing: 0; {{ (isset($cartCount) && $cartCount > 0) ? '' : 'display: none;' }}">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>

                    @auth
                        <!-- Customer User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-sm btn-book-outline dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; font-size: 0.72rem;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold text-truncate" style="max-width: 120px;">{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border mt-2" style="border-radius: 12px; border-color: var(--border-subtle) !important;">
                                <li class="px-3 py-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                                    <div class="small fw-bold text-dark">{{ auth()->user()->name }}</div>
                                    <div class="small text-muted text-truncate">{{ auth()->user()->email }}</div>
                                </li>
                                <li>
                                    <a class="dropdown-item small py-2" href="{{ route('orders.my') }}">
                                        <i class="bi bi-bag-check me-2 text-warning"></i> Pesanan Saya
                                    </a>
                                </li>
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>
                                    <li>
                                        <a class="dropdown-item small py-2" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard Admin
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item small text-danger py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Guest Auth Buttons -->
                        <a href="{{ route('login') }}" class="btn btn-book-outline">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-book-primary">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Body -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="store-footer">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-5">
                    <a class="brand-logo-text mb-2 d-inline-block" href="{{ route('home') }}">BookStore<span class="brand-dot">.</span></a>
                    <p class="text-muted small mb-3" style="max-width: 360px; line-height: 1.65;">
                        Pustaka kurasi buku berkualitas untuk pembaca dan pembelajar sejati. Menghadirkan wawasan terbaik dari penulis terkemuka.
                    </p>
                    <div class="text-muted small">
                        Jl. Pustaka Ilmu No. 45, Kebayoran Baru, Jakarta Selatan
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="footer-heading">Navigasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}" class="footer-link">Katalog Buku</a></li>
                        <li><a href="{{ route('about') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h6 class="footer-heading">Layanan & Kontak</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted mb-0">
                        <li>WhatsApp: +62 851-7335-0405</li>
                        <li>Email: info@bookstore.com</li>
                        <li>Jam Operasional: Senin - Sabtu (08:00 - 17:00 WIB)</li>
                    </ul>
                </div>
            </div>
            <div class="pt-3 border-top text-center text-muted small" style="border-color: var(--border-subtle) !important;">
                &copy; {{ date('Y') }} BookStore. Seluruh Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
            const toasts = document.querySelectorAll('.bookstore-alert');
            toasts.forEach(function (toast) {
                setTimeout(function () {
                    dismissToast(toast);
                }, 3000);
            });
        }

        function updateNavbarCartCount(count) {
            const badgeEl = document.getElementById('navbarCartBadge');
            const cartLink = document.getElementById('navbarCartLink');
            const parsedCount = parseInt(count) || 0;

            if (parsedCount > 0) {
                if (badgeEl) {
                    badgeEl.textContent = parsedCount;
                    badgeEl.style.display = 'inline-block';
                    badgeEl.classList.remove('scale-bounce');
                    void badgeEl.offsetWidth; // trigger reflow
                    badgeEl.classList.add('scale-bounce');
                }
            } else if (badgeEl) {
                badgeEl.style.display = 'none';
            }
        }

        document.addEventListener('submit', function (e) {
            const form = e.target.closest('.form-add-to-cart');
            if (!form) return;

            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn ? submitBtn.innerHTML : '';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.75';
            }

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function (response) {
                if (response.status === 401) {
                    window.location.href = "{{ route('login') }}";
                    return null;
                }
                return response.json();
            })
            .then(function (data) {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }

                if (data && data.success) {
                    updateNavbarCartCount(data.cart_count);
                } else if (data && data.message) {
                    alert(data.message);
                }
            })
            .catch(function () {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
                form.submit();
            });
        });

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', setupAutoDismissAlerts);
        } else {
            setupAutoDismissAlerts();
        }
    </script>
    @stack('scripts')
</body>
</html>
