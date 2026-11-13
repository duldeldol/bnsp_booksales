@extends('layouts.app')

@section('title', 'Katalog Buku - Koleksi Lengkap')

@push('styles')
<style>
    /* CATALOG HEADER */
    .catalog-header-haven {
        padding: 4rem 0 2rem 0;
        text-align: center;
    }

    .catalog-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 2.8rem;
        font-weight: 600;
        color: var(--color-ink);
        letter-spacing: -0.4px;
        margin-bottom: 0.5rem;
    }

    .catalog-subtitle {
        color: var(--text-muted);
        font-size: 1rem;
        max-width: 560px;
        line-height: 1.65;
        margin: 0 auto 1.5rem auto;
    }

    /* SEARCH BAR */
    .catalog-search-form {
        max-width: 580px;
        margin: 0 auto;
    }
    .catalog-search-input {
        background-color: #ffffff;
        border: 1px solid var(--border-medium);
        border-radius: 50px;
        padding: 0.75rem 2.85rem 0.75rem 2.85rem;
        font-size: 0.92rem;
        color: var(--text-main);
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(28, 25, 23, 0.04);
    }
    .catalog-search-input:focus {
        background-color: #ffffff;
        border-color: var(--color-amber);
        box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.12);
        outline: none;
    }
    .search-icon-inside {
        position: absolute;
        left: 1.15rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1rem;
        pointer-events: none;
    }
    .search-clear-btn {
        position: absolute;
        right: 1.15rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.1rem;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .search-clear-btn:hover {
        color: var(--color-ink);
    }

    /* CATEGORY PILLS */
    .cat-pills-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 6px;
        scrollbar-width: none;
    }
    @media (min-width: 992px) {
        .cat-pills-wrap {
            justify-content: center;
            flex-wrap: wrap;
        }
    }
    .cat-pills-wrap::-webkit-scrollbar {
        display: none;
    }

    .cat-pill-item {
        white-space: nowrap;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-muted);
        background-color: #ffffff;
        border: 1px solid var(--border-subtle);
        padding: 0.45rem 1.15rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .cat-pill-item:hover {
        background-color: #f7f3eb;
        color: var(--color-ink);
        border-color: var(--border-medium);
    }
    .cat-pill-item.active {
        background-color: var(--color-ink);
        color: #ffffff;
        border-color: var(--color-ink);
    }
</style>
@endpush

@section('content')

<!-- HEADER KATALOG -->
<section class="catalog-header-haven">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <h1 class="catalog-title">Katalog Koleksi Buku</h1>
                <p class="catalog-subtitle">
                    Temukan buku pilihan di berbagai bidang ilmu dari penulis dan penerbit terpercaya.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('catalog') }}" method="GET" class="catalog-search-form position-relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <i class="bi bi-search search-icon-inside"></i>
                    <input type="text" name="search" class="form-control catalog-search-input" placeholder="Cari judul buku, penulis, atau penerbit..." value="{{ request('search') }}">

                    @if(request('search'))
                        <a href="{{ route('catalog', request()->only('category')) }}" class="search-clear-btn" title="Hapus teks pencarian">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    @endif
                </form>

                @if(request('search'))
                    <div class="mt-3 text-center">
                        <span class="text-muted small" style="font-size: 0.82rem;">
                            Menampilkan hasil pencarian untuk "<strong>{{ request('search') }}</strong>"
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="pb-5">
    <div class="container">
        <!-- Filter Kategori -->
        <div class="cat-pills-wrap mb-4 pb-2">
            <a href="{{ route('catalog', request()->only('search')) }}" class="cat-pill-item {{ !request('category') ? 'active' : '' }}">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog', array_merge(request()->only('search'), ['category' => $cat->id])) }}" class="cat-pill-item {{ request('category') == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }} <span class="opacity-75 ms-1" style="font-size: 0.75rem;">({{ $cat->books_count }})</span>
                </a>
            @endforeach
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="row g-4">
                @foreach($books as $book)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="boutique-card">
                            <!-- Cover Image -->
                            <div class="boutique-cover-wrap" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $book->id }}">
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" loading="lazy">
                            </div>

                            <!-- Category & Title -->
                            <div class="boutique-tag">
                                {{ $book->category ? $book->category->name : 'Umum' }}
                            </div>
                            <h6 class="boutique-title" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $book->id }}" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h6>
                            <div class="boutique-author">
                                Penulis: {{ $book->author }}
                            </div>

                            <!-- Price & Action -->
                            <div class="boutique-bottom-row">
                                <span class="boutique-price">
                                    {{ $book->formatted_price }}
                                </span>
                                <div class="d-flex align-items-center" style="gap: 9px;">
                                    <button type="button" class="btn-boutique-action" data-bs-toggle="modal" data-bs-target="#modalBookDetail{{ $book->id }}">
                                        Detail
                                    </button>
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline form-add-to-cart m-0">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-book-primary p-0 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%;" title="Tambah 1 ke Keranjang" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                            <i class="bi bi-cart-plus" style="font-size: 0.95rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($books->total() > 0)
                <div class="mt-5 pt-4 border-top" style="border-color: var(--border-subtle) !important;">
                    <div class="row align-items-center w-100 g-0" style="margin: 0;">
                        <div class="col-12 col-md-4 text-center text-md-start p-0">
                            <span class="text-muted" style="font-size: 0.82rem; letter-spacing: 0.01em; line-height: 1.5;">
                                Menampilkan <strong class="text-dark">{{ $books->firstItem() ?? 0 }}</strong> – <strong class="text-dark">{{ $books->lastItem() ?? 0 }}</strong> dari <strong class="text-dark">{{ $books->total() }}</strong> buku
                            </span>
                        </div>

                        <div class="col-12 col-md-4 d-flex justify-content-center p-0 my-2 my-md-0">
                            @if($books->hasPages())
                                <nav aria-label="Navigasi Halaman Katalog">
                                    <ul class="pagination pagination-sm mb-0" style="gap: 4px;">
                                        {{-- Tombol Sebelumnya --}}
                                        @if ($books->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link rounded-2 px-3 py-1" style="font-size: 0.85rem;" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link rounded-2 px-3 py-1" href="{{ $books->previousPageUrl() }}" rel="prev" style="font-size: 0.85rem;" aria-label="Sebelumnya">&lsaquo;</a>
                                            </li>
                                        @endif

                                        {{-- Angka-angka Halaman --}}
                                        @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                            @if ($page == $books->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link rounded-2 px-3 py-1 fw-bold" style="font-size: 0.85rem;">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link rounded-2 px-3 py-1" href="{{ $url }}" style="font-size: 0.85rem;">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Tombol Selanjutnya --}}
                                        @if ($books->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link rounded-2 px-3 py-1" href="{{ $books->nextPageUrl() }}" rel="next" style="font-size: 0.85rem;" aria-label="Berikutnya">&rsaquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link rounded-2 px-3 py-1" style="font-size: 0.85rem;" aria-hidden="true">&rsaquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>

                        <div class="col-12 col-md-4 text-center text-md-end d-none d-md-block p-0">
                            @if($books->hasPages())
                                <span class="text-muted" style="font-size: 0.82rem; line-height: 1.5;">
                                    Halaman <strong class="text-dark">{{ $books->currentPage() }}</strong> dari <strong class="text-dark">{{ $books->lastPage() }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-5 my-4">
                <h4 class="font-serif-book fw-bold text-dark mb-2">Buku Tidak Ditemukan</h4>
                <p class="text-muted small mb-4">Tidak ada koleksi yang sesuai dengan kata kunci pencarian atau kategori yang Anda pilih.</p>
                <a href="{{ route('catalog') }}" class="btn btn-book-outline">
                    Kembali ke Seluruh Koleksi
                </a>
            </div>
        @endif
    </div>
</section>

@foreach($books as $mBook)
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
