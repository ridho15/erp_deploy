<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Quotation
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Manual</button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,sendQuotationToCustomer', 'message' => 'Memuat data...'])
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
                   <th>Kode Project</th>
                   <th>Nama Project</th>
                   <th>Pelanggan</th>
                   <th>Email Pelanggan</th>
                   <th>No Hp Pelanggan</th>
                   <th>Status</th>
                   <th>Keterangan</th>
                   <th>Hal</th>
                   <th>File</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listQuotation) > 0)
                        @foreach ($listQuotation as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show  + $index + 1 }}</td>
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
                                    @if ($item->laporanPekerjaan)
                                        {{ $item->laporanPekerjaan->customer->email }}
                                    @elseif($item->customer)
                                        {{ $item->customer->email }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->laporanPekerjaan)
                                        {{ $item->laporanPekerjaan->customer->no_hp }}
                                    @elseif($item->customer)
                                        {{ $item->customer->no_hp }}
                                    @endif
                                </td>
                                <td><?= $item->status_formatted ?></td>
                                <td><?= $item->keterangan ?></td>
                                <td>{{ $item->hal }}</td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ $item->file ? asset('storage' . $item->file) : '#' }}" class="btn btn-icon btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Dowload File" target="blank">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    @else
                                        <div class="text-center text-gray-500">
                                            Tidak ada file
                                        </div>
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
                            <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
            <div class="text-center">{{ $listQuotation->links() }}</div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        Livewire.on('onClickEdit', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '')
            Livewire.emit('setDataQuotation', item.id)
            $('#modal_form').modal('show')
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
    </script>
@endpush
