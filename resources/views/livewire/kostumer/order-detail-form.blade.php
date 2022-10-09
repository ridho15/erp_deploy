<div>
    <div wire:ignore.self class="modal fade kostumer" tabindex="-1" id="modal_form_order_detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Order Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataOrderBarang">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataOrderBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_order_detail" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label require">Total Barang</label>
                            <input type="number" name="total_barang" wire:model="total_barang" class="form-control form-control-solid" placeholder="Masukkan Total Barang" required>
                            @error('total_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Status Order</label>
                            <select name="status_order" wire:model="status_order" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_order_detail" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listStatusOrder as $item)
                                    <option value="{{ $item['status_order'] }}">{{ $item['keterangan'] }}</option>
                                @endforeach
                            </select>
                            @error('status_order')
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

        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_barang"]').select2()
            $('select[name="status_order"]').select2()
        })

        $('select[name="id_barang"]').on('change', function(){
            Livewire.emit('changeBarang', $(this).val())
        })

        $('select[name="status_order"]').on('change', function(){
            Livewire.emit('statusOrderChange', $(this).val())
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide');
            alertMessage(status, message);
        })
    </script>
@endpush
