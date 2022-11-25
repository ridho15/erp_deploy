<!DOCTYPE html>
<html lang="en">
@include('pdf_view.head')

<body class="p-10">
    @include('pdf_view.header')
    <div class="text-center fw-bold mb-10" style="font-size: 12pt">Laporan Pekerjaan</div>
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
                        <td>Merk</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->merk->nama_merk }}</span></td>
                    </tr>
                    <tr>
                        <td>No. Lift</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->nomor_lift }}</span></td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2">
                            </div>
                            <div class="mx-2" style="padding-left: 20px">Peminjaman suku cadang .... hari</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2">
                            </div>
                            <div class="mx-2" style="padding-left: 20px">Panggilan Darurat (Emergency Call)</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black;" class="mx-2">
                            </div>
                            <div class="mx-2" style="padding-left: 20px">Surver / General Check Up / Modernisasi</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2">
                            </div>
                            <div class="mx-2" style="padding-left: 20px">Pemasangan / ....</div>
                        </td>
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
    <br>
    <br>
    <br>
    <div class="mb-10">
        <div class="py-3 px-5"
            style="border: 1px solid black; border-top-left-radius: 10px; border-top-right-radius: 10px">
            Catatan Teknisi dan Keterangan Pekerja :
        </div>
        <div class="py-3 px-5"
            style="border: 1px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 100px;">
            {{ $laporanPekerjaan->keterangan }}
        </div>
    </div>
    <div class="mb-10">
        <div class="py-3 px-5"
            style="border: 1px solid black; border-top-left-radius: 10px; border-top-right-radius: 10px">
            Catatan Pelanggan :
        </div>
        <div class="py-3 px-5"
            style="border: 1px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 100px">
            {{ $laporanPekerjaan->catatan_pelanggan }}
        </div>
    </div>
    <br>
    <div>
        <table class="w-100">
            <tr style="width: 30%">
                <td>Tanggal : {{ $laporanPekerjaan->jam_mulai ? date('Y-m-d', strtotime($laporanPekerjaan->jam_mulai)) :
                    null }}</td>
                <td>Jam Datang : {{ $laporanPekerjaan->jam_mulai ? date('H:i', strtotime($laporanPekerjaan->jam_mulai))
                    : null }}</td>
                <td>Jam Selesai : {{ $laporanPekerjaan->jam_selesai ? date('H:i',
                    strtotime($laporanPekerjaan->jam_selesai)) : null }}</td>
            </tr>
            <tr style="width: 30%">
                <td>Diketahui Oleh,</td>
                <td>Diketahui Oleh,</td>
                <td>Diketahui Oleh,</td>
            </tr>
            <tr style="width: 30%">
                <td class="fw-bold">Kepala Teknik Divisi</td>
                <td class="fw-bold">Teknisi</td>
                <td class="fw-bold">Pelanggan</td>
            </tr>
            <tr style="width: 30%">
                <td>
                    <div style="height: 100px"></div>
                </td>
                <td>
                    <div style="height: 100px"></div>
                </td>
                <td>
                    <div style="height: 100px">
                        @if ($laporanPekerjaan->signature)
                        <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" height="100px" width="100"
                            style="object-fit: contain" alt="">
                        @endif
                    </div>
                </td>
            </tr>
            <tr style="width: 30%">
                <td>Nama:</td>
                <td>Nama: @foreach ($laporanPekerjaan->list_pekerja as $item)
                    {{ $item }},
                @endforeach</td>
                <td>Nama: {{ $laporanPekerjaan->customer ? $laporanPekerjaan->customer->nama : '-' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
