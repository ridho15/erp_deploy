<div>
    <div wire:ignore.self class="modal fade kategori-barang" tabindex="-1" id="modal_kategori_barang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">List Barang</h3>

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
                        @include('helper.simple-loading', ['target' => null, 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                         <thead>
                          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                           <th>No</th>
                           <th>Nama Kategori</th>
                           <th>Nama Barang</th>
                           <th>Merk</th>
                           <th>Aksi</th>
                          </tr>
                         </thead>
                         <tbody>
                            @if (count($listBarangKategori) > 0)
                                @foreach ($listBarangKategori as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                        <td>{{ $item->barang->nama }}</td>
                                        <td>{{ $item->barang->merk ? $item->barang->merk->nama_merk : '-' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Barang Kategori" wire:click="$emit('onClickHapusBarangKategori', {{ $item->id }})">
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

        Livewire.on('onClickHapusBarangKategori', async (id) => {
            const response = await alertConfirm('Peringatan', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusDataBarangKategori', id)
            }
        })
    </script>
@endpush
