<div>
    <h4>Project Foto</h4>
    <div class="text-end">
        <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Foto" wire:click="$emit('onClickTambahFoto')">
            <i class="bi bi-plus-circle"></i> Tambah
        </button>
    </div>
    @include('helper.alert-message')
    @if (count($listProjectFoto) > 0)
        <div class="row mt-5">
            @foreach ($listProjectFoto as $item)
                <div class="col-md-3">
                    <div class="image-hover position-relative">
                        <div class="position-absolute w-25 h-25 d-flex align-items-center justify-content-center py-3" wire:click="$emit('onClickHapusFoto', {{ $item->id }})">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </div>
                        <a href="{{ asset('storage' . $item->file) }}" class="glightbox">
                            <img src="{{ asset('storage' . $item->file) }}" alt="Foto" class="img-fluid">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 mt-5">Belum ada foto</div>
    @endif
    <div wire:ignore.self class="modal fade project-foto" tabindex="-1" id="modal_tambah_foto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Foto Project</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanFoto">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanFoto', 'message' => 'Menyimpan data ...'])
                        </div>
                        @error('id_project')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="mb-5"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="" class="form-label required">Pilih Gambar</label>
                            <input type="file" class="form-control form-control-solid" name="gambar" wire:model="gambar" placeholder="Pilih Gambar" required accept="image/jpg, image/png, image/jpeg" multiple>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @error('gambar.*')
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
            const lightbox = GLightbox();
        });

        Livewire.on('onClickTambahFoto', () => {
            $('#modal_tambah_foto').modal('show')
        })

        Livewire.on('onClickHapusFoto', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus foto ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusFoto', id)
            }
        })
    </script>
@endpush
