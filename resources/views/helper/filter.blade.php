<div class="me-4">
    <!--begin::Menu-->
    <a href="#" class="btn btn-flex btn-light btn-active-primary fw-bold" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->Filter
    </a>
    <!--begin::Menu 1-->
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" wire:ignore.self data-kt-menu="true" id="kt_menu_6332a713e8160">
        <!--begin::Header-->
        <div class="px-7 py-5">
            <div class="fs-5 text-dark fw-bold">Filter Options</div>
        </div>
        <!--end::Header-->
        <!--begin::Menu separator-->
        <div class="separator border-gray-200"></div>
        <!--end::Menu separator-->
        <!--begin::Form-->
        <div class="px-7 py-5">
            <form action="#" wire:submit.prevent="filterData">
            <div class="mb-10" data-select2-id="select2-data-207-fspd">
                <!--begin::Label-->
                <label class="form-label fw-semibold">Tanggal mulai:</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="date" name="date1" @if($date1 != null) wire:model="date1" @endif class="form-control form-control-lg form-control-solid">
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10" data-select2-id="select2-data-207-fspd">
                <!--begin::Label-->
                <label class="form-label fw-semibold">Tanggal selesai:</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="date" name="date2" @if($date2 != null) wire:model="date2" @endif class="form-control form-control-lg form-control-solid">
                <!--end::Input-->
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Filter</button>
            </div>
            <!--end::Actions-->
            </form>
        </div>
        <!--end::Form-->
    </div>
    <!--end::Menu 1-->
    <!--end::Menu-->
</div>
