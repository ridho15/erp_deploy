<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Management Tugas
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusManagementTugas', 'message' => 'Memuat
                data...'])
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
                            <th class="sticky" scope="col">Tanggal Pekerjaan</th>
                            <th class="sticky" scope="col">Jam Mulai</th>
                            <th class="sticky" scope="col">Jam Selesai</th>
                            <th class="sticky" scope="col">Keterangan</th>
                            <th class="sticky" scope="col">Status</th>
                            <th class="sticky" scope="col">Aksi</th>
                            <th class="sticky" scope="col">Form</th>
                            <th class="sticky" scope="col">Jumlah Service</th>
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
                            <td>{{ Carbon\Carbon::parse($item->tanggal_pekerjaan)->locale('id')->isoFormat('DD/MM/YYYY')
                                ?? '-' }}</td>
                            <td>{{ $item->jam_mulai_formatted ?? '-' }}</td>
                            <td>{{ $item->jam_selesai_formatted ?? '-' }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                @if ($item->signature != null && $item->jam_selesai != null)
                                <span class="badge badge-success">Selesai</span>
                                @elseif($item->user != null && $item->jam_mulai != null)
                                <span class="badge badge-warning">Sedang Dikerjakan</span>
                                @else
                                <span class="badge badge-secondary">Belum Dikerjakan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('management-tugas.export', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Cetak Management Tugas">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                    @if ($item->jam_selesai == null && $item->signatur == null)
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Management Tugas"
                                        wire:click="$emit('onClickEdit', {{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Management Tugas"
                                        wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Atur Jadwal Tugas"
                                        wire:click="$emit('onClickAturJadwal', {{ $item->id }})">
                                        <i class="bi bi-stopwatch"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Kirim ke daftar tugas"
                                        wire:click="$emit('onClickKirim', {{ $item->id }})">
                                        <i class="bi bi-send"></i>
                                    </button>
                                    <a href="{{ route('management-tugas.detail', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Lihat Detail Pekerjaan">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </div>
                            </td>
                            <td>{{ $item->formMaster->nama }} ({{ $item->formMaster->kode }})</td>
                            <td>
                                @php
                                $jumlahService = 0;
                                foreach($item->formMaster->templatePekerjaan as $templatePekerjaan){
                                foreach ($templatePekerjaan->detail as $detail) {
                                $jumlahService ++;
                                }
                                }

                                echo $jumlahService;
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="13" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{--
            </div> --}}
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
        Livewire.on('onClickKirim', (id) => {
            Livewire.emit('setKirim', id);
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus management tugas ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusManagementTugas', id)
            }
        })

        Livewire.on('onClickAturJadwal', (id) => {
            Livewire.emit('setDataLaporanPekerjaan', id)
            $('#modal_atur_jadwal').modal('show');
        })
</script>
@endpush
