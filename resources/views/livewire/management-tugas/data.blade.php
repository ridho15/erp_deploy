<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Management Tugas
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning mx-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data"
                    wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary mx-2" wire:click="$emit('onClickTambah')">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusManagementTugas',
                    'message' => 'Memuat data...',
                ])
            </div>
            <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3"
                            d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z"
                            fill="currentColor" />
                        <path
                            d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z"
                            fill="currentColor" />
                    </svg>
                </span>

                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h4 class="fw-semibold">Informasi</h4>
                    <ul>
                        <li>
                            <span>Jika unit tidak ditemukan setelah project di pilih. Silahkan isi data unit terlebih
                                dahulu pada bagian <strong>Project Master</strong>.</span>
                        </li>
                        <li>
                            <span>Untuk pembuatan management tugas dari quotation silahkan pilih quotation pada form
                                untuk membuat <strong>Management Tugas</strong> yang baru.</span>
                        </li>
                    </ul>
                </div>

                <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                fill="currentColor" />
                            <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(-45 9 13.0283)" fill="currentColor" />
                            <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                        </svg>
                    </span>
                </button>
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3 col-6">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
                <div class="col-md text-end">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Kirim Semua Ke Daftar Tugas" wire:click="$emit('onClickSendAll')">
                        <i class="fa-solid fa-share-from-square"></i> Send All
                    </button>
                </div>
            </div>

            {{-- <div class="table-responsive"> --}}
            <div class="tables w-100" style="position: relative !important">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                            <th>No</th>
                            <th>Nomor Pekerjaan</th>
                            <th>Project</th>
                            <th>Nomor Unit</th>
                            <th>Nomor PO</th>
                            <th>Pekerja</th>
                            <th>Tanggal Pekerjaan</th>
                            <th>Estimasi Selesai</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                    <td>{{ $item->no_ref }}</td>
                                    <td>{{ $item->projectUnit->project ? $item->projectUnit->project->nama : '-' }}</td>
                                    <td>{{ $item->projectUnit ? $item->projectUnit->no_unit . '  ' . $item->projectUnit->nama_unit : '-' }}
                                    </td>
                                    <td>
                                        @if (isset($item->projectUnit->purchaseOrder))
                                            {{ $item->projectUnit->purchaseOrder->no_ref }}
                                        @else
                                            -
                                        @endif
                                    </td>
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
                                        @if ($item->periode)
                                            {{ $item->periode }} Bulan
                                        @else
                                            -
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
                                        @if ($item->is_emergency_call == 1)
                                            <span class="badge badge-warning">Laporan Pekerjaan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('management-tugas.export', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" target="_blank"
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
                                            @if ($item->dikirim == 0)
                                                <button class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Kirim ke daftar tugas"
                                                    wire:click="$emit('onClickKirim', {{ $item->id }})">
                                                    <i class="bi bi-send"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('management-tugas.detail', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Lihat Detail Pekerjaan">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->projectUnit->project->customer->nama }}</td>
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
            {{-- </div> --}}
            <div class="text-center">{{ $listLaporanPekerjaan->links() }}</div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter Data</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', [
                            'target' => 'simpanMetodePembayaran',
                            'message' => 'Menyimpan data ...',
                        ])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Pekerjaan</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal_pekerjaan"
                            wire:model="tanggal_pekerjaan" data-dropdown-parent="#modal_filter"
                            placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Project</label>
                        <select name="id_project" wire:model="id_project" class="form-select form-select-solid"
                            data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listProject as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pekerjaan</label>
                        <select name="status_pekerjaan" wire:model="status_pekerjaan"
                            class="form-select form-select-solid" data-control="select2"
                            data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Dikerjakan</option>
                            <option value="1">Sedang Dikerjakan</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter"
                        data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            select2();
        });

        window.addEventListener('contentChange', function() {
            select2()
        })

        function select2() {
            $('select[name="status_pekerjaan"]').select2();
            $('select[name="id_project"]').select2();
            $('select[name="status_pekerjaan"]').on('change', function() {
                @this.set('status_pekerjaan', $(this).val())
            })

            $('select[name="id_project"]').on('change', function() {
                @this.set('id_project', $(this).val())
            })
        }


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
            const response = await alertConfirm("Peringatan !",
                "Apakah kamu yakin ingin menghapus management tugas ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusManagementTugas', id)
            }
        })

        Livewire.on('onClickAturJadwal', (id) => {
            Livewire.emit('setDataLaporanPekerjaan', id)
            $('#modal_atur_jadwal').modal('show');
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickSendAll', async () => {
            const response = await alertConfirmCustom('Peringatan !',
                "Apakah kamu yakin ingin mengirim semua data yang belum masuk daftar tugas ke daftar tugas ?",
                'Ya, Kirim')
            if (response.isConfirmed == true) {
                Livewire.emit('sendAllData')
            }
        })
    </script>
@endpush
