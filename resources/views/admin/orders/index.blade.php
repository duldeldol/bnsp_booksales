@extends('layouts.admin')

@section('title', 'List Pesanan')
@section('page-title', 'List Pesanan Pelanggan')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
    <div>
        <h5 class="font-serif-book fw-bold mb-1 text-dark">Daftar Transaksi Pesanan</h5>
        <p class="text-muted small mb-0">Kelola pesanan masuk dari pelanggan dan perbarui status transaksi.</p>
    </div>
</div>

<!-- Search & Status Filter Card -->
<div class="shadcn-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Cari nomor invoice, ID pesanan, atau nama pelanggan...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Status Pesanan</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas / Diproses</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-shadcn-primary btn-sm w-100 d-inline-flex align-items-center justify-content-center">Cari
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center px-2.5" style="min-width: 38px;" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise" style="line-height: 1;"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Orders Table -->
<div class="shadcn-card overflow-hidden">
    <div class="shadcn-card-header bg-white py-3">
        <span class="small font-monospace text-muted">Total: <strong>{{ $orders->total() }}</strong> item</span>
    </div>

    <div class="table-responsive">
        <table class="shadcn-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">No</th>
                    <th class="text-center">No. Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th class="text-center">Buku Dipesan</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center">Metode Pembayaran</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center" style="width: 90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $index => $order)
                    <tr>
                        <td class="text-center text-muted">{{ $orders->firstItem() + $index }}</td>
                        <td class="text-center font-monospace fw-semibold text-dark text-nowrap">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-decoration-none text-dark fw-bold" title="Lihat detail pesanan">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_phone }}</small>
                        </td>
                        <td class="text-center text-nowrap">
                            <span class="badge-editorial badge-editorial-stone">
                                {{ $order->items->sum('quantity') }} buku ({{ $order->items->count() }} judul)
                            </span>
                        </td>
                        <td class="text-center fw-semibold text-dark text-nowrap">{{ $order->formatted_total }}</td>
                        <td class="text-center text-nowrap">
                            <span class="badge-editorial badge-editorial-stone">
                                {{ $order->payment_method_label }}
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <span class="badge-editorial badge-{{ $order->status_badge }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="text-center text-muted small text-nowrap">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-shadcn-outline py-1 px-2.5" style="font-size: 0.75rem;">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted small">
                            <div>Belum ada pesanan yang sesuai kriteria pencarian.</div>
                            @if(request('search') || request('status'))
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="p-3 border-top">
            {{ $orders->links('admin.pagination') }}
        </div>
    @endif
</div>
@endsection
