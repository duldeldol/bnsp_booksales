<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - BookStore</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Literary Bookstore Typography: Lora (Serif) & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --border-color: #e8e2d5;
            --bg-canvas: #faf7f2;
            --text-main: #1c1917;
            --text-muted: #78716c;

            --color-ink: #1c1917;
            --color-ink-hover: #292524;
            --color-gold: #b45309;
            --color-gold-hover: #92400e;
            --color-gold-light: #fef3c7;
            --color-gold-border: #fde68a;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-book {
            font-family: 'Lora', Georgia, serif;
        }

        /* Fullscreen Layout Wrapper */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        #sidebar {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 1.25rem 1rem;
            z-index: 100;
        }

        .brand-header {
            padding: 0.75rem 0.6rem 1.35rem 0.6rem;
            border-bottom: 1px solid var(--border-color);
        }
        .brand-logo-admin {
            text-decoration: none;
            display: block;
        }
        .brand-logo-title {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.42rem;
            font-weight: 700;
            color: var(--color-ink);
            letter-spacing: -0.4px;
            line-height: 1.1;
            transition: color 0.2s ease;
        }
        .brand-logo-title .brand-dot {
            color: var(--color-gold);
            transition: color 0.2s ease;
        }
        .brand-logo-admin:hover .brand-logo-title {
            color: var(--color-gold);
        }
        .brand-logo-admin:hover .brand-dot {
            color: var(--color-ink) !important;
        }

        /* Sidebar Navigation */
        .nav-section-title {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #a8a29e;
            padding: 1rem 0.5rem 0.35rem 0.5rem;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-menu .nav-link {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .sidebar-menu .nav-link:hover {
            color: var(--color-ink);
            background-color: #faf8f4;
        }

        .sidebar-menu .nav-link.active {
            color: var(--color-gold-hover);
            background-color: var(--color-gold-light);
            font-weight: 600;
            border-radius: 8px;
        }
        .sidebar-menu .nav-link.active i {
            color: var(--color-gold);
        }

        /* Main Content Container */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Top Header */
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0.85rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-content {
            padding: 1.75rem;
            flex: 1;
        }

        .shadcn-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(28, 25, 23, 0.03);
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .shadcn-card:hover {
            border-color: #d6cebf;
        }

        .shadcn-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .shadcn-card-body {
            padding: 1.5rem;
        }

        .stat-icon-badge {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: transform 0.2s ease;
        }
        .shadcn-card:hover .stat-icon-badge {
            transform: scale(1.05);
        }
        .stat-icon-amber { background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .stat-icon-emerald { background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .stat-icon-slate { background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }
        .stat-icon-stone { background-color: #f5f5f4; color: #44403c; border: 1px solid #e7e5e4; }
        .stat-icon-honey { background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a; }

        .badge-editorial {
            font-size: 0.72rem;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
            white-space: nowrap !important;
            letter-spacing: 0.01em;
        }
        .badge-editorial-amber, .bg-editorial-amber { background-color: #fef3c7 !important; color: #b45309 !important; border: 1px solid #fde68a !important; font-weight: 500; }
        .badge-editorial-emerald, .bg-editorial-emerald { background-color: #ecfdf5 !important; color: #047857 !important; border: 1px solid #a7f3d0 !important; font-weight: 500; }
        .badge-editorial-rose, .bg-editorial-rose { background-color: #fff1f2 !important; color: #be123c !important; border: 1px solid #fecdd3 !important; font-weight: 500; }
        .badge-editorial-slate, .bg-editorial-slate { background-color: #f1f5f9 !important; color: #334155 !important; border: 1px solid #cbd5e1 !important; font-weight: 500; }
        .badge-editorial-stone, .bg-editorial-stone { background-color: #f5f5f4 !important; color: #44403c !important; border: 1px solid #e7e5e4 !important; font-weight: 500; }
        .badge-editorial-ink, .bg-editorial-ink { background-color: #1c1917 !important; color: #ffffff !important; border: 1px solid #1c1917 !important; font-weight: 500; }

        /* Sidebar footer action buttons */
        .btn-sidebar-store {
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 8px;
            background-color: #ffffff;
            color: var(--color-ink);
            border: 1px solid var(--border-color);
            transition: all 0.15s ease;
        }
        .btn-sidebar-store:hover {
            background-color: #faf7f2 !important;
            border-color: var(--color-gold) !important;
            color: var(--color-gold) !important;
        }
        .btn-sidebar-logout {
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 8px;
            background-color: #ffffff;
            color: #be123c;
            border: 1px solid var(--border-color);
            transition: all 0.15s ease;
        }
        .btn-sidebar-logout:hover {
            background-color: #fff1f2 !important;
            border-color: #fecdd3 !important;
            color: #be123c !important;
        }

        /* Buttons & Inputs */
        .btn-shadcn-primary {
            background-color: var(--color-ink);
            color: #ffffff;
            border: 1px solid var(--color-ink);
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
        }
        .btn-shadcn-primary:hover {
            background-color: var(--color-gold);
            border-color: var(--color-gold);
            color: #ffffff;
        }

        .btn-shadcn-outline {
            background-color: #ffffff;
            color: var(--color-ink);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
        }
        .btn-shadcn-outline:hover {
            background-color: #faf8f4;
            border-color: #c7beab;
            color: var(--color-gold);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--color-gold) !important;
            box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.12) !important;
        }

        /* Table styling */
        .shadcn-table {
            width: 100%;
            margin-bottom: 0;
            font-size: 0.85rem;
        }
        .shadcn-table th {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            background-color: #faf8f4;
            border-bottom: 1px solid var(--border-color);
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }
        .shadcn-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        .shadcn-table tbody tr:hover {
            background-color: #faf8f4;
        }

        .sidebar-footer {
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .pagination {
            margin-bottom: 0;
            gap: 4px;
        }
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            border-radius: 8px !important;
        }
        .pagination .page-link {
            color: var(--color-ink) !important;
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px !important;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 0.45rem 0.8rem;
            min-width: 36px;
            text-align: center;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }
        .pagination .page-link:hover {
            background-color: var(--color-gold-light);
            border-color: var(--color-gold-border);
            color: var(--color-gold-hover) !important;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--color-ink) !important;
            border-color: var(--color-ink) !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        .pagination .page-item.disabled .page-link {
            color: #a8a29e !important;
            background-color: #f5f2eb;
            border-color: var(--border-color);
            cursor: not-allowed;
            opacity: 0.65;
        }

        /* Authentic Modals */
        .modal-content {
            background: #ffffff;
            border: 1px solid var(--border-color) !important;
            border-radius: 14px !important;
            box-shadow: 0 20px 25px -5px rgba(28, 25, 23, 0.1), 0 10px 10px -5px rgba(28, 25, 23, 0.04);
            overflow: hidden;
        }
        .modal-header {
            border-bottom: 1px solid var(--border-color) !important;
            padding: 1.15rem 1.5rem !important;
            background-color: #faf8f4;
        }
        .modal-title {
            font-family: 'Lora', Georgia, serif;
            font-weight: 700;
            color: var(--color-ink);
            font-size: 1.05rem;
        }
        .modal-body {
            padding: 1.5rem !important;
        }
        .modal-footer {
            border-top: 1px solid var(--border-color) !important;
            padding: 1rem 1.5rem !important;
            background-color: #faf8f4;
        }

        .bookstore-toast-wrapper {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1090;
            min-width: 320px;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            pointer-events: none;
        }

        .bookstore-alert {
            pointer-events: auto;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 12px 24px -6px rgba(28, 25, 23, 0.12), 0 6px 12px -4px rgba(28, 25, 23, 0.06);
            padding: 0.95rem 1.15rem;
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            transform: translateY(0);
            opacity: 1;
            transition: opacity 0.35s ease, transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), max-height 0.4s ease, margin 0.4s ease, padding 0.4s ease;
            overflow: hidden;
        }

        .bookstore-alert.hiding {
            opacity: 0;
            transform: translateY(-12px);
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
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
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
            font-size: 0.92rem;
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
            font-size: 0.825rem;
            line-height: 1.4;
            word-break: break-word;
        }

        .toast-close-btn {
            background: transparent;
            border: none;
            color: #9ca3af;
            padding: 0;
            cursor: pointer;
            font-size: 1.25rem;
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

        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                left: -260px;
                transition: left 0.3s ease;
            }
            #sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <!-- SIDEBAR -->
    <aside id="sidebar">
        <div>
            <!-- Brand -->
            <div class="brand-header px-2 py-3">
                <a href="{{ route('admin.dashboard') }}" class="brand-logo-admin">
                    <div class="brand-logo-title">
                        BookStore<span class="brand-dot">.</span>
                    </div>
                    <span class="text-muted" style="font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 600; display: block; margin-top: 4px;">
                        Admin Portal
                    </span>
                </a>
            </div>

            <!-- Navigation Sections -->
            <div class="nav-section-title">Menu Utama</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </div>

            <div class="nav-section-title">Katalog & Produk</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Data Buku
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tag"></i> Kategori Buku
                </a>
            </div>

            <div class="nav-section-title">Transaksi & User</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> List Pesanan
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> User Terdaftar
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Pesan Masuk
                </a>
            </div>
        </div>

        <!-- Sidebar Footer / Current Admin -->
        <div class="sidebar-footer">
            <div class="rounded-3 mb-2" style="padding: 0.7rem 0.9rem; background-color: #faf7f2; border: 1px solid var(--border-color);">
                <div class="d-flex align-items-center" style="gap: 13px;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shrink-0 text-white" style="width: 35px; height: 35px; font-size: 0.82rem; background-color: var(--color-ink); box-shadow: 0 2px 5px rgba(28, 25, 23, 0.1);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-bold text-dark text-truncate" style="font-size: 0.84rem; line-height: 1.25;">{{ Auth::user()->name }}</div>
                        <span class="text-muted d-block text-truncate" style="font-size: 0.7rem; margin-top: 2px;">Administrator</span>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-1">
                <div class="col-6">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-sidebar-store w-100 d-inline-flex align-items-center justify-content-center gap-1.5 py-2 text-decoration-none">
                        <span>Toko</span>
                    </a>
                </div>
                <div class="col-6">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-sidebar-logout w-100 d-inline-flex align-items-center justify-content-center gap-1.5 py-2">
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTAINER -->
    <div class="main-container">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="d-flex align-items-center gap-2">
                <h5 class="font-serif-book fw-bold mb-0 text-dark">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-2.5">
                <span class="text-muted small ps-2.5 border-start" id="realtime-clock" style="font-size: 0.8rem; font-variant-numeric: tabular-nums; border-color: var(--border-color) !important;">
                    <span id="clock-display">{{ date('d M Y') }} | {{ date('H:i') }} WIB</span>
                </span>
            </div>
        </header>

        <!-- Authentic Bookstore Floating Flash Pop-ups -->
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

        <!-- Content Body -->
        <main class="page-content">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dismiss toast with smooth slide and fade
    function dismissToast(toastEl) {
        if (!toastEl || toastEl.classList.contains('hiding')) return;
        toastEl.classList.add('hiding');
        setTimeout(function () {
            if (toastEl.parentNode) {
                toastEl.parentNode.removeChild(toastEl);
            }
        }, 400);
    }

    // Auto-dismiss all bookstore toast popups after exactly 3 seconds
    function setupAutoDismissAlerts() {
        // Bookstore toast alerts
        const bookstoreToasts = document.querySelectorAll('.bookstore-alert');
        bookstoreToasts.forEach(function (toast) {
            setTimeout(function () {
                dismissToast(toast);
            }, 3000);
        });

        const standardAlerts = document.querySelectorAll('.alert:not(.bookstore-alert)');
        standardAlerts.forEach(function (alert) {
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

    // Live Real-time Clock
    function updateRealtimeClock() {
        const clockDisplay = document.getElementById('clock-display');
        if (!clockDisplay) return;

        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        const dayName = days[now.getDay()];
        const date = String(now.getDate()).padStart(2, '0');
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        clockDisplay.textContent = `${dayName}, ${date} ${month} ${year} | ${hours}:${minutes} WIB`;
    }

    setInterval(updateRealtimeClock, 1000);
    updateRealtimeClock();
</script>
@stack('scripts')
</body>
</html>
