@extends('layouts.app')

@section('title', 'Checkout Pemesanan - BookStore')

@section('content')
<div class="py-5" style="background-color: var(--bg-cream); min-height: 80vh;">
    <div class="container">

        <!-- Breadcrumb & Header -->
        <div class="mb-4">
            <h1 class="font-serif-book fw-bold text-dark mb-1" style="font-size: 2.1rem;">Checkout Pemesanan</h1>
            <p class="text-muted small mb-0">Lengkapi data alamat pengiriman dan konfirmasi pesanan.</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="row g-4">
                <!-- Left Column: Shipping & Payment Method -->
                <div class="col-lg-7 col-xl-8">

                    <!-- 1. Shipping Details Card -->
                    <div class="bg-white rounded-3 border p-4 shadow-sm mb-4" style="border-color: var(--border-subtle) !important;">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                            <span class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 0.75rem;">1</span>
                            <h5 class="font-serif-book fw-bold text-dark mb-0">Informasi Penerima & Pengiriman</h5>
                        </div>

                        <div class="row g-3">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label small fw-semibold text-dark">Nama Lengkap Penerima <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', $user->name) }}" required placeholder="Contoh: Budi Santoso">
                                @error('customer_name')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Customer Phone / WhatsApp -->
                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label small fw-semibold text-dark">Nomor WhatsApp / Telepon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted small"><i class="bi bi-whatsapp"></i></span>
                                    <input type="tel" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone', $user->phone ?? '') }}" required placeholder="081234567890">
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Kurir akan menghubungi nomor ini saat pengantaran buku.</small>
                                @error('customer_phone')
                                    <div class="invalid-feedback d-block small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Shipping Address -->
                            <div class="col-12">
                                <label for="shipping_address" class="form-label small fw-semibold text-dark">Alamat Lengkap Pengiriman <span class="text-danger">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control @error('shipping_address') is-invalid @enderror" required placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, dan kode pos...">{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div class="col-12">
                                <label for="notes" class="form-label small fw-semibold text-dark">Catatan untuk Kurir (Opsional)</label>
                                <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes') }}" placeholder="Contoh: Titipkan di satpam perumahan / pagar warna hitam">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Payment Method Selection Card -->
                    <div class="bg-white rounded-3 border p-4 shadow-sm" style="border-color: var(--border-subtle) !important;">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                            <span class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 0.75rem;">2</span>
                            <h5 class="font-serif-book fw-bold text-dark mb-0">Pilih Metode Pembayaran</h5>
                        </div>

                        <div class="row g-3">
                            <!-- Option 1: Cash on Delivery -->
                            <div class="col-12">
                                <label class="payment-method-card d-block p-3 border rounded-3 position-relative cursor-pointer" style="cursor: pointer; transition: all 0.2s ease;">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="pt-1">
                                            <input type="radio" name="payment_method" value="cod" class="form-check-input" checked id="payCOD">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="fw-bold text-dark font-serif-book" style="font-size: 1.05rem;">
                                                    <i class="bi bi-cash-coin me-1 text-warning"></i> Bayar di Tempat (COD / Cash on Delivery)
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">
                                                Bayar tunai kepada kurir saat paket buku tiba di alamat tujuan Anda. Aman, praktis, dan Anda dapat memeriksa fisik paket sebelum serah terima uang.
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Option 2: Bank Transfer -->
                            <div class="col-12">
                                <label class="payment-method-card d-block p-3 border rounded-3 position-relative cursor-pointer" style="cursor: pointer; transition: all 0.2s ease;">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="pt-1">
                                            <input type="radio" name="payment_method" value="whatsapp" class="form-check-input" id="payWA">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="fw-bold text-dark font-serif-book" style="font-size: 1.05rem;">
                                                    <i class="bi bi-bank me-1 text-primary"></i> Transfer Bank (Konfirmasi WhatsApp)
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">
                                                Transfer langsung ke rekening resmi BCA/Mandiri BookStore dan kirimkan foto struk bukti transfer kepada admin via WhatsApp.
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        @error('payment_method')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Right Column: Order Summary & Confirmation CTA -->
                <div class="col-lg-5 col-xl-4">
                    <div class="bg-white rounded-3 border p-4 shadow-sm sticky-top" style="border-color: var(--border-subtle) !important; top: 90px; z-index: 10;">
                        <h5 class="font-serif-book fw-bold text-dark mb-3">Rincian Belanja</h5>

                        <!-- Items List -->
                        <div class="checkout-items-list mb-3" style="max-height: 260px; overflow-y: auto; overflow-x: hidden; padding-right: 4px;">
                            @foreach($cartItems as $item)
                                <div class="d-flex align-items-center py-2 border-bottom" style="gap: 12px; border-color: #f6f1e8 !important;">
                                    <img src="{{ $item->book ? $item->book->cover_url : '' }}" alt="Cover" class="rounded shadow-sm flex-shrink-0" style="width: 42px; height: 58px; object-fit: cover;">
                                    <div class="flex-grow-1 min-w-0" style="min-width: 0; overflow: hidden;">
                                        <h6 class="font-serif-book fw-bold text-dark mb-0 text-truncate" style="font-size: 0.88rem; line-height: 1.3;" title="{{ $item->book ? $item->book->title : '' }}">
                                            {{ $item->book ? $item->book->title : 'Buku' }}
                                        </h6>
                                        <small class="text-muted d-block text-nowrap mt-0.5" style="font-size: 0.76rem;">
                                            {{ $item->quantity }} x {{ $item->book ? $item->book->formatted_price : '-' }}
                                        </small>
                                    </div>
                                    <div class="text-end fw-bold text-dark flex-shrink-0 text-nowrap ms-2" style="font-size: 0.88rem; white-space: nowrap !important;">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Calculations -->
                        <div class="d-flex justify-content-between mb-2 text-muted small">
                            <span>Subtotal Produk</span>
                            <span class="fw-semibold text-dark text-nowrap" style="white-space: nowrap !important;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-muted small">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success fw-semibold text-nowrap" style="white-space: nowrap !important;">Gratis Ongkir</span>
                        </div>

                        <div class="pt-3 border-top mb-4" style="border-color: var(--border-subtle) !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 1rem;">Total Pembayaran</span>
                                <span class="font-serif-book fw-bold text-dark fs-4 text-nowrap" style="white-space: nowrap !important;">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-book-primary w-100 py-2.5 mb-3 d-flex align-items-center justify-content-center gap-2 fw-semibold">
                            <span>Konfirmasi & Buat Pesanan</span>
                        </button>

                        <div class="text-center">
                            <a href="{{ route('cart.index') }}" class="text-muted small text-decoration-none">
                                Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection
