<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Project</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanProject">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanProject', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Kode Project</label>
                                <input type="text" class="form-control form-control-solid" name="kode" wire:model="kode" placeholder="Masukkan kode" required>
                                @error('kode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Nama Project</label>
                                <input type="text" class="form-control form-control-solid" name="nama" wire:model="nama" placeholder="Masukkan nama" required>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Customer</label>
                                <select name="id_customer" class="form-select form-select-solid" wire:model="id_customer" data-control="select2" data-dropdown-parent="#modal_form" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listCustomer as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_customer) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">No Unit</label>
                                <input type="number" class="form-control form-control-solid" name="no_unit" wire:model="no_unit" placeholder="Masukkan Nomor Unit" required>
                                @error('no_unit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Alamat</label>
                                <input type="text" class="form-control form-control-solid" name="alamat" wire:model="alamat" placeholder="Masukkan alamat" required>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">No MFG</label>
                                <input type="number" class="form-control form-control-solid" name="no_mfg" wire:model="no_mfg" placeholder="Masukkan Nomor MFG" required>
                                @error('no_mfg')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Catatan</label>
                                <textarea name="catatan" wire:model="catatan" class="form-control form-control-solid" placeholder="Masukkan catatan"></textarea>
                                @error('no_unit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
        window.addEventListener('contentChange', function(){
            $('select[name="id_customer"]').select2()
        })

        $('select[name="id_customer"]').on('change', function(){
            @this.set('id_customer', $(this).val())
        })
        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
