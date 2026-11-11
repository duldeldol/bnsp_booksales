@extends('layouts.admin')

@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
    <div>
        <h5 class="font-serif-book fw-bold mb-1 text-dark">Klasifikasi Kategori</h5>
        <p class="text-muted small mb-0">Kelola kategori untuk mempermudah pencarian dan filter buku pelanggan.</p>
    </div>
    <button type="button" class="btn btn-shadcn-primary" data-bs-toggle="modal" data-bs-target="#modalAddCategory">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </button>
</div>

<!-- Search & Filter Card -->
<div class="shadcn-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Cari nama kategori atau kata kunci deskripsi...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="has_books" {{ request('filter') == 'has_books' ? 'selected' : '' }}>Ada Koleksi Buku</option>
                    <option value="empty" {{ request('filter') == 'empty' ? 'selected' : '' }}>Kategori Kosong (0 Buku)</option>
                    <option value="most_books" {{ request('filter') == 'most_books' ? 'selected' : '' }}>Koleksi Terbanyak</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-shadcn-primary btn-sm w-100 d-inline-flex align-items-center justify-content-center">Cari
                </button>
                @if(request('search') || request('filter'))
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center px-2.5" style="min-width: 38px;" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise" style="line-height: 1;"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="shadcn-card overflow-hidden">
    <div class="shadcn-card-header bg-white py-3">
        <span class="small font-monospace text-muted">Total: <strong>{{ $categories->total() }}</strong> item</span>
    </div>

    <div class="table-responsive">
        <table class="shadcn-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Total Koleksi Buku</th>
                    <th style="width: 120px;" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $cat)
                    <tr>
                        <td class="text-muted">{{ $categories->firstItem() + $index }}</td>
                        <td class="fw-semibold text-dark">{{ $cat->name }}</td>
                        <td class="text-muted small">{{ $cat->description ?: '-' }}</td>
                        <td>
                            <span class="badge bg-light text-secondary border fw-normal">
                                {{ $cat->books_count }} Judul Buku
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-light border py-1 px-2 me-1"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditCategory{{ $cat->id }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-light border text-danger py-1 px-2"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDeleteCategory{{ $cat->id }}" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>

                            <!-- Modal Edit -->
                            <div class="modal fade text-start" id="modalEditCategory{{ $cat->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                                        <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0 pb-0">
                                                <h6 class="modal-title fw-bold text-dark">Edit Kategori</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label small fw-semibold">Deskripsi</label>
                                                    <textarea name="description" rows="3" class="form-control">{{ $cat->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-sm btn-shadcn-outline" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-shadcn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete Confirmation -->
                            <div class="modal fade text-start" id="modalDeleteCategory{{ $cat->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header border-0 pb-0">
                                                <h6 class="modal-title fw-bold text-danger">Hapus Kategori</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <p class="mb-1 text-secondary small">Apakah Anda yakin ingin menghapus kategori <strong>{{ $cat->name }}</strong>?</p>
                                                @if($cat->books_count > 0)
                                                    <div class="alert alert-warning small mt-2 mb-0 py-2">
                                                        <i class="bi bi-info-circle me-1"></i> Kategori ini memuat {{ $cat->books_count }} buku. Pindahkan atau hapus buku terlebih dahulu.
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-sm btn-shadcn-outline" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-danger rounded-2" {{ $cat->books_count > 0 ? 'disabled' : '' }}>Hapus Kategori</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted small">
                            <div>Belum ada kategori buku yang sesuai kriteria pencarian.</div>
                            @if(request('search') || request('filter'))
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($categories->hasPages())
        <div class="p-3 border-top">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalAddCategory" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold text-dark">Tambah Kategori Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Pemrograman Web" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Deskripsi</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Deskripsi singkat mengenai jenis buku"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-shadcn-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-shadcn-primary">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
