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
              <th>Merek</th>
              <th>Stock</th>
              <th>Satuan</th>
              <th>Minimal Stock</th>
              <th>Tipe Barang</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
             </tr>
            </thead>
            <tbody>
               @if (count($listBarang) > 0)
                   @foreach ($listBarang as $index => $item)
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
                               <div class="btn-group">
                                   <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
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
    <div class="text-center">{{ $listBarang->links() }}</div>
</div>
