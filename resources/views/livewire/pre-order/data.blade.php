<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                PO Masuk
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning mx-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data"
                    wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Manual / Add PO</button>
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
                            <span>Tipe pembayaran adalah cara melakukan pembayaran yang dilakukan client dangan salah
                                satu contoh : <strong>TOP, Payment Before Work, 3 Bulan dan lainnya</strong></span>
                        </li>
                        <li>
                            <span>Metode Pembayaran adalah cara client / customer melakukan pengiriman uang ke
                                perusahaan, contoh : <strong>semisal contoh TF dari bank mandiri, Cash, Link
                                    Aja</strong> </span>
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
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusPreOrder',
                    'message' => 'Memuat data...',
                ])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="tables w-100" style="position: relative !important">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                            <th>No</th>
                            <th>No Ref</th>
                            <th>Nomor/No Quotation</th>
                            <th>Customer</th>
                            <th>Project Name</th>
                            <th>Nomor Unit Lift</th>
                            <th>Status Pekerjaan</th>
                            <th>Status Pembayaran</th>
                            <th>Keterangan</th>
                            <th>File</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listPreOrder) > 0)
                            @foreach ($listPreOrder as $index => $item)
                                @if ($status_pembayaran != null)
                                    @if ($status_pembayaran == $item->status_pembayaran_kode)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->no_ref }}</td>
                                            <td>{{ $item->quotation ? $item->quotation->no_ref : '-' }}</td>
                                            <td>
                                                @if ($item->id_quotation != null)
                                                    {{ $item->quotation->projectUnit->project->customer->nama }}
                                                @else
                                                    {{ $item->projectUnit->project->customer->nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->id_quotation != null)
                                                    {{ $item->quotation->projectUnit->project->nama }}
                                                @elseif($item->id_project_unit != null)
                                                    {{ $item->projectUnit->project->nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->id_quotation != null)
                                                    {{ $item->quotation->projectUnit->no_unit }}
                                                    {{ $item->projectUnit->nama_unit }}
                                                @elseif($item->id_project_unit != null)
                                                    {{ $item->projectUnit->no_unit }}
                                                    {{ $item->projectUnit->nama_unit }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->quotation && $item->quotation->laporanPekerjaan)
                                                    @if ($item->quotation->laporanPekerjaan->signature != null && $item->quotation->laporanPekerjaan->jam_selesai != null)
                                                        <span class="badge badge-success">Selesai</span>
                                                    @elseif($item->quotation->laporanPekerjaan->jam_mulai != null)
                                                        <span class="badge badge-warning">Sedang Dikerjakan</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Dikerjakan</span>
                                                    @endif
                                                @else
                                                    Belum dikerjakan
                                                @endif
                                            </td>
                                            <td><?= $item->keterangan ?? '-' ?></td>
                                            <td>
                                                @if ($item->file)
                                                    <a href="{{ asset('storage' . $item->file) }}"
                                                        class="btn btn-sm btn-icon btn-light-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Download File">
                                                        <i class="fa-solid fa-file"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->user)
                                                    {{ $item->user->name }}
                                                @else
                                                    Dikonfirmasi Pelanggan
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Purchase Order" wire:click="$emit('onClickEdit', {{ $item }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button> --}}
                                                    <button class="btn btn-sm btn-icon btn-info"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Preview Purchase order"
                                                        wire:click="$emit('onClickPreview', {{ $item->id }})">
                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-icon btn-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Hapus Purchase Order"
                                                        wire:click="$emit('onClickHapus', {{ $item->id }})">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                    <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}"
                                                        class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Kelola Purchase Order"
                                                        target="blank">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->no_ref }}</td>
                                        <td>{{ $item->id_quotation != null ? $item->quotation->no_ref : '-' }}</td>
                                        <td>
                                            @if ($item->id_quotation != null)
                                                {{ $item->quotation->projectUnit->project->customer->nama }}
                                            @else
                                                {{ $item->projectUnit->project->customer->nama }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->id_quotation != null)
                                                {{ $item->quotation->projectUnit->project->nama }}
                                            @elseif($item->id_project_unit != null)
                                                {{ $item->projectUnit->project->nama }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->id_quotation != null)
                                                {{ $item->quotation->projectUnit->no_unit }}
                                                {{ $item->quotation->projectUnit->nama_unit }}
                                            @elseif($item->id_project_unit != null)
                                                {{ $item->projectUnit->no_unit }}
                                                {{ $item->projectUnit->nama_unit }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->quotation && $item->quotation->laporanPekerjaan)
                                                @if ($item->quotation->laporanPekerjaan->signature != null && $item->quotation->laporanPekerjaan->jam_selesai != null)
                                                    <span class="badge badge-success">Selesai</span>
                                                @elseif($item->quotation->laporanPekerjaan->jam_mulai != null)
                                                    <span class="badge badge-warning">Sedang Dikerjakan</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum Dikerjakan</span>
                                                @endif
                                            @else
                                                Belum Dikerjakan
                                            @endif
                                        </td>
                                        <td><?= $item->status_pembayaran ?></td>
                                        <td><?= $item->keterangan ?? '-' ?></td>
                                        <td>
                                            @if ($item->file)
                                                <a href="{{ asset('storage' . $item->file) }}"
                                                    class="btn btn-sm btn-icon btn-light-primary"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Download File">
                                                    <i class="fa-solid fa-file"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->user)
                                                {{ $item->user->name }}
                                            @else
                                                Dikonfirmasi Pelanggan
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-success"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Purchase Order"
                                                    wire:click="$emit('onClickEdit', {{ $item }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Hapus Purchase Order"
                                                    wire:click="$emit('onClickHapus', {{ $item->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Preview Purchase order"
                                                    wire:click="$emit('onClickPreview', {{ $item->id }})">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                                <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}"
                                                    class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Kelola Purchase Order"
                                                    target="blank">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center">{{ $listPreOrder->links() }}</div>
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
                        <label for="" class="form-label">Tanggal Purchase Order</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal_preorder"
                            wire:model="tanggal_preorder" data-dropdown-parent="#modal_filter"
                            placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_preorder')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Customer</label>
                        <select name="id_customer_filter" wire:model="id_customer_filter"
                            class="form-select form-select-solid" data-control="select2"
                            data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listCustomer as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">User</label>
                        <select name="id_user_filter" wire:model="id_user_filter"
                            class="form-select form-select-solid" data-control="select2"
                            data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listUser as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <option value="2">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" wire:model="status_pembayaran"
                            class="form-select form-select-solid" data-control="select2"
                            data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Bayar</option>
                            <option value="1">Belum Lunas</option>
                            <option value="2">Lunas</option>
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
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {});

        window.addEventListener('contentChange', function() {
            $('select[name="id_customer_filter"]').select2()
            $('select[name="id_user_filter"]').select2()
            $('select[name="status_pekerjaan"]').select2()
            $('select[name="status_pembayaran"]').select2()
        })

        $('select[name="id_customer_filter"]').on('change', function() {
            @this.set('id_customer_filter', $(this).val())
        })

        $('select[name="status_pembayaran"]').on('change', function() {
            @this.set('status_pembayaran', $(this).val())
        })

        $('select[name="status_pekerjaan"]').on('change', function() {
            @this.set('status_pekerjaan', $(this).val())
        })

        $('select[name="id_user_filter"]').on('change', function() {
            @this.set('id_user_filter', $(this).val())
        })

        Livewire.on('onClickTambah', () => {
            tinymce.activeEditor.setContent('')
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if (response.isConfirmed == true) {
                Livewire.emit('hapusPreOrder', id);
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickPreview', (id) => {
            Livewire.emit('setPurchaseOrderPreview', id)
            $('#modal_preview').modal('show')
        })
    </script>
@endpush
