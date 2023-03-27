<div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-10">
                <h3>Account Receivable</h3>
                @if ($totalPreOrder > 0)
                    <div class="p-1 position-relative">
                        <div class="position-absolute d-flex align-items-center justify-content-center top-0 end-0 rounded-circle bg-danger" style="height: 20px; width: 20px">
                            <span class="fw-bold text-white">{{ $totalPreOrder }}</span>
                        </div>
                        <a href="{{ route('laporan.account-receivable') }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Semua">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                   <th>No</th>
                   <th>No Ref</th>
                   <th>Kode Quotation</th>
                   <th>Customer</th>
                   <th>Pembuat</th>
                   <th>Tipe Pembayaran</th>
                   <th>Metode Pembayaran</th>
                   <th>Status Pembayaran</th>
                   <th>Keterangan</th>
                   <th>File</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listPreOrder) > 0)
                        @foreach ($listPreOrder as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->no_ref }}</td>
                                <td>{{ $item->quotation? $item->quotation->no_ref : '-' }}</td>
                                <td>{{ $item->projectUnit->project->customer ? $item->projectUnit->project->customer->nama : '-'}} {{ $item->customer ? $item->customer->kode : '-' }}</td>
                                <td>
                                    @if ($item->user)
                                        {{ $item->user->name }}
                                    @else
                                        Dikonfirmasi Pelanggan
                                    @endif
                                </td>
                                <td>{{ $item->tipePembayaran ? $item->tipePembayaran->nama_tipe : '-' }}</td>
                                <td>
                                    @if ($item->metodePembayaran)
                                        {{ $item->metodePembayaran->nama_metode }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><?= $item->status_pembayaran ?></td>
                                <td><?= $item->keterangan ?? '-' ?></td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ asset('storage' . $item->file) }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download File">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Pre Order" target="blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
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
