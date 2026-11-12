@if ($paginator->hasPages())
    <div class="row align-items-center w-100 g-0" style="margin: 0;">
        {{-- Kiri: Menampilkan X - Y dari Z data --}}
        <div class="col-12 col-md-4 text-center text-md-start p-0">
            <span class="text-muted" style="font-size: 0.82rem; letter-spacing: 0.01em; line-height: 1.5;">
                Menampilkan <strong class="text-dark">{{ $paginator->firstItem() ?? 0 }}</strong> – <strong class="text-dark">{{ $paginator->lastItem() ?? 0 }}</strong> dari <strong class="text-dark">{{ $paginator->total() }}</strong> data
            </span>
        </div>

        {{-- Tengah: Angka Navigasi Halaman --}}
        <div class="col-12 col-md-4 d-flex justify-content-center p-0 my-2 my-md-0">
            <nav aria-label="Navigasi Halaman">
                <ul class="pagination pagination-sm mb-0" style="gap: 4px;">
                    {{-- Tombol Sebelumnya --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link rounded-2 px-3 py-1" style="font-size: 0.85rem;" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-2 px-3 py-1" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="font-size: 0.85rem;" aria-label="Sebelumnya">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Angka-angka Halaman --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link rounded-2 px-3 py-1" style="font-size: 0.85rem;">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link rounded-2 px-3 py-1 fw-bold" style="font-size: 0.85rem;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link rounded-2 px-3 py-1" href="{{ $url }}" style="font-size: 0.85rem;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Tombol Selanjutnya --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link rounded-2 px-3 py-1" href="{{ $paginator->nextPageUrl() }}" rel="next" style="font-size: 0.85rem;" aria-label="Berikutnya">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link rounded-2 px-3 py-1" style="font-size: 0.85rem;" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        {{-- Kanan: Halaman A dari B --}}
        <div class="col-12 col-md-4 text-center text-md-end d-none d-md-block p-0">
            <span class="text-muted" style="font-size: 0.82rem; line-height: 1.5;">
                Halaman <strong class="text-dark">{{ $paginator->currentPage() }}</strong> dari <strong class="text-dark">{{ $paginator->lastPage() }}</strong>
            </span>
        </div>
    </div>
@endif
