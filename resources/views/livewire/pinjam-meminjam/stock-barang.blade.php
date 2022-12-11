    <div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5 align-items-center">
        <div class="col-md-3">
            <form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
                <span class="svg-icon svg-icon-2 svg-icon-lg-3 svg-icon-gray-800 position-absolute top-50 translate-middle-y ms-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                    </svg>
                </span>
                <input type="text" class="search-input form-control form-control-solid ps-13" name="cari" wire:model="cari" placeholder="Nama Barang-Merk-Satuan-Tipe Barang-Deskripsi">
                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                    <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                </span>
                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </span>
            </form>
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
                                <td>{{ $item->tipeBarang ? $item->tipeBarang->tipe_barang : '-' }}</td>
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
