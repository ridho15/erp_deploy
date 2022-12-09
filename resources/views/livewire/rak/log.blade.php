<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                History Rak
            </h3>
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
                   <th>SKU</th>
                   <th>Barang</th>
                   <th>Status</th>
                   <th>Jumlah</th>
                   <th>Keterangan</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listRakLog) > 0)
                        @foreach ($listRakLog as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->sku }}</td>
                                <td>{{ $item->barang->nama }}</td>
                                <td><?= $item->status_formatted ?></td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->keterangan }}</td>
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
            {{ $listRakLog->links() }}
        </div>
    </div>
</div>
