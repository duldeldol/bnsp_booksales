@extends('layouts.app')

@section('title', 'Pesanan Saya - BookStore')

@section('content')
<div class="py-5" style="background-color: var(--bg-cream); min-height: 80vh;">
    <div class="container">

        <!-- Breadcrumb & Header -->
        <div class="mb-4">
            <h1 class="font-serif-book fw-bold text-dark mb-1" style="font-size: 2.1rem;">Riwayat Pesanan Saya</h1>
            <p class="text-muted small mb-0">Pantau status pengiriman buku dan arsip transaksi belanja Anda.</p>
        </div>

        @if($orders->count() > 0)
            <div class="bg-white rounded-3 border shadow-sm overflow-hidden" style="border-color: var(--border-subtle) !important;">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light" style="font-size: 0.78rem; border-bottom: 1px solid var(--border-subtle);">
                            <tr>
                                <th class="ps-4 py-3 text-muted text-uppercase" style="letter-spacing: 0.05em;">No. Invoice</th>
                                <th class="py-3 text-muted text-uppercase" style="letter-spacing: 0.05em;">Tanggal</th>
                                <th class="py-3 text-muted text-uppercase" style="letter-spacing: 0.05em;">Buku Dipesan</th>
                                <th class="py-3 text-center text-muted text-uppercase" style="letter-spacing: 0.05em;">Metode</th>
                                <th class="py-3 text-center text-muted text-uppercase" style="letter-spacing: 0.05em;">Status</th>
                                <th class="py-3 text-end text-muted text-uppercase" style="letter-spacing: 0.05em;">Total Bayar</th>
                                <th class="pe-4 py-3 text-center text-muted text-uppercase" style="width: 110px; letter-spacing: 0.05em;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.88rem;">
                            @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #f6f1e8;">
                                    <td class="ps-4 py-3">
                                        <a href="{{ route('orders.success', $order->order_number) }}" class="fw-bold font-monospace text-dark text-decoration-none" title="Lihat nota">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="py-3 text-muted small">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="py-3">
                                        <div class="fw-semibold text-dark mb-0">
                                            {{ $order->items->first() && $order->items->first()->book ? $order->items->first()->book->title : 'Pesanan Buku' }}
                                        </div>
                                        @if($order->items->count() > 1)
                                            <small class="text-muted">+ {{ $order->items->count() - 1 }} judul buku lainnya</small>
                                        @else
                                            <small class="text-muted">{{ $order->items->sum('quantity') }} eksemplar</small>
                                        @endif
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge-editorial badge-editorial-stone" style="font-size: 0.72rem;">
                                            {{ $order->payment_method === 'cod' ? 'COD (Tunai)' : 'Transfer Bank' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge-editorial badge-{{ $order->status_badge }}" style="font-size: 0.72rem;">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-end fw-bold text-dark font-serif-book text-nowrap" style="font-size: 0.95rem; white-space: nowrap !important;">
                                        {{ $order->formatted_total }}
                                    </td>
                                    <td class="pe-4 py-3 text-center">
                                        <a href="{{ route('orders.success', $order->order_number) }}" class="btn btn-sm btn-book-outline py-1 px-2.5" style="font-size: 0.78rem;">
                                            <i class="bi bi-receipt me-1"></i> Nota
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                    <div class="p-3 border-top" style="border-color: var(--border-subtle) !important;">
                        {{ $orders->links('admin.pagination') }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3 border p-5 text-center shadow-sm" style="border-color: var(--border-subtle) !important; max-width: 620px; margin: 2rem auto;">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background-color: #f7f3eb; color: var(--color-amber);">
                    <i class="bi bi-bag-x" style="font-size: 2.2rem;"></i>
                </div>
                <h3 class="font-serif-book fw-bold text-dark mb-2">Belum Ada Riwayat Pesanan</h3>
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    Anda belum pernah membuat pesanan buku di BookStore. Temukan berbagai koleksi buku terbaik kami dan pesan sekaran.
                </p>
                <a href="{{ route('catalog') }}" class="btn btn-book-primary px-4 py-2">
                    Mulai Berbelanja
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
