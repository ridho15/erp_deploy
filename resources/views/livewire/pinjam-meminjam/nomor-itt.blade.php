<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_nomor_itt">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"># Nomor ITT/ITS</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanNomorPeminjamanHarian', 'message' => 'Menyimpan data ...'])
                    </div>
                    @if ($showForm == true)
                        <form action="#" wire:submit.prevent="simpanNomorPeminjamanHarian" id="form_permintaan_barang">
                            <div class="mb-5">
                                <label for="" class="form-label">Nomor ITT Start</label>
                                <input type="number" name="itt_start" class="form-control form-control-solid" wire:model="itt_start" placeholder="Nomor ITT" required>
                                @error('itt_start')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Nomor ITT End</label>
                                <input type="number" name="itt_end" class="form-control form-control-solid" wire:model="itt_end" placeholder="Nomor ITT" required>
                                @error('itt_end')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" wire:model="tanggal" class="form-control form-control-solid" required>
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                            </div>
                        </form>
                    @endif
                    <hr>
                    <div class="row mb-5">
                        <div class="col-md-4">
                            @include('helper.form-pencarian', ['model' => 'cari'])
                        </div>
                        <div class="col-md text-end">
                            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Nomor ITT" wire:click="changeShowFormITT">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                         <thead>
                          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                           <th>No</th>
                           <th>Nomor ITT Start</th>
                           <th>Nomor ITT End</th>
                           <th>Tanggal</th>
                           <th>Aksi</th>
                          </tr>
                         </thead>
                         <tbody>
                            @if (count($listNomorPeminjamanHarian) > 0)
                                @foreach ($listNomorPeminjamanHarian as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->itt_start }}</td>
                                        <td>{{ $item->itt_end }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Nomor ITT" wire:click="editNomorITT({{ $item->id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Nomor ITT" wire:click="$emit('onClickHapusNomorITT', {{ $item->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500">Tidak ada data</td>
                                </tr>
                            @endif
                         </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
            $('.modal').modal('hide')
            alertMessage(status, message)
        })


        Livewire.on("onClickHapusNomorITT", async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusNomorITT', id)
            }
        })
    </script>
@endpush
