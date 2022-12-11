<div>
    <div wire:ignore.self class="modal fade user" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form User</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDataUser">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataUser', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="name" wire:model="name" placeholder="Masukkan nama" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Username</label>
                                <input type="text" class="form-control form-control-solid" name="username" wire:model="username" placeholder="Masukkan username" required>
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Password</label>
                                <input type="password" class="form-control form-control-solid" name="password" wire:model="password" placeholder="Masukkan password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="">Keterangan boleh dikosongkan ketika edit data</small>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Tipe User</label>
                                <select name="id_tipe_user" class="form-select form-select-solid" wire:model="id_tipe_user" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih tipe user" multiple required>
                                    <option value="">Pilih</option>
                                    @foreach ($listTipeUser as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_tipe }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipe_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" wire:model="jabatan" class="form-control form-control-solid" placeholder="Masukkan jabatan">
                                @error('jabatan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control form-control-solid" wire:model="email" placeholder="Masukkan email">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-solid" wire:model="phone" placeholder="Masukkan email">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5 d-flex flex-stack w-lg-50">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="is_active" checked="checked"/>
                                    <span class="form-check-label fw-semibold text-muted">
                                        Aktif
                                    </span>
                                </label>
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
            $('select[name="id_tipe_user"]').select2()
        })

        $('select[name="id_tipe_user"]').on('change', function(){
            console.log($(this).val());
            @this.set('id_tipe_user', $(this).val())
        })

        Livewire.on("finishSimpanData", (status, message) => {
            $('#modal_form').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
