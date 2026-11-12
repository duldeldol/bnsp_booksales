@extends('layouts.app')

@section('title', 'Hubungi Kami - BookStore')

@push('styles')
<style>
    .contact-hero {
        padding: 4.5rem 0 3rem 0;
        text-align: center;
    }
    .contact-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 3rem;
        font-weight: 600;
        color: var(--color-ink);
        letter-spacing: -0.5px;
        line-height: 1.18;
        max-width: 680px;
        margin: 0 auto 1.25rem auto;
    }
    .contact-subtitle {
        color: var(--text-muted);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 560px;
        margin: 0 auto;
    }

    /* CARDS */
    .contact-info-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 16px;
        padding: 2.25rem;
        height: 100%;
        box-shadow: 0 4px 18px rgba(28, 25, 23, 0.03);
    }
    .contact-form-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 16px;
        padding: 2.75rem;
        box-shadow: 0 4px 18px rgba(28, 25, 23, 0.03);
    }

    .contact-item-group {
        padding-bottom: 1.35rem;
        margin-bottom: 1.35rem;
        border-bottom: 1px solid #f6f1e8;
    }
    .contact-item-group:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .contact-item-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--color-amber);
        margin-bottom: 0.35rem;
    }

    .btn-wa-direct {
        background-color: #f0fdf4;
        color: #15803d !important;
        border: 1px solid #bbf7d0;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.35rem 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.15s ease;
        margin-top: 0.35rem;
    }
    .btn-wa-direct:hover {
        background-color: #15803d;
        color: #ffffff !important;
        border-color: #15803d;
    }

    /* FAQ SECTION */
    .faq-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        padding: 1.75rem;
        height: 100%;
        transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .faq-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -4px rgba(28, 25, 23, 0.06);
        border-color: var(--border-medium);
    }
    .faq-question {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.08rem;
        font-weight: 700;
        color: var(--color-ink);
        margin-bottom: 0.65rem;
        line-height: 1.4;
    }
    .faq-answer {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.65;
        margin-bottom: 0;
    }

    @media (max-width: 767.98px) {
        .contact-title { font-size: 2.2rem; }
        .contact-form-card, .contact-info-card { padding: 1.75rem; }
    }
</style>
@endpush

@section('content')

<!-- 1. HERO HEADER -->
<section class="contact-hero">
    <div class="container">
        <h1 class="contact-title">Ada Pertanyaan atau Butuh Bantuan?</h1>
        <p class="contact-subtitle">
            Tim BookStore siap membantu kebutuhan buku, pemesanan khusus, konfirmasi pesanan, maupun pertanyaan seputar koleksi katalog kami.
        </p>
    </div>
</section>

<!-- 2. CONTACT CHANNELS & MESSAGE FORM -->
<section class="pb-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Left Column: Informasi Kontak -->
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h4 class="font-serif-book fw-bold text-dark mb-4">Saluran Komunikasi</h4>

                    <!-- Alamat Fisik -->
                    <div class="contact-item-group">
                        <div class="contact-item-label">Alamat Toko</div>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            Jl. Pustaka Ilmu No. 45, Kebayoran Baru, Jakarta Selatan, 12150
                        </p>
                    </div>

                    <!-- Layanan WhatsApp -->
                    <div class="contact-item-group">
                        <div class="contact-item-label">Layanan Cepat WhatsApp</div>
                        <div class="fw-bold text-dark mb-1">+62 851-7335-0405</div>
                        <div class="text-muted small mb-2" style="font-size: 0.78rem;">Respon Cepat di Jam Operasional</div>
                        <div>
                            <a href="https://wa.me/6285173350405?text=Halo%20Admin%20BookStore,%20saya%20ingin%20bertanya%20seputar%20buku..." target="_blank" class="btn-wa-direct">
                                <i class="bi bi-whatsapp"></i> Chat WhatsApp Sekarang
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-item-group">
                        <div class="contact-item-label">Email</div>
                        <div class="text-secondary small mb-0">
                            <div><strong class="text-dark">info@bookstore.com</strong> (Layanan Umum)</div>
                            <div><strong class="text-dark">support@bookstore.com</strong> (Bantuan Pesanan)</div>
                        </div>
                    </div>

                    <!-- Jam Buka -->
                    <div class="contact-item-group">
                        <div class="contact-item-label">Jam Operasional Toko</div>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            Senin – Sabtu: 08:00 – 17:00 WIB<br>
                            <span class="text-muted" style="font-size: 0.78rem;">Minggu &amp; Hari Libur Nasional: Tutup (Katalog Web Aktif 24 Jam)</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Formulir Kontak -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h4 class="font-serif-book fw-bold text-dark mb-2">Kirimkan Pesan Langsung</h4>
                    <p class="text-muted small mb-4">
                        Tuliskan pertanyaan atau kebutuhan Anda. Pesan akan langsung masuk ke kotak masuk tim Administrator BookStore.
                    </p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" placeholder="Contoh: Budi Santoso" style="border-radius: 8px; border-color: var(--border-medium); font-size: 0.92rem; padding: 0.65rem 1rem;" required>
                            @error('name')
                                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" placeholder="nama@email.com" style="border-radius: 8px; border-color: var(--border-medium); font-size: 0.92rem; padding: 0.65rem 1rem;" required>
                            @error('email')
                                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Subjek Pesan <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Contoh: Ketersediaan Stok Buku Sapiens" style="border-radius: 8px; border-color: var(--border-medium); font-size: 0.92rem; padding: 0.65rem 1rem;" required>
                            @error('subject')
                                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-dark">Isi Pesan <span class="text-danger">*</span></label>
                            <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Tuliskan pertanyaan, masukan, atau kebutuhan buku Anda secara rinci..." style="border-radius: 8px; border-color: var(--border-medium); font-size: 0.92rem; padding: 0.75rem 1rem;" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="text-danger small mt-1" style="font-size: 0.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-book-primary w-100 py-2" style="font-size: 0.92rem;">
                            Kirimkan Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. MINI FAQ SECTION -->
        <div class="pt-4 border-top" style="border-color: var(--border-subtle) !important;">
            <div class="text-center mb-4">
                <h3 class="font-serif-book fw-bold text-dark" style="font-size: 1.85rem;">Pertanyaan yang Sering Diajukan</h3>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="faq-card">
                        <div class="faq-question">Berapa lama estimasi pengiriman buku?</div>
                        <p class="faq-answer">
                            Pesanan diproses dalam 1x24 jam kerja. Untuk area Jabodetabek estimasi tiba 1–2 hari kerja, sedangkan luar kota 2–4 hari kerja menggunakan ekspedisi terpercaya.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-card">
                        <div class="faq-question">Apakah melayani pembayaran Bayar di Tempat (COD)?</div>
                        <p class="faq-answer">
                            Ya, kami melayani opsi Bayar di Tempat (COD / Cash on Delivery). Anda dapat melakukan pembayaran langsung secara aman saat kurir mengantarkan buku ke alamat Anda.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-card">
                        <div class="faq-question">Bisa memesan buku yang belum ada di katalog?</div>
                        <p class="faq-answer">
                            Tentu bisa. Silakan kirimkan judul buku dan nama penulis yang Anda cari melalui formulir pesan di atas atau hubungi kami langsung via WhatsApp.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
