<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_project_detail_sub_foto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Foto</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanfoto', 'message' => 'Menyimpan data ...'])
                    </div>
                    <form action="#" method="POST" wire:submit="simpanFoto">
                        <div class="mb-5"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="" class="form-label required">Masukkan Foto</label>
                            <input type="file" name="file" class="form-control form-control-solid" wire:model="file" required accept="image/*" multiple>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Foto">
                                Simpan
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        @foreach ($listFoto as $item)
                            <div class="col-md-4">
                                <img src="{{ asset('storage' . $item->file) }}" class="img-fluid rounded" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
