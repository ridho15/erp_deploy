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
                @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>Nama Pekerjaan</th>
                   <th>Keterangan</th>
                   <th>Checklist 1 Bulan</th>
                   <th>Checklist 2 Bulan</th>
                   <th>Checklist 3 Bulan</th>
                   <th>Checklist 6 Bulan</th>
                   <th>Checklist 1 Tahun</th>
                   <th>Kondisi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listTemplatePekerjaan) > 0)
                        @foreach ($listTemplatePekerjaan as $index => $item)
                            <tr class="fw-bold">
                                <td>#</td>
                                <td>{{ $item->nama_pekerjaan }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($item->detail as $nomor => $value)
                                <tr>
                                    <td>{{ $nomor + 1 }}</td>
                                    <td>{{ $value->nama_pekerjaan }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    <td><?= $value->checklist_1_bulan_formatted ?></td>
                                    <td><?= $value->checklist_2_bulan_formatted ?></td>
                                    <td><?= $value->checklist_3_bulan_formatted ?></td>
                                    <td><?= $value->checklist_6_bulan_formatted ?></td>
                                    <td><?= $value->checklist_1_tahun_formatted ?></td>
                                    <td>
                                        <select name="id_kondisi" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kondisi">
                                            <option value="">Pilih</option>
                                            @foreach ($listKondisi as $kondisi)
                                                <option value="{{ $kondisi->id }}">{{ $kondisi->kode }} - {{ $kondisi->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_kondisi"]').select2()
        })
    </script>
@endpush
