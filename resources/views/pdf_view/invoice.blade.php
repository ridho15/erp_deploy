<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}" media="all" />
    <meta http-equiv="Content-Type" content="text/html;"/>
    <style media="all">
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087c3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 18cm;
            height: 28cm;
            margin: 0 auto;
            color: #555555;
            background: #ffffff;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #aaaaaa;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087c3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087c3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #eeeeee;
            text-align: center;
            border-bottom: 1px solid #ffffff;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57b223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #ffffff;
            font-size: 1.6em;
            background: #57b223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #dddddd;
        }

        table .qty {}

        table .total {
            background: #57b223;
            color: #ffffff;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #ffffff;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #aaaaaa;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57b223;
            font-size: 1.4em;
            border-top: 1px solid #57b223;
        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087c3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #aaaaaa;
            padding: 8px 0;
            text-align: center;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .badge-danger {
            color: #fff;
            background-color: #f1416c;
        }

        .badge {
            color: #fff;
            display: inline-flex;
            align-items: center;
            padding: 2px 5px;
            border-radius: 4px;
        }

        .text-center {
            text-align: center;
        }

    </style>
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
                        <span class="badge badge-danger">Belum ada data barang</span>
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
