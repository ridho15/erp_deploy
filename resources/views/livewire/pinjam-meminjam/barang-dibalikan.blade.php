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
                <th>Nama Proyek</th>
                <th>SKU</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Estimasi Kembali</th>
                <th>Jumlah / Qty</th>
                <th>Label</th>
                <th>Nomor ITT/ITS</th>
                <th>Tipe Barang</th>
                <th>Catatan Teknisi</th>
                <th>Status</th>
                <th>Yang Menerima</th>
                <th>Peminjam</th>
                <th>Tanggal Peminjaman</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listBarangDibalikan) > 0)
                @foreach ($listBarangDibalikan as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ isset($item->laporanPekerjaan->projectUnit->project) ? $item->laporanPekerjaan->projectUnit->project->nama : null }}</td>
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
                        <td>{{ isset($item->nomorItt) ? $item->nomorItt->nomor_itt : '-' }}</td>
                        <td>{{ $item->tipeBarang ? $item->tipeBarang->tipe_barang : '-' }}</td>
                        <td>{{ $item->catatan_teknisi }}</td>
                        <td><?= $item->status_formatted ?></td>
                        <td>{{ $item->userPenerima ? $item->userPenerima->name : '-' }}</td>
                        <td>{{ $item->userPeminjam ? $item->userPeminjam->name : '-' }}</td>
                        <td>
                            @php
                                $laporanPekerjaanBarangLog = \App\Models\LaporanPekerjaanBarangLog::where('id_laporan_pekerjaan_barang', $item->id)
                                ->where('status', 3)
                                ->orderBy('updated_at', 'ASC')
                                ->first();

                                if($laporanPekerjaanBarangLog){
                                    echo date('d-m-Y H:i', strtotime($laporanPekerjaanBarangLog->updated_at));
                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listBarangDibalikan->links() }}</div>
</div>
