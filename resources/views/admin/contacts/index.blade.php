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
                    <th class="text-center" style="width: 50px;">No</th>
                    <th style="width: 220px;">Pengirim</th>
                    <th>Subjek & Isi Pesan</th>
                    <th class="text-center text-nowrap" style="width: 130px;">Status</th>
                    <th class="text-center text-nowrap" style="width: 170px;">Waktu Masuk</th>
                    <th class="text-center text-nowrap" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $index => $msg)
                    <tr id="contact-row-{{ $msg->id }}" class="{{ !$msg->is_read ? 'bg-light' : '' }}">
                        <td class="text-center text-muted">{{ $messages->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $msg->name }}</div>
                            <small class="text-muted">{{ $msg->email }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $msg->subject }}</div>
                            <div class="text-muted small text-truncate" style="max-width: 420px;">{{ $msg->message }}</div>
                        </td>
                        <td id="contact-status-cell-{{ $msg->id }}" class="text-center text-nowrap">
                            @if(!$msg->is_read)
                                <span class="badge-editorial badge-editorial-rose" id="contact-status-badge-{{ $msg->id }}">Belum Dibaca</span>
                            @else
                                <span class="badge-editorial badge-editorial-stone" id="contact-status-badge-{{ $msg->id }}">Sudah Dibaca</span>
                            @endif
                        </td>
                        <td class="text-center text-muted small text-nowrap">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-center text-nowrap" style="width: 100px;">
                            <div class="d-inline-flex align-items-center gap-1 justify-content-center">
                                <button type="button" class="btn btn-sm btn-light border py-1 px-2" data-bs-toggle="modal" data-bs-target="#viewContactModal{{ $msg->id }}" title="Baca Pesan">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light border text-danger py-1 px-2" data-bs-toggle="modal" data-bs-target="#deleteContactModal{{ $msg->id }}" title="Hapus Pesan">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Modal Detail & Baca Pesan Lengkap -->
                            <div class="modal fade text-start" id="viewContactModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
                                    <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: 1px solid #e8e2d5; box-shadow: 0 20px 25px -5px rgba(28, 25, 23, 0.12);">
                                        <div class="modal-header d-flex align-items-center justify-content-between" style="padding: 1.25rem 1.5rem; background-color: #fbf9f5; border-bottom: 1px solid #e8e2d5;">
                                            <div class="d-flex align-items-center" style="gap: 12px;">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center shrink-0" style="width: 40px; height: 40px; font-size: 1.15rem; background-color: #fef3c7; color: #b45309;">
                                                    <i class="bi bi-envelope-open"></i>
                                                </div>
                                                <div>
                                                    <h6 class="font-serif-book fw-bold text-dark mb-0 fs-5">Detail Pesan Pelanggan</h6>
                                                    <small class="text-muted" style="font-size: 0.75rem;">Diterima pada {{ $msg->created_at->format('d M Y, H:i') }} WIB</small>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>

                                        <div class="modal-body" style="padding: 1.5rem;">
                                            <!-- Sender Information Box -->
                                            <div class="p-3 rounded-3 mb-3" style="background-color: #faf7f2; border: 1px solid #e8e2d5;">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-6">
                                                        <span class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.06em; margin-bottom: 2px;">Nama Pengirim</span>
                                                        <span class="fw-bold text-dark d-block text-truncate" style="font-size: 0.88rem;">{{ $msg->name }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.06em; margin-bottom: 2px;">Alamat Email</span>
                                                        <a href="mailto:{{ $msg->email }}" class="text-decoration-none text-dark fw-medium text-break d-block text-truncate" style="font-size: 0.85rem;" title="{{ $msg->email }}">{{ $msg->email }}</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Subject -->
                                            <div class="mb-3">
                                                <span class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.06em; margin-bottom: 4px;">Subjek Pesan</span>
                                                <div class="font-serif-book fw-bold text-dark fs-6" style="line-height: 1.4;">{{ $msg->subject }}</div>
                                            </div>

                                            <!-- Message Body -->
                                            <div>
                                                <span class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.06em; margin-bottom: 6px;">Isi Pesan</span>
                                                <div class="p-3 rounded-3 text-dark" style="background-color: #fdfcf9; border: 1px solid #e8e2d5; font-size: 0.875rem; line-height: 1.65; white-space: pre-wrap; min-height: 80px;">{{ $msg->message }}</div>
                                            </div>
                                        </div>

                                        <div class="modal-footer d-flex align-items-center justify-content-end" style="padding: 1rem 1.5rem; background-color: #fbf9f5; border-top: 1px solid #e8e2d5;">
                                            <a href="mailto:{{ $msg->email }}?subject=Re:%20{{ rawurlencode($msg->subject) }}" onclick="replyAndMarkRead({{ $msg->id }}, this)" class="btn btn-sm btn-dark px-3.5 py-2 d-inline-flex align-items-center text-white" style="border-radius: 8px; font-size: 0.82rem; font-weight: 500; background-color: #1c1917; border-color: #1c1917;">
                                                <span>Balas via Email</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Konfirmasi Hapus Kustom -->
                            <div class="modal fade text-start" id="deleteContactModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                                    <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: 1px solid #e8e2d5; box-shadow: 0 20px 25px -5px rgba(28, 25, 23, 0.12);">
                                        <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header d-flex align-items-center justify-content-between" style="padding: 1.25rem 1.5rem; background-color: #fbf9f5; border-bottom: 1px solid #e8e2d5;">
                                                <div class="d-flex align-items-center" style="gap: 12px;">
                                                    <div>
                                                        <h6 class="font-serif-book fw-bold text-danger mb-0 fs-5">Hapus Pesan Masuk</h6>
                                                        <small class="text-muted" style="font-size: 0.75rem;">Konfirmasi penghapusan pesan pelanggan</small>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body" style="padding: 1.5rem;">
                                                <p class="text-secondary small mb-3" style="line-height: 1.5;">Apakah Anda yakin ingin menghapus pesan masuk ini? Tindakan ini tidak dapat dibatalkan.</p>
                                                <div class="p-3 rounded-3" style="background-color: #faf7f2; border: 1px solid #e8e2d5;">
                                                    <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Rincian Pesan:</div>
                                                    <div class="fw-bold text-dark small mb-0.5">{{ $msg->name }} <span class="text-muted fw-normal">({{ $msg->email }})</span></div>
                                                    <div class="text-secondary small fst-italic text-truncate">"{{ $msg->subject }}"</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex align-items-center justify-content-end" style="gap: 8px; padding: 1rem 1.5rem; background-color: #fbf9f5; border-top: 1px solid #e8e2d5;">
                                                <button type="button" class="btn btn-sm btn-light border px-3 py-2 text-dark" data-bs-dismiss="modal" style="border-radius: 8px; font-size: 0.8rem; font-weight: 500;">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-danger px-3 py-2 d-inline-flex align-items-center" style="border-radius: 8px; font-size: 0.8rem; font-weight: 500;">
                                                    <span>Hapus Pesan</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
            {{ $messages->links('admin.pagination') }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function replyAndMarkRead(id, linkEl) {
    fetch('{{ url("admin/contacts") }}/' + id + '/read', {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(function(response) {
        return response.json();
    }).then(function(data) {
        if (data && data.success) {
            const badge = document.getElementById('contact-status-badge-' + id);
            if (badge) {
                badge.className = 'badge-editorial badge-editorial-stone';
                badge.textContent = 'Sudah Dibaca';
            }
            const row = document.getElementById('contact-row-' + id);
            if (row) {
                row.classList.remove('bg-light');
            }
        }
    }).catch(function(error) {
        console.error('Error marking message as read:', error);
    });
}
</script>
@endpush
