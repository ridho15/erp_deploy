<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                PO Masuk
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusPreOrder', 'message' => 'Memuat data...'])
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
                   <th>Kode Quotation</th>
                   <th>Customer</th>
                   <th>User</th>
                   <th>Tipe Pembayaran</th>
                   <th>Metode Pembayaran</th>
                   <th>Status</th>
                   <th>Keterangan</th>
                   <th>File</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listPreOrder) > 0)
                        @foreach ($listPreOrder as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->quotation? $item->quotation->no_ref : '-' }}</td>
                                <td>{{ $item->customer ? $item->customer->nama : '-'}} {{ $item->customer ? $item->customer->kode : '-' }}</td>
                                <td>
                                    @if ($item->user)
                                        {{ $item->user->name }}
                                    @else
                                        Dikonfirmasi Pelanggan
                                    @endif
                                </td>
                                <td>{{ $item->tipePembayaran->nama_tipe }}</td>
                                <td>
                                    @if ($item->metodePembayaran)
                                        {{ $item->metodePembayaran->nama_metode }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><?= $item->status_formatted ?></td>
                                <td><?= $item->keterangan ?? '-' ?></td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ asset('storage' . $item->file) }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download File">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pre Order" wire:click="$emit('onClickEdit', {{ $item }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pre order" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Pre Order" target="blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
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
            <div class="text-center">{{ $listPreOrder->links() }}</div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambah', () => {
            tinymce.activeEditor.setContent('')
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async(id) =>{
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusPreOrder', id);
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
