<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Payable
            </h3>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusMetodePembayaran', 'message' => 'Memuat data...'])
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
                    <th>No Ref</th>
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
                                <td>{{ $item->no_ref }}</td>
                                <td>{{ $item->supplier ? $item->supplier->name : '-' }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td><?= $item->status_order_formatted['badge'] ?></td>
                                <td><?= $item->status_pembayaran_formatted ?></td>
                                <td>{{ $item->total_harga_formatted }}</td>
                                <td>{{ $item->tanggal_order_formatted }}</td>
                                <td>{{ $item->tipePembayaran->nama_tipe }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <div class="btn-group">
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
            {{ $listSupplierOrder->links() }}
        </div>
    </div>
</div>
