<div>
    <div class="card-header">
        <h3 class="card-title">Gambar Barang</h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambahGambar')" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Gambar">
                <i class="bi bi-plus"></i> Tambah Gambar
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('helper.alert-message')
        @if (count($listBarangGambar) > 0)
            <div class="d-flex align-items-center justify-content-start">
                @foreach ($listBarangGambar as $item)
                    <div class="position-relative image-hover me-2" wire:click="$emit('onClickHapusGambar', {{ $item->id }})">
                        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </div>
                        <img src="{{ asset('storage' . $item->file) }}" alt="" class="" width="100" height="100" style="object-fit: cover">
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500">Belum ada gambar</div>
        @endif
    </div>

    <div wire:ignore.self class="modal fade tambah-gambar" tabindex="-1" id="modal_tambah_gambar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Tambah Gambar</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataGambar">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataGambar', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="" class="form-label required">Pilih Gambar</label>
                            <input type="file" class="form-control form-control-solid" name="file" wire:model="file" placeholder="Pilih Gambar" required accept="image/*" multiple>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('file.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambahGambar', () => {
            $('#modal_tambah_gambar').modal('show')
        })

        Livewire.on("onClickHapusGambar", async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus gambar ?");
            if(response.isConfirmed == true){
                Livewire.emit('hapusGambar', id)
            }
        })
    </script>
@endpush
