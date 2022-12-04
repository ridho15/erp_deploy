<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_isi_rak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Isi Rak</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanIsiRak">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanIsiRak', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Rak</label>
                            <select name="id_rak" class="form-select form-select-solid" wire:model="id_rak" data-control="select2" data-dropdown-parent="#modal_form_isi_rak" disabled>
                                <option value="">Pilih</option>
                                @foreach ($listRak as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_rak }}  ({{ $item->kode_rak }})</option>
                                @endforeach
                            </select>
                            @error('id_rak')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" class="form-select form-select-solid" wire:model="id_barang" data-control="select2" data-dropdown-parent="#modal_form_isi_rak">
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->merk ? $item->merk->nama_merk : '-' }}</option>
                                @endforeach
                            </select>
                            @if ($barang)
                                @if (count($barang->isiRak) > 0)
                                    <small>Tersedia di rak :
                                        @foreach ($barang->isiRak as $item)
                                            @if ($item->rak)
                                                {{ $item->rak->kode_rak }} ({{ $item->jumlah }}),
                                            @endif
                                        @endforeach
                                    </small>
                                @else
                                    <small>Belum tersedia di rak</small>
                                @endif
                            @endif
                            @error('id_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control form-control-solid" wire:model="jumlah" placeholder="Masukkan jumlah" required>
                            @error('jumlah')
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

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_pindah_rak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Pindah Rak</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanPindahRak">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanPindahRak', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Rak</label>
                            <select name="id_rak" class="form-select form-select-solid" wire:model="id_rak" data-control="select2" data-dropdown-parent="#modal_form_pindah_rak">
                                <option value="">Pilih</option>
                                @foreach ($listRak as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_rak }}  ({{ $item->kode_rak }})</option>
                                @endforeach
                            </select>
                            @error('id_rak')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Barang</label>
                            <select name="id_barang" class="form-select form-select-solid" wire:model="id_barang" data-control="select2" data-dropdown-parent="#modal_form_pindah_rak" disabled>
                                <option value="">Pilih</option>
                                @foreach ($listBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->merk->nama_merk }}</option>
                                @endforeach
                            </select>
                            @if ($barang)
                                @if (count($barang->isiRak) > 0)
                                    <small>Tersedia di rak :
                                        @foreach ($barang->isiRak as $item)
                                            @if ($item->rak)
                                                {{ $item->rak->kode_rak }} ({{ $item->jumlah }}),
                                            @endif
                                        @endforeach
                                    </small>
                                @else
                                    <small>Belum tersedia di rak</small>
                                @endif
                            @endif
                            @error('id_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control form-control-solid" wire:model="jumlah" placeholder="Masukkan jumlah" required>
                            @error('jumlah')
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
        Livewire.on('finishSimpanData', (status, message) => {
            $(".modal").modal('hide')
            alertMessage(status, message)
        })

        window.addEventListener('contentChange', function(){
            $('select[name="id_rak"]').select2()
            $('select[name="id_barang"]').select2()
        })

        $('select[name="id_rak"]').on('change', function(){
            @this.set('id_rak', $(this).val())
        })

        $('select[name="id_barang"]').on('change', function(){
            Livewire.emit('changeBarang', $(this).val())
        })
    </script>
@endpush
