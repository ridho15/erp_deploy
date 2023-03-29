<div>
    <div wire:ignore.self class="modal fade supplier" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Supplier</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataSupplier">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', [
                                'target' => 'simpanDataSupplier',
                                'message' => 'Menyimpan data ...',
                            ])
                        </div>
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="name"
                                    wire:model="name" placeholder="Masukkan nama" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email"
                                    wire:model="email" placeholder="Masukkan email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nomor Hp #1</label>
                                <input type="text" class="form-control form-control-solid" name="no_hp_1"
                                    wire:model="no_hp_1" placeholder="Masukkan nomor Hp" required>
                                @error('no_hp_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nomor Hp #2</label>
                                <input type="text" class="form-control form-control-solid" name="no_hp_2"
                                    wire:model="no_hp_2" placeholder="Masukkan nomor Hp" required>
                                @error('no_hp_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Telp #1</label>
                                <input type="text" class="form-control form-control-solid" name="telp_1"
                                    wire:model="telp_1" placeholder="Masukkan nomor Hp" required>
                                @error('telp_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Telp #2</label>
                                <input type="text" class="form-control form-control-solid" name="telp_2"
                                    wire:model="telp_2" placeholder="Masukkan nomor Hp" required>
                                @error('telp_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">PIC</label>
                                <input type="text" name="pic" class="form-control form-control-solid" wire:model="pic" placeholder="Masukkan nama PIC">
                                @error('pic')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Alamat</label>
                                <textarea name="alamat" class="form-control form-control-solid" wire:model="alamat"
                                    placeholder="Masukkan alamat lengkap"></textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-stack w-lg-50">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            wire:model="status" checked="checked" />
                                        <span class="form-check-label fw-semibold text-muted">
                                            Aktif
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">Produk</label>
                                <input type="text" name="produk" class="form-control form-control-solid" wire:model="produk" placeholder="Masukkan nama produk">
                                @error('produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
            select2()
        });

        window.addEventListener('contentChange', () => {
            select2()
        })

        function select2() {
            $('select[name="list_id_sales"]').select2()

            $('select[name="list_id_sales"]').on('change', function() {
                Livewire.emit('changeSales', $(this).val())
            })
        }

        Livewire.on("finishSimpanData", (status, message) => {
            $('#modal_form').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
