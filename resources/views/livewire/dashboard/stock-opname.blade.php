<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-10">
            <h3>Stock Opname</h3>
            @if ($totalStockOpname > 0)
                <div class="p-1 position-relative">
                    <div class="position-absolute d-flex align-items-center justify-content-center top-0 end-0 rounded-circle bg-danger" style="height: 20px; width: 20px">
                        <span class="fw-bold text-white">{{ $totalStockOpname }}</span>
                    </div>
                    <a href="{{ route('laporan.stock-opname') }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Semua">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </div>
            @endif
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
               <th>Dilakukan Oleh</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listStockOpname) > 0)
                    @foreach ($listStockOpname as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->barang->sku }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->barang->merk ? $item->barang->merk->nama_merk : null }}</td>
                            <td>{{ $item->jumlah_tercatat ?? 0 }}</td>
                            <td>{{ $item->jumlah_mutasi ?? 0 }}</td>
                            <td>{{ $item->jumlah_terjual ?? 0 }}</td>
                            <td>{{ $item->jumlah_terbaru ?? 0 }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                            <td>
                                {{ $item->user ? $item->user->name : '-' }}
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
