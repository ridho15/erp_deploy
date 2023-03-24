<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Project
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusProject',
                    'message' => 'Memuat data...',
                ])
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Penanggung Jawab</th>
                            <th>Email</th>
                            <th>No Handphone</th>
                            <th>Customer</th>
                            <th>Alamat</th>
                            <th>Catatan</th>
                            <th>No Unit</th>
                            <th>No MFG</th>
                            <th>Sales</th>
                            <th>Lokasi</th>
                            <th>Tanggal Project</th>
                            <th>Total Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listProject) > 0)
                            @foreach ($listProject as $index => $item)
                                <tr>
                                    <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->penanggung_jawab }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->catatan }}</td>
                                    <td>
                                        @foreach ($item->listUnit as $unit)
                                            ({{ $unit->no_unit }} {{ $unit->nama_unit }})
                                            ,
                                        @endforeach
                                    </td>
                                    <td>{{ $item->no_mfg }}</td>
                                    <td>
                                        @foreach ($item->salesProject as $salesProject)
                                            {{ $salesProject->sales->nama }},
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($item->map)
                                            <a href="{{ $item->map }}"
                                                class="btn btn-sm btn-icon btn-outline btn-outline-success"
                                                target="_blank">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->tanggal)
                                            {{ date('d-m-Y', strtotime($item->tanggal)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $total_pekerjaan_selesai = 0;
                                            foreach ($item->listUnit as $index => $unit) {
                                                if ($unit->laporanPekerjaan != null) {
                                                    if ($unit->laporanPekerjaan->signature != null && $unit->laporanPekerjaan->jam_selesai != null) {
                                                        $total_pekerjaan_selesai++;
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{ $total_pekerjaan_selesai }} / {{ $item->total_pekerjaan }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Project"
                                                wire:click="$emit('onClickEdit', {{ $item->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Isi Data Unit"
                                                wire:click="$emit('onClickUnit', {{ $item->id }})">
                                                <i class="fas fa-circle-info"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus Project"
                                                wire:click="$emit('onClickHapus', {{ $item->id }})">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center">{{ $listProject->links() }}</div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {

        });

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataProject', id)
            $('#modal_form').modal("show")
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if (response.isConfirmed == true) {
                Livewire.emit('hapusProject', id)
            }
        })

        Livewire.on('onClickUnit', (id) => {
            Livewire.emit('setProjectInUnit', id)
            $('#modal_form_unit').modal('show')
        })
    </script>
@endpush
