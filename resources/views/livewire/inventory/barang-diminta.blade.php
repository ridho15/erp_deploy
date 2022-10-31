<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
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
                <th>Kode Pekerjaan</th>
                <th>SKU</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Jumlah / Qty</th>
                <th>Tipe Barang</th>
                <th>Catatan Teknisi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listBarangDiminta) > 0)
                @foreach ($listBarangDiminta as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ $item->laporanPekerjaan->kode_pekerjaan }}</td>
                        <td>{{ $item->barang->sku }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->barang->satuan->nama_satuan }}</td>
                        <td>{{ $item->barang->harga_formatted }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->barang->tipeBarang->tipe_barang }}</td>
                        <td>{{ $item->catatan_teknisi }}</td>
                        <td><?= $item->status_formatted ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Abaikan Pinjaman Barang" wire:click="$emit('onClickAbaikan', {{ $item->id }})">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pinjaman Barang" wire:click="$emit('onClickConfirm', {{ $item->id }})">
                                    <i class="bi bi-check-circle"></i>
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
    <div class="text-center">{{ $listBarangDiminta->links() }}</div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_konfirmasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Konfirmasi Jumlah Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="confirmasiPeminjamanBarang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'confirmasiPeminjamanBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        @error('id_laporan_pekerjaan_barang')
                            <div class="text-center">
                                <small class="text-center text-danger">{{ $message }}</small>
                            </div>
                        @enderror
                        @if ($barang)
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    SKU
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->sku }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->nama }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Harga
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->harga_formatted }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Satuan
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->satuan->nama_satuan }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Stock
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->stock }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Tipe Barang
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->tipeBarang->tipe_barang }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Deskripsi
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->deskripsi }}</span>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="mb-5">
                            <label for="" class="form-label required">Jumlah</label>
                            <input type="number" class="form-control form-control-solid" name="qty" wire:model="qty" placeholder="Jumlah barang" required>
                            @error('qty')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickAbaikan', async (id) => {
            const response = await alertConfirmCustom("Peringatan !", "Apakah kamu yakin ingin mengabaikan peminjangan barang ini?", 'Ya, Abaikan')
            if(response.isConfirmed == true){
                Livewire.emit('abaikanPeminjamanBarang', id)
            }
        })

        Livewire.on('onClickConfirm', (id) => {
            Livewire.emit('setLaporanPekerjaanBarang', id)
            $('#modal_konfirmasi').modal('show')
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })
    </script>
@endpush
