<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Quotation
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data" wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Manual</button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => null, 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="tables w-100" style="position: relative !important;">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky" style="overflow-x: auto">
                        <th>No</th>
                        <th>No. Ref</th>
                        <th>Kode Project</th>
                        <th>Nama Project</th>
                        <th>Pelanggan</th>
                        <th>Sales</th>
                        <th>Status Pekerjaan</th>
                        <th>Status Kirim</th>
                        <th>Konfirmasi</th>
                        <th>Dibuat pada</th>
                        <th>Status Quotation</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($listQuotation) > 0)
                        @foreach ($listQuotation as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show  + $index + 1 }}</td>
                                <td>{{ $item->no_ref }}</td>
                                <td>{{ $item->laporanPekerjaan ? $item->laporanPekerjaan->project->kode : '-' }}</td>
                                <td>{{ $item->laporanPekerjaan ? $item->laporanPekerjaan->project->nama : '-' }}</td>
                                <td>
                                    @if ($item->laporanPekerjaan)
                                        {{ $item->laporanPekerjaan->customer->kode }} {{ $item->laporanPekerjaan->customer->nama }}
                                    @elseif($item->customer)
                                        {{ $item->customer->kode }} {{ $item->customer->nama }}
                                    @endif
                                </td>
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
                                        @if($item->laporanPekerjaan->jam_selesai != null && $item->laporanPekerjaan->signature)
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
                                {{-- <td>
                                    @if ($item->file)
                                        <a href="{{ $item->file ? asset('storage' . $item->file) : '#' }}" class="btn btn-icon btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Dowload File" target="blank">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    @else
                                        <div class="text-center text-gray-500">
                                            Tidak ada file
                                        </div>
                                    @endif
                                </td> --}}
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
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Quotation" wire:click="$emit('onClickEdit', {{ $item }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="{{ route('quotation.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Quotation">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
                                        @if ($item->status_like === null)
                                            <button class="btn btn-sm btn-icon btn-danger" wire:click="$emit('onClickQuotationGagal', {{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Quotation Gagal">
                                                <i class="fa-solid fa-thumbs-down"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-primary" wire:click="quotationBerhasil({{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Quotation Berhasil">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('quotation.export', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Quotation">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Quotation Ke Email Pelanggan" wire:click="$emit('onClickSend', {{ $item->id }})">
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

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanMetodePembayaran', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Dibuat</label>
                        <input type="text" class="form-control form-control-solid" name="tanggal_dibuat" wire:model="tanggal_dibuat" data-dropdown-parent="#modal_filter" placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_dibuat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Kode Project</label>
                        <select name="id_project" wire:model="id_project" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listProject as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Kirim</label>
                            <select name="status_kirim" wire:model="status_kirim" class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Belum Dikirim</option>
                                <option value="1">Sudah Dikirim</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Status Konfirmasi</label>
                            <select name="status_konfirmasi" wire:model="status_konfirmasi" class="form-select form-select-solid" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="0">Belum Dikonfirmasi</option>
                                <option value="1">Sudah Dikonfirmasi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter" data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {
            $('input[name="tanggal_dibuat"]').flatpickr()
        });
        window.addEventListener('contentChange', function(){
            $('select[name="id_project"]').select2();
        })

        $('select[name="id_project"]').on('change', function(){
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

        Livewire.on('onClickSend', async(id) => {
            const response = await alertConfirmCustom('Pemberitahuan !', 'Apakah kamu yakin ingin mengirim quotation ke pelanggan ?', 'Ya, Kirim');
            if(response.isConfirmed == true){
                Livewire.emit('sendQuotationToCustomer', id)
            }
        })

        Livewire.on('finishRefreshData', (status, message) => {
            alertMessage(status, message);
        })

        Livewire.on('onClickHapus', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusQuotation', id)
            }
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickQuotationGagal', async (id) => {
            const response = await alertConfirmCustom('Peringatan !', "Apakah quotation benar gagal ?", "Ya, Gagal")
            if(response.isConfirmed == true){
                Livewire.emit('quotationGagal', id)
            }
        })
    </script>
@endpush
