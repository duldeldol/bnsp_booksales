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

        html {
            overflow-x: clip;
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
            overflow-x: clip;
        }

        .font-serif-book {
            font-family: 'Lora', Georgia, serif;
        }

        .store-navbar {
            background-color: rgba(250, 247, 242, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-subtle);
            position: sticky;
            top: 0;
            z-index: 1040;
            padding: 1.1rem 0;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
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

        .boutique-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Mobile Bottom Floating Dock */
        .mobile-bottom-dock {
            position: fixed;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1040;
            pointer-events: none;
            margin: 0;
            width: max-content;
        }
        .dock-container {
            pointer-events: auto;
            background-color: #1c1917;
            border: 1px solid rgba(224, 215, 199, 0.2);
            border-radius: 50px;
            padding: 5px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 252px;
            box-shadow: none;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-sizing: border-box;
        }
        .dock-item {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
        }
        .dock-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d6cebf;
            font-size: 1.22rem;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            box-sizing: border-box;
        }
        .dock-item:hover .dock-icon-wrap {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }
        .dock-item.active .dock-icon-wrap {
            background-color: var(--color-amber);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(180, 83, 9, 0.42);
        }

        @media (max-width: 991.98px) {
            .store-footer {
                padding-bottom: calc(2.5rem + 72px) !important;
            }
            .store-navbar {
                padding: 0.85rem 0;
            }
        }

        @media (max-width: 575.98px) {
            .boutique-card {
                padding: 0.75rem;
                border-radius: 12px;
            }
            .boutique-cover-wrap {
                border-radius: 6px;
                margin-bottom: 0.65rem;
            }
            .boutique-tag {
                font-size: 0.65rem;
                margin-bottom: 0.15rem;
            }
            .boutique-title {
                font-size: 0.88rem;
                height: 2.5em;
                margin-bottom: 0.2rem;
            }
            .boutique-author {
                font-size: 0.74rem;
                margin-bottom: 0.75rem;
            }
            .boutique-bottom-row {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
                padding-top: 0.65rem;
            }
            .boutique-price {
                font-size: 0.95rem;
                text-align: left;
            }
            .boutique-actions {
                width: 100%;
                gap: 6px;
            }
            .boutique-actions .btn-boutique-action {
                flex: 1;
                text-align: center;
                padding: 0.35rem 0.5rem;
                font-size: 0.76rem;
            }
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
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Brand Text Logo -->
            <a class="brand-logo-text" href="{{ route('home') }}">
                BookStore<span class="brand-dot">.</span>
            </a>

            <!-- Desktop Nav Links (Hidden on Mobile) -->
            <ul class="navbar-nav d-none d-lg-flex flex-row align-items-center gap-1 mb-0">
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

            <!-- Right Area: Cart & Profile Icons -->
            <div class="d-flex align-items-center gap-2">
                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" id="navbarCartLink" class="btn btn-sm btn-book-outline position-relative d-inline-flex align-items-center justify-content-center gap-1 px-2.5 px-lg-3 py-1.5 {{ request()->routeIs('cart.*') ? 'active' : '' }}" title="Keranjang Belanja" style="border-radius: 50px;">
                    <i class="bi bi-cart3 fs-6"></i>
                    <span class="d-none d-lg-inline fw-semibold ms-1">Keranjang</span>
                    <span id="navbarCartBadge" class="badge rounded-pill bg-dark text-white ms-0.5 ms-lg-1" style="font-size: 0.65rem; padding: 0.2em 0.45em; line-height: 1; letter-spacing: 0; {{ (isset($cartCount) && $cartCount > 0) ? '' : 'display: none;' }}">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>

                @auth
                    <!-- Customer User Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-book-outline dropdown-toggle d-flex align-items-center gap-2 px-2 px-lg-3 py-1.5" type="button" data-bs-toggle="dropdown" aria-label="Menu Akun" style="border-radius: 50px;">
                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 22px; height: 22px; font-size: 0.72rem;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="fw-semibold text-truncate d-none d-lg-inline" style="max-width: 120px;">{{ auth()->user()->name }}</span>
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
                    <!-- Guest View -->
                    <!-- Desktop: Masuk & Daftar buttons -->
                    <div class="d-none d-lg-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-book-outline">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-book-primary">
                            Daftar
                        </a>
                    </div>
                    <!-- Mobile: Profile Icon Button with Dropdown -->
                    <div class="dropdown d-lg-none">
                        <button class="btn btn-sm btn-book-outline d-flex align-items-center justify-content-center p-0" type="button" data-bs-toggle="dropdown" aria-label="Menu Akun" style="width: 34px; height: 34px; border-radius: 50%;">
                            <i class="bi bi-person fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border mt-2" style="border-radius: 12px; border-color: var(--border-subtle) !important;">
                            <li>
                                <a class="dropdown-item small py-2" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2 text-primary"></i> Masuk
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item small py-2" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus me-2 text-success"></i> Buat Akun Baru
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Body -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Floating Bottom Navigation Dock (Mobile Only) -->
    <nav class="mobile-bottom-dock d-lg-none" aria-label="Navigasi Bawah">
        <div class="dock-container">
            <a href="{{ route('home') }}" class="dock-item {{ request()->routeIs('home') ? 'active' : '' }}" title="Beranda">
                <div class="dock-icon-wrap">
                    <i class="bi {{ request()->routeIs('home') ? 'bi-house-door-fill' : 'bi-house-door' }}"></i>
                </div>
            </a>
            <a href="{{ route('catalog') }}" class="dock-item {{ request()->routeIs('catalog') ? 'active' : '' }}" title="Katalog Buku">
                <div class="dock-icon-wrap">
                    <i class="bi {{ request()->routeIs('catalog') ? 'bi-book-half' : 'bi-book' }}"></i>
                </div>
            </a>
            <a href="{{ route('about') }}" class="dock-item {{ request()->routeIs('about') ? 'active' : '' }}" title="Tentang Kami">
                <div class="dock-icon-wrap">
                    <i class="bi {{ request()->routeIs('about') ? 'bi-info-circle-fill' : 'bi-info-circle' }}"></i>
                </div>
            </a>
            <a href="{{ route('contact') }}" class="dock-item {{ request()->routeIs('contact') ? 'active' : '' }}" title="Kontak">
                <div class="dock-icon-wrap">
                    <i class="bi {{ request()->routeIs('contact') ? 'bi-chat-dots-fill' : 'bi-chat-dots' }}"></i>
                </div>
            </a>
        </div>
    </nav>

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
