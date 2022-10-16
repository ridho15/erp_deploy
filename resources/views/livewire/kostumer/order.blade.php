<div>
    @include('helper.alert-message')
    <div class="">
        <div class="row mb-5">
            <div class="col-md-5">
                Kode
            </div>
            <div class="col-md-5">
                : <span class="fw-bold">{{ $kostumer->kode }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Nama Kostumer
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->nama }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                No HP
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->no_hp }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Email
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->email }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Alamat
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->alamat }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Status
            </div>
            <div class="col-md">
                : <span class="fw-bold"><?= $kostumer->status_formatted ?></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md-9 d-flex justify-content-end">
            <button class="btn btn-sm btn-outline btn-outline-info btn-tambah-barang me-2" wire:click="$emit('onClickTambah')"><i class="bi bi-plus"></i> Tambah Order</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                <th>No</th>
                <th>User</th>
                <th>Status Order</th>
                <th>Total Produk</th>
                <th>Total Harga</th>
                <th>Keterangan</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @if (count($listKostumerOrder) > 0)
                @foreach ($listKostumerOrder as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                                <span class="badge badge-light-@if ($item->status_order == 1)warning @elseif($item->status_order == 2)primary @elseif($item->status_order == 3)info @elseif($item->status_order == 4)success  @elseif($item->status_order == 0)danger @endif">{{ $item->status_order_formatted }}</span>
                        </td>
                        <td>{{ $item->total_produk }}</td>
                        <td>{{ $item->total_harga_formatted }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kostumer Order" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Kostumer Order" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <a href="{{ route('kostumer.order-detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Kostumer Order">
                                    <i class="bi bi-info-circle-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
         </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listKostumerOrder->links() }}</div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambah', () => {
            $('#modal_form_order').modal('show')
        })

        Livewire.on('onClickEdit', (id) =>{
            Livewire.emit('setDataKostumerOrder', id)
            $('#modal_form_order').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ini ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusKostumerOrder', id)
            }
        })

        Livewire.on('finishSupplierOrder', (status, message) =>{
            alertMessage(status, message)
        })
    </script>
@endpush
