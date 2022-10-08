<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Quotation
            </h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
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
                   <th>Project</th>
                   <th>Customer</th>
                   <th>Status Response</th>
                   <th>Tipe Pembayaran</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listQuotation) > 0)
                        @foreach ($listQuotation as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show  + $index + 1 }}</td>
                                <td>{{ $item->id_project }}</td>
                                <td>{{ $item->project->nama_project }}</td>
                                <td>{{ $item->project->customer->nama }}</td>
                                <td><?= $item->status_response_formatted ?></td>
                                <td>{{ $item->tipePembayaran? $item->tipePembayaran->nama_tipe : '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Quotation" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        {{-- <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Hapus" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button> --}}
                                        <a href="{{ route('quotation.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Quotation">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
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
    <script>
        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataQuotation', id)
            $('#modal_form').modal('show')
        })
    </script>
@endpush
