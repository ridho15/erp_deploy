<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                History Peminjaman Barang
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>SKU</th>
                   <th>Barang</th>
                   <th>Satuan</th>
                   <th>Jumlah</th>
                   <th>Status</th>
                   <th>Tanggal</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listHistoryPeminjamanBarang) > 0)
                        @foreach ($listHistoryPeminjamanBarang as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                <td>{{ $item->laporanPekerjaanBarang->barang->sku }}</td>
                                <td>{{ $item->laporanPekerjaanBarang->barang->nama }}</td>
                                <td>{{ $item->laporanPekerjaanBarang->barang->satuan->nama_satuan }}</td>
                                <td>{{ $item->laporanPekerjaanBarang->qty }}</td>
                                <td><?= $item->status_formatted ?></td>
                                <td>{{ $item->tanggal_formatted }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
            {{ $listHistoryPeminjamanBarang->links() }}
        </div>
    </div>
</div>
