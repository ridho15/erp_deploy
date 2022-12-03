<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Stock Opname
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="date" class="form-control form-control-solid" name="tanggal" wire:model="tanggal" placeholder="Pilih tanggal">
                    @error('tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>SKU</th>
                   <th>Nama Barang</th>
                   <th>Merk</th>
                   <th>Jumlah Tercatat</th>
                   <th>Jumlah Mutasi</th>
                   <th>Jumlah Terjual</th>
                   <th>Jumlah Terbaru</th>
                   <th>Keterangan</th>
                   <th>Tanggal</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listStockOpname) > 0)
                        @foreach ($listStockOpname as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->sku }}</td>
                                <td>{{ $item->barang->nama }}</td>
                                <td>{{ $item->barang->merk->nama_merk }}</td>
                                <td>{{ $item->jumlah_tercatat }}</td>
                                <td>{{ $item->jumlah_mutasi }}</td>
                                <td>{{ $item->jumlah_terjual }}</td>
                                <td>{{ $item->jumlah_terbaru }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Metode Pembayaran" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambah', () => {
            $('#modal_form_stock_opname').modal('show')
        })
    </script>
@endpush
