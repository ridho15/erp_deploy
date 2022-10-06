<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                List Data Project
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusProject', 'message' => 'Memuat data...'])
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
                   <th>Nama Project</th>
                   <th>Customer</th>
                   <th>Alamat Project</th>
                   <th>Keterangan Project</th>
                   <th>Diketahui Pelanggan</th>
                   <th>Total Barang</th>
                   <th>Total Harga</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listProject) > 0)
                        @foreach ($listProject as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_project ?? '-' }}</td>
                                <td>{{ $item->customer ? $item->customer->nama : '-' }}</td>
                                <td>{{ $item->alamat_project ?? '-'}}</td>
                                <td>{{ $item->keterangan_project ?? '-' }}</td>
                                <td>{{ $item->diketahui_pelanggan_formatted ?? '-' }}</td>
                                <td>{{ $item->total_barang }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Project" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Project" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <a href="{{ route('form-pekerjaan.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Project">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
            <div class="text-center">{{ $listProject->links() }}</div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataProject', id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus');
            if(response.isConfirmed == true){
                Livewire.emit('hapusDataProject', id)
            }
        })

        Livewire.on('finishRefreshProject', (status, message) => {
            alertMessage(status, message)
        })
    </script>
@endpush
