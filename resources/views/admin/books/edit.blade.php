@extends('layouts.admin')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Data Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="shadcn-card overflow-hidden">
            <div class="shadcn-card-header bg-white">
                <div>
                    <h6 class="font-serif-book fw-bold mb-0 text-dark">Edit Data Buku</h6>
                    <small class="text-muted">Perbarui rincian informasi buku katalog.</small>
                </div>
            </div>

            <div class="shadcn-card-body">
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label small fw-semibold text-dark">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Penulis / Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $book->author) }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Penerbit</label>
                            <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher', $book->publisher) }}">
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
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $book->price) }}" min="0" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold text-dark">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $book->stock) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Sampul Buku Saat Ini</label>
                        <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-2 border">
                            <img src="{{ $book->cover_url }}" alt="Cover" class="rounded border shadow-xs" style="width: 40px; height: 56px; object-fit: cover;">
                            <span class="small text-muted">Abaikan unggahan sampul di bawah jika tidak ingin mengganti cover yang ada.</span>
                        </div>
                        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                        <small class="text-muted d-block mt-1">Pilih file baru jika ingin memperbarui cover.</small>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-dark">Deskripsi / Sinopsis</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-shadcn-outline">Batal</a>
                        <button type="submit" class="btn btn-shadcn-primary px-4">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
