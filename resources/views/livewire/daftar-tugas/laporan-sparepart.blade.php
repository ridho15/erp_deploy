<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Penggunaan Barang
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Spareparts" wire:click="$emit('onClickTambahBarang')">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>Nama Barang</th>
                   <th>Tipe Barang</th>
                   <th>Harga</th>
                   <th>Satuan</th>
                   <th>Qty</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listLaporanPekerjaanBarang) > 0)
                        @foreach ($listLaporanPekerjaanBarang as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->nama }}</td>

                                <td>{{ $item->barang->tipeBarang->tipe_barang }}</td>
                                <td>{{ $item->barang->harga_formatted }}</td>
                                <td>{{ $item->barang->satuan }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kategori" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Kategori" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambahBarang', () => {
            $('#modal_form_barang').modal('show')
        })

        Livewire.on('onClickEditBarang', (id) => {
            Livewire.emit('setDataLaporanPekerjaanBarang', id)
            $('#modal_form_barang').modal('show')
        })

        Livewire.on('onClickHapusBarang', async(id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus barang ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusLaporanPekerjaanBarang', id)
            }
        })
    </script>
@endpush
