<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Daftar Tugas Selesai
            </h3>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusManagementTugas',
                    'message' => 'Memuat
                                data...',
                ])
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3 col-6">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
            <div class="tables w-100" style="position: relative !important">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                            <th>No</th>
                            <th>Nomor Pekerjaan</th>
                            <th>Project</th>
                            <th>Nomor Unit Lift</th>
                            <th>Pekerja</th>
                            <th>Tanggal Pekerjaan</th>
                            <th>Estimasi Selesai</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Form</th>
                            <th>Jumlah Service</th>
                            <th>No.MFG</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listLaporanPekerjaan) > 0)
                            @foreach ($listLaporanPekerjaan as $index => $item)
                                <tr>
                                    <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                    <td>{{ $item->kode_pekerjaan }}</td>
                                    <td>{{ $item->project ? $item->project->nama : '-' }}</td>
                                    <td>{{ $item->nomor_lift }}</td>
                                    <td>
                                        @foreach ($item->teknisi as $nama)
                                            {{ $nama->user ? $nama->user->name : '-' }},
                                        @endforeach
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal_pekerjaan)->locale('id')->isoFormat('DD/MM/YYYY') ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($item->tanggal_estimasi)
                                            {{ date('d-m-Y H:i', strtotime($item->tanggal_estimasi)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->jam_mulai_formatted ?? '-' }}</td>
                                    <td>
                                        {{ $item->jam_selesai_formatted ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($item->is_emergency_call == 1)
                                            <span class="badge badge-warning">Laporan Pekerjaan</span>
                                        @else
                                            {{ $item->periode }} Bulan
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->signature != null && $item->jam_selesai != null)
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif(count($item->teknisi) > 0 && $item->jam_mulai != null)
                                            <span class="badge badge-warning">Sedang Dikerjakan</span>
                                        @else
                                            <span class="badge badge-secondary">Belum Dikerjakan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td>{{ $item->formMaster->nama }} ({{ $item->formMaster->kode }})</td>
                                    <td>
                                        @php
                                            $jumlahService = 0;
                                            foreach ($item->formMaster->templatePekerjaan as $templatePekerjaan) {
                                                foreach ($templatePekerjaan->detail as $detail) {
                                                    $jumlahService++;
                                                }
                                            }

                                            echo $jumlahService;
                                        @endphp
                                    </td>
                                    <td>{{ $item->project ? $item->project->no_mfg : '-' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="17" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            </div>
            <div class="text-center">{{ $listLaporanPekerjaan->links() }}</div>
        </div>
    </div>
</div>
