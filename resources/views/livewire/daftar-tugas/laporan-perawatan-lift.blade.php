<div>
    <div class="card shadow-sm" role="tabpanel">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Perawatan Lift
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' =>
                'simpanLaporanPekerjaanChecklist,setIdLaporanPekerjaanChecklist', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <form action="#" method="POST" wire:submit.prevent="simpanLaporanPekerjaanChecklist">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>No</th>
                                <th>Nama Pekerjaan</th>
                                <th style="width: 200px;">Pekerjaan</th>
                                @if ($periode > 0)
                                <th>Checklist 1 Bulan</th>
                                @endif
                                @if ($periode > 1)
                                <th>Checklist 2 Bulan</th>
                                @endif
                                @if ($periode > 2)
                                <th>Checklist 3 Bulan</th>
                                @endif
                                @if ($periode > 5)
                                <th>Checklist 6 Bulan</th>
                                @endif
                                @if ($periode > 11)
                                <th>Checklist 1 Tahun</th>
                                @endif
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listTemplatePekerjaan) > 0)
                            @foreach ($listTemplatePekerjaan as $index => $item)
                            <tr class="fw-bold">
                                <td class="bg-success">{{ \App\CPU\Helpers::numberToLetter($loop->iteration) }}</td>
                                <td class="bg-success">{{ $item->nama_pekerjaan }}</td>
                                <td class="bg-success"></td>
                                @if ($periode > 0)
                                <td class="bg-success"></td>
                                @endif
                                @if ($periode > 1)
                                <td class="bg-success"></td>
                                @endif
                                @if ($periode > 2)
                                <td class="bg-success"></td>
                                @endif
                                @if ($periode > 5)
                                <td class="bg-success"></td>
                                @endif
                                @if ($periode > 11)
                                <td class="bg-success"></td>
                                @endif
                                <td class="bg-success"></td>
                            </tr>
                            @foreach ($item->detail as $nomor => $value)
                            <tr>
                                <td class="text-end">{{ $nomor + 1 }}</td>
                                <td>{{ $value->nama_pekerjaan }}</td>
                                <td>
                                    <select name="pekerjaan[]" multiple="multiple"
                                        class="js-example-basic-multiple form-select form-select-solid id-kondisi"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih pekerjaan</option>
                                        @foreach ($listPekerjaan as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if(in_array($kondisi->id,
                                            json_decode($value->keterangan)))
                                            selected @endif>{{ $kondisi->keterangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                @if ($periode > 0)
                                <td class="text-center">
                                    {{--
                                    <?= $value->detail ?> --}}
                                    <select name="kondisi1" class="form-select form-select-solid id-kondisi1"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih kondisi</option>
                                        @foreach ($listKondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if($kondisi->id ==
                                            $value->checklist_1_bulan) selected @endif>{{ $kondisi->keterangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                @if ($periode > 1)
                                <td class="text-center">
                                    <select name="kondisi2" class="form-select form-select-solid id-kondisi"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih kondisi</option>
                                        @foreach ($listKondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if($kondisi->id ==
                                            $value->checklist_2_bulan)
                                            selected @endif>{{ $kondisi->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                @if ($periode > 2)
                                <td class="text-center">
                                    <select name="kondisi3" class="form-select form-select-solid id-kondisi"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih kondisi</option>
                                        @foreach ($listKondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if($kondisi->id ==
                                            $value->checklist_3_bulan)
                                            selected @endif>{{ $kondisi->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                @if ($periode > 5)
                                <td class="text-center">
                                    <select name="kondisi6" class="form-select form-select-solid id-kondisi"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih kondisi</option>
                                        @foreach ($listKondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if($kondisi->id ==
                                            $value->checklist_6_bulan)
                                            selected @endif>{{ $kondisi->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                @if ($periode > 11)
                                <td class="text-center">
                                    <select name="kondisi12" class="form-select form-select-solid id-kondisi"
                                        data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                        <option value="">Pilih kondisi</option>
                                        @foreach ($listKondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" @if($kondisi->id ==
                                            $value->checklist_12_bulan)
                                            selected @endif>{{ $kondisi->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endif
                                <td>
                                    <div
                                        class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                        <input name="statusPekerjaan" class="form-check-input" data-id_template_pekerjaan_detail="{{ $value->id }}" onclick="changeStatus({{ $value->id.','.$value->status }})" type="checkbox" value="{{ $value->status }}" @if ($value->status == 1)
                                            checked
                                        @endif
                                            id="kt_flexSwitchCustomDefault_1_1" />
                                        <label class="form-check-label" for="kt_flexSwitchCustomDefault_1_1">
                                            @if ($value->status == 1)
                                                Selesai
                                            @else
                                                Belum selesai
                                            @endif
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- <div class="text-end">
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-bs-placement="top"
                        title="Simpan Kondisi Lift">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div> --}}
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
            refreshSelect2()
        });

        window.addEventListener('contentChange', function(){
            // $('select[name="kondisi1"]').select2()
            refreshSelect2()
        })

        function changeStatus(id, val){
            console.log('val', id, val);
            var id_detail = id;
            var value = 0;
            if(val == 0){
                value = 1;
            }else{
                value = 0
            }

        }

        function refreshSelect2(){
            $('select[name="kondisi1"]').select2()
            $('select[name="kondisi2"]').select2()
            $('select[name="kondisi3"]').select2()
            $('select[name="kondisi6"]').select2()
            $('select[name="kondisi12"]').select2()
            $('select[name="pekerjaan[]"]').select2()

            $('input[name="statusPekerjaan"]').on('click', function(){
                var status = $(this).val();
                if(status == 0){
                    status = 1;
                }else{
                    status = 0
                }
                @this.set('statusPekerjaan', status)
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setStatus');
                // console.log('status', $(this).val())
            })

            $('select[name="pekerjaan[]"]').on('change', function(){
                @this.set('pekerjaan', $(this).val())
                console.log('pekerjaan', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setPekerjaan');
            })

            $('select[name="kondisi1"]').on('change', function(){
                @this.set('kondisi1', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setKondisi1')
            })
            $('select[name="kondisi2"]').on('change', function(){
                @this.set('kondisi2', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setKondisi2')
            })
            $('select[name="kondisi3"]').on('change', function(){
                @this.set('kondisi3', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setKondisi3')
            })
            $('select[name="kondisi6"]').on('change', function(){
                @this.set('kondisi6', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setKondisi6')
            })
            $('select[name="kondisi12"]').on('change', function(){
                @this.set('kondisi12', $(this).val())
                @this.set('templateListId', $(this).data('id_template_pekerjaan_detail'))
                Livewire.emit('setKondisi12')
            })
        }

</script>
@endpush
