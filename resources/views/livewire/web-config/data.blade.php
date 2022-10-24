<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Pengaturan Web
            </h3>
            {{-- <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Manual</button>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,sendQuotationToCustomer', 'message' => 'Memuat
                data...'])
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <form action="#" wire:submit.prevent="simpanWebConfig">
                            <div class="card-header">
                                <div class="card-title">
                                    <h6>Aplikasi</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('helper.alert-message')
                                <div class="text-center">
                                    @include('helper.simple-loading', ['target' => 'simpanTipeBarang', 'message' =>
                                    'Menyimpan data ...'])
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Judul</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="text" name="judul" wire:model="judul"
                                            class="form-control form-control-lg form-control-solid" placeholder="">
                                        @error('judul')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Deskripsi</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <textarea name="deskripsi"
                                            class="form-control form-control-lg form-control-solid"
                                            wire:model="deskripsi">
                                    </textarea>
                                        @error('deskripsi')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-4 col-form-label required fw-semibold fs-6">Logo</div>
                                    <div
                                        class="col-lg-8 d-flex justify-content-center position-relative fv-row fv-plugins-icon-container">
                                        @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" class="preview-img">
                                        @else
                                        <img src="{{ $logoView ? asset($logoView['value']) : 'undefined' }}"
                                            class="preview-img"
                                            onerror="this.src='{{ asset('assets/images/placeholder/logo.png') }}'">
                                        @endif

                                        <div class="spinner-border text-danger" role="status" wire:loading
                                            wire:target="logo">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4"></div>
                                    <div class="col-lg-8 mt-4 position-relative">
                                        <input type="file" name="loader_gif" id="logoUploader" class="custom-file-input"
                                            wire:model="logo"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUploadLoader">Pilih
                                            Logo</label>
                                        @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <div class="col-lg-4 col-form-label required fw-semibold fs-6">Favicon</div>
                                    <div
                                        class="col-lg-8 d-flex justify-content-center position-relative fv-row fv-plugins-icon-container">
                                        @if ($favicon)
                                        <img src="{{ $favicon->temporaryUrl() }}" class="preview-img">
                                        @else
                                        <img src="{{ $faviconView ? asset($faviconView['value']) : 'undefined' }}"
                                            class="preview-img"
                                            onerror="this.src='{{ asset('assets/images/placeholder/logo.png') }}'">
                                        @endif

                                        <div class="spinner-border text-danger" role="status" wire:loading
                                            wire:target="favicon">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4"></div>
                                    <div class="col-lg-8 mt-4 position-relative">
                                        <input type="file" name="loader_gif" id="logoUploader" class="custom-file-input"
                                            wire:model="favicon"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUploadLoader">Pilih
                                            Favicon</label>
                                        @error('favicon')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end p-3">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan Aplikasi</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <form action="#" wire:submit.prevent="saveLogo">
                            <div class="card-header">
                                <div class="card-title">
                                    <h6>Perusahaan</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('helper.alert-message')
                                <div class="text-center">
                                    @include('helper.simple-loading', ['target' => 'simpanTipeBarang', 'message' =>
                                    'Menyimpan data ...'])
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama
                                        Perusahaan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="text" name="nama" wire:model="nama"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="email website">
                                        @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat
                                        Perusahaan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <textarea type="text" name="alamat" wire:model="alamat"
                                            class="form-control form-control-lg form-control-solid"></textarea>
                                        @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat
                                        Surel</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="email" name="email" wire:model="email"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="email website">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-3">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Telepon
                                        Perusahaan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="number" name="phone" wire:model="phone"
                                            class="form-control form-control-lg form-control-solid">
                                        @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-3">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Faksimili</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="text" name="faksimili" wire:model="faksimili"
                                            class="form-control form-control-lg form-control-solid">
                                        @error('faksimili')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Logo
                                        Perusahaan</label>
                                    <div class="col-lg-8 d-flex justify-content-center position-relative">
                                        @if ($logoPerusahaan)
                                        <img src="{{ $logoPerusahaan->temporaryUrl() }}" class="preview-img">
                                        @else
                                        <img src="{{ $logoPerusahaanView ? asset($logoPerusahaanView['value']) : 'undefined' }}"
                                            class="preview-img"
                                            onerror="this.src='{{ asset('assets/images/placeholder/logo.png') }}'">
                                        @endif

                                        <div class="spinner-border text-danger" role="status" wire:loading
                                            wire:target="logoPerusahaan">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8 mt-4">
                                        <div class="row footer-img ms-1 mb-4">
                                            <input type="file" name="loader_gif" id="logoUploader"
                                                class="custom-file-input" wire:model="logoPerusahaan"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label" for="customFileUploadLoader">Pilih
                                                Logo Perusahaan</label>
                                            @error('logoPerusahaan')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="card-footer d-flex justify-content-end p-3">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan perusahaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function () {

        });

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message)
        })
</script>
@endpush
