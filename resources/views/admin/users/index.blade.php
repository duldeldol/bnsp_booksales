@extends('layouts.admin')

@section('title', 'User Terdaftar')
@section('page-title', 'User Terdaftar')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
    <div>
        <h5 class="font-serif-book fw-bold mb-1 text-dark">Data Pengguna & Pelanggan</h5>
        <p class="text-muted small mb-0">Daftar seluruh akun yang terdaftar dalam sistem toko buku.</p>
    </div>
</div>

<!-- Search & Role Filter -->
<div class="shadcn-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 align-items-center admin-filter-form">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Cari nama pelanggan, alamat email, atau nomor HP...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="dropdown admin-custom-dropdown w-100">
                    @php
                        $roleOptions = [
                            'customer' => 'Customer Saja',
                            'admin' => 'Admin Saja',
                        ];
                        $selectedLabel = $roleOptions[request('role')] ?? 'Semua Peran (Role)';
                    @endphp
                    <button class="btn btn-sm form-select form-select-sm text-start d-flex align-items-center justify-content-between w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-truncate">{{ $selectedLabel }}</span>
                    </button>
                    <ul class="dropdown-menu w-100 shadow-sm border mt-1" style="border-radius: 10px; border-color: var(--border-color) !important;">
                        <li>
                            <button type="button" class="dropdown-item small py-2 d-flex align-items-center justify-content-between {{ !request('role') ? 'active' : '' }}" onclick="submitAdminFilter(this, '')">
                                <span>Semua Peran (Role)</span>
                                @if(!request('role'))
                                    <i class="bi bi-check2"></i>
                                @endif
                            </button>
                        </li>
                        @foreach($roleOptions as $val => $lbl)
                            <li>
                                <button type="button" class="dropdown-item small py-2 d-flex align-items-center justify-content-between {{ request('role') == $val ? 'active' : '' }}" onclick="submitAdminFilter(this, '{{ $val }}')">
                                    <span class="text-truncate">{{ $lbl }}</span>
                                    @if(request('role') == $val)
                                        <i class="bi bi-check2"></i>
                                    @endif
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="role" value="{{ request('role') }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-shadcn-primary btn-sm w-100 d-inline-flex align-items-center justify-content-center">Cari
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center px-2.5" style="min-width: 38px;" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise" style="line-height: 1;"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="shadcn-card overflow-hidden">
    <div class="shadcn-card-header bg-white py-3">
        <span class="small font-monospace text-muted">Total: <strong>{{ $users->total() }}</strong> item</span>
    </div>

    <div class="table-responsive">
        <table class="shadcn-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">No</th>
                    <th>Pengguna</th>
                    <th>Email & Kontak</th>
                    <th>Alamat Pengiriman</th>
                    <th class="text-center">Peran</th>
                    <th class="text-center">Total Transaksi</th>
                    <th class="text-center">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $u)
                    <tr>
                        <td class="text-center text-muted">{{ $users->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="fw-semibold text-dark">{{ $u->name }}</div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $u->email }}</div>
                            <small class="text-muted">{{ $u->phone ?: '-' }}</small>
                        </td>
                        <td class="text-muted small" style="max-width: 250px;">
                            {{ $u->address ?: '-' }}
                        </td>
                        <td class="text-center text-nowrap">
                            @if($u->role === 'admin')
                                <span class="badge-editorial badge-editorial-ink">
                                    Administrator
                                </span>
                            @else
                                <span class="badge-editorial badge-editorial-emerald">
                                    Customer
                                </span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">
                            <span class="badge-editorial badge-editorial-stone">
                                {{ $u->orders_count }} Pesanan
                            </span>
                        </td>
                        <td class="text-center text-muted small text-nowrap">
                            {{ $u->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted small">
                            <div>Tidak ada data pengguna yang sesuai kriteria pencarian.</div>
                            @if(request('search') || request('role'))
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="p-3 border-top">
            {{ $users->links('admin.pagination') }}
        </div>
    @endif
</div>
@endsection
