<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Barang</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataBarang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', [
                                'target' => 'simpanDataBarang',
                                'message' => 'Menyimpan data ...',
                            ])
                        </div>
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">SKU</label>
                                <input type="text" class="form-control form-control-solid" name="nomor"
                                    wire:model="nomor" placeholder="Masukkan nomor" required>
                                @error('nomor')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="nama"
                                    wire:model="nama" placeholder="Masukkan nama" required>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Version</label>
                                <select name="version" class="form-select form-select-solid" wire:model="version"
                                    data-control="select2" data-drodown-parent="#modal_form" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listVersion as $item)
                                        <option value="{{ $item }}">{{ $item }} V</option>
                                    @endforeach
                                </select>
                                @error('version')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Harga Modal</label>
                                <input type="number" class="form-control form-control-solid" name="harga_modal"
                                    wire:model="harga_modal" placeholder="Masukkan harga" required>
                                @error('harga_modal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Tipe Barang</label>
                                <select name="id_tipe_barang" class="form-select form-select-solid"
                                    wire:model='id_tipe_barang' data-dropdown-parent="#modal_form"
                                    data-placeholder="Pilih" data-control="select2">
                                    <option value="">Pilih</option>
                                    @foreach ($listTipeBarang as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_barang }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipe_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Harga</label>
                                <input type="number" class="form-control form-control-solid" name="harga"
                                    wire:model="harga" placeholder="Masukkan harga" required>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Stock</label>
                                <input type="number" class="form-control form-control-solid" name="stock"
                                    wire:model="stock" placeholder="Masukkan stock" required>
                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Minimal Stock</label>
                                <input type="number" class="form-control form-control-solid" name="min_stock"
                                    wire:model="min_stock" placeholder="Masukkan stok" required>
                                @error('min_stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Merk</label>
                                <select name="id_merk" class="form-select form-select-solid" wire:model='id_merk'
                                    data-dropdown-parent="#modal_form" data-placeholder="Pilih" data-control="select2"
                                    required>
                                    <option value="">Pilih</option>
                                    @foreach ($listMerk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_merk }}</option>
                                    @endforeach
                                </select>
                                @error('id_merk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Satuan</label>
                                <select name="id_satuan" class="form-select form-select-solid" wire:model='id_satuan'
                                    data-dropdown-parent="#modal_form" data-placeholder="Pilih"
                                    data-control="select2">
                                    <option value="">Pilih</option>
                                    @foreach ($listSatuan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_satuan }}</option>
                                    @endforeach
                                </select>
                                @error('id_satuan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" wire:model="deskripsi" class="form-control form-control-solid"
                                    placeholder="Masukkan deskripsi barang"></textarea>
                                @error('deskripsi')
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

        window.addEventListener('contentChange', function() {
            select2()
        })

        function select2() {
            $('select[name="id_tipe_barang"]').select2();
            $('select[name="id_merk"]').select2();
            $('select[name="id_satuan"]').select2();
            $('select[name="version"]').select2();
            $('select[name="id_tipe_barang"]').on('change', function() {
                Livewire.emit('changeTipeBarang', $(this).val())
            })

            $('select[name="id_merk"]').on('change', function() {
                Livewire.emit('changeMerk', $(this).val())
            })

            $('select[name="id_satuan"]').on('change', function() {
                Livewire.emit('changeSatuan', $(this).val())
            })

            $('select[name="version"]').on('change', function() {
                Livewire.emit('changeVersion', $(this).val())
            })
        }

        Livewire.on("finishSimpanData", (status, message) => {
            $('#modal_form').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
