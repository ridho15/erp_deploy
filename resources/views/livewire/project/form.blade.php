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
                                <label for="" class="form-label required">Penanggung Jawab</label>
                                <input type="text" class="form-control form-control-solid" name="penanggung_jawab" wire:model="penanggung_jawab" placeholder="Masukkan nama" required>
                                @error('penanggung_jawab')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email" wire:model="email" placeholder="Masukkan email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">No Hp</label>
                                <input type="number" class="form-control form-control-solid" name="no_hp" wire:model="no_hp" placeholder="Masukkan no_hp" required>
                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Customer</label>
                                <select name="id_customer" class="form-select form-select-solid" wire:model="id_customer" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" required>
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
                                @error('catatan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Total Pekerjaan</label>
                                <input type="number" name="total_pekerjaan" wire:model="total_pekerjaan" class="form-control form-control-solid" placeholder="Masukkan total pekerjaan" required>
                                @error('total_pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">PIC</label>
                                <select name="listIdSales" wire:model="listIdSales" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" multiple>
                                    <option value="">Pilih</option>
                                    @foreach ($listSales as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('listIdSales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Lokasi (Link Map)</label>
                                <input name="map" wire:model="map" class="form-control form-control-solid" placeholder="Masukkan lokasi">
                                @error('map')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" wire:model="tanggal" class="form-control form-control-solid" placeholder="Masukkan tanggal">
                                @error('tanggal')
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
            refreshSelect()
        });

        function refreshSelect(){
            $('select[name="id_customer"]').select2()

            $('select[name="id_customer"]').on('change', function(){
                @this.set('id_customer', $(this).val())
            })

            $('select[name="listIdSales"]').select2();

            $('select[name="listIdSales"]').on('change', function(){
                @this.set('listIdSales', $(this).val())
            })
        }



        window.addEventListener('contentChange', function(){
            refreshSelect()
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
