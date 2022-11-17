<div>
    <div class="card shadow-sm" role="tabpanel">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Pekerjaan
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <form action="#" method="POST" wire:submit.prevent="simpanLaporanPekerjaan">
                @include('helper.alert-message')
                <div class="text-center">
                    @include('helper.simple-loading', ['target' => 'simpanLaporanPekerjaan', 'message' => 'Sedang menyimpan data ...'])
                </div>
                <div class="row mb-5">
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="text" class="form-control form-control-solid" name="tanggal" placeholder="Masukkan tanggal" value="{{ $tanggal ? date('d-m-Y', strtotime($tanggal)) : null }}" disabled>
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Jam Mulai</label>
                        <input type="text" class="form-control form-control-solid" name="jam_mulai" placeholder="Masukkan waktu" value="{{ $jam_mulai ? date('H:i', strtotime($jam_mulai)) : null }}" disabled>
                        @error('jam_mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Jam Selesai</label>
                        <input type="text" class="form-control form-control-solid" name="jam_selesai" placeholder="Masukkan waktu" value="{{ $jam_selesai ? date('H:i', strtotime($jam_selesai)) : null }}" disabled>
                        @error('jam_selesai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="mb-5 col-md-6">
                        <label for="" class="form-label required">Keterangan Pekerja / Catatan Teknisi</label>
                        <textarea name="keterangan_laporan_pekerjaan" class="form-control form-control-solid" placeholder="Masukkan keterangan / Catatan" cols="30" rows="5" wire:model='keterangan_laporan_pekerjaan'></textarea>
                        @error('keterangan_laporan_pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-5 col-md-6">
                        <label for="" class="form-label required">Catatan Client / Pelanggan</label>
                        <textarea name="catatan_pelanggan" wire:model="catatan_pelanggan" class="form-control form-control-solid" placeholder="Masukkan keterangan / Catatan" cols="30" rows="5"></textarea>
                        @error('catatan_pelanggan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-5"
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false, progress = 0"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <label for="" class="form-label">Upload Foto</label>
                        <div class="border rounded text-center py-5 px-2">
                            <label for="upload_file" class="btn btn-sm btn-icon btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Foto">
                                <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-10-09-043348/core/html/src/media/icons/duotune/general/gen035.svg-->
                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </label>
                            <input type="file" wire:model="foto" hidden accept="image/*" multiple id="upload_file">
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('foto.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row mt-5">
                                @foreach ($foto as $index => $item)
                                    <div class="col-md-4">
                                        <div class="image-hover border rounded position-relative text-center">
                                            <div class="position-absolute w-100 h-100 rounded d-flex align-items-center justify-content-center" wire:click="$emit('onClickHapusFotoByIndex', {{ $index }})">
                                                <i class="bi bi-trash-fill text-danger fs-2"></i>
                                            </div>
                                            <img src="{{ $item->temporaryUrl() }}" class="img-fluid rounded" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <label for="" class="form-label">Keterangan Foto</label>
                        <textarea name="keterangan_foto" wire:model="keterangan_foto" class="form-control form-control-solid" placeholder="Masukkan keterangan foto" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="row justify-content-end align-items-start mb-5">
                    <div class="col-md-8 pt-10 mb-5">
                        <div class="w-100 border rounded px-5 py-3 d-flex flex-wrap">
                            @if (count($laporanPekerjaan->laporanPekerjaanFoto) > 0)
                                @foreach ($laporanPekerjaan->laporanPekerjaanFoto as $item)
                                    <div class="image-hover border rounded position-relative text-center m-2">
                                        <div class="position-absolute w-100 h-100 rounded d-flex align-items-center justify-content-center" wire:click="$emit('onClickHapusFoto', {{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->keterangan }}">
                                            <i class="bi bi-trash-fill text-danger fs-2"></i>
                                        </div>
                                        <img src="{{ asset('storage' . $item->file) }}" class="rounded" alt="" width="200" height="200" style="object-fit: cover">
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-gray-500 w-100">
                                    Belum ada foto
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <label for="" class="form-label">Tanda Tangan</label>
                        <div class="position-relative">
                            <canvas id="signature-pad" class="signature-pad border rounded w-100" style="height: 200px;"></canvas>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-5">
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear" wire:click="$emit('onClickClear')">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai" wire:click="$emit('onClickFiks')">
                                <i class="fa-solid fa-circle-check"></i>
                            </button>
                        </div>
                        <div class="border rounded p-5 text-center text-gray-500">
                            @if ($signature)
                                <img src="{{ asset('storage/' . $signature) }}" class="img-fluid" alt="">
                            @else
                                Belum di tanda tangan
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Laporan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        var signaturePad = null;
        $(document).ready(function () {
            const canvas = document.querySelector("canvas");
            $('input[name="tanggal"]').flatpickr({
                dateFormat: 'd-m-Y'
            })
            $('input[name="jam_mulai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })
            $('input[name="jam_selesai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })
            signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
            });
        });

        window.addEventListener('contentChange', function(){
            $('input[name="tanggal"]').flatpickr({
                dateFormat: 'd-m-Y'
            })
            $('input[name="jam_mulai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })
            $('input[name="jam_selesai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })

            // signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            //     backgroundColor: 'rgba(255, 255, 255, 0)',
            //     penColor: 'rgb(0, 0, 0)'
            // });

        })

        Livewire.on('onClickHapusFotoByIndex',async(index) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus foto ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusFotoByIndex', index)
            }
        })

        Livewire.on('onClickHapusFoto', async(id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus foto ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusFoto', id)
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickClear', () => {
            if(signaturePad != null){
                signaturePad.clear();
            }

            @this.set('signature', null);
        })

        Livewire.on('onClickFiks', () => {
            if(signaturePad != null){
                var data = signaturePad.toDataURL('image/png');
                Livewire.emit('base64ToImage', data)
            }
        })
    </script>
@endpush
