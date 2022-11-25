<div class="page-break"></div>
    @include('pdf_view.header')
    <div class="text-center fw-bold mb-10" style="font-size: 13pt">Laporan Perawatan Lift</div>
    <div class="mb-10">
        <div style="float: left; width: 50%">
            <div>
                <table>
                    <tr>
                        <td>Nomor Form</td>
                        <td>: {{ $laporanPekerjaan->formMaster->kode }}</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->customer->nama }}</span></td>
                    </tr>
                    <tr>
                        <td>Nama Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project ? $laporanPekerjaan->project->nama : '-' }}</span></td>
                    </tr>
                    <tr>
                        <td>Kode Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project ? $laporanPekerjaan->project->kode : '-' }}</span></td>
                    </tr>
                    <tr>
                        <td>Alamat Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project ? $laporanPekerjaan->project->alamat : '-' }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="float: right; width: 50%">
            <div>
                <table>
                    <tr>
                        <td>Perawatan Ke</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>MFG No.</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_mfg : '-' }}</span></td>
                    </tr>
                    <tr>
                        <td>No Unit</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_unit : '-' }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div>
        @php
        $periode = $laporanPekerjaan->periode;
        @endphp
        <table id="data">
            <thead style="border: 1px solid black">
                <tr>
                    <td class="align-items-center">NO</td>
                    <td class="align-items-center text-capitalize">URAIAN PEKERJAAN</td>
                    <td class="align-items-center text-center">PEKERJAAN</td>
                    {{-- <td
                    colspan="@if ($periode == 1) 1 @elseif($periode == 2) 2 @elseif($periode == 3) 3 @elseif($periode == 6) 4 @elseif($periode == 12) 5 @endif "
                        class="text-center align-items-center">CHECKLIST</td> --}}
                    <td class="align-items-center text-center">KETERANGAN</td>
                    <td class="align-items-center text-center">PERIODE {{ $periode }} BULAN</td>
                </tr>
                {{-- <tr>
                    @if ($periode > 0)
                        <td>1 Bulan</td>
                    @endif
                    @if ($periode > 1)
                        <td>2 Bulan</td>
                    @endif
                    @if ($periode > 2)
                        <td>3 Bulan</td>
                    @endif
                    @if ($periode > 5)
                        <td>6 Bulan</td>
                    @endif
                    @if ($periode > 11)
                        <td>1 Tahun</td>
                    @endif
                </tr> --}}
            </thead>
            <tbody style="border: 1px solid black">
                @foreach ($listTemplatePekerjaan as $item)
                <tr>
                    <td class="fw-bold text-capitalize">{{ \App\CPU\Helpers::numberToLetter($loop->iteration) }}</td>
                    <td class="fw-bold text-capitalize">{{ $item->nama_pekerjaan }}</td>
                    <td>
                        @if ($item->kondisi != null && is_array(json_decode($item->kondisi)))
                            @foreach (json_decode($item->kondisi) as $kondisi)
                                {{ $kondisi }}
                            @endforeach
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                    @foreach ($item->detail as $index => $detail)
                    @php
                        $laporanPekerjaanChecklist = count($laporanPekerjaan->laporanPekerjaanChecklist) > 0 ?
                        $laporanPekerjaan->laporanPekerjaanChecklist : null;
                        if ($laporanPekerjaanChecklist) {
                            $laporanPekerjaanChecklist = $laporanPekerjaanChecklist->where('id_template_pekerjaan_detail',
                            $detail->id)->first();
                        }
                    @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->nama_pekerjaan }}</td>
                            <td>
                                @if ($detail->kondisi != null)
                                    @if (is_array(json_decode($detail->kondisi)))
                                        @foreach (json_decode($detail->kondisi) as $val)
                                            {{ $val }}
                                        @endforeach
                                    @endif
                                @endif
                            </td>
                            {{-- @if ($periode > 0)
                                <td @if(0 < $detail->periode) style="background-color: black" @endif>
                                    <span class="badge me-1 badge-info  text-light">
                                        @php
                                            $periodeKondisiLift = null;
                                            $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                            if ($laporanPekerjaanChecklist) {
                                                $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 1)->first();
                                                if ($periodeKondisiLift) {
                                                    $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                                }
                                            }

                                            echo $periodeKondisiLift;
                                        @endphp
                                    </span>
                                </td>
                            @endif
                            @if ($periode > 1)
                                <td @if(1 < $detail->periode) style="background-color: black" @endif>
                                    <span class="badge me-1 badge-info  text-light">
                                        @php
                                            $periodeKondisiLift = null;
                                            $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                            if ($laporanPekerjaanChecklist) {
                                                $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 2)->first();
                                                if ($periodeKondisiLift) {
                                                    $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                                }
                                            }

                                            echo $periodeKondisiLift;
                                        @endphp
                                    </span>
                                </td>
                            @endif
                            @if ($periode > 2)
                                <td @if(2 < $detail->periode) style="background-color: black" @endif>
                                    <span class="badge me-1 badge-info  text-light">
                                        @php
                                            $periodeKondisiLift = null;
                                            $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                            if ($laporanPekerjaanChecklist) {
                                                $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 3)->first();
                                                if ($periodeKondisiLift) {
                                                    $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                                }
                                            }

                                            echo $periodeKondisiLift;
                                        @endphp
                                    </span>
                                </td>
                            @endif
                            @if ($periode > 5)
                                <td @if(5 < $detail->periode) style="background-color: black" @endif>
                                    <span class="badge me-1 badge-info  text-light">
                                        @php
                                            $periodeKondisiLift = null;
                                            $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                            if ($laporanPekerjaanChecklist) {
                                                $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 6)->first();
                                                if ($periodeKondisiLift) {
                                                    $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                                }
                                            }

                                            echo $periodeKondisiLift;
                                        @endphp
                                    </span>
                                </td>
                            @endif
                            @if ($periode > 11)
                                <td @if(11 < $detail->periode) style="background-color: black" @endif>
                                    <span class="badge me-1 badge-info  text-light">
                                        @php
                                            $periodeKondisiLift = null;
                                            $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                            if ($laporanPekerjaanChecklist) {
                                                $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', 12)->first();
                                                if ($periodeKondisiLift) {
                                                    $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                                }
                                            }

                                            echo $periodeKondisiLift;
                                        @endphp
                                    </span>
                                </td>
                            @endif --}}
                            <td>
                                @php
                                    $keterangan = null;
                                    $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                    if($laporanPekerjaanChecklist){
                                        $keterangan = $laporanPekerjaanChecklist->keterangan;
                                    }

                                    echo $keterangan;
                                @endphp
                                keterangan
                            </td>
                            <td>
                                <span class="badge me-1 badge-info  text-light">
                                    @php
                                        $periodeKondisiLift = null;
                                        $laporanPekerjaanChecklist = $laporanPekerjaan->laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                                        if ($laporanPekerjaanChecklist) {
                                            $periodeKondisiLift = $laporanPekerjaanChecklist->perawatanLiftKondisi->where('periode', $periode)->first();
                                            if ($periodeKondisiLift) {
                                                $periodeKondisiLift = $periodeKondisiLift->kondisi->keterangan;
                                            }
                                        }

                                        echo $periodeKondisiLift;
                                    @endphp
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
    </table>
    </div>
    <br>
    <br>
    <div>
        <div style="float: left; width: 50%">
            <span>Dilaksanakan Oleh :</span><br>
            <span class="fw-bold">Teknisi</span><br>
            <div style="height: 100px"></div><br>
            <span>Nama : @foreach ($laporanPekerjaan->list_pekerja as $item)
                {{ $item }},
            @endforeach</span>
        </div>
        <div style="float: right; width: 50%">
            <span>Diketahui Oleh :</span><br>
            <span class="fw-bold">Pelanggan</span><br>
            <div style="height: 100px">
                @if ($laporanPekerjaan->signature)
                <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" height="100" width="100"
                    style="object-fit: contain" alt="">
                @endif
            </div><br>
            <span>Nama : {{ $laporanPekerjaan->customer ? $laporanPekerjaan->customer->nama : '-' }}</span>
        </div>
    </div>
