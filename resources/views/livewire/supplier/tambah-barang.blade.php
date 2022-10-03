<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_tambah_supplier_barang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Barang</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanSupplierBarang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanSupplierBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Supplier</label>
                            <select name="id_supplier" wire:model="id_supplier" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_supplier_barang" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listSupplier as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('id_supplier')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_supplier_barang" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_barang')
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
        Livewire.on('onFinishTambahBarang', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        window.addEventListener('contentChange', function(){
            $('select[name="id_supplier"]').select2()
            $('select[name="id_barang"]').select2()
        })

        $('select[name="id_supplier"]').on('change',function(){
            @this.set('id_supplier', $(this).val())
        })

        $('select[name="id_barang"]').on('change',function(){
            @this.set('id_barang', $(this).val())
        })
    </script>
@endpush
