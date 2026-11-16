@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="shadcn-card overflow-hidden">
            <div class="shadcn-card-header bg-white">
                <div>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark">Formulir Tambah Buku</h6>
                    <small class="text-muted">Masukkan rincian buku baru ke dalam katalog.</small>
                </div>
            </div>

            <div class="shadcn-card-body">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label small fw-semibold text-dark">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Pemrograman Web Modern" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
                            <div class="dropdown admin-custom-dropdown w-100">
                                @php
                                    $selectedCat = $categories->firstWhere('id', old('category_id'));
                                    $catText = $selectedCat ? $selectedCat->name : '-- Pilih Kategori --';
                                @endphp
                                <button class="btn btn-sm form-select text-start d-flex align-items-center justify-content-between w-100 @error('category_id') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="bookCatDropdownBtn">
                                    <span id="bookCatSelectedLabel" class="text-truncate">{{ $catText }}</span>
                                </button>
                                <ul class="dropdown-menu w-100 shadow-sm border mt-1" style="max-height: 250px; overflow-y: auto; border-radius: 10px; border-color: var(--border-color) !important;">
                                    <li>
                                        <button type="button" class="dropdown-item small py-2 d-flex align-items-center justify-content-between {{ !old('category_id') ? 'active' : '' }}" onclick="document.getElementById('category_id_input').value = ''; document.getElementById('bookCatSelectedLabel').textContent = '-- Pilih Kategori --'; this.closest('.dropdown').querySelectorAll('.dropdown-item').forEach(el => el.classList.remove('active')); this.classList.add('active');">
                                            <span>-- Pilih Kategori --</span>
                                            @if(!old('category_id'))
                                                <i class="bi bi-check2"></i>
                                            @endif
                                        </button>
                                    </li>
                                    @foreach($categories as $cat)
                                        <li>
                                            <button type="button" class="dropdown-item small py-2 d-flex align-items-center justify-content-between {{ old('category_id') == $cat->id ? 'active' : '' }}" onclick="document.getElementById('category_id_input').value = '{{ $cat->id }}'; document.getElementById('bookCatSelectedLabel').textContent = '{{ $cat->name }}'; this.closest('.dropdown').querySelectorAll('.dropdown-item').forEach(el => el.classList.remove('active')); this.classList.add('active');">
                                                <span class="text-truncate">{{ $cat->name }}</span>
                                                @if(old('category_id') == $cat->id)
                                                    <i class="bi bi-check2"></i>
                                                @endif
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="category_id" id="category_id_input" value="{{ old('category_id') }}" required>
                            </div>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Penulis / Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}" placeholder="Contoh: Robert C. Martin" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Penerbit</label>
                            <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}" placeholder="Contoh: Gramedia">
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">Rp</span>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="95000" min="0" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 10) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Sampul Buku (Cover Image)</label>
                        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                        <small class="text-muted d-block mt-1">Opsional: JPG, PNG, WEBP (Maks. 2MB). Jika dikosongkan, sampul default akan otomatis terpasang.</small>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-dark">Deskripsi / Sinopsis</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Tuliskan ringkasan isi buku...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-shadcn-outline">Batal</a>
                        <button type="submit" class="btn btn-shadcn-primary px-4">
                            Simpan Data Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
