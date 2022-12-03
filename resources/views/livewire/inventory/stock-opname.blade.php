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
                   <th style="width: 100px">Jumlah Mutasi</th>
                   <th style="width: 100px">Jumlah Terjual</th>
                   <th style="width: 100px">Jumlah Terbaru</th>
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
                                <td>{{ $item->jumlah_tercatat ?? 0 }}</td>
                                <td>
                                    <input type="number" step="0.001" class="form-control jumlah-mutasi" placeholder="0" value="{{ $item->jumlah_mutasi }}" data-id="{{ $item->id }}">
                                </td>
                                <td>
                                    <input type="number" step="0.001" class="form-control jumlah-terjual" placeholder="0" value="{{ $item->jumlah_terjual }}" data-id="{{ $item->id }}">
                                </td>
                                <td>
                                    <input type="number" step="0.001" class="form-control jumlah-terbaru" placeholder="0" value="{{ $item->jumlah_terbaru }}" data-id="{{ $item->id }}">
                                </td>
                                <td>
                                    <textarea class="form-control keterangan" name="keterangan" placeholder="-" data-id="{{ $item->id }}">{{ $item->keterangan }}</textarea>
                                </td>
                                <td>
                                    <input type="date" class="form-control tanggal" name="tanggal" value="{{ date('Y-m-d', strtotime($item->tanggal)) }}" data-id="{{ $item->id }}">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" wire:click="$emit('onClickHapus', {{ $item->id }})">
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
            Change()
        });

        window.addEventListener('contentChange', Change)

        Livewire.on('onClickTambah', () => {
            $('#modal_form_stock_opname').modal('show')
        })

        function Change (){
            $('.jumlah-mutasi').on('change', function(){
                const id = $(this).data('id')
                const val = $(this).val()
                Livewire.emit('simpanJumlahMutasi', id, val)
            })

            $('.jumlah-terjual').on('change', function(){
                const id = $(this).data('id')
                const val = $(this).val()
                Livewire.emit('simpanJumlahTerjual', id, val)
            })

            $('.jumlah-terbaru').on('change', function(){
                const id = $(this).data('id')
                const val = $(this).val()
                Livewire.emit('simpanJumlahTerbaru', id, val)
            })

            $('.keterangan').on('change', function(){
                const id = $(this).data('id')
                const val = $(this).val()
                Livewire.emit('simpanKeterangan', id, val)
            })

            $('input[name="tanggal"]').on('change', function(){
                const id = $(this).data('id')
                const val = $(this).val()
                Livewire.emit('simpanTanggal', id, val)
            })
        }

        Livewire.on('onClickHapus', async(id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus data ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusStockOpname', id)
            }
        })
    </script>
@endpush
