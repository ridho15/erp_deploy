<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_unit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Unit</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanUnit">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanUnit', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="table table-rounded table-striped border gy-7 gs-7">
                             <thead>
                              <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                               <th>No</th>
                               <th>Nama Unit</th>
                               <th>Nomor Unit</th>
                               <th>Aksi</th>
                              </tr>
                             </thead>
                             <tbody>
                                @if (count($listProjectUnit) > 0)
                                    @foreach ($listProjectUnit as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_unit ?? '-' }}</td>
                                            <td>{{ $item->no_unit ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Unit" wire:click="$emit('onClickHapusUnit', {{ $item->id }})">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endif
                             </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Nama Unit</label>
                                <input type="text" class="form-control form-control-solid" name="nama_unit" wire:model="nama_unit" placeholder="Masukkan nama metode" required>
                                @error('nama_unit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Nomor Unit</label>
                                <input type="number" name="no_unit" wire:model="no_unit" class="form-control form-control-solid" placeholder="Nomor Unit" aria-describedby="basic-addon2"/>
                                @error('no_unit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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

        Livewire.on('onClickHapusUnit', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu ingin menghapus data unit?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusUnit', id)
            }
        })
    </script>
@endpush
