<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Daftar Tugas
            </h3>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            {{-- <div class="table-responsive"> --}}
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th class="sticky" scope="col">No</th>
                   <th class="sticky" scope="col">Customer</th>
                   <th class="sticky" scope="col">Project</th>
                   <th class="sticky" scope="col">Nomor Lift</th>
                   <th class="sticky" scope="col">Merk</th>
                   <th class="sticky" scope="col">Pekerja</th>
                   <th class="sticky" scope="col">Jam Mulai</th>
                   <th class="sticky" scope="col">Jam Selesai</th>
                   <th class="sticky" scope="col">Keterangan</th>
                   <th class="sticky" scope="col">Signature</th>
                   <th class="sticky" scope="col">Status</th>
                   <th class="sticky" scope="col">Aksi</th>
                   <th class="sticky" scope="col">Kode Pekerjaan</th>
                   <th class="sticky" scope="col">Form</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listLaporanPekerjaan) > 0)
                        @foreach ($listLaporanPekerjaan as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                <td>{{ $item->customer->nama }}</td>
                                <td>{{ $item->project->nama }}</td>
                                <td>{{ $item->nomor_lift }}</td>
                                <td>{{ $item->merk->nama_merk }}</td>
                                <td>
                                    @foreach ($item->teknisi as $nama)
                                        {{ $nama->user->name }},
                                    @endforeach
                                </td>
                                <td>{{ $item->jam_mulai_formatted ?? '-' }}</td>
                                <td>{{ $item->jam_selesai_formatted ?? '-' }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    @if ($item->signature)
                                        <img src="{{ asset('storage/' . $item->signature) }}" class="img-fluid" alt="">
                                    @else
                                        <div class="text-center text-gray-500">
                                            Belum ditanda tangan
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->signature != null && $item->jam_selesai != null)
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($item->jam_mulai != null)
                                        <span class="badge badge-warning">Sedang Dikerjakan</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Dikerjakan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if (!$item->teknisi->where('id_user', session()->get('id_user'))->first())
                                            <a href="{{ route('daftar-tugas.ambil', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Ambil Tugas">
                                                <i class="fa-solid fa-hand-holding-heart"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('management-tugas.export', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <a href="{{ route('daftar-tugas.kelola', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Tugas">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $item->kode_pekerjaan }}</td>
                                <td>{{ $item->formMaster->nama }} ({{ $item->formMaster->kode }})</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="14" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            {{-- </div> --}}
            <div class="text-center">{{ $listLaporanPekerjaan->links() }}</div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('finishRefreshData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataManagementTugas', id);
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus management tugas ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusManagementTugas', id)
            }
        })
    </script>
@endpush
