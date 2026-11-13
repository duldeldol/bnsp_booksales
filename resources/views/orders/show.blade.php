@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $order->order_number)

@push('styles')
<style>
    @media print {
        body * { visibility: hidden; }
        #printableInvoice, #printableInvoice * { visibility: visible; }
        #printableInvoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 20px;
            border: none !important;
            box-shadow: none !important;
        }
        .no-print { display: none !important; }
    }
</style>
@endpush

@section('content')
<div class="py-5" style="background-color: var(--bg-cream); min-height: 85vh;">
    <div class="container" style="max-width: 820px;">

        <!-- Back Button & Breadcrumbs -->
        <div class="mb-4 no-print">
            <a href="{{ route('orders.my') }}" class="btn btn-sm btn-book-outline mb-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Pesanan Saya
            </a>
            <h2 class="font-serif-book fw-bold text-dark mb-1">Nota Pesanan {{ $order->order_number }}</h2>
            <p class="text-muted small mb-0">Rincian status pengiriman dan transaksi pembelian buku.</p>
        </div>

        <!-- Printable Invoice Container -->
        <div class="bg-white rounded-3 border p-4 p-md-5 shadow-sm mb-4" id="printableInvoice" style="border-color: var(--border-subtle) !important;">
            
            <!-- Header Invoice -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start pb-4 mb-4 border-bottom" style="border-color: var(--border-subtle) !important;">
                <div>
                    <h3 class="font-serif-book fw-bold text-dark mb-0">BookStore<span style="color: var(--color-amber);">.</span></h3>
                    <p class="text-muted small mb-0" style="font-size: 0.8rem;">Toko Buku & Pustaka Terkurasi</p>
                </div>
                <div class="text-sm-end mt-3 mt-sm-0">
                    <span class="badge bg-light text-dark border px-3 py-1 font-monospace" style="font-size: 0.85rem;">
                        {{ $order->order_number }}
                    </span>
                    <div class="text-muted small mt-1" style="font-size: 0.78rem;">
                        {{ $order->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>

            <!-- Meta Information Grid -->
            <div class="row g-4 mb-4">
                <div class="col-sm-6">
                    <h6 class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.72rem; letter-spacing: 0.08em;">Informasi Penerima</h6>
                    <div class="fw-bold text-dark mb-1">{{ $order->customer_name }}</div>
                    <div class="text-muted small mb-2"><i class="bi bi-telephone me-1"></i> {{ $order->customer_phone }}</div>
                    <div class="text-secondary small" style="line-height: 1.5; white-space: pre-line;">{{ $order->shipping_address }}</div>
                </div>

                <div class="col-sm-6">
                    <h6 class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.72rem; letter-spacing: 0.08em;">Status & Pembayaran</h6>
                    <div class="mb-2">
                        <span class="badge-editorial badge-{{ $order->status_badge }} px-2.5 py-1" style="font-size: 0.75rem;">
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <div class="small text-muted mb-1">
                        Metode: <strong class="text-dark">{{ $order->payment_method_label }}</strong>
                    </div>
                    @if($order->payment_method === 'cod')
                        <div class="p-2 rounded bg-light border text-success small mt-2" style="font-size: 0.78rem;">
                            <i class="bi bi-truck me-1"></i> Pembayaran tunai saat kurir tiba.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ordered Books Table -->
            <div class="table-responsive mb-4">
                <table class="table align-middle">
                    <thead class="bg-light" style="font-size: 0.78rem;">
                        <tr>
                            <th class="ps-3 py-2 text-muted" style="width: 50px;">Buku</th>
                            <th class="py-2 text-muted">Judul & Penulis</th>
                            <th class="py-2 text-center text-muted text-nowrap" style="width: 120px; white-space: nowrap !important;">Harga</th>
                            <th class="py-2 text-center text-muted text-nowrap" style="width: 70px; white-space: nowrap !important;">Qty</th>
                            <th class="py-2 text-end pe-3 text-muted text-nowrap" style="width: 130px; white-space: nowrap !important;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.88rem;">
                        @foreach($order->items as $item)
                            <tr style="border-bottom: 1px solid #f6f1e8;">
                                <td class="ps-3 py-2.5" style="width: 50px;">
                                    <img src="{{ $item->book ? $item->book->cover_url : '' }}" alt="Cover" class="rounded border flex-shrink-0" style="width: 36px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="py-2.5" style="min-width: 180px;">
                                    <div class="fw-semibold text-dark" style="line-height: 1.35;">{{ $item->book ? $item->book->title : 'Buku' }}</div>
                                    <small class="text-muted d-block mt-0.5" style="font-size: 0.78rem;">{{ $item->book ? $item->book->author : '-' }}</small>
                                </td>
                                <td class="py-2.5 text-center text-muted text-nowrap" style="white-space: nowrap !important;">{{ $item->formatted_price }}</td>
                                <td class="py-2.5 text-center fw-semibold text-dark text-nowrap" style="white-space: nowrap !important;">{{ $item->quantity }}</td>
                                <td class="py-2.5 text-end pe-3 fw-bold text-dark text-nowrap" style="white-space: nowrap !important;">{{ $item->formatted_subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-semibold text-muted pt-3 pb-1">Subtotal Buku:</td>
                            <td class="text-end pe-3 pt-3 pb-1 fw-semibold text-dark text-nowrap" style="white-space: nowrap !important;">{{ $order->formatted_total }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-semibold text-muted py-1">Biaya Pengiriman:</td>
                            <td class="text-end pe-3 py-1 text-success fw-semibold text-nowrap" style="white-space: nowrap !important;">Gratis</td>
                        </tr>
                        <tr class="border-top" style="border-color: var(--border-subtle) !important;">
                            <td colspan="4" class="text-end fw-bold text-dark fs-6 pt-2">Total Tagihan:</td>
                            <td class="text-end pe-3 fw-bold text-dark fs-5 pt-2 font-serif-book text-nowrap" style="white-space: nowrap !important;">
                                {{ $order->formatted_total }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- COD Instructions Notice -->
            @if($order->payment_method === 'cod')
                <div class="alert alert-warning border-0 rounded-3 p-3 mb-0" style="background-color: #fffbeb; border-left: 4px solid var(--color-amber) !important;">
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                        <i class="bi bi-info-circle-fill text-warning me-1"></i> Catatan Pembayaran COD:
                    </h6>
                    <p class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.6;">
                        Kurir akan mengantarkan pesanan ke alamat Anda. Mohon siapkan uang pas sebesar <strong>{{ $order->formatted_total }}</strong> saat kurir tiba.
                    </p>
                </div>
            @endif

        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 no-print">
            <button type="button" class="btn btn-book-primary px-4 py-2" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Cetak Nota / PDF
            </button>
            <a href="{{ route('orders.my') }}" class="btn btn-book-outline px-4 py-2">
                Kembali ke Pesanan Saya
            </a>
        </div>

    </div>
</div>
@endsection
