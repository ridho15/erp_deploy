<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset($web_logo) }}">
        </div>
        <div id="company">
            <h2 class="name">{{ $web_name }}</h2>
            <div>{{ $web_alamat }}</div>
            <div>(+62) {{ (int)$web_phone }}</div>
            <div><a href="mailto:company@example.com">{{ $web_email }}</a></div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">INVOICE UNTUK:</div>
                <h2 class="name text-capitalize">{{ $preOrder->customer->nama }}</h2>
                <div class="address">{{ $preOrder->customer->alamat }}</div>
                <div class="email"><a href="mailto:{{ $preOrder->customer->email }}">{{ $preOrder->customer->email
                        }}</a></div>
            </div>
            <div id="invoice">
                <h1>INVOICE 3-2-1</h1>
                <div class="date">Tanggal Invoice: {{ $preOrder->updated_at }}</div>
                {{-- <div class="date">Due Date: 30/06/2014</div> --}}
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc">NAMA ITEM</th>
                    <th class="unit">HARGA ITEM</th>
                    <th class="qty">JUMLAH</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            @if (count($preOrder->preOrderDetail) > 0)
            <tbody>
                @php($total = [])
                @foreach ($preOrder->preOrderDetail as $p)
                @php($barang = App\CPU\Helpers::getBarang($p->id_barang))
                <tr>
                    @php($subtotal = $p->qty * $barang->harga)
                    <td class="no">01</td>
                    <td class="desc">
                        {{ $barang->nama }}
                    </td>
                    <td class="unit">{{ $barang->harga }}</td>
                    <td class="qty">{{ $p->qty }}</td>
                    <td class="total">{{ $subtotal }}</td>
                    @php(array_push($total, $subtotal))
                </tr>
                @endforeach
            </tbody>
            @else
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">
                        <span class="badge badge-danger p-2">Belum ada data barang</span>
                    </td>
                </tr>
            </tbody>
            @endif
            <tfoot>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>$5,200.00</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAX 25%</td>
                    <td>$1,300.00</td>
                </tr> --}}
                <tr>
                    @if (count($preOrder->preOrderDetail) > 0)
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>{{ array_sum($total) }}</td>
                    @endif
                </tr>
            </tfoot>
        </table>
        <div id="thanks">Terima Kasih!</div>
        <div id="notices">
            <div>Catatan:</div>
            <div class="notice">{!! $preOrder->keterangan !!}</div>
        </div>
    </main>
    <footer>
        Invoice dibuat dengan sistem otomatis dan merupakan bukti pembayaran yang sah tanpa tanda tangan.
    </footer>
</body>

</html>
