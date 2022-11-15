<div>
    <div wire:ignore.self class="modal fade management-tugas" tabindex="-1" id="modal_form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Pekerjaan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanManagementTugas">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanManagementTugas', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Customer</label>
                                <select name="id_customer" wire:model="id_customer" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih Customer" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listCustomer as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_customer) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Project</label>
                                <select name="id_project" wire:model="id_project" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih Project" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listProject as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_project) selected @endif>{{ $item->nama }} - {{ $item->kode }}</option>
                                    @endforeach
                                </select>
                                @error('id_project')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Form</label>
                                <select name="id_form_master" wire:model="id_form_master" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih Project" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listFormMaster as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_form_master) selected @endif>{{ $item->nama }} - {{ $item->kode }}</option>
                                    @endforeach
                                </select>
                                @error('id_form_master')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Merk</label>
                                <select name="id_merk" wire:model="id_merk" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih Merk" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listMerk as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $id_merk) selected @endif>{{ $item->nama_merk }}</option>
                                    @endforeach
                                </select>
                                @error('id_merk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6" wire:ignore>
                                <label for="" class="form-label">Pekerja</label>
                                <select name="listIdUser" wire:model="listIdUser" class="form-select form-select-solid" multiple data-control="select2" data-dropdown-parent="#modal_form" multiple data-placeholder="Pilih">
                                    <option value="">Pilih</option>
                                    @foreach ($listUser as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ( {{(\App\CPU\Helpers::checkTeknisi($item->id)) }} Pekerjaan)</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6" wire:ignore>
                                <label for="tanggal">Tanggal Pekerjaan</label>
                                <input type="date" class="form-control form-control-solid" name="tanggal" wire:model="tanggal">
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Periode Pekerjaan</label>
                                <select name="periode" wire:model="periode" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih Periode" required>
                                    <option value="">Pilih</option>
                                    <option value="0">0 (Emergency Call)</option>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">1 Tahun</option>
                                </select>
                                @error('periode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-6">
                                <label for="" class="form-label required">Nomor Lift</label>
                                <input type="number" class="form-control form-control-solid" name="nomor_lift" wire:model="nomor_lift" placeholder="Masukkan nomor lift" required>
                                @error('nomor_lift')
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

        window.addEventListener('contentChange', function(){
            refreshSelect()
        })

        function refreshSelect(){
            $('select[name="id_customer"]').select2()
            $('select[name="id_project"]').select2()
            $('select[name="id_merk"]').select2()
            $('select[name="listIdUser"]').select2()
            $('select[name="id_form_master"]').select2()
            $('select[name="periode"]').select2()

            $('select[name="id_customer"]').on('change', function(){
                @this.set('id_customer', $(this).val())
            })

            $('select[name="id_project"]').on('change', function(){
                @this.set('id_project', $(this).val())
            })

            $('select[name="id_merk"]').on('change', function(){
                @this.set('id_merk', $(this).val())
            })

            $('select[name="listIdUser"]').on('change', function(){
                @this.set('listIdUser', $(this).val())
            })

            $('select[name="id_form_master"]').on('change', function(){
                @this.set('id_form_master', $(this).val())
            })

            $('select[name="periode"]').on('change', function(){
                @this.set('periode', $(this).val())
            })
        }

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
