<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Quotation</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="updateDataQuotation">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'updateDataQuotation', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Kode Project
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->laporanPekerjaan->project->kode : null }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Nama Project
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->laporanPekerjaan->project->nama : null }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Pelanggan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->laporanPekerjaan->customer->nama : null }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Email Pelanggan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->laporanPekerjaan->customer->email : null }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                No Hp Pelanggan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->laporanPekerjaan->customer->no_hp : null }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Keterangan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">{{ $quotation? $quotation->keterangan : '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Status
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold"><?= $quotation? $quotation->status_formatted : null ?></span>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="" class="form-label">File</label>
                            <input type="file" name="file" wire:model="file" accept="application/pdf,application/vnd.ms-excel,.docx" id="pilih_file" hidden>
                            <div class="text-center">
                                <label for="pilih_file" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload File">
                                    <i class="fa-solid fa-file"></i> Pilih File
                                </label>
                            </div>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            <div class="text-center">
                                @if ($file)
                                    {{ $file->getClientOriginalName() }} <span class="text-danger mx-2" style="cursor: pointer" wire:click="onClickHapusFile"><i class="fa-solid fa-trash-can text-danger fs-2"></i></span>
                                @endif
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){

        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })
    </script>
@endpush
