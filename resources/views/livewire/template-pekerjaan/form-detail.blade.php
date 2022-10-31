<div>
    <div wire:ignore.self class="modal fade kostumer" tabindex="-1" id="modal_form_detail_pekerjaan">
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
                            <select name="id_template_pekerjaan" wire:model="id_template_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_detail_pekerjaan" data-placeholder="Pilih">
                                <option value="">Pilih</option>
                                @foreach ($listTemplatePekerjaan as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $id_template_pekerjaan) selected @endif>{{ $item->nama_pekerjaan }}</option>
                                @endforeach
                            </select>
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
                        {{-- <div class="mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="" class="form-label">Checklist</label>
                            <div class="d-flex flex-wrap align-items-center justify-content-evenly">
                                @if ($periode > 0)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="checklist_1_bulan" id="checklist_1_bulan"/>
                                    <label class="form-check-label" for="checklist_1_bulan">
                                        1 Bulan
                                    </label>
                                    @error('checklist_1_bulan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endif
                                @if ($periode > 1)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="checklist_2_bulan" id="checklist_2_bulan"/>
                                    <label class="form-check-label" for="checklist_2_bulan">
                                        2 Bulan
                                    </label>
                                    @error('checklist_2_bulan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endif
                                @if ($periode > 2)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="checklist_3_bulan" id="checklist_3_bulan"/>
                                    <label class="form-check-label" for="checklist_3_bulan">
                                        3 Bulan
                                    </label>
                                    @error('checklist_3_bulan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endif
                                @if ($periode > 5)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="checklist_6_bulan" id="checklist_6_bulan"/>
                                    <label class="form-check-label" for="checklist_6_bulan">
                                        6 Bulan
                                    </label>
                                    @error('checklist_6_bulan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endif
                                @if ($periode > 11)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="checklist_1_tahun" id="checklist_1_tahun"/>
                                    <label class="form-check-label" for="checklist_1_tahun">
                                        1 Tahun
                                    </label>
                                    @error('checklist_1_tahun')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endif
                            </div>
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

        })
    </script>
@endpush
