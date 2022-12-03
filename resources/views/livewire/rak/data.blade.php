<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Rak
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambah')"><i class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusRak', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>
            <div class="row">
                @if (count($listRak) > 0)
                    @foreach ($listRak as $item)
                        <div class="col-md-4">
                            <a href="{{ route('rak.detail', ['id' => $item->id]) }}">
                                <div class="d-flex align-items-start bg-light-{{ $item->warna_rak }} rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-{{ $item->warna_rak }} svg-icon-1 me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('rak.detail', ['id' => $item->id]) }}" class="fw-bold text-gray-800 text-hover-{{ $item->warna_rak }} fs-6">{{ $item->kode_rak }}</a>
                                        <span class="text-muted fw-semibold d-block">{{ $item->nama_rak }}</span>
                                    </div>
                                    <div class="fw-bold text-{{ $item->warna_rak }} py-1 d-flex flex-column text-end">
                                        <span>Jumlah Jenis Barang {{ count($item->isiRak) }}</span>
                                        <span class="text-danger" style="cursor: pointer" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            {{-- <i class="fa-solid fa-trash text-danger"></i> --}}
                                            Hapus
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center text-gray-500">
                        Belum ada rak
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){

        })

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus rak ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusRak', id)
            }
        })
    </script>
@endpush
