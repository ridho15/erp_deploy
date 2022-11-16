<div>
    <div wire:ignore.self class="modal fade template-pekerjaan" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Template Pekerjaan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanTemplatePekerjaan">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanTemplatePekerjaan', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Form Master</label>
                            <select name="id_form_master" class="form-select form-select-solid" wire:model="id_form_master" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listFormMaster as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $id_form_master) selected @endif>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_form_master')
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
                            <label for="" class="form-label">Kondisi</label>
                            <select name="kondisi" wire:model="kondisi" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" multiple>
                                <option value="">Pilih</option>
                                @foreach ($listKondisi as $item)
                                    <option value="{{ $item->keterangan }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            @error('kondisi')
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
            $('select[name="id_form_master"]').select2()
            $('select[name="kondisi"]').select2()
        })

        $('select[name="id_form_master"]').on('change', function(){
            @this.set('id_form_master', $(this).val())
        })

        $('select[name="kondisi"]').on('change', function(){
            @this.set('kondisi', $(this).val())
        })

        $('select[name="periode"]').on('change', function(){
            @this.set('periode', $(this).val())
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
