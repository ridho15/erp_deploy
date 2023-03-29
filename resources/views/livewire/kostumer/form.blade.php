<div>
    <div wire:ignore.self class="modal fade kostumer" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Customer</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataKostumer">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataKostumer', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="nama" wire:model="nama" placeholder="Masukkan nama" required>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email" wire:model="email" placeholder="Masukkan email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">No Hp #1</label>
                                <input type="text" class="form-control form-control-solid" name="no_hp_1" wire:model="no_hp_1" placeholder="Ex: 0823 1234 5678">
                                @error('no_hp_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">No Hp #2</label>
                                <input type="text" class="form-control form-control-solid" name="no_hp_2" wire:model="no_hp_2" placeholder="Ex: 0823 1234 5678">
                                @error('no_hp_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">Telp #1</label>
                                <input type="text" class="form-control form-control-solid" name="telp_1" wire:model="telp_1" placeholder="Ex: 0823 1234 5678">
                                @error('telp_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label">Telp #1</label>
                                <input type="text" class="form-control form-control-solid" name="telp_2" wire:model="telp_2" placeholder="Ex: 0823 1234 5678">
                                @error('telp_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Alamat</label>
                                <textarea name="alamat" class="form-control form-control-solid" wire:model="alamat" placeholder="Masukkan alamat lengkap"></textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Barang Perlengkapan</label>
                                <textarea name="barang_customer" class="form-control form-control-solid" wire:model="barang_customer" placeholder="Masukkan barang customer"></textarea>
                                @error('barang_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">PPN (%)</label>
                                <input type="number" name="ppn" class="form-control form-control-solid" wire:model="ppn" placeholder="Masukkan nilai ppn" required>
                                @error('ppn')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="">PIC</label>
                                <select name="list_id_sales" class="form-control form-control-solid" wire:model="list_id_sales" data-dropdown-parent="#modal_form" data-control="select2" data-placeholder="Pilih PIC" multiple>
                                    <option value="">Pilih</option>
                                    @foreach ($listSales as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->no_hp }})</option>
                                    @endforeach
                                </select>
                                @error('list_id_sales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="d-flex flex-stack w-lg-50">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" wire:model="status" checked="checked"/>
                                        <span class="form-check-label fw-semibold text-muted">
                                            Aktif
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-5" wire:ignore>
                            <label for="" class="form-label">Barang</label>
                            <select name="id_barang_customer" wire:model="id_barang_customer" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" multiple>
                                <option value="">Pilih</option>
                                @foreach ($listBarangCustomer as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div> --}}

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
            select2()
        });
        
        window.addEventListener('contentChange', function(){
            select2()
        })

        function select2(){
            $('select[name="list_id_sales"]').select2();
            $('select[name="list_id_sales"]').on('change', function(){
                Livewire.emit('changeSales', $(this).val())
            });

            $('select[name="id_barang_customer"]').on('change', function(){
                @this.set('id_barang_customer', $(this).val())
            })
        }

        Livewire.on("finishSimpanData", (status, message) => {
            $('#modal_form').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
