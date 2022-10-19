<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
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
            <th>Nama</th>
            <th>Satuan</th>
            <th>Terjual</th>
            <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listBarangTerjual) > 0)
                @foreach ($listBarangTerjual as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang->sku }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->satuan->nama_satuan }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->tanggal_formatted }}</td>
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
    <div class="text-center">{{ $listBarangTerjual->links() }}</div>
</div>
