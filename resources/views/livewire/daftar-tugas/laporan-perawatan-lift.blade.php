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
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' =>
                'simpanLaporanPekerjaanChecklist,setIdLaporanPekerjaanChecklist', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    {{-- @include('helper.form-pencarian', ['model' => 'cari']) --}}
                </div>
            </div>

            <form action="#" method="POST" wire:submit.prevent="simpanLaporanPekerjaanChecklist">
                <div class="table-responsive">
                    <table class="table table-rounded border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>No</th>
                                <th>Nama Pekerjaan</th>
                                {{-- <th style="width: 200px;">Pekerjaan</th> --}}
                                <th style="width: 200px;">Kondisi</th>
                                <th style="width: 300px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listTemplatePekerjaan) > 0)
                                @php
                                    $nomor_level1 = 0;
                                @endphp
                                @foreach ($listTemplatePekerjaan as $item)
                                    <tr class="bg-light-success fw-bold">
                                        <td>{{ \App\CPU\Helpers::numberToLetter($nomor_level1 + 1) }}</td>
                                        <td>{{ $item->nama_pekerjaan }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @php
                                        $nomor_level2 = 0;
                                    @endphp
                                    @foreach ($item->detail as $value)
                                        @php
                                            $dataPekerjaanChecklist = \App\Models\LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $id_laporan_pekerjaan)
                                            ->where('id_template_pekerjaan_detail', $value->id)->first();
                                            $dataPekerjaan = null;
                                            if ($dataPekerjaanChecklist) {
                                                $dataPekerjaan = json_decode($dataPekerjaanChecklist->pekerjaan);
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $nomor_level2 + 1 }}</td>
                                            <td>{{ $value->nama_pekerjaan }}</td>
                                            <td>
                                                <div class="">
                                                    <select name="kondisi" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                        <option value="">Pilih</option>
                                                        @foreach ($listKondisi as $kondisi)
                                                            <option value="{{ $kondisi->keterangan }}" @if($dataPekerjaanChecklist && $kondisi->keterangan == $dataPekerjaanChecklist->kondisi) selected @endif>{{ $kondisi->keterangan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea name="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan" data-id_template_pekerjaan_detail="{{ $value->id }}">{{ $dataPekerjaanChecklist ? $dataPekerjaanChecklist->keterangan : null }}</textarea>
                                            </td>
                                        </tr>
                                        @php
                                            $nomor_level3 = 0;
                                        @endphp
                                        @foreach ($value->children as $child)
                                            @php
                                                $dataPekerjaanChecklist = \App\Models\LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $id_laporan_pekerjaan)
                                                ->where('id_template_pekerjaan_detail', $child->id)->first();
                                                $dataPekerjaan = null;
                                                if ($dataPekerjaanChecklist) {
                                                    $dataPekerjaan = json_decode($dataPekerjaanChecklist->pekerjaan);
                                                }
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ $nomor_level2 + 1 }}.{{ $nomor_level3 + 1 }} {{ $child->nama_pekerjaan }}</td>
                                                <td>
                                                    <div class="">
                                                        <select name="kondisi" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" data-id_template_pekerjaan_detail="{{ $value->id }}">
                                                            <option value="">Pilih</option>
                                                            @foreach ($listKondisi as $kondisi)
                                                                <option value="{{ $kondisi->keterangan }}" @if($dataPekerjaanChecklist && $kondisi->keterangan == $dataPekerjaanChecklist->kondisi) selected @endif>{{ $kondisi->keterangan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea name="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan" data-id_template_pekerjaan_detail="{{ $value->id }}">{{ $dataPekerjaanChecklist ? $dataPekerjaanChecklist->keterangan : null }}</textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @php
                                            $nomor_level2++;
                                        @endphp
                                    @endforeach
                                    @php
                                        $nomor_level1++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
            $('select[name="pekerjaan"]').select2();
            $('select[name="kondisi"]').select2();
        }

        $('select[name="pekerjaan"]').on('change', function(){
            const pekerjaan = $(this).val()
            const id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail');
            Livewire.emit('setPekerjaan', pekerjaan, id_template_pekerjaan_detail);
        })

        $('select[name="kondisi"]').on('change', function(){
            const kondisi = $(this).val()
            const id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail');
            Livewire.emit('setKondisi', kondisi, id_template_pekerjaan_detail);
        })

        $('textarea[name="keterangan"]').on('change', function(){
            const keterangan = $(this).val()
            const id_template_pekerjaan_detail = $(this).data('id_template_pekerjaan_detail');
            Livewire.emit('simpanKeterangan', keterangan, id_template_pekerjaan_detail)
        })

</script>
@endpush
