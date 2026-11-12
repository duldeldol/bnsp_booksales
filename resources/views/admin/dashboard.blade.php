@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Overview Dashboard')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <h4 class="font-serif-book fw-bold mb-1 text-dark">Ringkasan Operasional</h4>
    <p class="text-muted small mb-0">Statistik data buku, pelanggan, dan transaksi toko secara real-time.</p>
</div>

<!-- 5 Clean Stat Cards -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">
    <div class="col">
        <div class="shadcn-card p-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Total Judul Buku</span>
                    <div class="stat-icon-badge stat-icon-amber">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
                <div class="font-serif-book fs-3 fw-bold text-dark">{{ $totalBooks }}</div>
            </div>
            <div class="text-muted small mt-2 pt-2 border-top" style="font-size: 0.72rem;">
                Koleksi buku terdaftar
            </div>
        </div>
    </div>

    <div class="col">
        <div class="shadcn-card p-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Kategori Buku</span>
                    <div class="stat-icon-badge stat-icon-emerald">
                        <i class="bi bi-tag"></i>
                    </div>
                </div>
                <div class="font-serif-book fs-3 fw-bold text-dark">{{ $totalCategories }}</div>
            </div>
            <div class="text-muted small mt-2 pt-2 border-top" style="font-size: 0.72rem;">
                Klasifikasi genre buku
            </div>
        </div>
    </div>

    <div class="col">
        <div class="shadcn-card p-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Total Pesanan</span>
                    <div class="stat-icon-badge stat-icon-slate">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
                <div class="font-serif-book fs-3 fw-bold text-dark">{{ $totalOrders }}</div>
            </div>
            <div class="text-muted small mt-2 pt-2 border-top" style="font-size: 0.72rem;">
                Transaksi pelanggan
            </div>
        </div>
    </div>

    <div class="col">
        <div class="shadcn-card p-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Pelanggan</span>
                    <div class="stat-icon-badge stat-icon-stone">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="font-serif-book fs-3 fw-bold text-dark">{{ $totalCustomers }}</div>
            </div>
            <div class="text-muted small mt-2 pt-2 border-top" style="font-size: 0.72rem;">
                Akun customer aktif
            </div>
        </div>
    </div>

    <div class="col">
        <div class="shadcn-card p-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Total Pendapatan</span>
                    <div class="stat-icon-badge stat-icon-honey">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
                <div class="font-serif-book fs-5 fw-bold text-dark">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
            <div class="text-muted small mt-2 pt-2 border-top" style="font-size: 0.72rem;">
                Pesanan lunas & selesai
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="shadcn-card overflow-hidden mb-4">
            <div class="shadcn-card-header bg-white">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-text text-dark"></i>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Buku Terbaru</h6>
                </div>
                <a href="{{ route('admin.books.index') }}" class="small text-decoration-none text-muted">Kelola Buku</a>
            </div>

            @if($recentBooks->isEmpty())
                <div class="p-4 text-center text-muted small">Belum ada data buku ditambahkan.</div>
            @else
                <div class="table-responsive">
                    <table class="shadcn-table">
                        <thead>
                            <tr>
                                <th>Sampul & Judul Buku</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBooks as $b)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $b->cover_url }}" alt="Cover" class="rounded border shadow-xs" style="width: 30px; height: 42px; object-fit: cover;">
                                            <div>
                                                <div class="font-serif-book fw-bold text-dark text-truncate" style="max-width: 220px; font-size: 0.88rem;">{{ $b->title }}</div>
                                                <small class="text-muted">{{ $b->author }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <span class="badge-editorial badge-editorial-stone">
                                            {{ $b->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-semibold text-dark text-nowrap">{{ $b->formatted_price }}</td>
                                    <td class="text-center text-nowrap">
                                        @if($b->stock <= 5)
                                            <span class="badge-editorial badge-editorial-rose">Sisa {{ $b->stock }}</span>
                                        @else
                                            <span class="badge-editorial badge-editorial-emerald">{{ $b->stock }} unit</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.books.edit', $b->id) }}" class="btn btn-sm btn-shadcn-outline py-1 px-2.5" style="font-size: 0.75rem;">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="shadcn-card overflow-hidden">
            <div class="shadcn-card-header bg-white">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-receipt text-dark"></i>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Pesanan Masuk Terbaru</h6>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small text-decoration-none text-muted">Lihat Semua</a>
            </div>

            @if($recentOrders->isEmpty())
                <div class="p-4 text-center text-muted small">Belum ada transaksi pesanan masuk.</div>
            @else
                <div class="table-responsive">
                    <table class="shadcn-table">
                        <thead>
                            <tr>
                                <th class="text-center">Invoice</th>
                                <th>Pelanggan</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Metode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="text-center font-monospace fw-semibold text-dark text-nowrap">{{ $order->order_number }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                                        <small class="text-muted">{{ $order->customer_phone }}</small>
                                    </td>
                                    <td class="text-center fw-semibold text-dark text-nowrap">{{ $order->formatted_total }}</td>
                                    <td class="text-center text-nowrap">
                                        <span class="badge-editorial badge-editorial-stone">
                                            {{ $order->payment_method_label }}
                                        </span>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <span class="badge-editorial badge-{{ $order->status_badge }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-shadcn-outline py-1 px-2.5" style="font-size: 0.75rem;">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="shadcn-card p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-envelope text-dark"></i>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Pesan Pelanggan</h6>
                </div>
                @if($unreadMessages > 0)
                    <span class="badge-editorial badge-editorial-rose">{{ $unreadMessages }} Baru</span>
                @endif
            </div>

            <div class="p-3 rounded-3 mb-3" style="background-color: #faf7f2; border: 1px solid var(--border-color);">
                <span class="text-muted small d-block">Pesan belum dibuka:</span>
                <div class="font-serif-book fs-4 fw-bold text-dark">{{ $unreadMessages }} Pesan</div>
                <small class="text-muted">Dari formulir <em>Hubungi Kami</em></small>
            </div>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-shadcn-outline w-100 py-2">
                Buka Kotak Masuk Pesan
            </a>
        </div>

        <div class="shadcn-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-tag text-dark"></i>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Kategori Buku Terbaru</h6>
                </div>
            </div>

            <div class="d-flex flex-column gap-2 mb-3">
                @forelse($categoriesList as $cat)
                    <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background-color: #faf7f2; border: 1px solid var(--border-color);">
                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                            <i class="bi bi-tag text-muted"></i>
                            <span class="fw-semibold text-dark small text-truncate" style="max-width: 150px;">{{ $cat->name }}</span>
                        </div>
                        <span class="badge-editorial badge-editorial-stone">{{ $cat->books_count }} buku</span>
                    </div>
                @empty
                    <div class="text-center text-muted small py-3">Belum ada kategori.</div>
                @endforelse
            </div>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-shadcn-outline w-100 py-2 d-inline-flex align-items-center justify-content-center gap-1.5">
                <span>Kelola Semua Kategori</span>
            </a>
        </div>
    </div>
</div>
@endsection
