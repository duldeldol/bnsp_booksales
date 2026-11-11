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
            --border-color: #e5dfd3;
            --bg-canvas: #f6f4ee;
            --text-main: #1c1917;
            --text-muted: #78716c;

            /* Tema Otentik Toko Buku: Warm Paper, Deep Ink, & Amber Gold */
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

        /* Minimalist Light Sidebar */
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
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 0.5rem 1.25rem 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            background-color: var(--color-ink);
            color: #f59e0b;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 3px 8px rgba(28, 25, 23, 0.2);
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
            border-left: 3px solid var(--color-gold);
            border-radius: 0 8px 8px 0;
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

        /* Minimalist Cards on Warm Canvas */
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

        /* Stat Icon Badges (BookStore Style) */
        .stat-icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }
        .stat-icon-amber { background-color: #fef3c7; color: #b45309; }
        .stat-icon-emerald { background-color: #ecfdf5; color: #047857; }
        .stat-icon-navy { background-color: #eff6ff; color: #1d4ed8; }
        .stat-icon-purple { background-color: #f5f3ff; color: #6d28d9; }
        .stat-icon-rose { background-color: #fff1f2; color: #be123c; }

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
            padding: 0.75rem 1rem;
        }
        .shadcn-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        .shadcn-table tbody tr:hover {
            background-color: #faf8f4;
        }

        /* User profile widget at bottom of sidebar */
        .sidebar-footer {
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        /* Minimalist Shadcn Pagination */
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
            opacity: 0.65;
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
            <div class="brand-header">
                <div class="brand-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <div class="font-serif-book fw-bold text-dark fs-5" style="line-height: 1.1;">BookStore</div>
                    <span class="text-muted" style="font-size: 0.7rem;">Pustaka & Toko Buku</span>
                </div>
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
            <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light mb-2">
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <div class="rounded-circle bg-dark text-white fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.75rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-semibold text-dark text-truncate" style="font-size: 0.8rem;">{{ Auth::user()->name }}</div>
                        <div class="text-muted text-truncate" style="font-size: 0.7rem;">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-1">
                <div class="col-6">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-1.5 py-2" style="font-size: 0.8rem; font-weight: 500; border-radius: 8px;">
                        <span>Toko</span>
                    </a>
                </div>
                <div class="col-6">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-1.5 py-2" style="font-size: 0.8rem; font-weight: 500; border-radius: 8px;">
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
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small" id="realtime-clock" style="font-size: 0.8rem; font-variant-numeric: tabular-nums;">
                    <span id="clock-display">{{ date('d M Y') }} | {{ date('H:i') }} WIB</span>
                </span>
            </div>
        </header>

        <!-- Flash Alerts -->
        <div class="px-4 pt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border rounded-3 py-2 px-3 small d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="padding: 0.75rem;"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border rounded-3 py-2 px-3 small d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="padding: 0.75rem;"></button>
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
    // Auto-dismiss all alert popups after exactly 3 seconds
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

    // Live Real-time Clock (Indonesian Date & Hour:Minute)
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
