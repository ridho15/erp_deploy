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
            @if (count($listBarangDipinjam) > 0)
                @foreach ($listBarangDipinjam as $index => $item)
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
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Peminjaman Barang" wire:click="$emit('onClickBatalkan', {{ $item->id }})">
                                    <i class="bi bi-x-circle"></i>
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
    <div class="text-center">{{ $listBarangDipinjam->links() }}</div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickBatalkan', async (id) => {
            const response = await alertConfirmCustom("Peringatan !", "Apakah kamu yakin ingin mengembalikan barang ke gudang?", 'Ya, Kembalikan')
            if(response.isConfirmed == true){
                Livewire.emit('balikanBarangPinjaman', id)
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })
    </script>
@endpush
