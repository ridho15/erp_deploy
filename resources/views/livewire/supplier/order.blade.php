<div>
    <div class="row mb-3">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
         <thead>
          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
           <th>No</th>
           <th>Supplier</th>
           <th>User</th>
           <th>Status Order</th>
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td></td>
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
                    <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
         </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listSupplierOrder->links() }}</div>
</div>
