<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-10">
            <h3>Stock Minimum</h3>
            @if ($totalListBarang > 0)
                <div class="p-1 position-relative">
                    <div class="position-absolute d-flex align-items-center justify-content-center top-0 end-0 rounded-circle bg-danger" style="height: 20px; width: 20px">
                        <span class="fw-bold text-white">{{ $totalListBarang }}</span>
                    </div>
                    <a href="{{ route('laporan.spareparts') }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Semua">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table id="table_list_stock" class="table table-rounded table-striped border gy-7 gs-7">
                <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                <th>No</th>
                <th>SKU</th>
                <th>Nama</th>
                <th>Merek</th>
                <th>Stock</th>
                <th>Satuan</th>
                <th>Min.Stock</th>
                <th>Tipe Barang</th>
                <th>Deskripsi</th>
                <th>Status Stock</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 0;
                    @endphp
                    @foreach ($listBarang as $index => $item)
                        @if ($item->stock < $item->min_stock)
                                <tr>
                                    <td>{{ $nomor + 1 }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->merk ? $item->merk->nama_merk : '-' }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->satuan->nama_satuan }}</td>
                                    <td>{{ $item->min_stock }}</td>
                                    <td>{{ $item->tipeBarang->tipe_barang }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>
                                        @if ($item->stock < $item->min_stock)
                                            <span class="badge badge-danger">Stock Kurang</span>
                                        @else
                                            <span class="badge badge-success">Stock Cukup</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
                                                <i class="bi bi-info-circle-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        @endif
                        @php
                            $nomor++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
