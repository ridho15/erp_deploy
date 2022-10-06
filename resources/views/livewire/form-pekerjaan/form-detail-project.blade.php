<div>
    <div wire:ignore.self class="modal fade project" tabindex="-1" id="modal_form_project_detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Project Detail</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataProjectDetail">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataProjectDetail', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Project</label>
                            <input type="text" class="form-control form-control-solid" value="{{ $project ? $project->nama_project : '-' }}" disabled>
                            @error('id_customer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama Pekerjaan</label>
                            <input type="text" class="form-control form-control-solid" name="nama_pekerjaan" wire:model="nama_pekerjaan" placeholder="Masukkan nama pekerjaan" required>
                            @error('nama_pekerjaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Pekerja</label>
                            <select name="id_user" wire:model="id_user" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_project_detail" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listPekerja as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->tipeUser->nama_tipe }}</option>
                                @endforeach
                            </select>
                            @error('id_user')
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
                        <div class="mb-5">
                            <label for="" class="form-label">Waktu Mulai</label>
                            <input type="text" class="form-control form-control-solid" name="jam_mulai" wire:model="jam_mulai" placeholder="Masukkan jam mulai">
                            @error('jam_mulai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Waktu Selesai</label>
                            <input type="text" class="form-control form-control-solid" name="jam_selesai" wire:model="jam_selesai" placeholder="Masukkan jam mulai">
                            @error('jam_selesai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-stack w-lg-50">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="diketahui_pelanggan" type="checkbox" value="1" wire:model="status" checked="checked"/>
                                <span class="form-check-label fw-semibold text-muted">
                                    Selesai
                                </span>
                            </label>
                            @error('status')
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
            $('input[name="jam_mulai"]').flatpickr({
                enableTime:true
            })
            $('input[name="jam_selesai"]').flatpickr({
                enableTime:true
            })
        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_user"]').select2()
            $('input[name="jam_mulai"]').flatpickr({
                enableTime:true
            })
            $('input[name="jam_selesai"]').flatpickr({
                enableTime:true
            })
        })

        $('select[name="id_user"]').on('change', function(){
            @this.set('id_user', $(this).val())
        })
    </script>
@endpush
