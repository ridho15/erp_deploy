<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Quotation
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data"
                    wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Manual</button>
            </div>
        </div>
        <div class="card-body">
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
                            <span>Untuk Status Konfirmasi pada quotation, cara konfirmasi quotation adalah dari pihak project/client dengan cara buka pesan pada <strong>Email</strong> yang sudah dikirimkan quotation, lalu tekan konfirmasi pada pesan yang sudah dikirimkan.</span>
                        </li>
                        <li>
                            <span>Untuk Status pekerjaan pada quotation akan update setelah pekerjaan sedang di kerjakan, pekerjaan selesai, dan semua yang berkaitan tentang pekerjaan yang sudah di buat pada management tugas.</span>
                        </li>
                        <li>
                            <span>Untuk Status Kirim pada quotation akan update setelah melakukan pengiriman quotation pada customer.</span>
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
            <div class="text-center">
                @include('helper.simple-loading', ['target' => null, 'message' => 'Memuat data...'])
            </div>
            @include('helper.alert-message')
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="tables w-100" style="position: relative !important;">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky"
                            style="overflow-x: auto">
                            <th>No</th>
                            <th>No. Ref</th>
                            <th>Kode Project</th>
                            <th>Nama Project</th>
                            <th>Pelanggan</th>
                            <th>Sales</th>
                            <th>Status Pekerjaan</th>
                            <th>Status Kirim</th>
                            <th>Status Konfirmasi</th>
                            <th>Dibuat pada</th>
                            <th>Status Quotation</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listQuotation) > 0)
                            @foreach ($listQuotation as $index => $item)
                                <tr>
                                    <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                    <td>{{ $item->no_ref }}</td>
                                    <td>{{ $item->projectUnit->project->kode }}</td>
                                    <td>{{ $item->projectUnit->project->nama }}</td>
                                    <td>{{ $item->projectUnit->project->customer->nama }}</td>
                                    <td>
                                        @if (count($item->quotationSales) > 0)
                                            @foreach ($item->quotationSales as $quotationSales)
                                                {{ $quotationSales->sales->nama }},
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->laporanPekerjaan)
                                            @if ($item->laporanPekerjaan->jam_selesai != null && $item->laporanPekerjaan->signature)
                                                <span class="badge badge-success">Selesai</span>
                                            @elseif ($item->laporanPekerjaan->jam_mulai != null)
                                                <span class="badge badge-secondary">Sedang dikerjakan</span>
                                            @else
                                                <span class="badge badge-warning">Belum Dikerjakan</span>
                                            @endif
                                        @else
                                            Quotation Dibuat Manual
                                        @endif
                                    </td>
                                    <td><?= $item->status_formatted ?></td>
                                    <td>
                                        @if ($item->konfirmasi == 0)
                                            <span class="badge badge-danger">Belum dikonfirmasi</span>
                                        @else
                                            <span class="badge badge-success">Sudah dikonfirmasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->dibuat_pada }}
                                    </td>
                                    <td>
                                        @if ($item->status_like === 1)
                                            <span class="badge badge-success">Quotation Berhasil</span>
                                        @elseif($item->status_like === 0)
                                            <span class="badge badge-danger">Quotation Gagal</span>
                                        @elseif($item->status_like === 2)
                                            <span class="badge badge-primary">PO Sudah Dibuat</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Quotation"
                                                wire:click="$emit('onClickEdit', {{ $item }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <a href="{{ route('quotation.detail', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Detail Quotation">
                                                <i class="bi bi-info-circle-fill"></i>
                                            </a>
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus Quotation"
                                                wire:click="$emit('onClickHapus', {{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @if ($item->status_like === null)
                                                <button class="btn btn-sm btn-icon btn-danger"
                                                    wire:click="$emit('onClickQuotationGagal', {{ $item->id }})"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Quotation Gagal">
                                                    <i class="fa-solid fa-thumbs-down"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-primary"
                                                    wire:click="quotationBerhasil({{ $item->id }})"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Quotation Berhasil">
                                                    <i class="fa-solid fa-thumbs-up"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('quotation.export', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Export Quotation">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Kirim Quotation Ke Email Pelanggan"
                                                wire:click="$emit('onClickSend', {{ $item->id }})">
                                                <i class="fa-solid fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </td>
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
            <div class="text-center">{{ $listQuotation->links() }}</div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter Data</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', [
                            'target' => null,
                            'message' => 'Menyimpan data ...',
                        ])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal_dibuat"
                            wire:model="tanggal_dibuat" data-dropdown-parent="#modal_filter"
                            placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_dibuat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Kode Project</label>
                        <select name="id_project" wire:model="id_project" class="form-select form-select-solid"
                            data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listProject as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Quotation</label>
                            <select name="status_quotation" wire:model="status_quotation"
                                class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Quotation Gagal</option>
                                <option value="1">Quotation Berhasil</option>
                                <option value="2">Po Sudah Dibuat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Pekerjaan</label>
                            <select name="status_pekerjaan" wire:model="status_pekerjaan"
                                class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Belum Dikerjakan</option>
                                <option value="1">Sedang Dikerjakan</option>
                                <option value="2">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Kirim</label>
                            <select name="status_kirim" wire:model="status_kirim"
                                class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Belum Dikirim</option>
                                <option value="1">Sudah Dikirim</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Konfirmasi</label>
                            <select name="status_konfirmasi" wire:model="status_konfirmasi"
                                class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Belum Dikonfirmasi</option>
                                <option value="1">Sudah Dikonfirmasi</option>
                            </select>
                        </div>
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
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {});
        window.addEventListener('contentChange', function() {
            $('select[name="id_project"]').select2();
        })

        $('select[name="id_project"]').on('change', function() {
            @this.set('id_project', $(this).val())
        })
        Livewire.on('onClickEdit', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '')
            Livewire.emit('setDataQuotation', item.id)
            $('#modal_form_quotation').modal('show')
        })

        Livewire.on('onClickTambah', () => {
            $('#modal_form_manual').modal('show')
        })

        Livewire.on('onClickSend', async (id) => {
            const response = await alertConfirmCustom('Pemberitahuan !',
                'Apakah kamu yakin ingin mengirim quotation ke pelanggan ?', 'Ya, Kirim');
            if (response.isConfirmed == true) {
                Livewire.emit('sendQuotationToCustomer', id)
            }
        })

        Livewire.on('finishRefreshData', (status, message) => {
            alertMessage(status, message);
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if (response.isConfirmed == true) {
                Livewire.emit('hapusQuotation', id)
            }
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickQuotationGagal', async (id) => {
            const response = await alertConfirmCustom('Peringatan !', "Apakah quotation benar gagal ?",
                "Ya, Gagal")
            if (response.isConfirmed == true) {
                Livewire.emit('quotationGagal', id)
            }
        })
    </script>
@endpush
