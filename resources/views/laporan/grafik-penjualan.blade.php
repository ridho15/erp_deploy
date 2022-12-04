@extends('template.layout')

@section('content')
    <div class="mb-5">
        @livewire('laporan.grafik-penjualan')
    </div>
    <div class="row">
        <div class="col-md-6">
            @livewire('laporan.top-produk')
        </div>
        <div class="col-md-6">
            @livewire('laporan.top-customer')
        </div>
        <div class="col-md-6">
            @livewire('laporan.tipe-pembayaran')
        </div>
        <div class="col-md-6">
            @livewire('laporan.status-pembayaran')
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
        });

    </script>
@endsection
