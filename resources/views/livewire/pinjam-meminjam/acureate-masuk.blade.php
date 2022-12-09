<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,simpanCheck', 'message' => 'Memuat data...'])
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
                <th>Qty</th>
                <th>Peminjam</th>
                <th>Check</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listAcurateMasuk) > 0)
                @foreach ($listAcurateMasuk as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">
                                {{ $item->barang->sku }}
                            </a>
                        </td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->userPeminjam ? $item->userPeminjam->name : '-' }}</td>
                        <td>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" wire:click="simpanCheck({{ $item->id }})" @if($item->check == 1) checked @endif id="flexCheckDefault"/>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listAcurateMasuk->links() }}</div>
</div>
