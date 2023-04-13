<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Tipe Barang</h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success me-3" wire:click="$emit('onClickImport')">
                    <i class="fa-solid fa-file-import"></i> Import
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusBarang',
                    'message' => 'Memuat data...',
                ])
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
                            <th>Nama Tipe Barang</th>
                            <th>Total Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listTipeBarang) > 0)
                            @foreach ($listTipeBarang as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tipe_barang }}</td>
                                    <td>{{ $item->barang->count() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Tipe Barang"
                                                wire:click="$emit('onClickEdit', {{ $item->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus Tipe Barang"
                                                wire:click="$emit('onClickHapus', {{ $item->id }})">
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
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataTipeBarang', id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus data?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusTipeBarang', id)
            }
        })

        Livewire.on('refreshData', (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickImport', () => {
            $('#modal_import').modal('show')
        })
    </script>
@endpush
