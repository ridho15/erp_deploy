<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Rak</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanRak">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanRak', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Kode Rak</label>
                            <input type="text" class="form-control form-control-solid" name="kode_rak" wire:model="kode_rak" placeholder="Masukkan nama metode" required>
                            @error('kode_rak')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama Rak</label>
                            <input type="text" class="form-control form-control-solid" name="nama_rak" wire:model="nama_rak" placeholder="Masukkan nama metode" required>
                            @error('nama_rak')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5" wire:ignore>
                            <label for="" class="form-label required">Warna Rak</label>
                            <select name="warna_rak" class="form-select form-select-solid" wire:model="warna_rak" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                                <option value="secondary">Secondary</option>
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                            </select>
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
        Livewire.on('finishSimpanData', (status, message) => {
            $(".modal").modal('hide')
            alertMessage(status, message)
        })

        window.addEventListener('contentChange', function(){
            $('select[name="warna_rak"]').select2();
        })

        $('select[name="warna_rak"]').on('change', function(){
            @this.set('warna_rak', $(this).val())
        })
    </script>
@endpush
