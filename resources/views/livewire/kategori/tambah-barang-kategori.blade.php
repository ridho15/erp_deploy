<div>
    <div wire:ignore.self class="modal fade tambah-kategori-barang" tabindex="-1" id="modal_tambah_barang_kategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Kategori Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataKategoriBarang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataKategoriBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" class="form-select form-select-solid" wire:model="id_barang" data-placeholder="Pilih" data-dropdown-parent="#modal_tambah_barang_kategori" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $id_barang) selected @endif>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Kategori</label>
                            <select name="id_kategori" class="form-select form-select-solid" wire:model="id_kategori" data-placeholder="Pilih" data-dropdown-parent="#modal_tambah_barang_kategori" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listKategori as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $id_kategori) selected @endif>{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
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
            $('select[name="id_kategori"]').select2();
            $('select[name="id_barang"]').select2();
        })

        $('select[name="id_barang"]').on('change', function(){
            @this.set('id_barang', $(this).val())
        })

        $('select[name="id_kategori"]').on('change', function(){
            @this.set('id_kategori', $(this).val())
        })

        Livewire.on("finishSimpanData", (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
