@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Kotak Masuk Pesan Pelanggan')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
    <div>
        <h5 class="font-serif-book fw-bold mb-1 text-dark">Pesan Masuk (Contact Us)</h5>
        <p class="text-muted small mb-0">Kelola pertanyaan dan pesan yang dikirimkan oleh pengunjung melalui formulir kontak.</p>
    </div>
</div>

<!-- Search & Status Filter Card -->
<div class="shadcn-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Cari nama pengirim, email, subjek, atau isi pesan...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Status Pesan</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-shadcn-primary btn-sm w-100 d-inline-flex align-items-center justify-content-center">Cari
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center px-2.5" style="min-width: 38px;" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise" style="line-height: 1;"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="shadcn-card overflow-hidden">
    <div class="shadcn-card-header bg-white py-3">
        <span class="small font-monospace text-muted">Total: <strong>{{ $messages->total() }}</strong> item</span>
    </div>

    <div class="table-responsive">
        <table class="shadcn-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Pengirim</th>
                    <th>Subjek & Isi Pesan</th>
                    <th>Status</th>
                    <th>Waktu Masuk</th>
                    <th style="width: 140px;" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $index => $msg)
                    <tr class="{{ !$msg->is_read ? 'bg-light' : '' }}">
                        <td class="text-muted">{{ $messages->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $msg->name }}</div>
                            <small class="text-muted">{{ $msg->email }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $msg->subject }}</div>
                            <div class="text-muted small text-truncate" style="max-width: 420px;">{{ $msg->message }}</div>
                        </td>
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill" style="font-size: 0.7rem;">Belum Dibaca</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill" style="font-size: 0.7rem;">Sudah Dibaca</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center justify-content-end gap-2">
                                <form action="{{ route('admin.contacts.toggle', $msg->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 px-2.5 py-1" style="font-size: 0.75rem;" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                        <i class="bi {{ $msg->is_read ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                                        <span>{{ $msg->is_read ? 'Unread' : 'Read' }}</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center px-2 py-1" style="font-size: 0.75rem;" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted small">
                            <div>Belum ada pesan masuk yang sesuai kriteria pencarian.</div>
                            @if(request('search') || request('status'))
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="p-3 border-top">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
