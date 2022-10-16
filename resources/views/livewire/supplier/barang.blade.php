<div>
    <h4 class="mb-5">Supplier Barang</h4>
    @include('helper.alert-message')
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
           <th>Barang</th>
           <th>Merk</th>
           <th>Tipe Barang</th>
           <th>Satuan</th>
           <th>Harga</th>
           <th>Aksi</th>
          </tr>
         </thead>
         <tbody>
            @if (count($listSupplierBarang) > 0)
                @foreach ($listSupplierBarang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->barang->merk ? $item->barang->merk->nama_merk : '-' }}</td>
                        <td>{{ $item->barang->tipeBarang->tipe_barang }}</td>
                        <td>{{ $item->barang->satuan->nama_satuan }}</td>
                        <td>{{ $item->barang->harga_formatted }}</td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Barang" wire:click="$emit('onClickHapusSupplierBarang', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
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
    {{ $listSupplierBarang->links() }}
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickHapusSupplierBarang', async(id)=>{
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus supplier barang ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusSupplierBarang', id)
            }
        })
    </script>
@endpush
