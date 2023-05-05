<div>
    <div class="card shadow-sm" role="tabpanel">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Pekerjaan <span id="keycode"></span>
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3"
                            d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z"
                            fill="currentColor" />
                        <path
                            d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z"
                            fill="currentColor" />
                    </svg>
                </span>

                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h4 class="fw-semibold">Informasi</h4>
                    <ul>
                        <li>
                            <span>Jam selesai tidak dapat di edit, akan automatis terisi ketika tanda tangan customer
                                sudah di berikan dan data sudah berhasil disimpan.</span>
                        </li>
                        <li>
                            <span>Untuk keterangan pekerjaan / catatan teknisi selesai mengetikan catatan lalu tekan
                                <strong>Enter</strong> maka catatan yang baru di masukkan akan tampil. lalu isi
                                checklist ya atau tidak, berikan minimal 1 untuk mengkonfirmasi pekerjaan sudah
                                dikerjakan atau belum</span>
                        </li>
                        <li>
                            <span>Untuk tanda tangan silahkan isi tanda tangan customer pada area yang sudah diberikan,
                                lalu pilih tombol centang biru dan simpan. maka data berhasil di simpan dan jam selesai
                                akan terisi secara automatis</span>
                        </li>
                    </ul>

                </div>

                <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                fill="currentColor" />
                            <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(-45 9 13.0283)" fill="currentColor" />
                            <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                        </svg>
                    </span>
                </button>
            </div>
            <form action="#" method="POST" wire:submit.prevent="simpanLaporanPekerjaan" id="FormLaporanPekerjaan">
                @include('helper.alert-message')
                <div class="text-center">
                    @include('helper.simple-loading', [
                        'target' => 'simpanLaporanPekerjaan',
                        'message' => 'Sedang menyimpan data ...',
                    ])
                </div>
                <div class="row mb-5">
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal"
                            wire:model="tanggal" placeholder="Pilih tanggal">
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control form-control-solid" name="jam_mulai"
                            placeholder="Masukkan waktu" wire:model="jam_mulai">
                        @error('jam_mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md mb-5">
                        <label for="" class="form-label">Jam Selesai</label>
                        <input type="datetime" class="form-control form-control-solid" name="jam_selesai"
                            wire:model="jam_selesai" placeholder="-">
                        @error('jam_selesai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="mb-5 col-md-6">
                        <label for="" class="form-label">Nama Client</label>
                        <input type="text" name="nama_client" class="form-control form-control-solid"
                            wire:model='nama_client' placeholder="Masukkan nama client">
                        @error('nama_client')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5 col-md-6">
                        <div class="mb-3" wire:ignore>
                            <label for="" class="form-label required">Keterangan Pekerja / Catatan
                                Teknisi</label>
                            <input type="text" name="catatan_teknisi" class="form-control form-control-solid"
                                placeholder="Masukkan catatan">
                        </div>
                        <table>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Ya</td>
                                <td>Tidak</td>
                            </tr>
                            @if (count($listCatatanTeknisi) > 0)
                                @foreach ($listCatatanTeknisi as $item)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-light-active-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Hapus Catatan"
                                                wire:click="hapusCatatanTeknisi({{ $item->id }})">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </button>
                                        </td>
                                        <td class="px-2">
                                            {{ $item->keterangan }}
                                        </td>
                                        <td class="px-2">
                                            <div
                                                class="form-check form-check-custom form-check-solid mb-2 form-check-sm">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    @if ($item->status === 1) checked @endif
                                                    id="flexCheckDefault"
                                                    wire:click="checkCatatanTeknisi({{ $item->id }}, 1)" />
                                            </div>
                                        </td>
                                        <td class="px-2">
                                            <div
                                                class="form-check form-check-custom form-check-solid mb-2 form-check-sm">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    @if ($item->status === 0) checked @endif
                                                    id="flexCheckDefault"
                                                    wire:click="checkCatatanTeknisi({{ $item->id }}, 0)" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-white">Text</td>
                                    <td class="text-white">Text</td>
                                    <td class="text-white">Text</td>
                                    <td class="text-white">Text</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="mb-5 col-md-6">
                        <label for="" class="form-label required">Catatan Client / Pelanggan</label>
                        <textarea name="catatan_pelanggan" wire:model="catatan_pelanggan" class="form-control form-control-solid"
                            placeholder="Masukkan keterangan / Catatan" cols="30" rows="5"></textarea>
                        @error('catatan_pelanggan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-5" x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false, progress = 0"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="" class="form-label">Upload Foto</label>
                        <div class="border rounded text-center py-5 px-2">
                            <label for="upload_file"
                                class="btn btn-sm btn-icon btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Foto">
                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20"
                                            height="20" rx="5" fill="currentColor" />
                                        <rect x="10.8891" y="17.8033" width="12" height="2"
                                            rx="1" transform="rotate(-90 10.8891 17.8033)"
                                            fill="currentColor" />
                                        <rect x="6.01041" y="10.9247" width="12" height="2"
                                            rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                            </label>
                            <input type="file" wire:model="foto" hidden accept="image/*" multiple
                                id="upload_file">
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('foto.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row mt-5">
                                @foreach ($foto as $index => $item)
                                    <div class="col-md-4">
                                        <div class="image-hover border rounded position-relative text-center">
                                            <div class="position-absolute w-100 h-100 rounded d-flex align-items-center justify-content-center"
                                                wire:click="$emit('onClickHapusFotoByIndex', {{ $index }})">
                                                <i class="bi bi-trash-fill text-danger fs-2"></i>
                                            </div>
                                            <img src="{{ $item->temporaryUrl() }}" class="img-fluid rounded"
                                                alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <label for="" class="form-label">Keterangan Foto</label>
                        <textarea name="keterangan_foto" wire:model="keterangan_foto" class="form-control form-control-solid"
                            placeholder="Masukkan keterangan foto" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="row justify-content-end align-items-start mb-5">
                    <div class="col-md-8 pt-10 mb-5">
                        <div class="w-100 border rounded px-5 py-3 d-flex flex-wrap">
                            @if (count($laporanPekerjaan->laporanPekerjaanFoto) > 0)
                                @foreach ($laporanPekerjaan->laporanPekerjaanFoto as $item)
                                    <div class="image-hover border rounded position-relative text-center m-2">
                                        <div class="position-absolute w-100 h-100 rounded d-flex align-items-center justify-content-center"
                                            wire:click="$emit('onClickHapusFoto', {{ $item->id }})"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $item->keterangan }}">
                                            <i class="bi bi-trash-fill text-danger fs-2"></i>
                                        </div>
                                        <img src="{{ asset('storage' . $item->file) }}" class="rounded"
                                            alt="" width="200" height="200" style="object-fit: cover">
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
                            <canvas id="signature-pad" class="signature-pad border rounded w-100"
                                style="height: 200px;"></canvas>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-5">
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-danger mx-2"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Clear"
                                wire:click="$emit('onClickClear')">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-primary mx-2"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai"
                                wire:click="$emit('onClickFiks')">
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
                    <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Simpan Laporan">
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
        $(document).ready(function() {
            const canvas = document.querySelector("canvas");
            $('input[name="tanggal"]').flatpickr({
                dateFormat: 'Y-m-d'
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

        window.addEventListener('contentChange', function() {
            $('input[name="tanggal"]').flatpickr({
                dateFormat: 'Y-m-d'
            })
            $('input[name="jam_mulai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })
            $('input[name="jam_selesai"]').flatpickr({
                enableTime: true,
                dateFormat: 'H:i'
            })
        })

        Livewire.on('onClickHapusFotoByIndex', async (index) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus foto ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusFotoByIndex', index)
            }
        })

        Livewire.on('onClickHapusFoto', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus foto ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusFoto', id)
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickClear', () => {
            if (signaturePad != null) {
                signaturePad.clear();
            }

            @this.set('signature', null);
        })

        Livewire.on('onClickFiks', () => {
            if (signaturePad != null) {
                var data = signaturePad.toDataURL('image/png');
                Livewire.emit('base64ToImage', data)
            }
        })

        $('input[name="catatan_teknisi"]').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            console.log(keyCode);
            $('#keycode').html(keyCode)
            const catatan_teknisi = $(this).val();
            if (keyCode === 13) {
                e.preventDefault();
                Livewire.emit('addCatatanTeknisi', catatan_teknisi)
                return false;
            } else if (keyCode === 'Enter') {
                e.preventDefault();
                Livewire.emit('addCatatanTeknisi', catatan_teknisi)
                return false;
            }

            // else if (keyCode === 229) {
            //     e.preventDefault();
            //     Livewire.emit('addCatatanTeknisi', catatan_teknisi)
            //     return false;
            // }

        })

        // const catatanTeknisi = document.querySelector('input[type="catatan_teknisi"]');

        // catatanTeknisi.addEventListener("blur", (event) => {
        //     e.preventDefault();
        //     Livewire.emit('addCatatanTeknisi', catatan_teknisi)
        //     return false;
        // });

        $('input[name="catatan_teknisi"]').on('blur', function(e) {
            e.preventDefault();
            Livewire.emit('addCatatanTeknisi', catatan_teknisi)
            return false;
        })
    </script>
@endpush
