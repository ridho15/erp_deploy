<div>
    <div wire:ignore.self class="modal fade atur-jadwal" tabindex="-1" id="modal_atur_jadwal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Atur Ulang Jadwal</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataJadwal">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataJadwal', 'message' => 'Menyimpan data ...'])
                        </div>
                        @if ($laporanPekerjaan)
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Kode Pekerjaan
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->kode_pekerjaan }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Kode Project
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->project->kode }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama Project
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->project->nama }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    No Lift
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->no_lift }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Merk
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->merk->nama_merk }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Tanggal
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ date('d-m-Y', strtotime($laporanPekerjaan->jam_mulai)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Jam Mulai
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ date('H:i', strtotime($laporanPekerjaan->jam_mulai)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Pekerja
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">
                                        @if ($laporanPekerjaan->user)
                                            {{ $laporanPekerjaan->user->name }} ({{ $laporanPekerjaan->user->jabatan }})
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Form
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->formMaster->nama }} ({{ $laporanPekerjaan->formMaster->kode }})</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Keterangan
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->keterangan }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Catatan Pelanggan
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $laporanPekerjaan->catatan_pelanggan }}</span>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="mb-5">
                            <label for="" class="form-label required">Tanggal</label>
                            <input type="text" class="form-control form-control-solid" name="tanggal" wire:model="tanggal" placeholder="Tanggal" disabled>
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Waktu Mulai</label>
                            <input type="text" class="form-control form-control-solid" name="jam_mulai" wire:model="jam_mulai" placeholder="Masukkan waktu mulai" required>
                            @error('jam_mulai')
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
            $('input[name="jam_mulai"]').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
            })
        });

        window.addEventListener('contentChangeFormAturJadwal', () => {
            $('input[name="jam_mulai"]').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
            })
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
