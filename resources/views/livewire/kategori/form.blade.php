<div>
    <div wire:ignore.self class="modal fade kostumer" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Kategori</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataKategori">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataKategori', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama</label>
                            <input type="text" class="form-control form-control-solid" name="nama_kategori" wire:model="nama_kategori" placeholder="Masukkan nama kategori" required>
                            @error('nama_kategori')
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

        window.addEventListener('contentChange', function(){
        })

        Livewire.on("finishSimpanData", (status, message) => {
            $('.modal').modal('hide')
            console.log('testing');
            alertMessage(status, message)
        })
    </script>
@endpush
