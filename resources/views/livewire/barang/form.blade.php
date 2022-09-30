<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataBarang">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama</label>
                            <input type="text" class="form-control form-control-solid" name="nama" wire:model="nama" placeholder="Masukkan nama" required>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Merk</label>
                            <select name="id_merk" class="form-select form-select-solid" wire:model='id_merk' data-control="select2">
                                <option value="">Pilih</option>
                                @foreach ($listMerk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_merk }}</option>
                                @endforeach
                            </select>
                            @error('id_merk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Harga</label>
                            <input type="number" class="form-control form-control-solid" name="harga" wire:model="harga" placeholder="Masukkan harga" required>
                            @error('harga')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Stock</label>
                            <input type="text" class="form-control form-control-solid" name="stock" wire:model="stock" placeholder="Masukkan stok" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Tipe Barang</label>
                            <select name="tip_barang" class="form-select form-select-solid" wire:model='tipe_barang' data-control="select2">
                                <option value="">Pilih</option>
                            </select>
                            @error('min_stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-stack w-lg-50">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" wire:model="status" checked="checked"/>
                                <span class="form-check-label fw-semibold text-muted">
                                    Aktif
                                </span>
                            </label>
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
            $('#modal_form').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
