<div>
    <div wire:ignore.self class="modal fade pre-order" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Pre Order</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataPreOrder">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataPreOrder', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Customer</label>
                                <select name="id_customer" wire:model="id_customer" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listCustomer as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->kode }}</option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Quotation</label>
                                <select name="id_quotation" class="form-select form-select-solid" wire:model="id_quotation" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listQuotation as $item)
                                        <option value="{{ $item->id }}">{{ $item->no_ref }}</option>
                                    @endforeach
                                </select>
                                @error('id_quotation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Tipe Pembayaran</label>
                                <select name="id_tipe_pembayaran" class="form-select form-select-solid" wire:model="id_tipe_pembayaran" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listTipePembayaran as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_tipe }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipe_pembayaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Metode Pembayaran</label>
                                <select name="id_metode_pembayaran" class="form-select form-select-solid" wire:model="id_metode_pembayaran" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listMetodePembayaran as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_metode }}</option>
                                    @endforeach
                                </select>
                                @error('id_metode_pembayaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-5" wire:ignore>
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                            wire:ignore
                        >
                            <label for="" class="form-label">File</label>
                            <input type="file" id="file" name="file" wire:model="file" class="form-control form-control-solid" hidden accept=".jpg,.png,.jpeg,.docx,.pdf,.xlsx">
                            <div class="text-center">
                                <label for="file" class="btn btn-sm btn-outline btn-outline-primary btn-outline-dashed btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih File">
                                    <i class="fa-solid fa-file"></i> Upload File
                                </label>
                            </div>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($file)
                                <div class="d-flex align-items-center justify-content-center mt-5">
                                    <span class="me-5">{{ $file->getClientOriginalName() }}</span>
                                    <span class="" wire:click="hapusFile" style="cursor: pointer">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </span>
                                </div>
                            @endif
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
            refreshSelect()
        });
        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide');
            alertMessage(status, message)
        })

        tinymce.init({
            selector: 'textarea[name="keterangan"]',
            forced_root_block: false,
            setup: function(editor){
                editor.on('init change', function(){
                    editor.save()
                });
                editor.on('change', function(e){
                    // @this.set('keterangan', editor.getContent())
                    Livewire.emit('changeKeterangan', editor.getContent())
                })
            }
        });

        window.addEventListener('contentChange', function(){
            refreshSelect()
        })

        function refreshSelect(){
            $('select[name="id_quotation"]').select2();
            $('select[name="id_customer"]').select2();
            $('select[name="id_tipe_pembayaran"]').select2();
            $('select[name="id_metode_pembayaran"]').select2();

            $('select[name="id_quotation"]').on('change', function(){
                @this.set('id_quotation', $(this).val())
            });

            $('select[name="id_customer"]').on('change', function(){
                @this.set('id_customer', $(this).val())
            });

            $('select[name="id_tipe_pembayaran"]').on('change', function(){
                @this.set('id_tipe_pembayaran', $(this).val())
            });

            $('select[name="id_metode_pembayaran"]').on('change', function(){
                @this.set('id_metode_pembayaran', $(this).val())
            });
        }
    </script>
@endpush
