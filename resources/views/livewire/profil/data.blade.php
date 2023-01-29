<div>
    <div class="toolbar d-flex flex-stack mb-0 mb-lg-n4 pt-5" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">Ubah Profil Pengguna</h1>
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ $fotoView ? asset($fotoView) : asset('assets/images/user.gif') }}"
                                    alt="image">
                                <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                </div>
                            </div>
                        </div>
                        @php
                            $log = App\CPU\Helpers::getUserLogs();
                        @endphp
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="javascript:"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $log->user->name }}</a>
                                        <a href="javascript:">
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
                                        </a>
                                        <a href="javascript:"
                                            class="btn btn-sm btn-light-success fw-bold ms-2 fs-8 py-1 px-3"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
                                            @foreach (session()->get('list_tipe_user') as $item)
                                                {{ $item }},
                                            @endforeach
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="javascript:"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg width="24" height="24" stroke-width="1.5"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
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
                                            {{ $lastIp }}
                                        </a>
                                        <a href="javascript:"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
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
                                        </a>
                                        <a href="javascript:"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none">
                                                    <path fill="currentColor"
                                                        d="M19 6v5H5V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M3 11h2m16.5 0H19m0 0V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v5m14 0H5" />
                                                    <circle cx="7" cy="17" r="3"
                                                        fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" />
                                                    <circle cx="17" cy="17" r="3"
                                                        fill="currentColor" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" />
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M10 16h4" />
                                                </svg>
                                            </span>
                                            {{ $userAgent }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg> </span>
                                                @if ($lastLogin)
                                                    @php
                                                        $date = Carbon\Carbon::parse($lastLogin)->isoFormat('dddd, D MMMM Y');
                                                    @endphp
                                                    <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                        data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                        data-kt-initialized="1">
                                                        {{ App\CPU\Helpers::dateChange($date) }}
                                                    </div>
                                                @else
                                                    <div class="fs-2 fw-bold counted text-capitalize"
                                                        data-kt-countup="true" data-kt-countup-value="4500"
                                                        data-kt-countup-prefix="$" data-kt-initialized="1">Belum ada
                                                        data</div>
                                                @endif
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-400 text-capitalize">Terakhir masuk
                                            </div>
                                        </div>
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg>
                                                </span>
                                                @if ($lastActivity)
                                                    @php
                                                        $dates = Carbon\Carbon::parse($lastActivity)->isoFormat('dddd, D MMMM Y');
                                                    @endphp
                                                    <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                        data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                        data-kt-initialized="1">
                                                        {{ App\CPU\Helpers::dateChange($dates) }}
                                                    </div>
                                                @else
                                                    <div class="fs-2 fw-bold counted text-capitalize"
                                                        data-kt-countup="true" data-kt-countup-value="4500"
                                                        data-kt-countup-prefix="$" data-kt-initialized="1">Belum ada
                                                        data</div>
                                                @endif
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-400 text-capitalize">Aktivitas
                                                Terakhir</div>
                                        </div>
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg> </span>
                                                @if ($lastPasswordChange)
                                                    @php
                                                        $dated = Carbon\Carbon::parse($lastPasswordChange)->isoFormat('dddd, D MMMM Y - H:m');
                                                    @endphp
                                                    <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                        data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                        data-kt-initialized="1">
                                                        {{ App\CPU\Helpers::dateChange($dated) }}
                                                    </div>
                                                @else
                                                    <div class="fs-2 fw-bold counted text-capitalize"
                                                        data-kt-countup="true" data-kt-countup-value="4500"
                                                        data-kt-countup-prefix="$" data-kt-initialized="1">Belum ada
                                                        data</div>
                                                @endif
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-400">Kata Sandi Berubah</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0 text-capitalize">Detail data pengguna</h3>
                    </div>
                </div>
                <div id="kt_account_settings_profile_details" class="collapse show">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', [
                            'target' => 'simpanDataPreOrder',
                            'message' => 'Menyimpan
                                                                                                data ...',
                        ])
                    </div>
                    <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data" action="#" wire:submit.prevent="simpanProfile">
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                        <div class="image-input-wrapper w-125px h-125px d-flex justify-content-center">
                                            @if ($foto)
                                                <img src="{{ $foto->temporaryUrl() }}" class="preview-img h-100">
                                            @else
                                                <img src="{{ $fotoView ? asset($fotoView) : 'undefined' }}"
                                                    class="preview-img h-100"
                                                    onerror="this.src='{{ asset('assets/images/user.gif') }}'">
                                            @endif

                                            <div class="spinner-border text-danger" role="status" wire:loading
                                                wire:target="foto">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            aria-label="Change avatar" data-kt-initialized="1">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg"
                                                wire:model="foto">
                                        </label>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            aria-label="Cancel avatar" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            aria-label="Remove avatar" data-kt-initialized="1">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Tipe gambar yang diizinkan: png, jpg, jpeg.</div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="text" name="username"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Username" wire:model="username">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="text" name="name" wire:model="name"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Masukan nama lengkap">
                                            @error('id_customer')
                                                <small class="text-danger">{{ $name }}</small>
                                            @enderror
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="email" name="email" wire:model="email"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="Masukan Email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Handphone</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Phone number must be active" data-kt-initialized="1"></i>
                                </label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="tel" name="phone" wire:model="phone"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="Phone number">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary"
                                id="kt_account_profile_details_submit">Simpan Perubahan</button>
                        </div>
                        <input type="hidden">
                    </form>
                </div>
            </div>

            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Ganti Password</h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bold mb-1">Password <span class="ms-5 text-primary"
                                        style="cursor: pointer;" wire:click="changeShowPassword">
                                        @if ($showPassword == false)
                                            <i class="fa-solid fa-eye"></i>
                                        @elseif($showPassword == true)
                                            <i class="fa-solid fa-eye-slash"></i>
                                        @endif
                                    </span></div>
                                <div class="fw-semibold text-gray-600">
                                    @php
                                        $user = \App\CPU\Helpers::getUser();
                                        if ($showPassword == true) {
                                            echo $user->password;
                                            echo '<br>  <small class="text-danger">Password dalam mode ke amanan. Password asli tidak bisa di tampilkan</small>';
                                        }else {
                                            echo '************';
                                        }
                                    @endphp
                                </div>
                            </div>
                            <div class="modal fade" wire:ignore.self tabindex="-1" id="password_change"
                                wire:submit.prevent="changePassword">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Penggantian Password</h3>

                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2"
                                                            width="20" height="20" rx="10"
                                                            fill="currentColor" />
                                                        <rect x="7" y="15.3137" width="12"
                                                            height="2" rx="1"
                                                            transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                        <rect x="8.41422" y="7" width="12"
                                                            height="2" rx="1"
                                                            transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <form action="#" wire:submit.prevent="changePassword">
                                            <div class="modal-body">
                                                <div class="input-group mb-5">
                                                    <span class="input-group-text" id="basic-addon1">Password
                                                        lama</span>
                                                    <input type="password" class="form-control" required
                                                        wire:model="oldPassword" />
                                                </div>
                                                @error('newPassword')
                                                    <small class="text-danger mb-5"
                                                        style="margin-top: -10px;">{{ $message }}</small>
                                                @enderror

                                                <div class="input-group mb-5">
                                                    <span class="input-group-text" id="basic-addon1">Password
                                                        Baru</span>
                                                    <input type="password" class="form-control" required
                                                        wire:model="newPassword" />

                                                </div>
                                                <div class="input-group mb-5">
                                                    <span class="input-group-text" id="basic-addon1">Ulangi Password
                                                        Baru</span>
                                                    <input type="password" class="form-control" required
                                                        wire:model="c_newPassword" />
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Password
                                                    baru</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary"
                                    wire:click="$emit('onClickUbah')">Ganti Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message)
        })
        Livewire.on('onClickUbah', () => {
            $('#password_change').modal('show')
        })
        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })
    </script>
@endpush
