<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form_quotation">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Quotation</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="updateDataQuotation">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', [
                                'target' => 'updateDataQuotation',
                                'message' => 'Menyimpan data ...',
                            ])
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Kode Project
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold"></span>
                                <span
                                    class="fw-bold">{{ $quotation && $quotation->project ? $quotation->project->kode : '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Nama Project
                            </div>
                            <div class="col-md-8 col-8">
                                : <span
                                    class="fw-bold">{{ $quotation && $quotation->project ? $quotation->project->nama : '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Nama Penanggung Jawab
                            </div>
                            <div class="col-md-8 col-8">
                                : <span
                                    class="fw-bold">{{ $quotation && isset($quotation->project) ? $quotation->project->penanggung_jawab : '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Email Pelanggan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span
                                    class="fw-bold">{{ $quotation && isset($quotation->project) ? $quotation->project->email: '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                No Hp Pelanggan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span
                                    class="fw-bold">{{ $quotation && isset($quotation->project) ? $quotation->project->no_hp : '-' }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Sales
                            </div>
                            <div class="col-md-8 col-8">
                                : @if (isset($quotation->quotationSales) && count($quotation->quotationSales) > 0)
                                    <span class="fw-bold">
                                        @foreach ($quotation->quotationSales as $item)
                                            {{ $item->sales->nama }},
                                        @endforeach
                                    </span>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Keterangan
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold"><?= $quotation ? $quotation->keterangan : '-' ?></span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Hal
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold"><?= $quotation ? $quotation->hal : '-' ?></span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Status
                            </div>
                            <div class="col-md-8 col-8">
                                : <span
                                    class="fw-bold"><?= $quotation ? $quotation->status_formatted : null ?></span>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="mb-5" wire:ignore>
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid"
                                placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Perihal</label>
                            <textarea name="hal" class="form-control form-control-solid" wire:model="hal" placeholder="Masukkan perihal"></textarea>
                            @error('hal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Sales</label>
                            <select name="listIdSales" wire:model="listIdSales" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih" multiple>
                                <option value="">Pilih</option>
                                @foreach ($listSales as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('listIdSales')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="" class="form-label">File</label>
                            <input type="file" name="file" wire:model="file"
                                accept="application/pdf,application/vnd.ms-excel,.docx" id="pilih_file" hidden>
                            <div class="text-center">
                                <label for="pilih_file"
                                    class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload File">
                                    <i class="fa-solid fa-file"></i> Pilih File
                                </label>
                            </div>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            <div class="text-center">
                                @if ($file)
                                    {{ $file->getClientOriginalName() }} <span class="text-danger mx-2"
                                        style="cursor: pointer" wire:click="onClickHapusFile"><i
                                            class="fa-solid fa-trash-can text-danger fs-2"></i></span>
                                @endif
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form_manual">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Quotation</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataQuotation">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', [
                                'target' => 'file,simpanDataQuotation',
                                'message' => 'Menyimpan data ...',
                            ])
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Customer</label>
                                <select name="id_customer" wire:model="id_customer"
                                    class="form-select form-select-solid" data-control="select2"
                                    data-dropdown-parent="#modal_form_manual" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listCustomer as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode }} {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Project</label>
                                <select name="id_project" wire:model="id_project"
                                    class="form-select form-select-solid" data-control="select2"
                                    data-dropdown-parent="#modal_form_manual" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listProject as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode }} {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_project')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-5" wire:ignore>
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid"
                                placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Perihal</label>
                            <textarea name="hal" class="form-control form-control-solid" wire:model="hal" placeholder="Masukkan perihal"></textarea>
                            @error('hal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Sales</label>
                            <select name="listIdSales" wire:model="listIdSales" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih" multiple>
                                <option value="">Pilih</option>
                                @foreach ($listSales as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('listIdSales')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="" class="form-label">File</label>
                            <div class="text-center">
                                <label for="pilih_file2"
                                    class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload File">
                                    <i class="fa-solid fa-file"></i> Pilih File
                                </label>
                            </div>
                            <input type="file" name="file" wire:model="file"
                                accept="application/pdf,application/vnd.ms-excel,.docx" id="pilih_file2" hidden>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            <div class="text-center">
                                @if ($file)
                                    {{ $file->getClientOriginalName() }} <span class="text-danger mx-2"
                                        style="cursor: pointer" wire:click="onClickHapusFile"><i
                                            class="fa-solid fa-trash-can text-danger fs-2"></i></span>
                                @endif
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            refreshSelect()
        });

        function refreshSelect() {
            $('select[name="id_customer"]').select2();
            $('select[name="id_project"]').select2();

            $('select[name="id_customer"]').on('change', function() {
                Livewire.emit('changeCustomer', $(this).val())
            })

            $('select[name="id_project"]').on('change', function() {
                Livewire.emit('changeProject', $(this).val())
            })

            $('select[name="listIdSales"]').select2();
            $('select[name="listIdSales"]').on('change', function() {
                Livewire.emit('changeSales', $(this).val())
            });
        }

        tinymce.init({
            selector: 'textarea[name="keterangan"]',
            forced_root_block: false,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save()
                });
                editor.on('change', function(e) {
                    Livewire.emit('changeKeterangan', editor.getContent())
                })
            }
        });

        window.addEventListener('contentChange', function() {
            refreshSelect()
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })
    </script>
@endpush
