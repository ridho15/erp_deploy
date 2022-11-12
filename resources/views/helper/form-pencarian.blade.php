<form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
    @if (\Request::route()->getName() == 'management-tugas')
    <span class="svg-icon svg-icon-2 svg-icon-lg-3 svg-icon-gray-800 position-absolute top-50 translate-middle-y ms-5 mt-4">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
        </svg>
    </span>
    <div class="row flex-row">
        <div class="col-6">
            <label class="form-label fw-semibold">Cari berdasarkan nama / project / nomor lift:</label>
            <input type="text" class="search-input form-control form-control-solid ps-13" name="cari" @if($model != null) wire:model="cari" @endif placeholder="Search...">
        </div>
        <div class="col-6">
            <label class="form-label fw-semibold">Cari berdasarkan Tanggal mulai / selesai:</label>
            <input type="date" placeholder="Tanggal mulai" name="cari" class="search-input form-control form-control-solid ps-13" wire:model='cari'>
        </div>
        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
            <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
        </span>
    </div>
    @else
    <span class="svg-icon svg-icon-2 svg-icon-lg-3 svg-icon-gray-800 position-absolute top-50 translate-middle-y ms-5">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
        </svg>
    </span>
    <input type="text" class="search-input form-control form-control-solid ps-13" name="cari" @if($model != null) wire:model="cari" @endif placeholder="Search...">
    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
        <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
    </span>
    @endif
    <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
        <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
            </svg>
        </span>
    </span>
</form>
