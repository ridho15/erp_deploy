<!DOCTYPE html>
<html lang="en">
    @include('pdf_view.head')
<body class="p-10">
    @include('pdf_view.header')
    <div>
        <div style="float: left; width: 50%;">Ref. No: 059/QT/SVC-ELV/MGK/III/21</div>
        <div style="float: right; width: 50%; text-align: right">Jakarta, 25 Maret 2021</div>
    </div>
    <br>
    <div>
        <span>Kepada Yth:</span><br>
        <span class="fw-bold">Bp.Hartono</span><br>
        <span>Jl. Kusuma Atmaja No. 27</span><br>
        <span>Menteng Jakarta Pusat</span>
    </div>
    <br>
    <table>
        <tr>
            <td class="fw-bold">Up</td>
            <td class="fw-bold">: Ibu Erni - 0813 2604 4482</td>
        </tr>
        <tr>
            <td class="fw-bold">Email</td>
            <td class="fw-bold">: ralamzah@gmail.com</td>
        </tr>
        <tr>
            <td class="fw-bold">Hal</td>
            <td class="fw-bold">: Penawaran General Check Up</td>
        </tr>
    </table>
    <br>
    <div>Dengan Hormat, <br>
        Bersama ini kami ajukan penawaran harga sebagai berikut:
        <table class="table">
            <thead class="border" style="border: 1px solid black;">
                <tr class="fw-semibold text-gray-800">
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Total Barang</th>
                </tr>
            </thead>
            <tbody class="border" style="border: 1px solid black;">
            @if (count($listKategori) > 0)
                @foreach ($listKategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->barangKategori->count() }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div>
        Keterangan:

        <ul>
            <li>Pengecekan terhadap sistem mekanik dan elektrik</li>
            <li>Pengecekan semua safety mekanik dan elektrik</li>
            <li>Memberikan laporan hasil pengecekan</li>
            <li>Memberikan laporan rekomendasi penggantian sparepart (jika ada)</li>
            <li>Jam kerja 08:30 – 17:30</li>
            <li>Cara pembayaran : 50% Uang Muka, 50% setelah pekerjaan selesai</li>
            <li>Masa penawaran : 2 (dua) minggu</li>
        </ul>
        <br>
        Atas Perhatiannya kami ucapkan terimakasih.
    </div>
    <br>
    <div>
        <span>Hormat Kami</span><br>
        <span style="font-weight: bold">
            PT. Mitra Global Kencana
        </span>
        <br>
        <img src="" alt="Tanda Tangan" height="100" width="100" style="object-fit: contain">
        <br>
        <span style="font-weight: bold;">Nama Orang</span><br>
        <span>Position</span>
    </div>
</body>
</html>
