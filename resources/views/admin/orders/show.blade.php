@extends('layouts.admin')

@section('title', 'Detail Pesanan ' . $order->order_number)
@section('page-title', 'Detail Transaksi ' . $order->order_number)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-shadcn-outline btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke List Pesanan
    </a>
</div>

<div class="row g-4">
    <!-- Left Column: Order Items Table -->
    <div class="col-lg-8">
        <div class="shadcn-card overflow-hidden mb-4">
            <div class="shadcn-card-header bg-white">
                <div>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark">Rincian Buku yang Dipesan</h6>
                    <small class="text-muted font-monospace">Invoice: {{ $order->order_number }}</small>
                </div>
                <span class="badge-editorial badge-{{ $order->status_badge }} px-3 py-1.5" style="font-size: 0.75rem;">
                    {{ $order->status_label }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="shadcn-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Sampul</th>
                            <th>Judul Buku</th>
                            <th>Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->book ? $item->book->cover_url : '' }}" alt="Cover" class="rounded border" style="width: 38px; height: 52px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $item->book ? $item->book->title : 'Buku telah dihapus' }}</div>
                                    <small class="text-muted">{{ $item->book ? $item->book->author : '-' }}</small>
                                </td>
                                <td class="text-muted">{{ $item->formatted_price }}</td>
                                <td class="text-center fw-semibold text-dark">{{ $item->quantity }} pcs</td>
                                <td class="text-end fw-semibold text-dark">{{ $item->formatted_subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold text-dark" style="font-size: 0.9rem;">Total Tagihan:</td>
                            <td class="text-end fw-bold text-dark fs-6">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Status Update & Shipping Info -->
    <div class="col-lg-4">
        <!-- Update Status Card -->
        <div class="shadcn-card p-4 mb-4">
            <h6 class="fw-semibold text-dark mb-3" style="font-size: 0.9rem;">
                <i class="bi bi-sliders me-1"></i> Perbarui Status Pesanan
            </h6>

            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label small text-muted">Pilih status terkini:</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Lunas / Diproses</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-shadcn-primary w-100 btn-sm">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>

        <!-- Recipient Information Card -->
        <div class="shadcn-card p-4">
            <h6 class="fw-semibold text-dark mb-3" style="font-size: 0.9rem;">
                <i class="bi bi-person me-1"></i> Data Penerima
            </h6>

            <div class="mb-3">
                <span class="text-muted small d-block">Nama Lengkap:</span>
                <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Kontak WhatsApp:</span>
                <div class="fw-semibold text-dark">{{ $order->customer_phone }}</div>
                <div class="mt-1">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="btn btn-sm btn-light border text-success">
                        <i class="bi bi-whatsapp me-1"></i> Buka WhatsApp
                    </a>
                </div>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Alamat Pengiriman:</span>
                <div class="p-2.5 bg-light rounded-2 text-dark small">{{ $order->shipping_address }}</div>
            </div>

            <div class="mb-3">
                <span class="text-muted small d-block">Metode Pembayaran:</span>
                <span class="badge-editorial badge-editorial-stone">{{ $order->payment_method_label }}</span>
            </div>

            <div class="pt-2 border-top text-muted small" style="font-size: 0.72rem;">
                Dibuat pada: {{ $order->created_at->format('d F Y, H:i') }} WIB
            </div>
        </div>
    </div>
</div>
@endsection
