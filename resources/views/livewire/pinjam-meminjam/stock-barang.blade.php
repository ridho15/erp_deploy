<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5 align-items-center">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md d-flex justify-content-end">
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" wire:model="stockKurang" id="flexCheckDefault"/>
                <label class="form-check-label" for="flexCheckDefault">
                    Stock Kurang
                </label>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
             <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
              <th>No</th>
              <th>SKU</th>
              <th>Nama</th>
              <th>Merek</th>
              <th>Stock</th>
              <th>Satuan</th>
              <th>Min.Stock</th>
              <th>Tipe Barang</th>
              <th>Deskripsi</th>
              <th>Status Stock</th>
              <th>Aksi</th>
             </tr>
            </thead>
            <tbody>
               @if (count($listBarang) > 0)
                   @foreach ($listBarang as $index => $item)
                       @if ($stockKurang == true && $item->stock < $item->min_stock)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->merk ? $item->merk->nama_merk : '-' }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ $item->satuan->nama_satuan }}</td>
                                <td>{{ $item->min_stock }}</td>
                                <td>{{ $item->tipeBarang->tipe_barang }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if ($item->stock < $item->min_stock)
                                        <span class="badge badge-danger">Stock Kurang</span>
                                    @else
                                        <span class="badge badge-success">Stock Cukup</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @elseif($stockKurang == false)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->merk ? $item->merk->nama_merk : '-' }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ $item->satuan->nama_satuan }}</td>
                                <td>{{ $item->min_stock }}</td>
                                <td>{{ $item->tipeBarang->tipe_barang }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if ($item->stock < $item->min_stock)
                                        <span class="badge badge-danger">Kurang</span>
                                    @else
                                        <span class="badge badge-success">Cukup</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                       @endif
                   @endforeach
               @else
                   <tr>
                       <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                   </tr>
               @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listBarang->links() }}</div>
</div>
