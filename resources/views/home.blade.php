@extends('layouts.app')

@section('title', 'Beranda - Toko Buku & Pustaka')

@push('styles')
<style>
    /* HERO SECTION */
    .hero-haven-section {
        padding: 5rem 0 5.5rem 0;
    }

    .hero-headline {
        font-family: 'Lora', Georgia, serif;
        font-size: 3.5rem;
        font-weight: 600;
        line-height: 1.15;
        color: var(--color-ink);
        letter-spacing: -0.5px;
        margin-bottom: 1.25rem;
    }

    .hero-description {
        font-size: 1rem;
        color: var(--text-muted);
        line-height: 1.75;
        max-width: 460px;
        margin-bottom: 2.25rem;
    }

    .btn-haven-explore {
        background-color: var(--color-amber);
        color: #ffffff !important;
        font-size: 0.92rem;
        font-weight: 600;
        padding: 0.85rem 2.2rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(180, 83, 9, 0.22);
        transition: all 0.2s ease;
    }
    .btn-haven-explore:hover {
        background-color: var(--color-amber-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(180, 83, 9, 0.32);
    }

    /* HERO ARCH DISPLAY & SLIDER */
    .hero-arch-carousel-container {
        position: relative;
        width: 100%;
        max-width: 520px;
        margin: 0 auto;
    }

    .haven-arches-cluster {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 1.75rem;
        max-width: 520px;
        margin: 0 auto;
    }

    .haven-arch-niche {
        flex: 1;
        max-width: 155px;
        background-color: #ede6d8;
        border-top-left-radius: 999px;
        border-top-right-radius: 999px;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.25rem 0.5rem;
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
    }
    .haven-arch-niche:hover {
        background-color: #e5ddcd;
        transform: translateY(-5px);
    }

    .haven-arch-niche.niche-side {
        height: 250px;
    }

    .haven-arch-niche.niche-center {
        height: 285px;
        background-color: #e5decb;
    }

    .haven-arch-book-img {
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 18px 30px -4px rgba(35, 30, 20, 0.25), 0 8px 12px -3px rgba(35, 30, 20, 0.12);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
    }
    .haven-arch-niche.niche-side .haven-arch-book-img {
        width: 96px;
        height: 144px;
    }
    .haven-arch-niche.niche-center .haven-arch-book-img {
        width: 118px;
        height: 176px;
    }
    .haven-arch-niche:hover .haven-arch-book-img {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 24px 38px -4px rgba(35, 30, 20, 0.32);
    }

    /* SECTION HEADERS */
    .haven-section-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 2.25rem;
    }

    .haven-section-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--color-ink);
        letter-spacing: -0.3px;
        margin-bottom: 0;
    }

    .haven-section-link {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .haven-section-link:hover {
        color: var(--color-amber);
    }

    /* CATEGORY CARD */
    .haven-cat-pill-card {
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        padding: 1.25rem 1rem;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        height: 100%;
        min-height: 112px;
        transition: all 0.2s ease;
    }
    .haven-cat-pill-card:hover {
        background-color: #fcf9f5;
        border-color: var(--border-medium);
        transform: translateY(-3px);
        box-shadow: 0 8px 18px -4px rgba(28, 25, 23, 0.05);
    }
    .haven-cat-name {
        font-family: 'Lora', Georgia, serif;
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--color-ink);
        line-height: 1.3;
        margin-bottom: 0.35rem;
        height: 2.6em;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .haven-cat-count {
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    @media (max-width: 991.98px) {
        .hero-headline { font-size: 2.6rem; }
        .hero-haven-section { padding: 2rem 0 2.5rem 0; }

        /* Mobile 3D Spotlight Arch Slider */
        .hero-arch-carousel-container {
            max-width: 380px;
            margin: 0 auto;
            overflow: visible;
        }
        .haven-arches-cluster {
            position: relative;
            height: 255px;
            margin: 0 auto 1.5rem auto;
            display: block;
        }
        .hero-arch-slide {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 168px;
            max-width: 168px;
            height: 245px;
            padding: 1.15rem 0.6rem;
            margin: 0;
            border-top-left-radius: 999px;
            border-top-right-radius: 999px;
            border-bottom-left-radius: 14px;
            border-bottom-right-radius: 14px;
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                        opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                        box-shadow 0.45s ease,
                        background-color 0.45s ease;
            transform-origin: center center;
            box-sizing: border-box;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Slide Positions: Active (Center), Prev (Left peek), Next (Right peek) */
        .hero-arch-slide.slide-center {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            z-index: 5;
            background-color: #e5decb;
            box-shadow: 0 22px 38px -4px rgba(28, 25, 23, 0.3), 0 8px 16px rgba(0, 0, 0, 0.1);
            pointer-events: auto;
        }
        .hero-arch-slide.slide-center .haven-arch-book-img {
            width: 126px;
            height: 188px;
            box-shadow: 0 20px 32px -4px rgba(35, 30, 20, 0.38);
        }

        .hero-arch-slide.slide-prev {
            transform: translate(-138%, -50%) scale(0.68);
            opacity: 0.38;
            z-index: 2;
            background-color: #ede6d8;
            pointer-events: auto;
        }
        .hero-arch-slide.slide-prev .haven-arch-book-img {
            width: 110px;
            height: 164px;
        }

        .hero-arch-slide.slide-next {
            transform: translate(38%, -50%) scale(0.68);
            opacity: 0.38;
            z-index: 2;
            background-color: #ede6d8;
            pointer-events: auto;
        }
        .hero-arch-slide.slide-next .haven-arch-book-img {
            width: 110px;
            height: 164px;
        }
    }

    @media (max-width: 575.98px) {
        .hero-headline { font-size: 1.95rem; line-height: 1.2; margin-bottom: 0.65rem; }
        .hero-description { font-size: 0.86rem; line-height: 1.55; margin-bottom: 1.15rem; }
        .hero-haven-section { padding: 1.25rem 0 1.75rem 0; }
        .haven-arches-cluster { height: 245px; margin-bottom: 1.25rem; }
        .hero-arch-slide { width: 160px; max-width: 160px; height: 235px; }
        .hero-arch-slide.slide-center .haven-arch-book-img { width: 120px; height: 178px; }
        .hero-arch-slide.slide-prev { transform: translate(-136%, -50%) scale(0.66); opacity: 0.35; }
        .hero-arch-slide.slide-next { transform: translate(36%, -50%) scale(0.66); opacity: 0.35; }
        .haven-section-title { font-size: 1.35rem; }
        .haven-section-head { margin-bottom: 1.15rem; }
    }
</style>
@endpush

@section('content')

<!-- 1. HERO SECTION -->
<section class="hero-haven-section">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6 order-2 order-lg-1">
                <h1 class="hero-headline">
                    Temukan Bacaan<br>Terbaik Anda
                </h1>
                <p class="hero-description">
                    Jelajahi karya-karya pilihan yang menginspirasi pikiran dan memperluas wawasan Anda. Setiap buku dikurasi dengan cermat untuk pembaca dan pembelajar sejati.
                </p>
                <div>
                    <a href="{{ route('catalog') }}" class="btn-haven-explore">
                        Jelajahi Katalog
                    </a>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2">
                <div class="hero-arch-carousel-container" id="heroArchCarousel">
                    <div class="haven-arches-cluster">
                        @foreach($heroBooks as $index => $hBook)
                            <div class="hero-arch-slide haven-arch-niche {{ $index === 1 ? 'slide-center niche-center' : ($index === 0 ? 'slide-prev niche-side' : 'slide-next niche-side') }}"
                                 data-slide-index="{{ $index }}"
                                 data-bs-toggle="modal"
                                 data-bs-target="#modalBookDetail{{ $hBook->id }}"
                                 title="{{ $hBook->title }}">
                                <img src="{{ $hBook->cover_url }}" alt="{{ $hBook->title }}" class="haven-arch-book-img" loading="eager">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. SECTION: REKOMENDASI PILIHAN -->
<section class="py-5">
    <div class="container">
        <div class="haven-section-head">
            <h2 class="haven-section-title">Rekomendasi Untuk Anda</h2>
            <a href="{{ route('catalog') }}" class="haven-section-link">
                Lihat Semua
            </a>
        </div>

        <div class="row g-4">
            @foreach($recommendedBooks as $rBook)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="boutique-card">
                        <!-- Book Cover -->
                        <div class="boutique-cover-wrap" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $rBook->id }}">
                            <img src="{{ $rBook->cover_url }}" alt="{{ $rBook->title }}" loading="lazy">
                        </div>

                        <!-- Category & Title -->
                        <div class="boutique-tag">
                            {{ $rBook->category ? $rBook->category->name : 'Umum' }}
                        </div>
                        <h6 class="boutique-title" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $rBook->id }}" title="{{ $rBook->title }}">
                            {{ $rBook->title }}
                        </h6>
                        <div class="boutique-author">
                            Penulis: {{ $rBook->author }}
                        </div>

                        <!-- Price & Action -->
                        <div class="boutique-bottom-row">
                            <span class="boutique-price">
                                {{ $rBook->formatted_price }}
                            </span>
                            <div class="boutique-actions d-flex align-items-center" style="gap: 8px;">
                                <button type="button" class="btn-boutique-action" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $rBook->id }}">
                                    Detail
                                </button>
                                <form action="{{ route('cart.add', $rBook->id) }}" method="POST" class="d-inline form-add-to-cart m-0">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-book-primary p-0 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%;" title="Tambah 1 ke Keranjang" {{ $rBook->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus" style="font-size: 0.95rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. SECTION: KATEGORI PILIHAN -->
<section class="py-5">
    <div class="container">
        <div class="haven-section-head">
            <h2 class="haven-section-title">Kategori Pilihan</h2>
            <a href="{{ route('catalog') }}" class="haven-section-link">
                Semua Kategori
            </a>
        </div>

        <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
            @foreach($categories as $cat)
                <div class="col d-flex">
                    <a href="{{ route('catalog', ['category' => $cat->id]) }}" class="haven-cat-pill-card w-100">
                        <div class="haven-cat-name">{{ $cat->name }}</div>
                        <div class="haven-cat-count">{{ $cat->books_count }} Koleksi Buku</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@php
    $allModalBooks = $heroBooks->merge($recommendedBooks)->unique('id');
@endphp
@foreach($allModalBooks as $mBook)
    <div class="modal fade" id="modalBookDetail{{ $mBook->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-serif-book">Detail Informasi Buku</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4 text-center">
                            <div class="rounded-3 overflow-hidden mx-auto" style="max-width: 200px; box-shadow: 0 12px 24px -4px rgba(28, 25, 23, 0.2);">
                                <img src="{{ $mBook->cover_url }}" alt="{{ $mBook->title }}" class="img-fluid w-100" style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="boutique-tag mb-1">
                                {{ $mBook->category ? $mBook->category->name : 'Umum' }}
                            </div>
                            <h4 class="font-serif-book fw-bold text-dark mb-2">{{ $mBook->title }}</h4>
                            <div class="text-muted small mb-3">
                                Penulis: <strong class="text-dark">{{ $mBook->author }}</strong> <span class="mx-2 text-muted opacity-50">|</span>
                                Penerbit: <strong class="text-dark">{{ $mBook->publisher ?? 'Penerbit Pustaka' }}</strong>
                            </div>

                            <div class="fs-4 fw-bold text-dark mb-3">
                                {{ $mBook->formatted_price }}
                            </div>

                            <div class="mb-3">
                                <h6 class="small fw-bold text-uppercase text-muted" style="letter-spacing: 0.06em; font-size: 0.75rem;">Sinopsis:</h6>
                                <p class="small text-secondary mb-0" style="line-height: 1.7;">
                                    {{ $mBook->description ?? 'Buku pilihan terkurasi untuk memperluas cakrawala pengetahuan Anda.' }}
                                </p>
                            </div>

                            <div class="pt-2 border-top text-muted small" style="border-color: var(--border-subtle) !important;">
                                Ketersediaan: <strong class="text-dark">{{ $mBook->stock }} eksemplar</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('cart.add', $mBook->id) }}" method="POST" class="w-100 form-add-to-cart m-0">
                        @csrf
                        <div class="d-flex align-items-center justify-content-end gap-2 w-100">
                            <button type="button" class="btn btn-book-outline" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-book-primary" {{ $mBook->stock <= 0 ? 'disabled' : '' }}>
                                <i class="bi bi-cart-plus me-1"></i> Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('heroArchCarousel');
    if (!container) return;

    const slides = container.querySelectorAll('.hero-arch-slide');
    const totalSlides = slides.length;
    if (totalSlides < 2) return;

    let currentHeroIndex = 1;
    let autoSlideTimer = null;
    const SLIDE_INTERVAL = 5000;

    function updateCarousel(newIndex) {
        currentHeroIndex = (newIndex + totalSlides) % totalSlides;
        const prevIndex = (currentHeroIndex - 1 + totalSlides) % totalSlides;
        const nextIndex = (currentHeroIndex + 1) % totalSlides;

        slides.forEach(function (slide, idx) {
            slide.classList.remove('slide-center', 'slide-prev', 'slide-next', 'niche-center', 'niche-side');
            if (idx === currentHeroIndex) {
                slide.classList.add('slide-center', 'niche-center');
            } else if (idx === prevIndex) {
                slide.classList.add('slide-prev', 'niche-side');
            } else if (idx === nextIndex) {
                slide.classList.add('slide-next', 'niche-side');
            } else {
                slide.classList.add('niche-side');
            }
        });
    }

    window.goToHeroSlide = function (index) {
        updateCarousel(index);
        restartTimer();
    };

    window.nextHeroSlide = function () {
        updateCarousel(currentHeroIndex + 1);
        restartTimer();
    };

    window.prevHeroSlide = function () {
        updateCarousel(currentHeroIndex - 1);
        restartTimer();
    };

    function startTimer() {
        if (autoSlideTimer) clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(function () {
            if (window.innerWidth < 992) {
                nextHeroSlide();
            }
        }, SLIDE_INTERVAL);
    }

    function stopTimer() {
        if (autoSlideTimer) {
            clearInterval(autoSlideTimer);
            autoSlideTimer = null;
        }
    }

    function restartTimer() {
        stopTimer();
        startTimer();
    }

    // Touch Swipe Support
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartTime = 0;

    container.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartTime = Date.now();
        stopTimer();
    }, { passive: true });

    container.addEventListener('touchend', function (e) {
        touchEndX = e.changedTouches[0].screenX;
        const diffX = touchEndX - touchStartX;
        const duration = Date.now() - touchStartTime;

        if (Math.abs(diffX) > 35 && duration < 600) {
            if (diffX < 0) {
                nextHeroSlide();
            } else {
                prevHeroSlide();
            }
        }
        startTimer();
    }, { passive: true });

    container.addEventListener('mouseenter', stopTimer);
    container.addEventListener('mouseleave', startTimer);

    slides.forEach(function (slide) {
        slide.addEventListener('click', function (e) {
            if (window.innerWidth < 992) {
                const sIdx = parseInt(this.getAttribute('data-slide-index'));
                if (sIdx !== currentHeroIndex) {
                    e.preventDefault();
                    e.stopPropagation();
                    goToHeroSlide(sIdx);
                }
            }
        }, true);
    });

    updateCarousel(currentHeroIndex);
    startTimer();
});
</script>
@endpush
