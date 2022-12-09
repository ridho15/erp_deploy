<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,simpanCheck', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md text-end">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                <th>No</th>
                <th>Proyek</th>
                <th>SKU</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Estimasi Peminjaman</th>
                <th>Jumlah / Qty</th>
                <th>Version</th>
                <th>Tipe Barang</th>
                <th>Status</th>
                <th>Yang Meminjamkan</th>
                <th>Peminjam</th>
                <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listBarangDikasih) > 0)
                @foreach ($listBarangDikasih as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ $item->laporanPekerjaan ? $item->laporanPekerjaan->kode_pekerjaan : '-'}}</td>
                        <td>
                            <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">
                                {{ $item->barang->sku }}
                            </a>
                        </td>
                        <td>{{ $item->barang ? $item->barang->nama : '-' }}</td>
                        <td>{{ $item->barang? $item->barang->satuan->nama_satuan : '-' }}</td>
                        <td>
                            @if ($item->estimasi)
                                {{ date('d-m-Y H:i', strtotime($item->estimasi)) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->version }} V</td>
                        <td>{{ $item->tipeBarang ? $item->tipeBarang->tipe_barang : '-' }}</td>
                        <td>
                            <span class="badge badge-warning">Diberikan</span>
                        </td>
                        <td>{{ $item->userMeminjamkan ? $item->userMeminjamkan->name : '-' }}</td>
                        <td>{{ $item->userPeminjam ? $item->userPeminjam->name : '-' }}</td>
                        <td>
                            @php
                                $laporanPekerjaanBarangLog = \App\Models\LaporanPekerjaanBarangLog::where('id_laporan_pekerjaan_barang', $item->id)
                                ->where('keterangan', 'LIKE', '%dikonfirmasi%')
                                ->orderBy('updated_at', 'ASC')->first();

                                if($laporanPekerjaanBarangLog){
                                    echo date('d-m-Y H:i', strtotime($laporanPekerjaanBarangLog->updated_at));
                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="12" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listBarangDikasih->links() }}</div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_laporan_pekerjaan"]').select2();
            $('select[name="id_tipe_barang"]').select2();
            $('select[name="version"]').select2();
            $('select[name="id_barang"]').select2();
        })

        $('select[name="id_laporan_pekerjaan"]').on('change', function(){
            @this.set('id_laporan_pekerjaan', $(this).val())
        });

        $('select[name="id_barang"]').on('change', function(){
            @this.set('id_barang', $(this).val())
        });

        $('select[name="id_tipe_barang"]').on('change', function(){
            @this.set('id_tipe_barang', $(this).val())
        });

        $('select[name="version"]').on('change', function(){
            @this.set('version', $(this).val())
        });

        Livewire.on('onClickBatalkan', async (id) => {
            const response = await alertConfirmCustom("Peringatan !", "Apakah kamu yakin ingin mengembalikan barang ke gudang?", 'Ya, Kembalikan')
            if(response.isConfirmed == true){
                Livewire.emit('balikanBarangPinjaman', id)
            }
        })

        Livewire.on('onClickKembalikan', (id) => {
            Livewire.emit('setBarangPinjaman', id)
            $('#modal_kembalikan_barang').modal('show')
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })

        Livewire.on('onClickTambahPeminjamanBarang', () => {
            $('#modal_tambah_peminjaman_barang').modal('show');
        })
    </script>
@endpush
