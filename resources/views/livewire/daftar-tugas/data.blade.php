<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Daftar Tugas
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data" wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
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
                <div class="tables w-100" style="position: relative; !important">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                                <th>No</th>
                                <th>Customer</th>
                                <th>Project</th>
                                <th>Pekerja</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Kode Pekerjaan</th>
                                <th>Form</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listLaporanPekerjaan) > 0)
                                @foreach ($listLaporanPekerjaan as $index => $item)
                                <tr>
                                    <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td>{{ $item->project ? $item->project->nama : '-' }}</td>
                                    <td>
                                        @foreach ($item->teknisi as $nama)
                                        {{ $nama->user->name }},
                                        @endforeach
                                    </td>
                                    <td>{{ $item->jam_mulai_formatted ?? '-' }}</td>
                                    <td>
                                        @if ($item->jam_selesai)
                                            {{ $item->jam_selesai_formatted }}
                                        @elseif($item->tanggal_estimasi)
                                            {{ date('d-m-Y H:i', strtotime($item->tanggal_estimasi)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_emergency_call == 1)
                                            <span class="badge badge-warning">Laporan Pekerjaan</span>
                                        @else
                                            {{ $item->periode }} Bulan
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if ($item->signature)
                                        <img src="{{ asset('storage/' . $item->signature) }}" class="img-fluid" alt="">
                                        @else
                                        <div class="text-center text-gray-500">
                                            Belum ditanda tangan
                                        </div>
                                        @endif
                                    </td> --}}
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
                                            {{-- <a href="{{ route('daftar-tugas.ambil', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ambil Tugas">
                                                <i class="fa-solid fa-hand-holding-heart"></i>
                                            </a> --}}
                                            @endif
                                            <a href="{{ route('management-tugas.export', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Export PDF">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail Tugas" wire:click="$emit('onClickDetailTugas', {{ $item->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            {{-- <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Kembalikan ke management tugas"
                                                wire:click="$emit('onClickKirim', {{ $item->id }})">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </button> --}}
                                            <a href="{{ route('daftar-tugas.kelola', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Kelola Tugas">
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
                                <td colspan="15" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{--
            </div> --}}
            <div class="text-center">{{ $listLaporanPekerjaan->links() }}</div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter Data</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanMetodePembayaran', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Pekerjaan</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal_pekerjaan" wire:model="tanggal_pekerjaan" data-dropdown-parent="#modal_filter" placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Project</label>
                        <select name="id_project" wire:model="id_project" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listProject as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pekerjaan</label>
                        <select name="status_pekerjaan" wire:model="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Dikerjakan</option>
                            <option value="1">Sedang Dikerjakan</option>
                            <option value="2">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter" data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_detail_tugas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detail Tugas</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanMetodePembayaran', 'message' => 'Menyimpan data ...'])
                    </div>
                    @if ($laporanPekerjaan != null)
                    <div class="row mb-7">
                        <div class="col-md-6 mb-10">
                            <div class="mb-5 fw-bold">
                                Customer
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->customer->nama }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    No HP
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->customer->no_hp }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Email
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->customer->no_hp }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Alamat
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->customer->alamat }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Barang Perlengkapan
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->customer->barang_customer }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <div class="mb-5 fw-bold">
                                Project
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->nama : '-' }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Kode
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->kode : '-' }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    No Unit
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_unit : '-' }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    No MFG
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_mfg : '-' }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Alamat
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->alamat : '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <div class="mb-5 fw-bold">
                                Data Tambahan
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Merk
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->merk->nama_merk }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama Form
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->formMaster->nama }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Kode Form
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->formMaster->kode }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nomor Lift
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : {{ $laporanPekerjaan->nomor_lift }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Teknisi
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : @foreach ($laporanPekerjaan->teknisi as $item)
                                        {{ $item->user->name }},
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Periode
                                </div>
                                <div class="col-md-8 col-8 fw-bold">
                                    : @if ($laporanPekerjaan->is_emergency_call == 1)
                                        <span class="badge badge-warning">Laporan Pekerjaan</span>
                                    @else
                                        {{ $laporanPekerjaan->periode }} Bulan
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <div class="mb-5">
                                <div class="mb-3">Catatan Teknisi : </div>
                                <div class="row">
                                    @if (count($laporanPekerjaan->catatanTeknisiPekerjaan) > 0)
                                        @foreach ($laporanPekerjaan->catatanTeknisiPekerjaan as $item)
                                            <div class="col-md fw-bold">
                                                {{ $item->keterangan }} ({{ $item->status == 1 ? "Ya" : "Tidak" }}),
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 text-center text-gray-500">
                                            Belum ada catatan
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="mb-3">Keterangan Pelanggan :</div>
                                <div class="fw-bold">
                                    {{ $laporanPekerjaan->catatan_pelanggan }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
        $(document).ready(function () {
        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_project"]').select2();
            $('select[name="status_pekerjaan"]').select2();
        })

        $('select[name="id_project"]').on('change', function(){
            @this.set('id_project', $(this).val())
        })

        $('select[name="status_pekerjaan"]').on('change', function(){
            @this.set('status_pekerjaan', $(this).val())
        })

        Livewire.on('finishRefreshData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickKirim', (id) => {
            Livewire.emit('setKirim', id);
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

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickDetailTugas', (id) => {
            Livewire.emit('setLaporanPekerjaan', id)
            $("#modal_detail_tugas").modal('show')
        })
</script>
@endpush
