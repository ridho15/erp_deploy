<!DOCTYPE html>
<html lang="en">
@include('pdf_view.head')

<body style="padding-top: 10px; padding-bottom: 10px; padding-right: 20px; padding-left: 20px;">
    <div class="container">
        @if (isset($show_back))
            <div style="text-align: center; margin-bottom: 10px">
                <a href="{{ route('quotation') }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>
        @endif
        @include('pdf_view.header')
        <div>
        </div>
        <div>
            <div style="float: left; width: 50%; margin-bottom: 10px">Ref. No: {{ $quotation->no_ref }}</div>
            <div style="float: right; width: 50%; text-align: right; margin-bottom: 10px">Jakarta,
                {{ $quotation->updated_at_formatted }}</div>
        </div>
        <br>
        <div>
            <span style="margin-bottom: 10px">Kepada Yth:</span><br>
            <span style="font-weight: bold; margin-bottom: 10px">{{ $quotation->projectUnit->project->customer->nama }}</span><br>
            <span style="margin-bottom: 10px">{{ $quotation->projectUnit->project->customer->alamat }}</span><br>
        </div>
        <br>
        <table>
            <tr>
                <td style="font-weight: bold;">Nama Project</td>
                <td style="font-weight: bold">:
                    {{ $quotation->projectUnit->project->nama }}
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">No Handphone</td>
                <td style="font-weight: bold">:
                    {{ $quotation->projectUnit->project->no_hp }}
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">Email</td>
                <td style="font-weight: bold">:
                    {{ $quotation->projectUnit->project->email }}
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">Hal</td>
                <td style="font-weight: bold">: {{ $quotation->hal }}</td>
            </tr>
        </table>
        <br>
        <div>Dengan Hormat, <br>
            Bersama ini kami ajukan penawaran harga sebagai berikut:
            <table id="data">
                <thead>
                    <tr>
                        <th style="width: 20px">No.</th>
                        <th>Nama Barang</th>
                        <th>Keterangan</th>
                        <th style="width: 50px">Jumlah</th>
                        <th>Satuan</th>
                        <th>Satuan Harga</th>
                        <th>Harga Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($quotation->quotationDetail) > 0)
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach ($quotation->quotationDetail as $index => $item)
                            @php
                                $subTotal += $item->qty * $item->harga;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->nama }}</td>
                                <td style="text-align: start">{{ $item->deskripsi }}</td>
                                <td style="text-align: end">{{ $item->qty }}</td>
                                <td style="text-align: center">{{ $item->satuan->nama_satuan }}</td>
                                <td style="text-align: end">{{ $item->harga_formatted }}</td>
                                <td style="text-align: end">{{ $item->sub_total_formatted }}</td>
                            </tr>
                        @endforeach
                        @php
                            $ppn = (10 / 100) * $subTotal;
                            $total = $subTotal + $ppn;
                        @endphp
                        <tr>
                            <td colspan="7" style="text-align: center; font-weight: bold; font-style: italic">Sub
                                Total</td>
                            <td style="font-weight: bold; text-align: end">
                                {{ 'Rp. ' . number_format($subTotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: center; font-weight: bold; font-style: italic">PPN
                                {{ $quotation->ppn }}%
                            </td>
                            <td style="font-weight: bold; text-align: end">
                                {{ 'Rp. ' . number_format($ppn, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: center; font-weight: bold; font-style: italic">Total
                            </td>
                            <td style="font-weight: bold; text-align: end">
                                {{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="7" style="text-align: center; font-weight: bold">Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div>
            Keterangan:
            <?= $quotation->keterangan ?>
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
            <br>
            <br>
            <br>
            <span style="font-weight: bold;">Nama : {{ $user->name }}</span><br>
            <span>Jabatan : {{ $user->jabatan }}</span>
        </div>
    </div>
</body>

</html>
