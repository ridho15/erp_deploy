<div class="d-flex align-items-center ms-1 ms-lg-3 position-relative">
    @if ($totalNotifikasi > 0)
        <div class="bg-danger rounded-circle w-15px h-15px d-flex align-items-center justify-content-center" style="position: absolute; top: 0px; right: 0px">
            <small class="text-white">{{ $totalNotifikasi }}</small>
        </div>
    @endif
    <div class="btn btn-color-gray-800 btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px position-relative btn btn-color-gray-800 btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <span class="svg-icon svg-icon-2x">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M8 8C8 7.4 8.4 7 9 7H16V3C16 2.4 15.6 2 15 2H3C2.4 2 2 2.4 2 3V13C2 13.6 2.4 14 3 14H5V16.1C5 16.8 5.79999 17.1 6.29999 16.6L8 14.9V8Z" fill="currentColor"/>
                <path d="M22 8V18C22 18.6 21.6 19 21 19H19V21.1C19 21.8 18.2 22.1 17.7 21.6L15 18.9H9C8.4 18.9 8 18.5 8 17.9V7.90002C8 7.30002 8.4 6.90002 9 6.90002H21C21.6 7.00002 22 7.4 22 8ZM19 11C19 10.4 18.6 10 18 10H12C11.4 10 11 10.4 11 11C11 11.6 11.4 12 12 12H18C18.6 12 19 11.6 19 11ZM17 15C17 14.4 16.6 14 16 14H12C11.4 14 11 14.4 11 15C11 15.6 11.4 16 12 16H16C16.6 16 17 15.6 17 15Z" fill="currentColor"/>
            </svg>
        </span>
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-400px" data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content text-center px-3">
                <div class="text-center fw-bold">
                    Notifikasi
                </div>
            </div>
        </div>
        <div class="separator my-2"></div>
        @if (count($listNotifikasi) > 0)
            @foreach ($listNotifikasi as $item)
                <div class="menu-item @if($item->status_lihat == 0) bg-light @endif">
                    <a href="#" wire:click="directNotifikasi({{ $item->id }})" class="menu-link px-5">
                        <div>
                            <span class="fw-bold">{{ $item->judul }}</span><br>
                            <small>{{ $item->pesan }}</small>
                        </div>
                    </a>
                </div>
                <div class="separator"></div>
            @endforeach
        @else
            <div class="text-center text-gray-500">Tidak ada notifikasi</div>
        @endif
    </div>
</div>
