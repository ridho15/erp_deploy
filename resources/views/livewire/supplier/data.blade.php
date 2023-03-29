<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Supplier
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,refreshSupplier', 'message' => 'Memuat data...'])
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
                   <th>Nama</th>
                   <th>Email</th>
                   <th>HP #1</th>
                   <th>HP #2</th>
                   <th>Telp #1</th>
                   <th>Telp #2</th>
                   <th>Alamat</th>
                   <th>Status</th>
                   <th>PIC</th>
                   <th>Produk</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listSupplier) > 0)
                        @foreach ($listSupplier as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp_1 }}</td>
                                <td>{{ $item->no_hp_2 }}</td>
                                <td>{{ $item->telp_1 }}</td>
                                <td>{{ $item->telp_2 }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td><?= $item->status_formatted ?></td>
                                <td>
                                    @foreach ($item->supplierSales as $supplierSales)
                                        {{ $supplierSales->sales->nama }} ({{ $supplierSales->sales->no_hp }}),
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->supplierBarang as $supplierBarang)
                                        {{ $supplierBarang->barang->nama }} ({{ $supplierBarang->barang->nomor }}),
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Supplier" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <a href="{{ route('supplier.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Supplier">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
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
            <div class="text-center">{{ $listSupplier->links() }}</div>
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
            $('#modal_form').modal('show')
            Livewire.emit('setDataSupplier', id)
        })

        Livewire.on('onClickHapus',async(id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus data ?");
            if(response.isConfirmed == true){
                Livewire.emit('hapusSupplier', id)
            }
        })

        Livewire.on("finishDataSupplier", (status, message) => {
            alertMessage(status, message)
        })
    </script>
@endpush
