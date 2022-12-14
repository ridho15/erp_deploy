<div class="mb-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('rak') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                Isi Rak
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success mx-2" wire:click="$emit('onClickEdit', {{ $id_rak }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Rak"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-outline btn-outline-primary mx-2" wire:click="$emit('onClickTambah', {{ $id_rak }})"><i class="bi bi-plus-circle"></i> Tambah Isi Rak</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusIsiRak', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3">
                    <a href="{{ route('rak.detail', ['id' => $id_rak]) }}">
                        <div class="d-flex align-items-center bg-light-{{ $rak->warna_rak }} rounded p-5 mb-7">
                            <span class="svg-icon svg-icon-{{ $rak->warna_rak }} svg-icon-1 me-5">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                    <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="flex-grow-1 me-2">
                                <a href="{{ route('rak.detail', ['id' => $id_rak]) }}" class="fw-bold text-gray-800 text-hover-{{ $rak->warna_rak }} fs-6">{{ $rak->kode_rak }}</a>
                                <span class="text-muted fw-semibold d-block">{{ $rak->nama_rak }}</span>
                            </div>
                            <span class="fw-bold text-{{ $rak->warna_rak }} py-1">Jumlah Jenis Barang {{ count($rak->isiRak) }}</span>
                        </div>
                    </a>
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>SKU</th>
                   <th>Nama Barang</th>
                   <th>Merk</th>
                   <th>Satuan</th>
                   <th>Jumlah</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listIsiRak) > 0)
                        @foreach ($listIsiRak as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">{{ $item->barang->sku }}</a>
                                </td>
                                <td>{{ $item->barang->nama }}</td>
                                <td>{{ $item->barang->merk ? $item->barang->merk->nama_merk : '-' }}</td>
                                <td>{{ $item->barang->satuan->nama_satuan }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Barang di rak" wire:click="$emit('onClickEditIsiRak', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Barang dari rak" wire:click="$emit('onClickHapusIsiRak', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Pindah Rak" wire:click="$emit('onClickPindahRak', {{ $item->id }})">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambah', (id) => {
            $('#modal_form_isi_rak').modal('show')
            Livewire.emit('setIdRak', id)
        })

        Livewire.on('onClickEdit', (id) => {
            $('#modal_form').modal('show')
            Livewire.emit('setIdRak', id)
        })

        Livewire.on('onClickEditIsiRak', (id) => {
            $('#modal_form_isi_rak').modal('show')
            Livewire.emit('setIsiRak', id)
        })

        Livewire.on('onClickHapusIsiRak', async (id) => {
            const response = await alertConfirm('Peringatan', 'Apakah kamu yakin ingin menghapus barang dari rak ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusIsiRak', id)
            }
        })

        Livewire.on('onClickPindahRak', (id) => {
            $('#modal_form_pindah_rak').modal('show')
            Livewire.emit('setIsiRak', id)
        })
    </script>
@endpush
