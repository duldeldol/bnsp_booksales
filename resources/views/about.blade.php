@extends('layouts.app')

@section('title', 'Tentang Kami - BookStore')

@push('styles')
<style>
    .about-hero {
        padding: 4.5rem 0 3rem 0;
        text-align: center;
    }
    .about-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 3rem;
        font-weight: 600;
        color: var(--color-ink);
        letter-spacing: -0.5px;
        line-height: 1.18;
        max-width: 720px;
        margin: 0 auto 1.25rem auto;
    }
    .about-subtitle {
        color: var(--text-muted);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 600px;
        margin: 0 auto;
    }

    /* STORY CARD */
    .about-story-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 4px 18px rgba(28, 25, 23, 0.03);
        margin-bottom: 3.5rem;
    }
    .about-quote {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.45rem;
        font-style: italic;
        color: var(--color-ink);
        line-height: 1.5;
        border-left: 3px solid var(--color-amber);
        padding-left: 1.5rem;
        margin-bottom: 2rem;
    }

    /* VALUE PILLARS */
    .value-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        padding: 2rem 1.75rem;
        height: 100%;
        transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .value-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 26px -6px rgba(28, 25, 23, 0.07);
        border-color: var(--border-medium);
    }
    .value-num {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--color-amber);
        margin-bottom: 0.75rem;
    }
    .value-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--color-ink);
        margin-bottom: 0.65rem;
    }
    .value-desc {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.65;
        margin-bottom: 0;
    }

    .store-stats-strip {
        background-color: #f5efe6;
        border: 1px solid var(--border-subtle);
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        margin-bottom: 3.5rem;
    }
    .stat-number {
        font-family: 'Lora', Georgia, serif;
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--color-ink);
        line-height: 1;
        margin-bottom: 0.35rem;
    }
    .stat-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    @media (max-width: 767.98px) {
        .about-title { font-size: 2.2rem; }
        .about-story-card { padding: 1.75rem; }
        .about-quote { font-size: 1.2rem; padding-left: 1rem; }
    }
</style>
@endpush

@section('content')

<!-- 1. HERO HEADER -->
<section class="about-hero">
    <div class="container">
        <h1 class="about-title">Menghidupkan Budaya Membaca yang Bermakna</h1>
        <p class="about-subtitle">
            BookStore hadir sebagai ruang temu literasi yang mengurasi karya-karya pemikiran terbaik, menghubungkan pembaca dengan karya literatur, teknologi, dan keilmuan bermutu.
        </p>
    </div>
</section>

<!-- 2. STORY NARRATIVE & PHILOSOPHY -->
<section class="pb-5">
    <div class="container">
        <div class="about-story-card">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-quote">
                        &ldquo;Sebuah buku adalah lentera yang menembus batas waktu, menghubungkan gagasan terdalam penulis dengan rasa ingin tahu pembaca.&rdquo;
                    </div>
                    <p class="text-secondary small mb-0" style="line-height: 1.8;">
                        Di era serbuan informasi digital yang serba cepat dan instan, kami percaya bahwa kedalaman berpikir hanya dapat diraih melalui perenungan yang tenang. Membuka lembaran buku fisik menghadirkan pengalaman tak tergantikan yang memperlambat waktu dan memperkaya batin.
                    </p>
                </div>
                <div class="col-lg-6">
                    <h4 class="font-serif-book fw-bold text-dark mb-3">Filosofi BookStore</h4>
                    <p class="text-secondary small mb-3" style="line-height: 1.8;">
                        Didirikan di Jakarta Selatan, <strong>BookStore</strong> bermula dari sebuah gagasan sederhana: membangun toko buku kurasi yang hanya menyediakan bacaan bernilai tinggi tanpa kebisingan judul-judul sensasional yang dangkal.
                    </p>
                    <p class="text-secondary small mb-0" style="line-height: 1.8;">
                        Setiap judul di etalase kami diseleksi secara cermat dari berbagai penerbit terkemuka, mencakup bidang rekayasa perangkat lunak, arsitektur sistem, literasi finansial, psikologi terapan, hingga sastra abadi peradaban.
                    </p>
                </div>
            </div>
        </div>

        <!-- 3. THREE CORE VALUES -->
        <div class="text-center mb-4">
            <h2 class="font-serif-book fw-bold text-dark" style="font-size: 2rem;">Komitmen untuk Pembaca</h2>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-num">01</div>
                    <h5 class="value-title">Kurasi Pustaka Terpilih</h5>
                    <p class="value-desc">
                        Kami tidak sekadar menumpuk ribuan judul. Setiap buku melalui proses seleksi ketat untuk memastikan relevansi pemikiran dan manfaat nyata bagi pembaca.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-num">02</div>
                    <h5 class="value-title">100% Karya Asli &amp; Terjamin</h5>
                    <p class="value-desc">
                        Seluruh koleksi bersumber langsung dari penerbit resmi dengan jaminan mutu cetakan orisinal, keaslian kertas, serta standar penjilidan terbaik.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-num">03</div>
                    <h5 class="value-title">Pengalaman Membaca Tenang</h5>
                    <p class="value-desc">
                        Antarmuka yang bersih, bernuansa kertas linen hangat, dan bebas dari distraksi iklan mengganggu agar Anda dapat menjelajahi pustaka dengan nyaman.
                    </p>
                </div>
            </div>
        </div>

        <!-- 4. STATS STRIP -->
        <div class="store-stats-strip">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Buku Orisinal</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">Kategori Pilihan</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">24 Jam</div>
                    <div class="stat-label">Akses Katalog</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">Jakarta</div>
                    <div class="stat-label">Pusat Distribusi</div>
                </div>
            </div>
        </div>

        <!-- 5. CALL TO ACTION -->
        <div class="text-center py-4">
            <h3 class="font-serif-book fw-bold text-dark mb-3">Siap Menemukan Bacaan Terbaik Anda?</h3>
            <p class="text-muted small mb-4" style="max-width: 440px; margin: 0 auto;">
                Koleksi buku terpilih kami siap menemani proses belajar dan bertumbuh Anda setiap hari.
            </p>
            <a href="{{ route('catalog') }}" class="btn btn-book-primary px-4 py-2">
                Jelajahi Katalog Buku
            </a>
        </div>
    </div>
</section>

@endsection
