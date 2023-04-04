<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_permintaan_barang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Permintaan Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanPermintaanBarang" id="form_permintaan_barang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanPermintaanBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Proyek</label>
                                <select name="id_laporan_pekerjaan" class="form-select form-select-solid" wire:model="id_laporan_pekerjaan" data-control="select2" data-dropdown-parent="#modal_form_permintaan_barang" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listLaporanPekerjaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode_pekerjaan }}</option>
                                    @endforeach
                                </select>
                                @error('id_laporan_pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Barang</label>
                                <select name="id_barang" class="form-select form-select-solid" wire:model="id_barang" data-control="select2" data-dropdown-parent="#modal_form_permintaan_barang" data-placeholder="Pilih" required multiple>
                                    <option value="">Pilih</option>
                                    @foreach ($listBarang as $item)
                                        <option value="{{ $item->id }}">{{ $item->sku }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Peminjam</label>
                                <select name="peminjam" class="form-select form-select-solid" wire:model="peminjam" data-control="select2" data-dropdown-parent="#modal_form_permintaan_barang" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listUser as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('peminjam')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Tipe Barang</label>
                                <select name="id_tipe_barang" class="form-select form-select-solid" wire:model="id_tipe_barang" data-control="select2" data-dropdown-parent="#modal_form_permintaan_barang" data-placeholder="Pilih" required>
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
                                <label for="" class="form-label required">Version</label>
                                <select name="version" wire:model="version" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listVersion as $item)
                                        <option value="{{ $item }}">{{ $item }} V</option>
                                    @endforeach
                                </select>
                                @error('version')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Rak</label>
                                <select name="id_rak" class="form-select form-select-solid" wire:model="id_rak" data-control="select2" data-dropdown-parent="#modal_form_permintaan_barang" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listRak as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rak }} (Jumlah {{ $item->isiRak->whereIn('id_barang', $id_barang)->first() ? $item->isiRak->whereIn('id_barang', $id_barang)->sum('jumlah') : '-' }})</option>
                                    @endforeach
                                </select>
                                @error('id_rak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Jumlah</label>
                                <input type="number" name="qty" class="form-control form-control-solid" wire:model="qty" placeholder="Jumlah barang" required>
                                @error('qty')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Estimasi Kembali</label>
                                <input type="datetime-local" name="estimasi" class="form-control form-control-solid" wire:model="estimasi" required>
                                @error('estimasi')
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
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){
            $('#form_permintaan_barang select[name="id_laporan_pekerjaan"]').select2();
            $('#form_permintaan_barang select[name="id_barang"]').select2();
            $('#form_permintaan_barang select[name="peminjam"]').select2();
            $('#form_permintaan_barang select[name="id_tipe_barang"]').select2();
            $('#form_permintaan_barang select[name="version"]').select2();
            $('#form_permintaan_barang select[name="id_rak"]').select2();

            $('#form_permintaan_barang select[name="id_laporan_pekerjaan"]').on('change', function(){
                @this.set('id_laporan_pekerjaan', $(this).val())
            })

            $('#form_permintaan_barang select[name="id_barang"]').on('change', function(){
                @this.set('id_barang', $(this).val())
            })

            $('#form_permintaan_barang select[name="peminjam"]').on('change', function(){
                @this.set('peminjam', $(this).val())
            })

            $('#form_permintaan_barang select[name="id_tipe_barang"]').on('change', function(){
                @this.set('id_tipe_barang', $(this).val())
            })

            $('#form_permintaan_barang select[name="version"]').on('change', function(){
                @this.set('version', $(this).val())
            })

            $('#form_permintaan_barang select[name="id_rak"]').on('change', function(){
                @this.set('id_rak', $(this).val())
            })
        })


    </script>
@endpush
