@extends('layouts.admin')

@section('title', 'Data Buku')
@section('page-title', 'Katalog Data Buku')

@section('content')
<!-- Header Bar -->
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
    <div>
        <h5 class="font-serif-book fw-bold mb-1 text-dark">Daftar Buku</h5>
        <p class="text-muted small mb-0">Kelola katalog produk, stok ketersediaan, dan harga buku.</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-shadcn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
    </a>
</div>

<!-- Search & Filter Card -->
<div class="shadcn-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.books.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Cari judul buku, penulis, atau penerbit...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-shadcn-primary btn-sm w-100 d-inline-flex align-items-center justify-content-center">Cari
                </button>
                @if(request('search') || request('category_id') || request('author') || request('filter'))
                    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center px-2.5" style="min-width: 38px;" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise" style="line-height: 1;"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Data Table Card -->
<div class="shadcn-card overflow-hidden">
    <div class="shadcn-card-header bg-white py-3">
        <span class="small font-monospace text-muted">Total: <strong>{{ $books->total() }}</strong> item</span>
    </div>

    <div class="table-responsive">
        <table class="shadcn-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 70px;">Sampul</th>
                    <th>Judul & Penulis</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th style="width: 130px;" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $index => $book)
                    <tr>
                        <td class="text-muted">{{ $books->firstItem() + $index }}</td>
                        <td>
                            <img src="{{ $book->cover_url }}" alt="Cover" class="rounded border shadow-xs" style="width: 38px; height: 52px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="font-serif-book fw-bold text-dark fs-6">{{ $book->title }}</div>
                            <div class="text-muted small">Penulis: {{ $book->author }} @if($book->publisher) • Penerbit: {{ $book->publisher }} @endif</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border fw-normal">
                                {{ $book->category ? $book->category->name : 'Umum' }}
                            </span>
                        </td>
                        <td class="fw-semibold text-dark">{{ $book->formatted_price }}</td>
                        <td>
                            @if($book->stock > 5)
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                    {{ $book->stock }} pcs
                                </span>
                            @elseif($book->stock > 0)
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill">
                                    Sisa {{ $book->stock }} pcs
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">
                                    Habis
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-light border py-1 px-2 me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-light border text-danger py-1 px-2" data-bs-toggle="modal" data-bs-target="#deleteBook{{ $book->id }}" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade text-start" id="deleteBook{{ $book->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header border-0 pb-0">
                                                <h6 class="modal-title fw-bold text-dark">Hapus Data Buku</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <p class="text-secondary small mb-1">Apakah Anda yakin ingin menghapus buku berikut?</p>
                                                <div class="fw-semibold text-dark">"{{ $book->title }}"</div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-sm btn-shadcn-outline" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-danger rounded-2">Hapus Buku</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted small">
                            <div>Belum ada data buku yang sesuai kriteria pencarian.</div>
                            @if(request('search') || request('category_id') || request('author') || request('filter'))
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($books->hasPages())
        <div class="p-3 border-top">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
