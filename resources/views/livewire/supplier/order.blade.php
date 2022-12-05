<div>
    @if ($segment != 'order')
        <h4 class="mb-5">Supplier Order</h4>
    @endif
    @include('helper.alert-message')
    <div class="row mb-3">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
    </div>
    <div class="tables w-100" style="position: relative !important">
        <table class="table table-rounded table-striped border gy-7 gs-7">
         <thead>
          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
           <th>No</th>
           <th>Supplier</th>
           <th>Pembuat</th>
           <th>Status Order</th>
           <th>Status Pembayaran</th>
           <th>Total Harga</th>
           <th>Tanggal Order</th>
           <th>Tipe Pembayaran</th>
           <th>Keterangan</th>
           <th>Aksi</th>
          </tr>
         </thead>
         <tbody>
            @if (count($listSupplierOrder) > 0)
                @foreach ($listSupplierOrder as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td><?= $item->status_order_formatted['badge'] ?></td>
                        <td><?= $item->status_pembayaran_formatted ?></td>
                        <td>{{ $item->total_harga_formatted }}</td>
                        <td>{{ $item->tanggal_order_formatted }}</td>
                        <td>{{ $item->tipePembayaran ? $item->tipePembayaran->nama_tipe : '-' }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier Order" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Supplier Order" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <a href="{{ route('supplier.order-detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Supplier Order">
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
    <div class="text-center">{{ $listSupplierOrder->links() }}</div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickEdit', (id) =>{
            Livewire.emit('setDataSupplierOrder', id)
            $('#modal_form_order').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ini ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusSupplierOrder', id)
            }
        })

        Livewire.on('finishSupplierOrder', (status, message) =>{
            alertMessage(status, message)
        })
    </script>
@endpush
