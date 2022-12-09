<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-10">
            <h3>Penjadwalan</h3>
            @if ($totalPekerjaanHariIni > 0)
                <div class="p-1 position-relative">
                    <div class="position-absolute d-flex align-items-center justify-content-center top-0 end-0 rounded-circle bg-danger" style="height: 20px; width: 20px">
                        <span class="fw-bold text-white">{{ $totalPekerjaanHariIni }}</span>
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
               <th>Kode Pekerjaan</th>
               <th>Project</th>
               <th>Nomor Lift</th>
               <th>Worker</th>
               <th>Jam Mulai</th>
               <th>Aksi</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listPekerjaanHariIni) > 0)
                    @foreach ($listPekerjaanHariIni as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_pekerjaan }}</td>
                            <td>{{ $item->project->kode }} {{ $item->project->nama }}</td>
                            <td>{{ $item->nomor_lift }}</td>
                            <td>{{ $item->user ? $item->user->name : '-' }}</td>
                            <td>{{ $item->jam_mulai_formatted }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Barang">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
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
    </div>
</div>
