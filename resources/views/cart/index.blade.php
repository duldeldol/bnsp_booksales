@extends('layouts.app')

@section('title', 'Keranjang Belanja - BookStore')

@section('content')
<div class="py-5" style="background-color: var(--bg-cream); min-height: 80vh;">
    <div class="container">

        <!-- Header -->
        <div class="mb-4">
            <h1 class="font-serif-book fw-bold text-dark mb-1" style="font-size: 2.1rem;">Keranjang Belanja</h1>
            <p class="text-muted small mb-0">Periksa kembali buku pilihan Anda sebelum melanjutkan ke proses pembayaran.</p>
        </div>

        @if($cartItems->count() > 0)
            <div class="row g-4">
                <!-- Cart Items Table (Left Column) -->
                <div class="col-lg-8">
                    <div class="bg-white rounded-3 border p-4 shadow-sm" style="border-color: var(--border-subtle) !important;">
                        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom" style="border-color: var(--border-subtle) !important;">
                            <span class="fw-semibold text-dark">Daftar Buku ({{ $cartItems->sum('quantity') }} item)</span>
                            <!-- Trigger Modal Kosongkan Keranjang -->
                            <button type="button" class="btn btn-sm text-danger p-0 border-0 bg-transparent" style="font-size: 0.82rem;" data-bs-toggle="modal" data-bs-target="#modalClearCart">
                                <i class="bi bi-trash3 me-1"></i> Kosongkan Keranjang
                            </button>
                        </div>

                        <!-- Scrollable Table Container -->
                        <div class="table-responsive" style="max-height: 245px; overflow-y: auto; overflow-x: auto;">
                            <table class="table align-middle mb-0">
                                <thead style="position: sticky; top: 0; background-color: #ffffff; z-index: 2;">
                                    <tr class="text-muted small text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-subtle);">
                                        <th style="width: 80px;" class="pb-2">Buku</th>
                                        <th class="pb-2">Detail Judul</th>
                                        <th class="text-center pb-2 text-nowrap" style="white-space: nowrap !important;">Harga</th>
                                        <th class="text-center pb-2 text-nowrap" style="width: 140px; white-space: nowrap !important;">Kuantitas</th>
                                        <th class="text-end pb-2 text-nowrap" style="white-space: nowrap !important;">Subtotal</th>
                                        <th class="text-center pb-2" style="width: 50px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr style="border-bottom: 1px solid #f6f1e8;">
                                            <!-- Book Cover Thumbnail -->
                                            <td class="py-3">
                                                <div class="rounded-2 overflow-hidden shadow-sm bg-light flex-shrink-0" style="width: 60px; height: 85px;">
                                                    <img src="{{ $item->book ? $item->book->cover_url : '' }}" alt="{{ $item->book ? $item->book->title : 'Buku' }}" class="w-100 h-100" style="object-fit: cover;">
                                                </div>
                                            </td>

                                            <!-- Book Title & Meta -->
                                            <td class="py-3">
                                                <div class="boutique-tag" style="font-size: 0.68rem; margin-bottom: 2px;">
                                                    {{ $item->book && $item->book->category ? $item->book->category->name : 'Kategori' }}
                                                </div>
                                                <h6 class="font-serif-book fw-bold text-dark mb-1" style="font-size: 0.95rem; line-height: 1.35;">
                                                    {{ $item->book ? $item->book->title : 'Buku tidak ditemukan' }}
                                                </h6>
                                                <div class="text-muted small" style="font-size: 0.78rem;">
                                                    Penulis: {{ $item->book ? $item->book->author : '-' }}
                                                </div>
                                                @if($item->book && $item->book->stock <= 5)
                                                    <span class="badge bg-warning text-dark mt-1" style="font-size: 0.68rem; font-weight: 500;">
                                                        Sisa stok: {{ $item->book->stock }}
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Unit Price -->
                                            <td class="py-3 text-center text-nowrap" style="font-size: 0.9rem; white-space: nowrap !important;">
                                                {{ $item->book ? $item->book->formatted_price : '-' }}
                                            </td>

                                            <!-- Quantity Controls -->
                                            <td class="py-3 text-center text-nowrap" style="white-space: nowrap !important;">
                                                <div class="d-inline-flex align-items-center border rounded-pill bg-light p-1" style="border-color: var(--border-medium) !important;">
                                                    <!-- Decrease Form -->
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline m-0">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="action" value="decrease">
                                                        <button type="submit" class="btn btn-sm btn-link text-dark p-0 d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; text-decoration: none;" title="{{ $item->quantity == 1 ? 'Hapus item' : 'Kurang 1' }}">
                                                            <i class="bi {{ $item->quantity == 1 ? 'bi-trash' : 'bi-dash' }}" style="font-size: 0.85rem;"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Quantity Value -->
                                                    <span class="fw-bold px-2 text-dark font-monospace" style="font-size: 0.9rem; min-width: 28px; text-align: center;">
                                                        {{ $item->quantity }}
                                                    </span>

                                                    <!-- Increase Form -->
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline m-0">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="action" value="increase">
                                                        <button type="submit" class="btn btn-sm btn-link text-dark p-0 d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; text-decoration: none;" title="Tambah 1" {{ ($item->book && $item->quantity >= $item->book->stock) ? 'disabled' : '' }}>
                                                            <i class="bi bi-plus" style="font-size: 0.85rem;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="py-3 text-end fw-bold text-dark text-nowrap" style="font-size: 0.95rem; white-space: nowrap !important;">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>

                                            <!-- Delete Action -->
                                            <td class="py-3 text-center">
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-secondary p-1 border-0 bg-transparent hover-danger" title="Hapus dari keranjang">
                                                        <i class="bi bi-x-lg" style="font-size: 0.85rem;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Bottom Cart Actions -->
                        <div class="d-flex align-items-center justify-content-end pt-3 mt-3 border-top" style="border-color: var(--border-subtle) !important;">
                            <a href="{{ route('catalog') }}" class="btn btn-book-outline btn-sm">
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="bg-white rounded-3 border p-4 shadow-sm sticky-top" style="border-color: var(--border-subtle) !important; top: 90px; z-index: 10;">
                        <h5 class="font-serif-book fw-bold text-dark mb-3">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between mb-2 text-muted small">
                            <span>Subtotal Buku ({{ $cartItems->sum('quantity') }} item)</span>
                            <span class="fw-semibold text-dark text-nowrap" style="white-space: nowrap !important;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 text-muted small">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success fw-semibold text-nowrap" style="white-space: nowrap !important;">Gratis (Promo Toko)</span>
                        </div>

                        <div class="pt-3 border-top mb-4" style="border-color: var(--border-subtle) !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 1rem;">Total Tagihan</span>
                                <span class="font-serif-book fw-bold text-dark fs-4 text-nowrap" style="white-space: nowrap !important;">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.78rem;">
                                Harga sudah termasuk PPN & biaya pengemasan aman.
                            </small>
                        </div>

                        <!-- CTA Button -->
                        <a href="{{ route('checkout.index') }}" class="btn btn-book-primary w-100 py-2.5 mb-3 d-flex align-items-center justify-content-center gap-2">
                            <span>Pilih Metode Pembayaran</span>
                        </a>

                        <!-- Trust Features Badge -->
                        <div class="p-3 rounded-2 bg-light border" style="border-color: #ede6db !important;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-shield-check text-dark"></i>
                                <span class="small fw-semibold text-dark">100% Koleksi Buku Original</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-box-seam text-dark"></i>
                                <span class="small fw-semibold text-dark">Pengemasan Bubble Wrap Tebal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Kosongkan Keranjang -->
            <div class="modal fade" id="modalClearCart" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title font-serif-book fw-bold text-dark mb-0">Kosongkan Keranjang</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                Apakah Anda yakin ingin mengosongkan seluruh isi keranjang belanja Anda? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-sm btn-book-outline" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3 border p-5 text-center shadow-sm" style="border-color: var(--border-subtle) !important; max-width: 620px; margin: 2rem auto;">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background-color: #f7f3eb; color: var(--color-amber);">
                    <i class="bi bi-bag-x" style="font-size: 2.2rem;"></i>
                </div>
                <h3 class="font-serif-book fw-bold text-dark mb-2">Keranjang Belanja Anda Kosong</h3>
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    Sepertinya Anda belum memilih buku apa pun. Jelajahi katalog koleksi kami untuk menemukan bacaan inspiratif dan karya-karya terbaik pilihan Anda.
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('catalog') }}" class="btn btn-book-primary px-4 py-2">
                        Jelajahi Katalog Buku
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
