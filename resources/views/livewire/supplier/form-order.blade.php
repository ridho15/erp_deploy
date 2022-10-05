<div>
    <div wire:ignore.self class="modal fade supplier" tabindex="-1" id="modal_form_order">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Supplier Order</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataSupplierOrder">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataSupplierOrder', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Supplier</label>
                            <select name="id_supplier" class="form-select form-select-solid" wire:model="id_supplier" data-control="select2" data-dropdown-parent="#modal_form_order" data-placeholder="Pilih">
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
                            <label for="" class="form-label required">Tanggal Order</label>
                            <input type="text" autocomplete="off" class="form-control form-control-solid" name="tanggal_order" wire:model="tanggal_order" placeholder="Tanggal Order" required>
                            @error('tanggal_order')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Status Order</label>
                            <select name="status_order" class="form-select form-select-solid" wire:model="status_order" data-control="select2" data-dropdown-parent="#modal_form_order" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listStatusOrder as $item)
                                    <option value="{{ $item['status_order'] }}" @if($item['status_order'] == $status_order) selected @endif>{{ $item['keterangan'] }}</option>
                                @endforeach
                            </select>
                            @error('status_order')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Tipe Pemayaran</label>
                            <select name="id_tipe_pembayaran" wire:model="id_tipe_pembayaran" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_order" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listTipePembayaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tipe }}</option>
                                @endforeach
                            </select>
                            @error('id_tipe_pembayaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
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
            $('input[name="tanggal_order"]').flatpickr()
        });

        window.addEventListener('contentChange', function(){
            $('input[name="tanggal_order"]').flatpickr()
            $('select[name="id_supplier"]').select2()
            $('select[name="status_order"]').select2()
            $('select[name="id_tipe_pembayaran"]').select2()
        })

        $('select[name="id_supplier"]').on('change', function(){
            Livewire.emit('changeSupplier', $(this).val())
        })

        $('select[name="status_order"]').on('change', function(){
            Livewire.emit('changeStatusOrder', $(this).val())
        })

        $('select[name="id_tipe_pembayaran"]').on('change', function(){
            Livewire.emit('changeTipePembayaran', $(this).val())
        })

        Livewire.on("finishSimpanData", (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
