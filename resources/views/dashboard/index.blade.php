@extends('template.layout')

@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
        @php($log = \App\CPU\Helpers::getUserLogs(session()->get('user_log_id')))
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{ asset('assets/images/user.gif') }}" alt="image">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="javascript:"
                                        class="text-gray-900 text-hover-primary fs-2 fw-bold me-1 text-capitalize">{{
                                        $log->user->name }}</a>
                                    <a href="javascript:">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                    fill="white"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="javascript:"
                                        class="btn btn-sm btn-light-success fw-bold ms-2 fs-8 py-1 px-3"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{
                                        \App\CPU\Helpers::getTipeUser($log->user->id_tipe_user) }}</a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="javascript:" data-bs-toggle="tooltip" title="Alamat IP"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2 15V9C2 5.68629 4.68629 3 8 3H16C19.3137 3 22 5.68629 22 9V15C22 18.3137 19.3137 21 16 21H8C4.68629 21 2 18.3137 2 15Z"
                                                    stroke="currentColor" />
                                                <path d="M12 9V15" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9 9V15" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M11.9999 12H14.5C15.3284 12 16 11.3284 16 10.5V10.5C16 9.67157 15.3284 9 14.5 9L12 9"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        {{ $log->last_ip }}
                                    </a>
                                    <a href="javascript:"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->SF, Bay Area
                                    </a>
                                    <a href="javascript:" data-bs-toggle="tooltip" title="Agen Pengguna"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                                <path fill="currentColor"
                                                    d="M19 6v5H5V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M3 11h2m16.5 0H19m0 0V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v5m14 0H5" />
                                                <circle cx="7" cy="17" r="3" fill="currentColor" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                <circle cx="17" cy="17" r="3" fill="currentColor" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M10 16h4" />
                                            </svg>
                                        </span>
                                        {{ $log->user_agent }}
                                    </a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <div class="d-flex flex-row">
                                <a href="{{ route('profile.edit') }}" class="icon-cog" data-bs-toggle="tooltip" title="Pengaturan Profil">
                                    <i class="fa-solid fa-cog fs-15"></i>
                                </a>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            @if ($log->lastLogin)
                                                @php($date = Carbon\Carbon::parse($log->lastLogin)->isoFormat('dddd, D MMMM Y'))
                                                <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">{{ App\CPU\Helpers::dateChange($date) }}</div>
                                            @else
                                                <div class="fs-2 fw-bold counted text-capitalize" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">Belum ada data</div>
                                            @endif
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-400">Masuk Terakhir</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            @if ($log->activity)
                                                @php($dates = Carbon\Carbon::parse($log->activity)->isoFormat('dddd, D MMMM Y'))
                                                <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">{{ App\CPU\Helpers::dateChange($dates) }}</div>
                                            @else
                                                <div class="fs-2 fw-bold counted text-capitalize" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">Belum ada data</div>
                                            @endif
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-400">Aktivitas Terakhir</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            @if ($log->user->lastPasswordChange)
                                                @php($dated = Carbon\Carbon::parse($log->user->lastPasswordChange)->isoFormat('dddd, D MMMM Y - H:m'))
                                                <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">{{ App\CPU\Helpers::dateChange($dated) }}</div>
                                            @else
                                                <div class="fs-2 fw-bold counted text-capitalize" data-kt-countup="true"
                                                    data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                    data-kt-initialized="1">Belum ada data</div>
                                            @endif
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-400">Kata Sandi Berubah</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

        <div class="row gy-0 gx-10">
            <div class="col-xl-8">
                <div class="mb-10">
                    <ul class="nav row mb-10">
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_1">
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                            fill="currentColor" />
                                        <path
                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="fs-6 fw-bold">Project
                                    <br />Manajemen</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_2">
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="fs-6 fw-bold">Main
                                    <br />Kategori</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px active"
                                data-bs-toggle="tab" href="#kt_general_widget_1_3">
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                            fill="currentColor" />
                                        <path
                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="fs-6 fw-bold">Order
                                    <br />Manajemen</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_4">
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                            fill="currentColor" />
                                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="fs-6 fw-bold">Sales
                                    <br />Statistik</span>
                            </a>
                        </li>
                        <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                            <a class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                data-bs-toggle="tab" href="#kt_general_widget_1_5">
                                <span class="svg-icon svg-icon-3x mb-5 mx-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="currentColor" />
                                        <path
                                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="fs-6 fw-bold">Akses
                                    <br />Kontrol</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="kt_general_widget_1_1">
                            <div class="card">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Produk terbaru</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">More than 100 new
                                            products</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="5" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" />
                                                        <rect x="14" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="5" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="14" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" id="kt_menu_6332a6a7eafaa">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Status:</label>
                                                    <div>
                                                        <select class="form-select form-select-solid"
                                                            data-kt-select2="true" data-placeholder="Select option"
                                                            data-dropdown-parent="#kt_menu_6332a6a7eafaa"
                                                            data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Pending</option>
                                                            <option value="2">In Process</option>
                                                            <option value="2">Rejected</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Member Type:</label>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                            <span class="form-check-label">Author</span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="2"
                                                                checked="checked" />
                                                            <span class="form-check-label">Customer</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Notifications:</label>
                                                    <div
                                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="notifications" checked="checked" />
                                                        <label class="form-check-label">Enabled</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table align-middle gs-0 gy-5">
                                            <thead>
                                                <tr>
                                                    <th class="p-0 w-50px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-125px"></th>
                                                    <th class="p-0 min-w-40px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/plurk.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Top
                                                            Authors</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Successful
                                                            Fellas</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger fw-semibold me-1">Angular</span>
                                                        <span class="badge badge-light-info fw-semibold me-1">PHP</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-muted fw-bold">4600 Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/telegram.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                            Authors</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Most
                                                            Successful</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger fw-semibold me-1">HTML</span>
                                                        <span class="badge badge-light-info fw-semibold me-1">CSS</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-muted fw-bold">7200 Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">New
                                                            Users</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Awesome
                                                            Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger fw-semibold me-1">React</span>
                                                        <span
                                                            class="badge badge-light-info fw-semibold me-1">SASS</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-muted fw-bold">890 Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/bebo.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                            Customers</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Best
                                                            Customers</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger fw-semibold me-1">Java</span>
                                                        <span class="badge badge-light-info fw-semibold me-1">PHP</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-muted fw-bold">6370 Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Bestseller
                                                            Theme</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Amazing
                                                            Templates</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger fw-semibold me-1">Python</span>
                                                        <span
                                                            class="badge badge-light-info fw-semibold me-1">MySQL</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-muted fw-bold">354 Users</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_general_widget_1_2">
                            <div class="card">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Files</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">Over 100 pending files</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="5" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" />
                                                        <rect x="14" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="5" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="14" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                    Payments</div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:" class="menu-link px-3">Create Invoice</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:" class="menu-link flex-stack px-3">Create Payment
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="Specify a target name for future usage and reference"></i></a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:" class="menu-link px-3">Generate Bill</a>
                                            </div>
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-end">
                                                <a href="javascript:" class="menu-link px-3">
                                                    <span class="menu-title">Subscription</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:" class="menu-link px-3">Plans</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:" class="menu-link px-3">Billing</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:" class="menu-link px-3">Statements</a>
                                                    </div>
                                                    <div class="separator my-2"></div>
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3">
                                                            <label
                                                                class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input w-30px h-20px"
                                                                    type="checkbox" value="1" checked="checked"
                                                                    name="notifications" />
                                                                <span
                                                                    class="form-check-label text-muted fs-6">Recuring</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item px-3 my-1">
                                                <a href="javascript:" class="menu-link px-3">Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table align-middle gs-0 gy-3">
                                            <thead>
                                                <tr>
                                                    <th class="p-0 w-50px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-140px"></th>
                                                    <th class="p-0 min-w-120px"></th>
                                                    <th class="p-0 min-w-40px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label bg-light-success">
                                                                <span class="svg-icon svg-icon-2x svg-icon-success">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                                                            fill="currentColor" />
                                                                        <path opacity="0.3"
                                                                            d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                                                            fill="currentColor" />
                                                                        <path opacity="0.3"
                                                                            d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Top
                                                            Authors</a>
                                                    </td>
                                                    <td class="text-end text-muted fw-bold">ReactJs, HTML</td>
                                                    <td class="text-end text-muted fw-bold">4600 Users</td>
                                                    <td class="text-end text-dark fw-bold fs-6 pe-0">5.4MB</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label bg-light-danger">
                                                                <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                                                            fill="currentColor" />
                                                                        <rect opacity="0.3" x="13" y="2" width="9"
                                                                            height="9" rx="2" fill="currentColor" />
                                                                        <rect opacity="0.3" x="13" y="13" width="9"
                                                                            height="9" rx="2" fill="currentColor" />
                                                                        <rect opacity="0.3" x="2" y="13" width="9"
                                                                            height="9" rx="2" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                            Authors</a>
                                                    </td>
                                                    <td class="text-end text-muted fw-bold">Python, MySQL</td>
                                                    <td class="text-end text-muted fw-bold">7200 Users</td>
                                                    <td class="text-end text-dark fw-bold fs-6 pe-0">2.8MB</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label bg-light-info">
                                                                <span class="svg-icon svg-icon-2x svg-icon-info">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3"
                                                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">New
                                                            Users</a>
                                                    </td>
                                                    <td class="text-end text-muted fw-bold">Laravel, Metronic</td>
                                                    <td class="text-end text-muted fw-bold">890 Users</td>
                                                    <td class="text-end text-dark fw-bold fs-6 pe-0">1.5MB</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label bg-light-warning">
                                                                <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3"
                                                                            d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                            Customers</a>
                                                    </td>
                                                    <td class="text-end text-muted fw-bold">AngularJS, C#</td>
                                                    <td class="text-end text-muted fw-bold">4600 Users</td>
                                                    <td class="text-end text-dark fw-bold fs-6 pe-0">5.4MB</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label bg-light-primary">
                                                                <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                                                            fill="currentColor" />
                                                                        <path opacity="0.3"
                                                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                            Customers</a>
                                                    </td>
                                                    <td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
                                                    <td class="text-end text-muted fw-bold">354 Users</td>
                                                    <td class="text-end text-dark fw-bold fs-6 pe-0">500KB</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade show active" id="kt_general_widget_1_3">
                            <div class="card">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Latest Products</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">More than 400 new
                                            products</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1 active"
                                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1"
                                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4"
                                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="border-0">
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-110px"></th>
                                                            <th class="p-0 min-w-50px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/plurk.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brad
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">React, HTML</td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-success">Approved</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/telegram.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                                    Authors</a>
                                                                <span class="text-muted fw-semibold d-block">Most
                                                                    Successful</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">Python, MySQL
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-warning">In
                                                                    Progress</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">New
                                                                    Users</a>
                                                                <span class="text-muted fw-semibold d-block">Awesome
                                                                    Users</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">Laravel,Metronic
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-primary">Success</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/bebo.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                                    Customers</a>
                                                                <span class="text-muted fw-semibold d-block">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">AngularJS, C#
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-danger">Rejected</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Bestseller
                                                                    Theme</a>
                                                                <span class="text-muted fw-semibold d-block">Best
                                                                    Customers</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">ReactJS, Ruby
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-warning">In
                                                                    Progress</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_table_widget_5_tab_2">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="border-0">
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-110px"></th>
                                                            <th class="p-0 min-w-50px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/plurk.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brad
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">React, HTML</td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-success">Approved</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/telegram.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                                    Authors</a>
                                                                <span class="text-muted fw-semibold d-block">Most
                                                                    Successful</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">Python, MySQL
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-warning">In
                                                                    Progress</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/bebo.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                                    Customers</a>
                                                                <span class="text-muted fw-semibold d-block">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">AngularJS, C#
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-danger">Rejected</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_table_widget_5_tab_3">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="border-0">
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-110px"></th>
                                                            <th class="p-0 min-w-50px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Bestseller
                                                                    Theme</a>
                                                                <span class="text-muted fw-semibold d-block">Best
                                                                    Customers</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">ReactJS, Ruby
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-warning">In
                                                                    Progress</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/bebo.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                                    Customers</a>
                                                                <span class="text-muted fw-semibold d-block">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">AngularJS, C#
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-danger">Rejected</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">New
                                                                    Users</a>
                                                                <span class="text-muted fw-semibold d-block">Awesome
                                                                    Users</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">Laravel,Metronic
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-primary">Success</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-45px me-2">
                                                                    <span class="symbol-label">
                                                                        <img src="assets/media/svg/brand-logos/telegram.svg"
                                                                            class="h-50 align-self-center" alt="" />
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                                    Authors</a>
                                                                <span class="text-muted fw-semibold d-block">Most
                                                                    Successful</span>
                                                            </td>
                                                            <td class="text-end text-muted fw-bold">Python, MySQL
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="badge badge-light-warning">In
                                                                    Progress</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                                                height="2" rx="1"
                                                                                transform="rotate(-180 18 13)"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade" id="kt_general_widget_1_4">
                            <div class="card">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">New Members</span>
                                        <span class="text-muted mt-1 fw-semibold fs-7">More than 400 new
                                            members</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary active fw-bold px-4 me-1"
                                                    data-bs-toggle="tab" href="#kt_table_widget_4_tab_1">Month</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4 me-1"
                                                    data-bs-toggle="tab" href="#kt_table_widget_4_tab_2">Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4"
                                                    data-bs-toggle="tab" href="#kt_table_widget_4_tab_3">Day</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="kt_table_widget_4_tab_1">
                                            <div class="table-responsive">
                                                <table class="table align-middle gs-0 gy-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-120px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/avatars/300-14.jpg" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brad
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/avatars/300-5.jpg" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Jessie
                                                                    Clarcson</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">HTML,
                                                                    CSS Coding</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/avatars/300-20.jpg" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Lebron
                                                                    Wayde</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">ReactJS
                                                                    Developer</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/avatars/300-23.jpg" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Natali
                                                                    Trump</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">UI/UX
                                                                    Designer</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/avatars/300-10.jpg" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Kevin
                                                                    Leonard</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Art
                                                                    Director</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_table_widget_4_tab_2">
                                            <div class="table-responsive">
                                                <table class="table align-middle gs-0 gy-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-120px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/043-boy-18.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Kevin
                                                                    Leonard</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Art
                                                                    Director</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/014-girl-7.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Natali
                                                                    Trump</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">UI/UX
                                                                    Designer</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/018-girl-9.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Jessie
                                                                    Clarcson</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">HTML,
                                                                    CSS Coding</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/001-boy.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brad
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Movie
                                                                    Creator</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_table_widget_4_tab_3">
                                            <div class="table-responsive">
                                                <table class="table align-middle gs-0 gy-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="p-0 w-50px"></th>
                                                            <th class="p-0 min-w-150px"></th>
                                                            <th class="p-0 min-w-140px"></th>
                                                            <th class="p-0 min-w-120px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/018-girl-9.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Jessie
                                                                    Clarcson</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">HTML,
                                                                    CSS Coding</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/047-girl-25.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Lebron
                                                                    Wayde</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">ReactJS
                                                                    Developer</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="symbol symbol-50px">
                                                                    <img src="assets/media/svg/avatars/014-girl-7.svg"
                                                                        alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Natali
                                                                    Trump</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">UI/UX
                                                                    Designer</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Rating</span>
                                                                <div class="rating">
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                    <div class="rating-label me-2 checked">
                                                                        <i class="bi bi-star-fill fs-5"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-twitter btn-sm me-3">
                                                                    <i class="bi bi-twitter fs-4"></i>
                                                                </a>
                                                                <a href="javascript:"
                                                                    class="btn btn-icon btn-light-facebook btn-sm">
                                                                    <i class="bi bi-facebook fs-4"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_general_widget_1_5">
                            <div class="card">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">Tasks Overview</span>
                                        <span class="text-muted fw-semibold fs-7">Pending 10 tasks</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="5" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" />
                                                        <rect x="14" y="5" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="5" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                        <rect x="14" y="14" width="5" height="5" rx="1"
                                                            fill="currentColor" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" id="kt_menu_6332a6a7eb296">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Status:</label>
                                                    <div>
                                                        <select class="form-select form-select-solid"
                                                            data-kt-select2="true" data-placeholder="Select option"
                                                            data-dropdown-parent="#kt_menu_6332a6a7eb296"
                                                            data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Pending</option>
                                                            <option value="2">In Process</option>
                                                            <option value="2">Rejected</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Member Type:</label>
                                                    <div class="d-flex">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                            <span class="form-check-label">Author</span>
                                                        </label>
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="2"
                                                                checked="checked" />
                                                            <span class="form-check-label">Customer</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-semibold">Notifications:</label>
                                                    <div
                                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="notifications" checked="checked" />
                                                        <label class="form-check-label">Enabled</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table align-middle gs-0 gy-5">
                                            <thead>
                                                <tr>
                                                    <th class="p-0 w-50px"></th>
                                                    <th class="p-0 min-w-200px"></th>
                                                    <th class="p-0 min-w-100px"></th>
                                                    <th class="p-0 min-w-40px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/plurk.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Top
                                                            Authors</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Successful
                                                            Fellas</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2">
                                                            <div class="d-flex flex-stack mb-2">
                                                                <span class="text-muted me-2 fs-7 fw-bold">70%</span>
                                                            </div>
                                                            <div class="progress h-6px w-100">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: 70%" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/telegram.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Popular
                                                            Authors</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Most
                                                            Successful</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2">
                                                            <div class="d-flex flex-stack mb-2">
                                                                <span class="text-muted me-2 fs-7 fw-bold">50%</span>
                                                            </div>
                                                            <div class="progress h-6px w-100">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: 50%" aria-valuenow="50"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">New
                                                            Users</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Awesome
                                                            Users</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2">
                                                            <div class="d-flex flex-stack mb-2">
                                                                <span class="text-muted me-2 fs-7 fw-bold">80%</span>
                                                            </div>
                                                            <div class="progress h-6px w-100">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: 80%" aria-valuenow="80"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/bebo.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Active
                                                            Customers</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Best
                                                            Customers</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2">
                                                            <div class="d-flex flex-stack mb-2">
                                                                <span class="text-muted me-2 fs-7 fw-bold">90%</span>
                                                            </div>
                                                            <div class="progress h-6px w-100">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: 90%" aria-valuenow="90"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                                    class="h-50 align-self-center" alt="" />
                                                            </span>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <a href="javascript:"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">Bestseller
                                                            Theme</a>
                                                        <span class="text-muted fw-semibold d-block fs-7">Amazing
                                                            Templates</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2">
                                                            <div class="d-flex flex-stack mb-2">
                                                                <span class="text-muted me-2 fs-7 fw-bold">70%</span>
                                                            </div>
                                                            <div class="progress h-6px w-100">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: 70%" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="18" y="13" width="13"
                                                                        height="2" rx="1" transform="rotate(-180 18 13)"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-10">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Recent Customers</span>
                            <span class="text-muted fw-semibold fs-7">More than 500 new customers</span>
                        </h3>
                        <div class="card-toolbar" data-kt-buttons="true">
                            <a class="btn btn-sm btn-color-muted btn-active btn-active-secondary px-4 me-1"
                                id="kt_charts_widget_5_year_btn">Year</a>
                            <a class="btn btn-sm btn-color-muted btn-active btn-active-secondary px-4 me-1"
                                id="kt_charts_widget_5_month_btn">Month</a>
                            <a class="btn btn-sm btn-color-muted btn-active btn-active-secondary px-4 active"
                                id="kt_charts_widget_5_week_btn">Week</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="kt_charts_widget_5_chart" style="height: 350px"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-10">
                    <div class="card-header border-0 bg-success py-5">
                        <h3 class="card-title fw-bold text-white">Sales Progress</h3>
                        <div class="card-toolbar">
                            <button type="button"
                                class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                    </div>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:" class="menu-link px-3">Create Invoice</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:" class="menu-link flex-stack px-3">Create Payment
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:" class="menu-link px-3">Generate Bill</a>
                                </div>
                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                    data-kt-menu-placement="right-end">
                                    <a href="javascript:" class="menu-link px-3">
                                        <span class="menu-title">Subscription</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <div class="menu-item px-3">
                                            <a href="javascript:" class="menu-link px-3">Plans</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:" class="menu-link px-3">Billing</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:" class="menu-link px-3">Statements</a>
                                        </div>
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                                        value="1" checked="checked" name="notifications" />
                                                    <span class="form-check-label text-muted fs-6">Recuring</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-item px-3 my-1">
                                    <a href="javascript:" class="menu-link px-3">Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="mixed-widget-12-chart card-rounded-bottom bg-success" data-kt-color="success"
                            style="height: 250px"></div>
                        <div class="card-rounded bg-body mt-n10 position-relative card-px py-15">
                            <div class="row g-0 mb-7">
                                <div class="col mx-5">
                                    <div class="fs-6 text-gray-400">Avarage Sale</div>
                                    <div class="fs-2 fw-bold text-gray-800">$650</div>
                                </div>
                                <div class="col mx-5">
                                    <div class="fs-6 text-gray-400">Comissions</div>
                                    <div class="fs-2 fw-bold text-gray-800">$29,500</div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col mx-5">
                                    <div class="fs-6 text-gray-400">Revenue</div>
                                    <div class="fs-2 fw-bold text-gray-800">$55,000</div>
                                </div>
                                <div class="col mx-5">
                                    <div class="fs-6 text-gray-400">Expenses</div>
                                    <div class="fs-2 fw-bold text-gray-800">$1,130,600</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

@endpush
