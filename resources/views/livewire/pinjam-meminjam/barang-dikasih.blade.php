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
                <th>Nama Proyek</th>
                <th>SKU</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Estimasi Kembali</th>
                <th>Jumlah / Qty</th>
                <th>Version</th>
                <th>Nomor ITT/ITS</th>
                <th>Tipe Barang</th>
                <th>Status</th>
                <th>Yang Meminjamkan</th>
                <th>Peminjam</th>
                <th>Tanggal Dikasih</th>
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
                        <td>{{ $item->nomorItt ? $item->nomorItt->nomor_itt : '-' }}</td>
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
                    <td colspan="15" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listBarangDikasih->links() }}</div>
</div>
