<div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_stock_opname">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Form Stock Opname</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-circle"></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <form action="#" wire:submit.prevent="simpanStockOpname">
                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanStockOpname', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" class="form-select form-select-solid" wire:model="id_barang" data-control="select2" data-dropdown-parent="#modal_form_stock_opname" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->merk ? $item->merk->nama_merk : '-' }})</option>
                                @endforeach
                            </select>
                            @error('id_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Jumlah Tercatat</label>
                            <input type="number" step="0.001" class="form-control form-control-solid" name="jumlah_tercatat" wire:model="jumlah_tercatat" placeholder="Masukkan jumlah tercatat" disabled required>
                            @error('jumlah_tercatat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Jumlah Mutasi</label>
                            <input type="number" step="0.001" class="form-control form-control-solid" name="jumlah_mutasi" wire:model="jumlah_mutasi" placeholder="Masukkan jumlah mutasi">
                            @error('jumlah_mutasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Jumlah Terjual</label>
                            <input type="number" step="0.001" class="form-control form-control-solid" name="jumlah_terjual" wire:model="jumlah_terjual" placeholder="Masukkan jumlah terjual">
                            @error('jumlah_terjual')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Jumlah Terbaru</label>
                            <input type="number" step="0.001" class="form-control form-control-solid" name="jumlah_terbaru" wire:model="jumlah_terbaru" placeholder="Masukkan jumlah terbaru">
                            @error('jumlah_terbaru')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" class="form-control form-control-solid" name="tanggal_input" wire:model="tanggal_input" placeholder="Masukkan tanggal">
                            @error('tanggal_input')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control form-control-solid" wire:model="keterangan" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
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

@push('js')
    <script>
        window.addEventListener('contentChange', function(){
            $('select[name="id_barang"]').select2()
        })


        $('select[name="id_barang"]').on('change', function(){
            Livewire.emit('changeBarang', $(this).val())
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
