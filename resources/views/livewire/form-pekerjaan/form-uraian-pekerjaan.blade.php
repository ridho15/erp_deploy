<div>
    <div wire:ignore.self class="modal fade project" tabindex="-1" id="modal_form_project_detail_sub">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Uraian Pekerjaan</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanProjectDetailSub">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanProjectDetailSub', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Bagian Dari Pekerjaan</label>
                                <select name="id_project_detail" class="form-select form-select-solid" wire:model="id_project_detail" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listProjectDetail as $item)
                                        <option value="{{ $item->id }}" wire:click="changeProjectDetail({{ $item->id }})">{{ $item->nama_pekerjaan }}</option>
                                    @endforeach
                                </select>
                                @error('id_project_detail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label required">Nama Pekerjaan</label>
                                <input type="text" class="form-control form-control-solid" name="nama_sub_pekerjaan" wire:model="nama_sub_pekerjaan" placeholder="Masukkan nama pekerjaan" required>
                                @error('nama_sub_pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 1 Bulan {{ $kondisi_1_bulan }}</label>
                                <select name="kondisi_1_bulan" class="form-select form-select-solid" wire:model="kondisi_1_bulan" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listKondisi as $item)
                                        <option value="{{ $item->id }}" wire:click="changeKondisi1Bulan({{ $item->id }})">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi_1_bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 2 Bulan</label>
                                <select name="kondisi_2_bulan" class="form-select form-select-solid" wire:model="kondisi_2_bulan" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listKondisi as $item)
                                        <option value="{{ $item->id }}" wire:click="changeKondisi2Bulan({{ $item->id }})">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi_2_bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 3 Bulan</label>
                                <select name="kondisi_3_bulan" class="form-select form-select-solid" wire:model="kondisi_3_bulan" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listKondisi as $item)
                                        <option value="{{ $item->id }}" wire:click="changeKondisi3Bulan({{ $item->id }})">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi_3_bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 6 Bulan</label>
                                <select name="kondisi_6_bulan" class="form-select form-select-solid" wire:model="kondisi_6_bulan" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listKondisi as $item)
                                        <option value="{{ $item->id }}" wire:click="changeKondisi6Bulan({{ $item->id }})">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi_6_bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 1 Tahun</label>
                                <select name="kondisi_1_tahun" class="form-select form-select-solid" wire:model="kondisi_1_tahun" data-control="select2" data-dropdown-parent="#modal_form_project_detail_sub" data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listKondisi as $item)
                                        <option value="{{ $item->id }}" wire:click="changeKondisi1Tahun({{ $item->id }})">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                                @error('kondisi_1_tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="" class="form-label">Kondisi 1 Tahun</label>
                                <textarea name="keterangan" class="form-control form-control-solid" wire:model="keterangan" placeholder="Masukkan keterangan"></textarea>
                                @error('keterangan')
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

        window.addEventListener('contentChangeFormUraian', function(){
            $('select[name="id_project_detail"]').select2()
            $('select[name="kondisi_1_bulan"]').select2()
            $('select[name="kondisi_2_bulan"]').select2()
            $('select[name="kondisi_3_bulan"]').select2()
            $('select[name="kondisi_6_bulan"]').select2()
            $('select[name="kondisi_1_tahun"]').select2()
        })

        $('select[name="id_project_detail"]').on('change', function(){
            @this.set('id_project_detail', $(this).val())
        })

        $('select[name="kondisi_1_bulan"]').on('change', function(){
            console.log($(this).val());
            @this.set('kondisi_1_bulan', $(this).val())
        })

        $('select[name="kondisi_2_bulan"]').on('change', function(){
            @this.set('kondisi_2_bulan', $(this).val())
        })

        $('select[name="kondisi_3_bulan"]').on('change', function(){
            @this.set('kondisi_3_bulan', $(this).val())
        })

        $('select[name="kondisi_6_bulan"]').on('change', function(){
            @this.set('kondisi_6_bulan', $(this).val())
        })

        $('select[name="kondisi_1_tahun"]').on('change', function(){
            @this.set('kondisi_1_tahun', $(this).val())
        })


        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
            setTimeout(() => {
                location.reload()
            }, 500);
        })
    </script>
@endpush
