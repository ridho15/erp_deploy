<div>
    <div wire:ignore.self class="modal fade project" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Project</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataProject">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataProject', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Customer</label>
                            <select name="id_customer" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" wire:model="id_customer" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                @foreach ($listCustomer as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_customer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama Project</label>
                            <input type="text" class="form-control form-control-solid" name="nama_project" wire:model="nama_project" placeholder="Masukkan nama project" required>
                            @error('nama_project')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Alamat Project</label>
                            <input type="text" class="form-control form-control-solid" name="alamat_project" wire:model="alamat_project" placeholder="Masukkan alamat project">
                            @error('alamat_project')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Keterangan Project</label>
                            <textarea name="keterangan_project" wire:model="keterangan_project" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan_project')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-stack w-lg-50">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="diketahui_pelanggan" type="checkbox" value="1" wire:model="diketahui_pelanggan" checked="checked"/>
                                <span class="form-check-label fw-semibold text-muted">
                                    Diketahui Pelanggan
                                </span>
                            </label>
                            @error('diketahui_pelanggan')
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
            $('select[name="id_customer"]').select2()
        })

        $('select[name="id_customer"]').on('change', function(){
            // Livewire.emit('changeCustomer', $(this).val())
            // @this.set('id_customer', $(this).val())
            Livewire.emit('changeCustomer', $(this).val())
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
