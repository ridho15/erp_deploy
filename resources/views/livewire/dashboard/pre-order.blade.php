<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-10">
            <h3>Pre Order Penagihan</h3>
            @if (count($listPreOrder) > 0)
                <div class="p-1 position-relative">
                    <div class="position-absolute d-flex align-items-center justify-content-center top-0 end-0 rounded-circle bg-danger" style="height: 20px; width: 20px">
                        <span class="fw-bold text-white">{{ count($listPreOrder) }}</span>
                    </div>
                    <a href="{{ route('management-tugas') }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Semua">
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
               <th>Quotation</th>
               <th>Tipe Pembayaran</th>
               <th>Keterangan</th>
               <th>Status</th>
               <th>Aksi</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listPreOrder) > 0)
                    @foreach ($listPreOrder as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($item->quotation)
                                    {{ $item->quotation->no_ref }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->tipePembayaran ? $item->tipePembayaran->nama_tipe : '-' }}</td>
                            <td>{{ $item->keterangan ? $item->keterangan : '-' }}</td>
                            <td><?= $item->status_formatted ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Barang">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
             </tbody>
            </table>
        </div>
    </div>
</div>
