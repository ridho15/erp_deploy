@extends('template.layout')

@section('content')
    @livewire('tipe-pembayaran.data')
    @livewire('tipe-pembayaran.form')
    @livewire('import.tipe-pembayaran')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
