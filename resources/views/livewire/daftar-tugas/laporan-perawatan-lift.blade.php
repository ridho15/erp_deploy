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
                                <th>Periode {{ $periode }}</th>
                                {{-- @if ($periode > 0)
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
                                @endif --}}
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listTemplatePekerjaan) > 0)
                                @foreach ($listTemplatePekerjaan as $index => $item)
                                <tr class="fw-bold">
                                    <td class="bg-success">{{ \App\CPU\Helpers::numberToLetter($loop->iteration) }}</td>
                                    <td class="bg-success">{{ $item->nama_pekerjaan }}</td>
                                    <td class="bg-success">
                                        @if ($item->kondisi != null)
                                            @foreach (json_decode($item->kondisi) as $kondisi)
                                                {{ $kondisi }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="bg-success"></td>
                                    {{-- @if ($periode > 0)
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
                                    @endif --}}
                                        <td class="bg-success"></td>
                                        <td class="bg-success"></td>
                                </tr>
                                    @foreach ($item->detail as $nomor => $value)
                                    <tr>
                                        <td class="text-end">{{ $nomor + 1 }}</td>
                                        <td>{{ $value->nama_pekerjaan }}</td>
                                        <td>
                                            @if ($value->kondisi != null)
                                                @if (is_array(json_decode($value->kondisi)))
                                                    @foreach (json_decode($value->kondisi) as $val)
                                                        {{ $val }}
                                                    @endforeach
                                                @endif
                                            @endif
                                        </td>
                                        @if ($periode == 1)
                                        <td class="text-center" wire:ignore>
                                            {{--
                                            <?= $value->detail ?> --}}
                                            @if (1 == $value->periode)
                                                @php
                                                    $periodeKondisiLift = null;
                                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                    if ($laporanPekerjaanChecklist) {
                                                        $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 1)->first();
                                                        if ($periodeKondisiLift) {
                                                            $periodeKondisiLift = $periodeKondisiLift->id_kondisi;
                                                        }
                                                    }
                                                @endphp
                                                <select name="kondisi1" class="form-select form-select-solid id-kondisi1"
                                                    data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                    <option value="">Pilih kondisi</option>
                                                    @foreach ($listKondisi as $kondisi)
                                                    <option value="{{ $kondisi->id }}" @if($kondisi->id == $periodeKondisiLift) selected @endif>{{ $kondisi->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <i class="fas fa-times-circle fs-2x text-danger"></i>
                                            @endif
                                        </td>
                                        @endif
                                        @if ($periode == 2)
                                        <td class="text-center" wire:ignore>
                                            @if (2 == $value->periode)
                                                @php
                                                    $periodeKondisiLift = null;
                                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                    if ($laporanPekerjaanChecklist) {
                                                        $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 2)->first();
                                                        if ($periodeKondisiLift) {
                                                            $periodeKondisiLift = $periodeKondisiLift->id_kondisi;
                                                        }
                                                    }
                                                @endphp
                                                <select name="kondisi2" class="form-select form-select-solid id-kondisi"
                                                    data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                    <option value="">Pilih kondisi</option>
                                                    @foreach ($listKondisi as $kondisi)
                                                    <option value="{{ $kondisi->id }}" @if($kondisi->id == $periodeKondisiLift)
                                                        selected @endif>{{ $kondisi->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            {{-- @else
                                                <i class="fas fa-times-circle fs-2x text-danger"></i> --}}
                                            @endif
                                        </td>
                                        @endif
                                        @if ($periode == 3)
                                        <td class="text-center" wire:ignore>
                                            @if (3 == $value->periode)
                                                @php
                                                    $periodeKondisiLift = null;
                                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                    if ($laporanPekerjaanChecklist) {
                                                        $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 3)->first();
                                                        if ($periodeKondisiLift) {
                                                            $periodeKondisiLift = $periodeKondisiLift->id_kondisi;
                                                        }
                                                    }
                                                @endphp
                                                <select name="kondisi3" class="form-select form-select-solid id-kondisi"
                                                    data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                    <option value="">Pilih kondisi</option>
                                                    @foreach ($listKondisi as $kondisi)
                                                    <option value="{{ $kondisi->id }}" @if($kondisi->id == $periodeKondisiLift)
                                                        selected @endif>{{ $kondisi->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <i class="fas fa-times-circle fs-2x text-danger"></i>
                                            @endif
                                        </td>
                                        @endif
                                        @if ($periode == 6)
                                        <td class="text-center" wire:ignore>
                                            @if (6 == $value->periode)
                                                @php
                                                    $periodeKondisiLift = null;
                                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                    if ($laporanPekerjaanChecklist) {
                                                        $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 6)->first();
                                                        if ($periodeKondisiLift) {
                                                            $periodeKondisiLift = $periodeKondisiLift->id_kondisi;
                                                        }
                                                    }

                                                @endphp
                                                <select name="kondisi6" class="form-select form-select-solid id-kondisi" data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                    <option value="">Pilih kondisi</option>
                                                    @foreach ($listKondisi as $kondisi)
                                                        <option value="{{ $kondisi->id }}" @if ($kondisi->id == $periodeKondisiLift) selected @endif>{{ $kondisi->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <i class="fas fa-times-circle fs-2x text-danger"></i>
                                            @endif
                                        </td>
                                        @endif
                                        @if ($periode == 12)
                                        <td class="text-center" wire:ignore>
                                            @if (12 == $value->periode)
                                                @php
                                                    $periodeKondisiLift = null;
                                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                    if ($laporanPekerjaanChecklist) {
                                                        $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 12)->first();
                                                        if ($periodeKondisiLift) {
                                                            $periodeKondisiLift = $periodeKondisiLift->id_kondisi;
                                                        }
                                                    }

                                                @endphp
                                                <select name="kondisi12" class="form-select form-select-solid id-kondisi"
                                                    data-control="select2" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                    <option value="">Pilih kondisi</option>
                                                    @foreach ($listKondisi as $kondisi)
                                                    <option value="{{ $kondisi->id }}" @if($kondisi->id == $periodeKondisiLift)
                                                        selected @endif>{{ $kondisi->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <i class="fas fa-times-circle fs-2x text-danger"></i>
                                            @endif
                                        </td>
                                        @endif
                                        <td wire:ignore>
                                            @php
                                                $keterangan = null;
                                                $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $value->id)->first();
                                                if($laporanPekerjaanChecklist){
                                                    $keterangan = $laporanPekerjaanChecklist->keterangan;
                                                }
                                            @endphp
                                            <textarea name="keterangan" class="form-control form-control-solid" data-id_template_pekerjaan_detail="{{ $value->id }}">{{ $keterangan }}</textarea>
                                        </td>
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
                                <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
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
                id_kondisi = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail')
                Livewire.emit('setKondisi1', 1, id_kondisi, id_template_pekerjaan_detail)
            })
            $('select[name="kondisi2"]').on('change', function(){
                id_kondisi = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail')
                Livewire.emit('setKondisi2',2, id_kondisi, id_template_pekerjaan_detail)
            })
            $('select[name="kondisi3"]').on('change', function(){
                id_kondisi = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail')
                Livewire.emit('setKondisi3',3, id_kondisi, id_template_pekerjaan_detail)
            })
            $('select[name="kondisi6"]').on('change', function(){
                id_kondisi = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail')
                Livewire.emit('setKondisi6', 6, id_kondisi, id_template_pekerjaan_detail)
            })
            $('select[name="kondisi12"]').on('change', function(){
                id_kondisi = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail')
                Livewire.emit('setKondisi12', 12, id_kondisi, id_template_pekerjaan_detail)
            })

            $('textarea[name="keterangan"]').on('change', function(){
                keterangan = $(this).val()
                id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail');

                Livewire.emit('simpanKeterangan', keterangan, id_template_pekerjaan_detail)
            })
        }

</script>
@endpush
