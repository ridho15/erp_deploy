<div>
    <div wire:ignore.self class="modal fade project" tabindex="-1" id="modal_project_detail_barang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Project Detail Barang</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanDataProject', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4">
                            @include('helper.form-pencarian', ['model' => 'cari'])
                        </div>
                        <div class="col-md text-end">
                            <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="showHideTambahBarang"><i class="bi bi-plus-circle"></i> Tambah</button>
                        </div>
                    </div>
                    @if ($tambahBarang)
                        <form action="#" wire:submit.prevent="simpanBarang" method="POST">
                            <div class="text-center">
                                @include('helper.simple-loading', ['target' => 'simpanBarang', 'message' => 'Sedang menyimpan data ...'])
                            </div>
                            @error('id_project_detail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row justify-content-end">
                                <div class="col-md-6 mb-5">
                                    <label for="" class="form-label required">Barang</label>
                                    <select name="id_barang" class="form-select form-select-solid tambah-barang" wire:model="id_barang" data-control="select2" data-dropdown-parent="#modal_project_detail_barang" data-placeholder="Pilih Barang" required id="#id_barang">
                                        <option value="">Pilih</option>
                                        @foreach ($listBarang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label for="" class="form-label required">Status Barang</label>
                                    <select name="status_barang" class="form-select form-select-solid tambah-barang" wire:model="status_barang" data-control="select2" data-dropdown-parent="#modal_project_detail_barang" data-placeholder="Pilih" required>
                                        <option value="">Pilih</option>
                                        @foreach ($listStatusBarang as $item)
                                            <option value="{{ $item['status_barang'] }}">{{ $item['keterangan'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label for="" class="form-label required">Quantity</label>
                                    <input type="number" name="qty" wire:model="qty" class="form-control form-control-solid" placeholder="Masukkan jumlah" required>
                                    @error('qty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-5 text-end">
                                    <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Barang">
                                        <i class="bi bi-box-arrow-down"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>No</th>
                            <th>Barang</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Status Barang</th>
                            <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($listProjectDetailBarang) > 0)
                                @foreach ($listProjectDetailBarang as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->barang ? $item->barang->nama : '-' }}</td>
                                        <td>{{ $item->barang->satuan->nama_satuan }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->status_barang_formatted }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Project" wire:click="$emit('onClickHapusBarang', {{ $item->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500">Tidak ada data</td>
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

        window.addEventListener('contentChange', function(){
            $('select[name="id_barang"]').select2()
            $('select[name="status_barang"]').select2()
            refreshSelect()
        })

        function refreshSelect(){
            $('select[name="id_barang"]').on('change', function(){
                Livewire.emit('changeBarang',$(this).val())
            })

            $('select[name="status_barang"]').on('change', function(){
                Livewire.emit('changeStatusBarang',$(this).val())
            })
        }

        Livewire.on('onClickHapusBarang', async(id) => {
            const response = await alertConfirm('Peringatan !', "Apakah anda yakin ingin menghapus barang dari pekerjaan ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusBarangProject', id)
            }
        })
    </script>
@endpush
