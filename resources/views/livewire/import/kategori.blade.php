<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_import">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Import Kategori</h3>
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
                            'target' => 'simpanData',
                            'message' => 'Menyimpan data ...',
                        ])
                    </div>
                    <small for="" class="form-label">Contoh Header Untuk Import Data</small>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>nama_kategori</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="text-center mt-7">

                        <label for="file"
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-success required mb-5">
                            <i class="fa-solid fa-file-import"></i> Pilih File
                        </label>
                        <div class="text-center" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <input type="file" id="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                class="form-control form-control-solid mb-5" hidden name="file" wire:model="file"
                                required>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="progress mt-3" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @if ($file != null)
                                <small class="text-center mt-5">
                                    {{ $file->getClientOriginalName() }}
                                    <span wire:click="clearFile" style="cursor: pointer;">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </span>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="simpanData" class="btn btn-primary btn-sm"><i
                            class="bi bi-box-arrow-down"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script></script>
@endpush
