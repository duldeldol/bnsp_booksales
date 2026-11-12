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
                    <th class="text-center" style="width: 50px;">No</th>
                    <th class="text-center" style="width: 70px;">Sampul</th>
                    <th>Judul & Penulis</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $index => $book)
                    <tr>
                        <td class="text-center text-muted">{{ $books->firstItem() + $index }}</td>
                        <td class="text-center">
                            <img src="{{ $book->cover_url }}" alt="Cover" class="rounded border shadow-xs" style="width: 38px; height: 52px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="font-serif-book fw-bold text-dark fs-6">{{ $book->title }}</div>
                            <div class="text-muted small">Penulis: {{ $book->author }} @if($book->publisher) | Penerbit: {{ $book->publisher }} @endif</div>
                        </td>
                        <td class="text-center text-nowrap">
                            <span class="badge-editorial badge-editorial-stone">
                                {{ $book->category ? $book->category->name : 'Umum' }}
                            </span>
                        </td>
                        <td class="text-center fw-semibold text-dark text-nowrap">{{ $book->formatted_price }}</td>
                        <td class="text-center text-nowrap">
                            @if($book->stock > 5)
                                <span class="badge-editorial badge-editorial-emerald">
                                    {{ $book->stock }} pcs
                                </span>
                            @elseif($book->stock > 0)
                                <span class="badge-editorial badge-editorial-amber">
                                    Sisa {{ $book->stock }} pcs
                                </span>
                            @else
                                <span class="badge-editorial badge-editorial-rose">
                                    Habis
                                </span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap" style="width: 100px;">
                            <div class="d-inline-flex align-items-center gap-1 justify-content-center">
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-light border py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-light border text-danger py-1 px-2" data-bs-toggle="modal" data-bs-target="#deleteBook{{ $book->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade text-start" id="deleteBook{{ $book->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h6 class="modal-title text-danger">Hapus Data Buku</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-secondary small mb-2">Apakah Anda yakin ingin menghapus buku berikut dari katalog?</p>
                                                <div class="p-2 rounded-2 bg-light border fw-semibold text-dark small">
                                                    "{{ $book->title }}" <span class="text-muted fw-normal">oleh {{ $book->author }}</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
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
            {{ $books->links('admin.pagination') }}
        </div>
    @endif
</div>
@endsection
