<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_detail_pekerjaan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Detail Pekerjaan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanDetailPekerjaan">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDetailPekerjaan', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Bagian Dari</label>
                            @if ($isParent == true)
                                <select name="id_template_pekerjaan" wire:model="id_template_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_detail_pekerjaan" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listTemplatePekerjaan as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_template_pekerjaan) selected @endif>{{ $item->nama_pekerjaan }}</option>
                                    @endforeach
                                </select>
                            @else
                                @if ($templatePekerjaanDetail)
                                    <input type="text" class="form-control form-control-solid" name="id_template_pekerjaan_detail" value="{{ $templatePekerjaanDetail->templatePekerjaan->nama_pekerjaan }}" disabled>
                                @endif
                            @endif
                            @error('id_template_pekerjaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" class="form-control form-control-solid" wire:model="periode">
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama Pekerjaan</label>
                            <input type="text" class="form-control form-control-solid" name="nama_pekerjaan" wire:model="nama_pekerjaan" placeholder="Masukkan nama pekerjaan">
                            @error('nama_pekerjaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @if ($isParent == true)
                            <div class="mb-5">
                                <label for="" class="form-label required">Periode</label>
                                <select name="periode_detail" wire:model="periode" class="form-select form-select-solid detail" data-control="select2" data-placeholder="Pilih" multiple required>
                                    <option value="">Pilih</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }} Bulan</option>
                                    @endfor
                                </select>
                                @error('periode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_edit_pekerjaan_detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Detail Pekerjaan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="updateDetailPekerjaan">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'updateDetailPekerjaan', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama Pekerjaan</label>
                            <input type="text" class="form-control form-control-solid" name="nama_pekerjaan" wire:model="nama_pekerjaan" placeholder="Masukkan nama pekerjaan">
                            @error('nama_pekerjaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-5">
                            <label for="" class="form-label required">Periode</label>
                            <select name="periode_detail" wire:model="periode" class="form-select form-select-solid detail" data-control="select2" data-placeholder="Pilih" multiple required>
                                <option value="">Pilih</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }} Bulan</option>
                                @endfor
                            </select>
                            @error('periode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
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
            $('select[name="id_template_pekerjaan"]').select2()
            $('select[name="periode_detail"]').select2()

            $('select[name="periode_detail"]').on('change', function(){
                @this.set('periode', $(this).val())
            })

            $('select[name="id_template_pekerjaan"]').on('change', function(){
                @this.set('id_template_pekerjaan', $(this).val())
            })
        })
    </script>
@endpush
